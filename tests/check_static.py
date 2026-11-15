"""Dependency-free regression checks for the PHP-to-Pages build.

The recorded CSS/JS/photo hashes come from the portfolio before conversion.
Browser viewport screenshots are a separate check; this does not emulate CSS.
"""
from pathlib import Path
from html.parser import HTMLParser
from collections import Counter
import argparse
import hashlib
import json
import re
import shutil
import subprocess
import tempfile

ROOT = Path(__file__).resolve().parent.parent
VOID = set('area base br col embed hr img input link meta param source track wbr'.split())


class Page(HTMLParser):
    def __init__(self, source):
        super().__init__(convert_charrefs=True)
        self.nodes = []
        self.stack = []
        self.feed(source)
        assert not self.stack, f'Unclosed elements: {self.stack}'

    def handle_starttag(self, tag, attrs):
        self.nodes.append((tag, dict(attrs)))
        if tag not in VOID:
            self.stack.append(tag)

    def handle_startendtag(self, tag, attrs):
        self.nodes.append((tag, dict(attrs)))

    def handle_endtag(self, tag):
        assert self.stack and self.stack[-1] == tag, f'Unexpected closing tag: {tag}'
        self.stack.pop()


def run_php(php, *args, cwd=ROOT):
    return subprocess.run([php, '-n', '-d', 'display_errors=stderr', '-d', 'error_reporting=-1', *args],
                          cwd=cwd, capture_output=True, timeout=30)


def verify(php, migration_baseline=None):
    output = ROOT / 'dist/index.html'
    html = output.read_text(encoding='utf-8')
    assert output.stat().st_size > 0
    direct = run_php(php, 'index.php')
    assert direct.returncode == 0 and not direct.stderr, direct.stderr.decode()
    assert direct.stdout == output.read_bytes() == (ROOT / 'index.html').read_bytes(), 'PHP and static output differ'
    assert not re.search(r'<\?(?:php\b|=)', html, re.I), 'Unprocessed PHP in HTML'
    page = Page(html)
    ids = [a['id'] for _, a in page.nodes if 'id' in a]
    assert len(ids) == len(set(ids)), 'Duplicate IDs'
    sections = [a.get('id') for tag, a in page.nodes if tag == 'section']
    assert sections == ['home', 'about', 'education', 'skills', 'interests', 'contact']
    for _, attrs in page.nodes:
        for key in ['aria-controls', 'aria-labelledby', 'aria-describedby']:
            assert all(target in ids for target in attrs.get(key, '').split()), (key, attrs)
    expected = json.loads((ROOT / 'tests/frontend-baseline.json').read_text())
    for key, tag in [('styles', 'style'), ('scripts', 'script')]:
        blocks = re.findall(fr'<{tag}(?:\s[^>]*)?>(.*?)</{tag}>', html, re.S)
        assert [hashlib.sha256(s.encode()).hexdigest() for s in blocks] == expected[key], f'Original {key} changed'
        if tag == 'script' and shutil.which('node'):
            for block in blocks:
                checked = subprocess.run(['node', '--check'], input=block.encode(), capture_output=True, timeout=20)
                assert checked.returncode == 0, checked.stderr.decode()
    assert hashlib.sha256((ROOT / 'profile.jpg').read_bytes()).hexdigest() == expected['photo_sha256']
    assert (ROOT / 'dist/profile.jpg').read_bytes() == (ROOT / 'profile.jpg').read_bytes()
    assert {p.name for p in (ROOT / 'dist').iterdir()} == {'index.html', 'profile.jpg', '.nojekyll'}
    print('PASS: PHP/static output is byte-identical; original CSS, JS, icons/assets, section structure and ARIA targets retained')

    # Read the actual PHP data to check that adding array items generates cards.
    inspection = run_php(php, '-r', '''ob_start(); require 'index.php'; ob_end_clean();
echo json_encode([
  'counts' => [count($strengths), count($education), count($skills), count($interests), count($contacts)],
  'escaped' => e('<script>' . chr(34) . chr(39) . '&'), 'roles' => $profile['roles'], 'name' => $profile['name']
], JSON_THROW_ON_ERROR);''')
    assert inspection.returncode == 0 and not inspection.stderr, inspection.stderr.decode()
    data = json.loads(inspection.stdout)
    card_classes = ['strength-card', 'education-card', 'skill-card', 'interest-card', 'contact-item']
    actual = [sum(css in a.get('class', '').split() for _, a in page.nodes) for css in card_classes]
    assert actual == data['counts'], (actual, data['counts'])
    assert data['escaped'] == '&lt;script&gt;&quot;&#039;&amp;', 'HTML escaping is unsafe'
    roles = next(a['data-roles'] for _, a in page.nodes if 'data-roles' in a)
    assert json.loads(roles) == data['roles']
    assert data['name'] in html
    print('PASS: PHP arrays generate the intended cards and role data; quotes, HTML and ampersands are escaped')

    if migration_baseline:
        original = Path(migration_baseline).read_text(encoding='utf-8')
        assert canonical(original) == canonical(html), 'Migration changed rendered markup/content'
        print('PASS: full original/generated DOM, attributes, icons and text match after insignificant whitespace normalization')

    # Failure injection runs only in a fresh temporary checkout with fake data.
    with tempfile.TemporaryDirectory(prefix='portfolio-build-test-') as directory:
        sandbox = Path(directory)
        (sandbox / 'scripts').mkdir()
        for item in ['index.php', 'profile.jpg', '.nojekyll', 'scripts/build.php']:
            shutil.copy2(ROOT / item, sandbox / item)
        (sandbox / '.env').write_text('TEST_ONLY=must-not-be-published')
        valid = (sandbox / 'index.php').read_text(encoding='utf-8')
        built = run_php(php, 'scripts/build.php', cwd=sandbox)
        assert built.returncode == 0 and not built.stderr, built.stderr.decode()
        assert not (sandbox / 'dist/.env').exists()
        before = (sandbox / 'dist/index.html').read_bytes()
        (sandbox / 'index.php').write_text(valid.replace("date_default_timezone_set('Asia/Manila');",
            "date_default_timezone_set('Asia/Manila'); trigger_error('Injected warning', E_USER_WARNING);", 1), encoding='utf-8')
        failed = run_php(php, 'scripts/build.php', cwd=sandbox)
        assert failed.returncode != 0 and b'Injected warning' in failed.stderr
        assert (sandbox / 'dist/index.html').read_bytes() == before, 'Partial output overwrote a valid build'
        (sandbox / 'index.php').write_text(valid.replace("'photo' => 'profile.jpg'", "'photo' => 'missing.jpg'", 1), encoding='utf-8')
        failed = run_php(php, 'scripts/build.php', cwd=sandbox)
        assert failed.returncode != 0 and b'not packaged' in failed.stderr
        (sandbox / 'index.php').write_text(valid, encoding='utf-8')
        (sandbox / 'dist/unexpected.php').write_text('<?php echo "test";')
        failed = run_php(php, 'scripts/build.php', cwd=sandbox)
        assert failed.returncode != 0 and b'Unexpected file' in failed.stderr
    print('PASS: warnings, missing assets and unexpected deployment files fail the build; unrelated root files are excluded')


def canonical(source):
    """Preserve inline whitespace, ignoring formatting between block elements."""
    class Tree(HTMLParser):
        def __init__(self):
            super().__init__(convert_charrefs=True)
            self.tokens = []
            self.raw = False

        def handle_starttag(self, tag, attrs):
            self.tokens.append(('start', tag, sorted(attrs)))
            self.raw = tag in ['script', 'style']

        def handle_startendtag(self, tag, attrs):
            self.tokens.append(('start', tag, sorted(attrs)))

        def handle_endtag(self, tag):
            self.tokens.append(('end', tag))
            self.raw = False

        def handle_data(self, data):
            if self.raw:
                self.tokens.append(('raw', data))
            elif data.strip():
                self.tokens.append(('text', ' '.join(data.split())))

    parser = Tree()
    parser.feed(source)
    return parser.tokens


if __name__ == '__main__':
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('--php', default='php', help='PHP CLI executable')
    parser.add_argument('--migration-baseline', help='Optional pre-conversion HTML for one-time full comparison')
    options = parser.parse_args()
    verify(options.php, options.migration_baseline)
