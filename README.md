# Kimberly Duero — Portfolio

The existing portfolio is developed in **PHP** and deployed as a static website
at <https://duerokim-dev.github.io/My_Profile/>. Its design, dark/light themes,
SVG icons, responsive breakpoints, animations, and contact form are preserved.
There are no frontend frameworks, Composer packages, or production PHP server.

**Edit `index.php` → commit → push to `main` → GitHub Actions renders PHP →
validated static HTML deploys to GitHub Pages.**

## Project files

```text
My_Profile/
├── index.php                      # Primary source: data, HTML, CSS, JavaScript
├── index.html                     # Generated local preview; ignored by Git
├── profile.jpg                    # Original portrait
├── .nojekyll                      # Static hosting compatibility marker
├── .gitignore
├── .github/workflows/deploy.yml    # Automatic build and Pages deployment
├── scripts/build.php              # PHP CLI renderer and output validation
├── tests/check_static.py           # Dependency-free build/regression checks
├── tests/frontend-baseline.json    # Original CSS/JS/photo fingerprints
└── dist/                          # Generated deployment files; ignored by Git
    ├── index.html
    ├── profile.jpg
    └── .nojekyll
```

`index.php` is the only page source. `index.html` and `dist/` are build outputs,
not a second implementation. They are deliberately untracked: committing them
would create stale output and duplicate the source maintained in PHP. A clean
checkout creates both by executing the build; neither is copied from PHP source
or converted by renaming a file.

## Edit content

Change the PHP arrays at the beginning of `index.php`:

- `$profile`: name, page title, rotating professional titles, biography, photo,
  email, phone, and Facebook address.
- `$navigation`: section links and labels.
- `$strengths`, `$education`, `$skills`, `$interests`: the existing repeated cards.
- `$contacts`: contact entries using the shared profile details.

Values render through `e()`, which escapes text and HTML attribute values with
UTF-8 and quote protection. The SVG map contains only trusted, fixed markup.
The copyright year is rendered by PHP using `Asia/Manila`; the original browser
JavaScript continues updating it when the page is viewed in a later year.

Keep the embedded CSS, JavaScript, class names, `data-*` attributes, section IDs,
and SVG definitions intact when editing content. All links to local assets must
remain relative, such as `profile.jpg`, so they work beneath `/My_Profile/`.
When introducing a new static asset, add it to the build script's asset allowlist
and update the corresponding asset check in `tests/check_static.py`.

## Local PHP preview

Use PHP 8.5 CLI with the DOM extension. The workflow installs this runtime;
local development requires PHP on your PATH. Python 3 and Node.js are used only
for checks, and are already available on GitHub's Ubuntu runner.

```sh
php -l index.php
php -l scripts/build.php
php -S 127.0.0.1:8000 -t .
```

Open **<http://127.0.0.1:8000/index.php>** explicitly. This executes the PHP
source; `/` could serve a previously generated `index.html` instead.

To generate and check the exact static version:

```sh
php scripts/build.php
python tests/check_static.py --php php
php -S 127.0.0.1:8001 -t dist
```

Open <http://127.0.0.1:8001/>. The build executes PHP with output buffering,
treats warnings as failures, validates output before writing it, and produces
both `index.html` and `dist/index.html` from the same rendered string. It needs
no HTTP request variables, database, environment secrets, or temporary web
server during the GitHub Actions build. Never edit generated HTML directly.

## GitHub Pages setup

The repository must use **GitHub Actions** as its publishing source, rather
than **Deploy from a branch**. This is a one-time repository setting:

1. Push the PHP source, build tools, tests, and workflow to `main`.
2. Open [Settings → Pages](https://github.com/duerokim-dev/My_Profile/settings/pages).
3. Under **Build and deployment → Source**, select **GitHub Actions**.
4. If the first run occurred before this setting changed, use **Run workflow**
   or rerun the workflow from the repository's
   [Actions tab](https://github.com/duerokim-dev/My_Profile/actions).

The workflow runs on pushes to `main` and on manual dispatch. It:

1. Checks out source with `actions/checkout` without persisting credentials.
2. Sets up supported PHP 8.5 using `shivammathur/setup-php`.
3. Lints the PHP files, executes the build, and runs regression checks.
4. Configures Pages with `actions/configure-pages`.
5. Uploads only `dist/` using `actions/upload-pages-artifact`.
6. Deploys with `actions/deploy-pages` in the `github-pages` environment.

The build job has `contents: read` and `pages: read`. The deployment job has
only `pages: write` and `id-token: write`. No personal token or repository secret
is required by the workflow. Deployment concurrency avoids interrupting an
in-progress Pages deployment. A failed build cannot reach the deployment job.

The output folder is an explicit allowlist, never a copy of the checkout.
`index.php`, build tools, tests, README, `.git`, and unrelated local files are
excluded. The `.nojekyll` marker is retained for compatibility; the Actions
artifact is already static and does not go through Jekyll.

This follows GitHub's
[custom Pages workflow documentation](https://docs.github.com/en/pages/getting-started-with-github-pages/using-custom-workflows-with-github-pages)
and PHP's [supported runtime policy](https://www.php.net/supported-versions.php).

## Contact form

The existing form validates in JavaScript and prepares an **Open email draft**
link. The visitor sends the message through their own email application.
Nothing is submitted to PHP, stored by this website, or POSTed to Pages.
The form never claims successful delivery. Direct email, phone, Facebook, and
the no-JavaScript `mailto:` fallback retain their existing behavior.

## Verification

`tests/check_static.py` checks PHP/static byte equivalence, original CSS and JS
fingerprints, JavaScript syntax when Node is available, section order, HTML
nesting, ARIA references, original portrait bytes, PHP array/card counts, role
data, and HTML escaping. It also injects test warnings, missing assets, and
unexpected deployment files in an isolated temporary folder to verify failures.
The build itself rejects empty output, unprocessed PHP, duplicate IDs, missing
sections/controls, invalid role data, broken anchors, unpackaged local paths,
and missing static assets.

The initial migration also compares the generated DOM, all attributes, SVGs,
and visible text against the pre-conversion page after formatting whitespace
normalization. Its CSS and JavaScript remain byte-for-byte identical, preserving
theme initialization, localStorage, Intersection Observer, animation timing,
reduced-motion support, and mobile interactions. Content edits do not require
updating frontend fingerprints. If a later intentional design, JavaScript, or
photo change is requested, review and update the relevant baseline hashes.

The automated checks do not take browser screenshots or inspect a live browser
console. For visual QA, compare PHP and static previews at 375, 768, 1024, and
1440 pixels in both themes; exercise theme persistence, navigation, reveals,
mobile menu, and contact validation. Repository settings and a successful live
Actions run must be verified separately from local build results.
