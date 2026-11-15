<?php
declare(strict_types=1);

// This is a CLI build tool, not a public backend route. Only its explicit
// output directory is uploaded to Pages; PHP and development files stay out.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 'stderr');
set_error_handler(static function (int $level, string $message, string $file, int $line): never {
    throw new ErrorException($message, 0, $level, $file, $line);
});

$root = dirname(__DIR__);
$output = $root . '/dist';
$assets = ['profile.jpg', '.nojekyll'];
$allowedFiles = array_merge(['index.html'], $assets);

function requireBuild(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function renderPortfolio(string $file): string
{
    // Isolate the template's data from build variables, and discard all partial
    // output on a warning/exception rather than publishing a broken page.
    ob_start();
    try {
        require $file;
        return (string) ob_get_clean();
    } catch (Throwable $error) {
        ob_end_clean();
        throw $error;
    }
}

try {
    foreach ($assets as $asset) {
        requireBuild(is_file($root . '/' . $asset), 'Missing static asset: ' . $asset);
        requireBuild(!is_link($root . '/' . $asset), 'Asset must be a regular file: ' . $asset);
    }
    $html = renderPortfolio($root . '/index.php');
    requireBuild(strlen(trim($html)) > 0, 'Rendered HTML is empty.');
    requireBuild(str_starts_with(ltrim($html), '<!doctype html>'), 'Missing HTML doctype.');
    requireBuild(!preg_match('/<\?(?:php\b|=)/i', $html), 'Unprocessed PHP found in rendered HTML.');

    // PHP's DOM extension is included in the workflow and standard CLI builds.
    $previousLibxml = libxml_use_internal_errors(true);
    $document = new DOMDocument();
    $loaded = $document->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NONET);
    libxml_clear_errors();
    libxml_use_internal_errors($previousLibxml);
    requireBuild($loaded, 'Rendered output is not an HTML document.');
    $xpath = new DOMXPath($document);
    $ids = [];
    foreach ($xpath->query('//*[@id]') as $element) {
        $id = $element->getAttribute('id');
        requireBuild(!isset($ids[$id]), 'Duplicate HTML id: ' . $id);
        $ids[$id] = true;
    }
    foreach (['home', 'about', 'education', 'skills', 'interests', 'contact'] as $section) {
        requireBuild($xpath->query('//main//section[@id="' . $section . '"]')->length === 1,
            'Missing portfolio section: ' . $section);
    }
    requireBuild($xpath->query('//h1[@id="hero-title"]')->length === 1, 'Missing profile heading.');
    foreach (['theme-toggle', 'menu-toggle'] as $class) {
        requireBuild($xpath->query('//button[contains(concat(" ", normalize-space(@class), " "), " ' . $class . ' ")]')->length === 1,
            'Missing interactive control: ' . $class);
    }
    foreach ($xpath->query('//*[@data-roles]') as $element) {
        $roles = json_decode($element->getAttribute('data-roles'), true, flags: JSON_THROW_ON_ERROR);
        requireBuild(is_array($roles) && count($roles) > 0, 'Role animation needs at least one role.');
    }
    foreach ($xpath->query('//*[@href or @src or @action]') as $element) {
        foreach (['href', 'src', 'action'] as $attribute) {
            if (!$element->hasAttribute($attribute)) {
                continue;
            }
            $url = $element->getAttribute($attribute);
            requireBuild($url !== '' && !str_starts_with($url, '/'), 'Use a relative asset/link: ' . $url);
            if (str_starts_with($url, '#')) {
                requireBuild(isset($ids[substr($url, 1)]), 'Missing anchor target: ' . $url);
            } elseif (!preg_match('/^[a-z][a-z\d+.-]*:/i', $url)) {
                $path = rawurldecode(explode('#', explode('?', $url, 2)[0], 2)[0]);
                requireBuild(in_array($path, $allowedFiles, true), 'Local link is not packaged: ' . $path);
            }
        }
    }
    $form = $xpath->query('//form[@id="contact-form"]')->item(0);
    requireBuild($form !== null && str_starts_with($form->getAttribute('action'), 'mailto:'),
        'The contact form must remain compatible with static hosting.');
    requireBuild(getimagesize($root . '/profile.jpg') !== false, 'Profile photograph is invalid.');

    // Never recursively copy the checkout. This allowlist prevents publishing
    // index.php, README, tests, .git, credentials, or unrelated local files.
    if (is_dir($output)) {
        foreach (new DirectoryIterator($output) as $file) {
            if ($file->isDot()) {
                continue;
            }
            requireBuild($file->isFile() && !$file->isLink() && in_array($file->getFilename(), $allowedFiles, true),
                'Unexpected file in dist; remove it before building: ' . $file->getFilename());
        }
    } else {
        requireBuild(mkdir($output, 0755, true), 'Cannot create dist directory.');
    }
    requireBuild(file_put_contents($output . '/index.html', $html, LOCK_EX) === strlen($html), 'Cannot write dist/index.html.');
    foreach ($assets as $asset) {
        requireBuild(copy($root . '/' . $asset, $output . '/' . $asset), 'Cannot copy asset: ' . $asset);
    }
    // Convenience preview output, from exactly the same render, never edited.
    requireBuild(file_put_contents($root . '/index.html', $html, LOCK_EX) === strlen($html), 'Cannot write preview index.html.');
    fwrite(STDOUT, 'Built dist/index.html and index.html (' . strlen($html) . " bytes); static assets verified.\n");
} catch (Throwable $error) {
    fwrite(STDERR, 'Build failed: ' . $error->getMessage() . "\n");
    exit(1);
} finally {
    restore_error_handler();
}
