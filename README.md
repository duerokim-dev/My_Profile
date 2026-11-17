# Kimberly Duero — Portfolio

The existing portfolio is developed in **PHP** and deployed as a static website
at <https://duerokim-dev.github.io/My_Profile/>. Its design, dark/light themes,
SVG icons, responsive breakpoints, animations, and contact form are preserved.
The page contains only HTML and embedded CSS rendered by PHP. There is no
JavaScript, frontend framework, Composer package, or production PHP server.

**Edit `index.php` → commit → push to `main` → GitHub Actions renders PHP →
validated static HTML deploys to GitHub Pages.**

## Project files

```text
My_Profile/
├── index.php                      # Primary source: PHP data, HTML, embedded CSS
├── index.html                     # Generated local preview; ignored by Git
├── profile.jpg                    # Original portrait
├── .nojekyll                      # Static hosting compatibility marker
├── .gitignore
├── .github/workflows/deploy.yml    # Automatic build and Pages deployment
├── scripts/build.php              # PHP CLI renderer and output validation
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
The copyright year is rendered by PHP using `Asia/Manila` and updates whenever
the static site is rebuilt.

Keep the embedded CSS, class names, section IDs,
and SVG definitions intact when editing content. All links to local assets must
remain relative, such as `profile.jpg`, so they work beneath `/My_Profile/`.
When introducing a new static asset, add it to the build script's asset allowlist
so the asset is packaged and its relative URL passes validation.

## Local PHP preview

Use PHP 8.5 CLI with the DOM extension. The workflow installs this runtime;
local development requires PHP on your PATH. No JavaScript runtime, Python,
package manager, or frontend build tool is required.

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

1. Push the PHP source, build tool, assets, and workflow to `main`.
2. Open [Settings → Pages](https://github.com/duerokim-dev/My_Profile/settings/pages).
3. Under **Build and deployment → Source**, select **GitHub Actions**.
4. If the first run occurred before this setting changed, use **Run workflow**
   or rerun the workflow from the repository's
   [Actions tab](https://github.com/duerokim-dev/My_Profile/actions).

The workflow runs on pushes to `main` and on manual dispatch. It:

1. Checks out source with `actions/checkout` without persisting credentials.
2. Sets up supported PHP 8.5 using `shivammathur/setup-php`.
3. Lints the PHP files, renders the page, and validates the output.
4. Configures Pages with `actions/configure-pages`.
5. Uploads only `dist/` using `actions/upload-pages-artifact`.
6. Deploys with `actions/deploy-pages` in the `github-pages` environment.

The build job has `contents: read` and `pages: read`. The deployment job has
only `pages: write` and `id-token: write`. No personal token or repository secret
is required by the workflow. Deployment concurrency avoids interrupting an
in-progress Pages deployment. A failed build cannot reach the deployment job.

The output folder is an explicit allowlist, never a copy of the checkout.
`index.php`, build tools, README, `.git`, and unrelated local files are
excluded. The `.nojekyll` marker is retained for compatibility; the Actions
artifact is already static and does not go through Jekyll.

This follows GitHub's
[custom Pages workflow documentation](https://docs.github.com/en/pages/getting-started-with-github-pages/using-custom-workflows-with-github-pages)
and PHP's [supported runtime policy](https://www.php.net/supported-versions.php).

## Contact form

The form uses HTML `required`, email type, and length constraints for browser
validation. **Open Email App** invokes the form's `mailto:` action; the visitor
reviews and sends the message in their configured email application. Support
for including form fields in the draft depends on the browser/email client.
The direct email link remains available. Nothing is submitted to PHP, stored
by the website, or POSTed to Pages, and the form never claims delivery.

## Verification

The PHP build rejects empty output, unprocessed PHP, script elements, inline
event handlers, script URLs, duplicate IDs, missing sections/native controls,
missing professional titles, broken anchors, unpackaged paths, and missing
assets. PHP warnings stop the build before partial rendered output is written.
Only allowlisted static files can be published.

## HTML/CSS-only interactions

- The existing palettes, layout, typography, portrait, SVGs, cards, responsive
  breakpoints, smooth anchor scrolling, and hover transitions are retained.
- The theme control is a keyboard-accessible checkbox styled with the existing
  sun/moon icons. CSS `light-dark()` and `:has()` follow the system theme and
  let visitors switch to its opposite. The choice is not saved across visits;
  there is no localStorage code. Older browsers fall back to the dark palette.
- The mobile menu uses the browser's native Popover API through HTML attributes,
  with CSS transitions. Toggle it with the menu button; Escape or a click outside
  dismisses it. After selecting a section, close the menu with the same button
  or by clicking outside. Older browsers show the links inline.
- Professional titles rotate with CSS keyframes, keeping both titles available
  to assistive technology. Hover pauses the rotation. Reduced motion shows the
  first title without animation.
- Fade-up, side entrance, staggered card, portrait, and timeline reveals use
  CSS animations. Supporting browsers tie them to scroll position with view
  timelines; otherwise entrance animations run at page load and content stays
  visible. Scroll-driven effects can reverse when scrolling back up.
- Named section timelines highlight navigation while scrolling where supported;
  other browsers highlight the selected URL fragment. Reduced motion disables
  movement, including smooth scrolling.

The CSS enhancements follow the documented
[view-timeline animation model](https://developer.mozilla.org/en-US/docs/Web/CSS/Reference/Properties/animation-timeline),
[light-dark theme selection](https://developer.mozilla.org/en-US/docs/Web/CSS/Reference/Values/color_value/light-dark),
and [HTML popover behavior](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Global_attributes/popover).
Browser screenshots are a separate visual check: inspect PHP and static previews
at 375, 768, 1024, and 1440 pixels in both themes. Verify the local build and a
successful live Actions run independently.
