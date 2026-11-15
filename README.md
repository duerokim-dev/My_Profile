# Kimberly Duero — Portfolio

A static portfolio ready for GitHub Pages. All page markup, styles, SVG icons,
and JavaScript are contained in `index.html`; the portrait is `profile.jpg`.
No build step, dependencies, or server runtime are required.

## Deploy

1. Commit these files and push them to the repository's `main` branch.
2. In **Settings → Pages → Build and deployment**, choose
   **Deploy from a branch**, **main**, and **/(root)**, then save.
3. Wait for the Pages deployment to finish in the repository's Actions tab.
4. Open <https://duerokim-dev.github.io/My_Profile/>.

The root-level `.nojekyll` file tells Pages to publish the static files directly.
Keep `profile.jpg` next to `index.html`. Its relative URL and the page's fragment
links work both at the domain root and under `/My_Profile/`.

## Contact form

The form validates inputs in the browser and prepares an **Open email draft**
link. The visitor reviews and sends the message from their own email app.
The site never claims to have sent a message and does not store form entries or
POST them to GitHub Pages. Direct email, phone, and Facebook links remain available.
With JavaScript disabled, the form uses its `mailto:` action instead.

## Edit and preview

Edit the content directly in `index.html`. The footer year updates in JavaScript;
its static fallback remains readable without scripts. Keep the embedded CSS and
JavaScript in this file when making changes.

For a local preview, run `python -m http.server 8000` from the repository root,
then open <http://localhost:8000/>. PHP is not needed.
