<?php
declare(strict_types=1);

// Edit portfolio content here. CSS, markup hooks, and JavaScript below are the
// existing portfolio implementation, shared by PHP preview and static builds.
date_default_timezone_set('Asia/Manila');

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$profile = [
    'first_name' => 'Kimberly',
    'last_name' => 'Duero',
    'page_title' => 'Design, Data & Possibility',
    'description' => 'Kimberly Duero — IT student at Mater Dei College, exploring UI/UX design and data analytics. Get to know my interests, education, and skills.',
    'roles' => [
        'Aspiring UI/UX Designer',
        'Future Data Analytics Specialist'
    ],
    'hero_description' => 'Exploring the space where thoughtful design meets meaningful data. I’m an IT student shaping a future in UI/UX design and data analytics.',
    'biography' => [
        'I’m Kimberly, an Information Technology student at Mater Dei College. I’m drawn to the way design and data can work together: one helps us understand people, the other helps us ask better questions.',
        'My goal is to grow into a UI/UX designer and data analytics specialist, creating digital experiences that feel intuitive and turning information into something useful.'
    ],
    'email' => 'carlynkate1@gmail.com',
    'phone' => '09507653822',
    'phone_uri' => 'tel:+639507653822',
    'facebook' => 'https://www.facebook.com/kimberly.duero.2025/',
    'photo' => 'profile.jpg',
    'photo_alt' => 'Kimberly Duero smiling in a swimming pool',
    'photo_alt' => 'Kimberly Duero smiling inside the Mcdonald',
    'field' => 'Information Technology'
];
$profile['name'] = $profile['first_name'] . ' ' . $profile['last_name'];

// Numbers for the CSS-only rotating role text (replaces the old JavaScript timer).
$roleCount = max(1, count($profile['roles']));
$roleStep  = 4.5;                                   // seconds each role stays on screen
$roleCycle = round($roleCount * $roleStep, 2);      // full loop length
$roleSlice = round(100 / $roleCount, 2);            // % of the loop for one role
$roleFade  = round(0.25 / $roleCycle * 100, 2);     // % used for the fade in/out

$navigation = [
    [
        'id' => 'home',
        'label' => 'Home'
    ],
    [
        'id' => 'about',
        'label' => 'About Me'
    ],
    [
        'id' => 'education',
        'label' => 'Education'
    ],
    [
        'id' => 'skills',
        'label' => 'Skills'
    ],
    [
        'id' => 'interests',
        'label' => 'Interests'
    ],
    [
        'id' => 'contact',
        'label' => 'Contact'
@@ -64,13 +71,13 @@
$strengths = [
    [
        'icon' => 'design',
        'title' => 'A design perspective',
        'description' => 'Interested in the details that make an experience clear and approachable.'
        'title' => 'My design perspective',
        'description' => 'I design clean, user-friendly interfaces that put people first, turning ideas into layouts that feel clear, simple, and easy to use.'
    ],
    [
        'icon' => 'data',
        'title' => 'An analytical curiosity',
        'description' => 'Drawn to the questions and patterns behind the information.'
        'description' => 'I build clean, responsive websites that turn your ideas into effective, user-friendly digital solutions.'
    ],
    [
        'icon' => 'book',
@@ -94,7 +101,7 @@
        'icon' => 'design',
        'title' => 'Design',
        'subtitle' => 'A thoughtful visual perspective',
        'description' => 'An interest in shaping clear, considered digital experiences, with UI/UX design as a future direction.',
        'description' => 'I have the skills in creativity, turning an interest into digital reality shaping clear, considered digital experiences, with UI/UX design as a future direction.',
        'tags' => [
            'Design'
        ],
@@ -104,7 +111,7 @@
        'icon' => 'data',
        'title' => 'Data Analytics',
        'subtitle' => 'Curiosity behind the numbers',
        'description' => 'An interest in finding patterns, asking useful questions, and making information easier to understand.',
        'description' => 'Being interest in finding patterns, asking useful questions, and making information easier to understand is what makes me unique.',
        'tags' => [
            'Data Analytics'
        ],
@@ -309,19 +316,6 @@
      rel="icon"
      href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='16' fill='%23080B12'/%3E%3Ctext x='32' y='41' font-family='Arial' font-size='27' font-weight='bold' text-anchor='middle' fill='%2300D4FF'%3EKD%3C/text%3E%3C/svg%3E"
    />
    <script>
      (() => {
        let theme = "dark";
        let saved;
        try { saved = localStorage.getItem("portfolio-theme"); } catch {}
        if (saved === "light" || saved === "dark") theme = saved;
        else if (window.matchMedia?.("(prefers-color-scheme: light)").matches)
          theme = "light";
        document.documentElement.dataset.theme = theme;
        document.querySelector('meta[name="theme-color"]').content =
          theme === "light" ? "#F8FAFC" : "#080B12";
      })();
    </script>
    <style>
      /* FOUNDATION */
      /* Theme colors live here; components use semantic custom properties. */
@@ -369,7 +363,7 @@
        --width: 1180px;
        --ease: cubic-bezier(0.22, 1, 0.36, 1);
      }
      :root[data-theme="light"] {
      :root:has(#theme-check:checked) {
        color-scheme: light;
        --bg: #F8FAFC;
        --bg-alt: #EEF2F7;
@@ -633,8 +627,7 @@
          border-color 0.3s;
        isolation: isolate;
      }
      .header.scrolled,
      .header.menu-open {
      .header:has(#menu-check:checked) {
        background: var(--header-bg);
        border-color: var(--border);
        backdrop-filter: blur(18px);
@@ -1841,7 +1834,7 @@
            transform 0.22s,
            visibility 0.22s;
        }
        .nav.open {
        .header:has(#menu-check:checked) .nav {
          visibility: visible;
          opacity: 1;
          transform: none;
@@ -2192,11 +2185,11 @@
      .icon-button:hover { color: var(--cyan); border-color: var(--border-hover); }
      .theme-toggle[hidden] { display: none; }
      .theme-toggle .moon-icon { display: none; }
      [data-theme="light"] .theme-toggle .sun-icon { display: none; }
      [data-theme="light"] .theme-toggle .moon-icon { display: block; }
      :root:has(#theme-check:checked) .theme-toggle .sun-icon { display: none; }
      :root:has(#theme-check:checked) .theme-toggle .moon-icon { display: block; }
      .menu-toggle .close-icon { display: none; }
      .menu-toggle[aria-expanded="true"] .menu-icon { display: none; }
      .menu-toggle[aria-expanded="true"] .close-icon { display: block; }
      .header:has(#menu-check:checked) .menu-icon { display: none; }
      .header:has(#menu-check:checked) .close-icon { display: block; }
      .button:active, .icon-button:active { transform: translateY(1px); }
      .button:disabled { opacity: 0.65; transform: none; box-shadow: none; }
      .button .icon { transition: transform 250ms var(--ease); }
@@ -2275,18 +2268,88 @@
        .reveal.reveal-pending:not(.is-visible) { opacity: 1; transform: none; }
        .education-card.reveal-pending::before { transform: none; }
      }

      /* NO-JAVASCRIPT VERSION: CSS replacements for the removed script. */
      /* Hidden-but-focusable checkboxes drive the theme toggle and mobile menu. */
      .sr-check {
        position: absolute;
        width: 1px;
        height: 1px;
        min-height: 0;
        padding: 0;
        border: 0;
        margin: 0;
        opacity: 0;
        pointer-events: none;
      }
      .sr-check:focus-visible + .icon-button,
      .sr-check:focus-visible + .menu-toggle {
        outline: 2px solid var(--cyan);
        outline-offset: 3px;
      }
      .theme-toggle,
      .menu-toggle { cursor: pointer; }

      /* Header border fades in as the page scrolls (was the .scrolled class). */
      @supports (animation-timeline: scroll()) {
        .header {
          animation: header-border linear both;
          animation-timeline: scroll(root);
          animation-range: 0 60px;
        }
        @keyframes header-border {
          from { border-color: transparent; }
          to { border-color: var(--border); }
        }
      }

      /* Reveal on scroll (was IntersectionObserver). Unsupported browsers simply show everything. */
      @media (prefers-reduced-motion: no-preference) {
        @supports (animation-timeline: view()) {
          .reveal {
            animation: reveal-in linear backwards;
            animation-timeline: view();
            animation-range: entry 0% entry 35%;
          }
          @keyframes reveal-in {
            from {
              opacity: 0;
              transform: translate(var(--reveal-x), var(--reveal-y)) scale(var(--reveal-scale));
            }
            to { opacity: 1; transform: none; }
          }
        }
      }

      /* Rotating role text (was setInterval). Items are stacked and faded in turn. */
      .role-rotator { display: inline-grid; }
      .role-item {
        grid-area: 1 / 1;
        opacity: 0;
        animation: role-cycle <?= $roleCycle ?>s linear infinite;
        animation-delay: calc(var(--i) * <?= $roleStep ?>s);
      }
      .role-item::after {
        content: "|";
        color: var(--cyan);
        font-weight: 300;
        margin-left: 5px;
      }
      @keyframes role-cycle {
        0% { opacity: 0; transform: translateY(5px); }
        <?= $roleFade ?>% { opacity: 1; transform: none; }
        <?= round($roleSlice - $roleFade, 2) ?>% { opacity: 1; transform: none; }
        <?= $roleSlice ?>% { opacity: 0; transform: translateY(5px); }
        100% { opacity: 0; transform: translateY(5px); }
      }
      @media (prefers-reduced-motion: reduce) {
        .role-item:first-child { opacity: 1; }
      }

      /* Native form validation styling (was custom JavaScript errors). */
      input:user-invalid,
      textarea:user-invalid { border-color: var(--error-border); }
    </style>
    <noscript><style>
      .menu-toggle { display: none; }
      @media (max-width: 700px) {
        .header { position: static; }
        .header-inner { height: auto; min-height: 72px; flex-wrap: wrap; padding-block: 14px; }
        .header-actions { order: 1; }
        .brand { order: 0; }
        .nav { order: 2; position: static; flex-direction: row; flex-wrap: wrap;
          width: 100%; padding: 0; visibility: visible; opacity: 1; transform: none; box-shadow: none; }
      }
    </style></noscript>
  </head>
  <body>
    <a class="skip-link" href="#main">Skip to content</a>
@@ -2298,13 +2361,14 @@
        </a>
        <nav class="nav" id="primary-nav" aria-label="Main navigation">
          <?php foreach ($navigation as $link): ?>
          <a href="#<?= e($link['id']) ?>"<?php if ($link['id'] === 'home'): ?> class="active" aria-current="location"<?php endif; ?>><?= e($link['label']) ?></a>
          <a href="#<?= e($link['id']) ?>"><?= e($link['label']) ?></a>
          <?php endforeach; ?>
        </nav>
        <div class="header-actions">
          <button class="icon-button theme-toggle" type="button" aria-label="Switch to light theme" title="Switch to light theme" hidden>
          <input type="checkbox" id="theme-check" class="sr-check" aria-label="Switch between dark and light theme">
          <label for="theme-check" class="icon-button theme-toggle" title="Switch theme">
            <svg class="icon sun-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M2 12h2m16 0h2M5 5l1.4 1.4m11.2 11.2L19 19M5 19l1.4-1.4M17.6 6.4 19 5"/></svg><svg class="icon moon-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.8 13A9 9 0 0 1 11 3.2 9 9 0 1 0 20.8 13Z"/></svg>
          </button>
          </label>
        <a class="button header-cta" href="#contact"
          >Let’s Connect
          <svg
@@ -2319,15 +2383,10 @@
          >
            <path d="M7 17 17 7M7 7h10v10" /></svg
        ></a>
        <button
          class="menu-toggle"
          type="button"
          aria-label="Open navigation"
          aria-expanded="false"
          aria-controls="primary-nav"
        >
        <input type="checkbox" id="menu-check" class="sr-check" aria-label="Open or close navigation" aria-controls="primary-nav">
        <label for="menu-check" class="menu-toggle">
          <svg class="icon menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"/></svg><svg class="icon close-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 6 12 12M6 18 18 6"/></svg>
        </button>
        </label>
        </div>
      </div>
    </header>
@@ -2344,11 +2403,11 @@
            <p class="hero-intro">Hello, I’m</p>
            <h1 id="hero-title"><?= e($profile['first_name']) ?><span><?= e($profile['last_name']) ?>.</span></h1>
            <div class="role-line">
              <span
                class="role-text"
                data-roles="<?= e(json_encode($profile['roles'], JSON_THROW_ON_ERROR)) ?>"
                ><?= e($profile['roles'][0]) ?></span
              ><span class="role-cursor" aria-hidden="true">|</span>
              <span class="role-rotator">
                <?php foreach ($profile['roles'] as $roleIndex => $roleName): ?>
                <span class="role-item" style="--i: <?= (int) $roleIndex ?>"><?= e($roleName) ?></span>
                <?php endforeach; ?>
              </span>
            </div>
            <p class="hero-description"><?= e($profile['hero_description']) ?></p>
            <div class="hero-actions">
@@ -2813,7 +2872,7 @@
              class="button button-primary form-submit"
              aria-describedby="delivery-note"
            >
              <span>Check Message</span
              <span>Open Email Draft</span
              ><svg
                class="icon"
                viewBox="0 0 24 24"
@@ -2831,12 +2890,6 @@
              Nothing is sent or stored by this site. You send the message from
              your email app.
            </p>
            <noscript
              ><p class="form-note">
                JavaScript is off. Submitting this form opens your email app;
                you can also use the direct email link.
              </p></noscript
            >
          </form>
        </div>
      </section>
@@ -2886,317 +2939,5 @@
      </div>
    </footer>

    <script>
      (() => {
        "use strict";
        // Manual choices persist; unselected themes continue following the OS.
        const themeToggle = document.querySelector(".theme-toggle");
        const systemTheme = window.matchMedia("(prefers-color-scheme: light)");
        let hasThemeChoice = false;
        try {
          hasThemeChoice = ["dark", "light"].includes(localStorage.getItem("portfolio-theme"));
        } catch {}
        const applyTheme = (theme) => {
          document.documentElement.dataset.theme = theme;
          document.querySelector('meta[name="theme-color"]').content =
            theme === "light" ? "#F8FAFC" : "#080B12";
          const label = `Switch to ${theme === "dark" ? "light" : "dark"} theme`;
          themeToggle.setAttribute("aria-label", label);
          themeToggle.title = label;
        };
        applyTheme(document.documentElement.dataset.theme || "dark");
        themeToggle.hidden = false;
        themeToggle.addEventListener("click", () => {
          const theme = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
          hasThemeChoice = true;
          applyTheme(theme);
          try { localStorage.setItem("portfolio-theme", theme); } catch {}
        });
        systemTheme.addEventListener("change", (event) => {
          if (!hasThemeChoice) applyTheme(event.matches ? "light" : "dark");
        });
        window.addEventListener("storage", (event) => {
          if (event.key !== "portfolio-theme" && event.key !== null) return;
          hasThemeChoice = event.newValue === "dark" || event.newValue === "light";
          applyTheme(hasThemeChoice ? event.newValue : systemTheme.matches ? "light" : "dark");
        });

        const header = document.querySelector(".header");
        const menu = document.querySelector(".nav");
        const toggle = document.querySelector(".menu-toggle");
        const links = [...menu.querySelectorAll("a")];
        const reducedMotion = window.matchMedia(
          "(prefers-reduced-motion: reduce)",
        );
        const mobileViewport = window.matchMedia("(max-width: 700px)");

        const setMenu = (open, returnFocus = false) => {
          toggle.setAttribute("aria-expanded", String(open));
          toggle.setAttribute(
            "aria-label",
            open ? "Close navigation" : "Open navigation",
          );
          menu.classList.toggle("open", open);
          header.classList.toggle("menu-open", open);
          menu.inert = mobileViewport.matches && !open;
          if (returnFocus) toggle.focus();
        };
        toggle.addEventListener("click", () =>
          setMenu(toggle.getAttribute("aria-expanded") !== "true"),
        );
        links.forEach((link) =>
          link.addEventListener("click", () => setMenu(false)),
        );
        document.addEventListener("keydown", (event) => {
          if (
            event.key === "Escape" &&
            toggle.getAttribute("aria-expanded") === "true"
          )
            setMenu(false, true);
        });
        document.addEventListener("click", (event) => {
          if (!header.contains(event.target)) setMenu(false);
        });
        header
          .querySelectorAll('a[href="#home"], a[href="#contact"]')
          .forEach((link) =>
            link.addEventListener("click", () => setMenu(false)),
          );
        mobileViewport.addEventListener("change", () => setMenu(false));
        setMenu(false);

        const sections = [...document.querySelectorAll("main section[id]")];
        let scrollQueued = false;
        const updateScroll = () => {
          header.classList.toggle("scrolled", window.scrollY > 16);
          const reference = Math.min(window.innerHeight * 0.35, 250);
          let current = sections[0].id;
          sections.forEach((section) => {
            if (section.getBoundingClientRect().top <= reference)
              current = section.id;
          });
          if (
            window.innerHeight + window.scrollY >=
            document.documentElement.scrollHeight - 10
          )
            current = "contact";
          links.forEach((link) => {
            const active = link.hash === "#" + current;
            link.classList.toggle("active", active);
            if (active) link.setAttribute("aria-current", "location");
            else link.removeAttribute("aria-current");
          });
          scrollQueued = false;
        };
        window.addEventListener(
          "scroll",
          () => {
            if (!scrollQueued) {
              scrollQueued = true;
              requestAnimationFrame(updateScroll);
            }
          },
          { passive: true },
        );
        window.addEventListener("resize", updateScroll, { passive: true });
        updateScroll();

        // Stagger each grid locally. Reveal once; retain normal hover timing afterward.
        const reveals = [...document.querySelectorAll(".reveal")];
        document.querySelectorAll(".strength-grid, .skills-grid, .interests-grid, .timeline")
          .forEach((grid) => {
            [...grid.children].forEach((card, index) =>
              card.style.setProperty("--reveal-delay", `${Math.min(index, 3) * 90}ms`),
            );
          });
        let revealObserver;
        const showAll = () => {
          revealObserver?.disconnect();
          reveals.forEach((element) => {
            element.classList.remove("reveal-pending", "reveal-entering");
            element.classList.add("is-visible");
          });
        };
        if ("IntersectionObserver" in window && !reducedMotion.matches) {
          try {
            revealObserver = new IntersectionObserver((entries) => {
              entries.forEach(({ target, isIntersecting }) => {
                if (!isIntersecting) return;
                target.classList.add("reveal-entering");
                // The pending transform has already been painted offscreen.
                requestAnimationFrame(() => target.classList.add("is-visible"));
                window.setTimeout(() => {
                  target.classList.remove("reveal-pending", "reveal-entering");
                }, 1000);
                revealObserver.unobserve(target);
              });
            }, { threshold: 0.08, rootMargin: "0px 0px -24px 0px" });
            reveals.forEach((element) => {
              // Above-the-fold content is immediately available, even on slow devices.
              if (element.getBoundingClientRect().top < window.innerHeight - 24)
                element.classList.add("is-visible");
              else {
                revealObserver.observe(element);
                element.classList.add("reveal-pending");
              }
            });
          } catch { showAll(); }
        }
        reducedMotion.addEventListener("change", (event) => {
          if (event.matches) showAll();
        });
        // Keyboard focus always exposes its containing card before interaction.
        document.addEventListener("focusin", (event) => {
          const container = event.target.closest(".reveal");
          if (container) {
            container.classList.remove("reveal-pending", "reveal-entering");
            container.classList.add("is-visible");
            revealObserver?.unobserve(container);
          }
        });

        const role = document.querySelector(".role-text");
        const roles = JSON.parse(role.dataset.roles);
        let roleIndex = 0;
        window.setInterval(() => {
          if (reducedMotion.matches || document.hidden) return;
          role.classList.add("changing");
          window.setTimeout(() => {
            roleIndex = (roleIndex + 1) % roles.length;
            role.textContent = roles[roleIndex];
            role.classList.remove("changing");
          }, 250);
        }, 4500);

        // Static hosting has no mail server. Validate locally and offer an
        // email draft; never claim delivery or submit data to the host.
        document.querySelector("#copyright-year").textContent =
          new Date().getFullYear();
        const form = document.querySelector("#contact-form");
        const submit = form.querySelector('[type="submit"]');
        const submitLabel = submit.querySelector("span");
        const originalLabel = submitLabel.textContent;
        const fieldNames = ["name", "email", "subject", "message"];
        const status = document.createElement("div");
        status.className = "form-status";
        status.id = "form-status";
        status.setAttribute("role", "status");
        status.setAttribute("tabindex", "-1");
        status.hidden = true;
        form.querySelector(".form-grid").before(status);

        const clearError = (field) => {
          field.removeAttribute("aria-invalid");
          field.removeAttribute("aria-describedby");
          document.getElementById("error-" + field.name)?.remove();
        };
        const showError = (field, message) => {
          const error = document.createElement("span");
          error.className = "field-error";
          error.id = "error-" + field.name;
          error.textContent = message;
          field.setAttribute("aria-invalid", "true");
          field.setAttribute("aria-describedby", error.id);
          field.after(error);
        };
        const showStatus = (message) => {
          status.replaceChildren(document.createTextNode(message));
          status.hidden = false;
          form.classList.add("is-visible");
        };
        const resetSubmit = () => {
          form.classList.remove("submitting");
          form.removeAttribute("aria-busy");
          submit.disabled = false;
          submitLabel.textContent = originalLabel;
        };
        fieldNames.forEach((name) => {
          form.elements.namedItem(name).addEventListener("input", (event) => {
            clearError(event.target);
            status.hidden = true;
            status.replaceChildren();
          });
        });
        form.addEventListener("submit", (event) => {
          event.preventDefault();
          const values = {};
          let firstInvalid = null;
          fieldNames.forEach((name) => {
            const field = form.elements.namedItem(name);
            clearError(field);
            values[name] = field.value.trim();
            const length = Array.from(values[name]).length;
            let message = "";
            if (
              name === "name" &&
              (length < 2 || length > 100 || /[\r\n]/.test(values[name]))
            ) {
              message = "Enter a name between 2 and 100 characters.";
            } else if (
              name === "email" &&
              (!values[name] ||
                length > 254 ||
                field.validity.typeMismatch ||
                /[\r\n]/.test(values[name]))
            ) {
              message = "Enter a valid email address.";
            } else if (
              name === "subject" &&
              (length < 2 || length > 150 || /[\r\n]/.test(values[name]))
            ) {
              message = "Enter a subject between 2 and 150 characters.";
            } else if (name === "message" && (length < 10 || length > 5000)) {
              message = "Enter a message between 10 and 5,000 characters.";
            }
            if (message) {
              showError(field, message);
              firstInvalid ||= field;
            }
          });
          if (firstInvalid) {
            showStatus("Please check the highlighted fields and try again.");
            firstInvalid.focus();
            return;
          }
          form.classList.add("submitting");
          form.setAttribute("aria-busy", "true");
          submit.disabled = true;
          submitLabel.textContent = "Preparing draft…";
          window.setTimeout(() => {
            try {
              const recipient = form.getAttribute("action");
              const body =
                "Name: " +
                values.name +
                "\r\nEmail: " +
                values.email +
                "\r\n\r\n" +
                values.message;
              const draft = document.createElement("a");
              draft.className = "text-link";
              draft.textContent = "Open email draft";
              draft.href =
                recipient +
                "?subject=" +
                encodeURIComponent(values.subject) +
                "&body=" +
                encodeURIComponent(body);
              showStatus(
                "Your message is ready. It has not been sent. Open the draft and send it from your email app. ",
              );
              status.append(draft);
              status.focus({ preventScroll: true });
            } catch {
              showStatus(
                "The email draft could not be prepared. Please use the direct email link instead.",
              );
            } finally {
              resetSubmit();
            }
          }, 150);
        });
        window.addEventListener("pageshow", resetSubmit);
      })();
    </script>
  </body>
</html>
