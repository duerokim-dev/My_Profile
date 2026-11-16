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
    ]
];

$strengths = [
    [
        'icon' => 'design',
        'title' => 'My design perspective',
        'description' => 'I design clean, user-friendly interfaces that put people first, turning ideas into layouts that feel clear, simple, and easy to use.'
    ],
    [
        'icon' => 'data',
        'title' => 'An analytical curiosity',
        'description' => 'I build clean, responsive websites that turn your ideas into effective, user-friendly digital solutions.'
    ],
    [
        'icon' => 'book',
        'title' => 'A learning mindset',
        'description' => 'Building a foundation for a future at the intersection of design and data.'
    ]
];

$education = [
    [
        'icon' => 'graduation',
        'label' => 'Academic journey',
        'institution' => 'Mater Dei College',
        'degree' => 'Bachelor of Science in Information Technology',
        'description' => 'Building an IT foundation while exploring a path in design and data analytics.'
    ]
];

$skills = [
    [
        'icon' => 'design',
        'title' => 'Design',
        'subtitle' => 'A thoughtful visual perspective',
        'description' => 'I have the skills in creativity, turning an interest into digital reality shaping clear, considered digital experiences, with UI/UX design as a future direction.',
        'tags' => [
            'Design'
        ],
        'focus' => 'UI/UX design'
    ],
    [
        'icon' => 'data',
        'title' => 'Data Analytics',
        'subtitle' => 'Curiosity behind the numbers',
        'description' => 'Being interest in finding patterns, asking useful questions, and making information easier to understand is what makes me unique.',
        'tags' => [
            'Data Analytics'
        ],
        'focus' => 'Data analytics specialist'
    ]
];

$interests = [
    [
        'icon' => 'layout',
        'tag' => 'The human side of technology',
        'title' => 'UI/UX Design',
        'description' => 'Exploring how thoughtful layouts and interactions can make everyday digital experiences feel more intuitive.'
    ],
    [
        'icon' => 'trend',
        'tag' => 'The story inside the data',
        'title' => 'Data Exploration',
        'description' => 'Following a curiosity for patterns and insights, with the goal of becoming a data analytics specialist.'
    ]
];

$contacts = [
    [
        'icon' => 'mail',
        'label' => 'Email me',
        'href' => 'mailto:' . $profile['email'],
        'value' => $profile['email'],
        'external' => false
    ],
    [
        'icon' => 'phone',
        'label' => 'Call or text',
        'href' => $profile['phone_uri'],
        'value' => $profile['phone'],
        'external' => false
    ],
    [
        'icon' => 'facebook',
        'label' => 'Find me on Facebook',
        'href' => $profile['facebook'],
        'value' => $profile['name'],
        'external' => true
    ]
];

// SVG markup is a fixed, trusted map, never user-provided content.
function portfolioIcon(string $name): string
{
    static $icons = [
        'design' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path d="m14 4 6 6-8 8-8 2 2-8 8-8Z" />
                  <path d="m12 6 6 6M4 20l5-5" />
                  <circle cx="10" cy="14" r="1" />
                </svg>',
        'data' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path d="M4 4v16h16M8 15v-4m5 4V7m5 8v-6" />
                </svg>',
        'book' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path
                    d="M12 6c-3-2-6-2-9-1v14c3-1 6-1 9 1 3-2 6-2 9-1V5c-3-1-6-1-9 1Zm0 0v14"
                  />
                </svg>',
        'graduation' => '<svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path
                  d="m2 9 10-5 10 5-10 5-10-5Zm4 2v6c4 3 8 3 12 0v-6m4-2v8"
                />
              </svg>',
        'layout' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <rect x="3" y="3" width="18" height="18" rx="3" />
                  <path d="M3 9h18M9 9v12" /></svg
                >',
        'trend' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path d="M4 19V5m0 14h16M8 15l4-5 4 2 4-7"/></svg
                >',
        'mail' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <rect x="3" y="5" width="18" height="14" rx="3" />
                  <path d="m3 7 9 6 9-6" />
                </svg>',
        'phone' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path
                    d="m7 3 3 5-3 3a15 15 0 0 0 6 6l3-3 5 3c-1 5-5 5-10 2S3 10 3 6c0-2 2-3 4-3Z"
                  />
                </svg>',
        'facebook' => '<svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path
                    d="M14 21v-8h3l.5-4H14V7c0-1 .5-2 2-2h2V2h-3c-3 0-5 2-5 5v2H7v4h3v8"
                  />
                </svg>',
        'external' => '<svg
                      class="icon"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.6"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      aria-hidden="true"
                    >
                      <path d="M7 17 17 7M7 7h10v10" /></svg
                  >'
    ];
    if (!isset($icons[$name])) {
        throw new InvalidArgumentException('Unknown portfolio icon: ' . $name);
    }
    return $icons[$name];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#080B12" />
    <meta
      name="description"
      content="<?= e($profile['description']) ?>"
    />
    <title><?= e($profile['name']) ?> — <?= e($profile['page_title']) ?></title>
    <link
      rel="icon"
      href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='16' fill='%23080B12'/%3E%3Ctext x='32' y='41' font-family='Arial' font-size='27' font-weight='bold' text-anchor='middle' fill='%2300D4FF'%3EKD%3C/text%3E%3C/svg%3E"
    />
    <style>
      /* FOUNDATION */
      /* Theme colors live here; components use semantic custom properties. */
      :root {
        color-scheme: dark;
        --bg: #080B12;
        --bg-alt: #101827;
        --card: #151E2D;
        --cyan: #00D4FF;
        --blue: #2563EB;
        --text: #F1F5F9;
        --muted: #94A3B8;
        --soft-text: #C6D2E2;
        --subtle-text: #94A3B8;
        --border: #263449;
        --border-hover: #476681;
        --accent-text: #A9EAFA;
        --accent-border: #345267;
        --accent-surface: #00D4FF0A;
        --accent-hover: #00D4FF18;
        --primary-bg: #00D4FF;
        --primary-hover: #6EE7FF;
        --primary-text: #04141C;
        --surface-hover: #1B293C;
        --input-bg: #0C1420;
        --header-bg: #080B12EF;
        --menu-bg: #101827FA;
        --note-bg: #151E2DF5;
        --ambient: #132D4B40;
        --selection: #00D4FF45;
        --shadow: #00000026;
        --portrait-start: #193653;
        --photo-overlay: #061322CC;
        --photo-text: #F1F5F9;
        --photo-muted: #C6D3E3;
        --error: #FFC2C2;
        --error-border: #F99797;
        --notice-text: #FFE0CE;
        --notice-border: #886453;
        --notice-bg: #A9712410;
        --success-text: #B9F1D3;
        --success-border: #397862;
        --success-bg: #2D886912;
        --radius: 20px;
        --width: 1180px;
        --ease: cubic-bezier(0.22, 1, 0.36, 1);
      }
      :root:has(#theme-check:checked) {
        color-scheme: light;
        --bg: #F8FAFC;
        --bg-alt: #EEF2F7;
        --card: #FFFFFF;
        --cyan: #0891B2;
        --blue: #2563EB;
        --text: #0F172A;
        --muted: #475569;
        --soft-text: #334155;
        --subtle-text: #526278;
        --border: #E2E8F0;
        --border-hover: #94ADC6;
        --accent-text: #0E7490;
        --accent-border: #B8D8E4;
        --accent-surface: #0891B20A;
        --accent-hover: #0891B214;
        --primary-bg: #2563EB;
        --primary-hover: #1D4ED8;
        --primary-text: #FFFFFF;
        --surface-hover: #E7EDF5;
        --input-bg: #F8FAFC;
        --header-bg: #F8FAFCEF;
        --menu-bg: #FFFFFFFA;
        --note-bg: #FFFFFFF5;
        --ambient: #0891B212;
        --selection: #2563EB26;
        --shadow: #0F172A12;
        --portrait-start: #DCEAF5;
        --error: #B91C1C;
        --error-border: #DC2626;
        --notice-text: #854D0E;
        --notice-border: #D4AE6B;
        --notice-bg: #FEF9EF;
        --success-text: #166534;
        --success-border: #86B99A;
        --success-bg: #F0FDF4;
      }
      *,
      *::before,
      *::after {
        box-sizing: border-box;
      }
      html {
        scroll-behavior: smooth;
        scroll-padding-top: 110px;
      }
      body {
        margin: 0;
        background: var(--bg);
        color: var(--text);
        font-family: Inter, "Segoe UI", system-ui, Arial, sans-serif;
        font-size: 16px;
        line-height: 1.65;
        -webkit-font-smoothing: antialiased;
      }
      body::before {
        content: "";
        position: absolute;
        inset: 0 0 auto;
        height: 1000px;
        pointer-events: none;
        background: radial-gradient(
          ellipse at 84% 37%,
          var(--ambient),
          transparent 49%
        );
        z-index: -1;
      }
      ::selection {
        background: var(--selection);
        color: var(--text);
      }
      a {
        color: inherit;
        text-decoration: none;
      }
      button,
      input,
      textarea {
        font: inherit;
      }
      button,
      a {
        -webkit-tap-highlight-color: transparent;
      }
      button {
        cursor: pointer;
      }
      button:disabled {
        cursor: wait;
      }
      img {
        display: block;
        max-width: 100%;
      }
      h1,
      h2,
      h3,
      p {
        margin: 0;
      }
      h1,
      h2,
      h3 {
        line-height: 1.15;
        letter-spacing: -0.045em;
      }
      p {
        color: var(--muted);
      }
      button {
        color: inherit;
      }
      svg {
        flex-shrink: 0;
      }
      :focus-visible {
        outline: 2px solid var(--cyan);
        outline-offset: 5px;
      }
      a,
      button,
      input,
      textarea {
        touch-action: manipulation;
      }
      .icon {
        width: 22px;
        height: 22px;
        vertical-align: middle;
      }
      .container {
        width: min(var(--width), calc(100% - 96px));
        margin-inline: auto;
      }
      .section {
        padding-block: 108px;
        scroll-margin-top: 20px;
      }
      .eyebrow {
        font-size: 11px;
        letter-spacing: 0.19em;
        font-weight: 650;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--cyan);
      }
      .eyebrow::before {
        content: "";
        height: 1px;
        width: 25px;
        background: currentColor;
      }
      .section-heading {
        font-size: clamp(34px, 4vw, 50px);
        font-weight: 600;
        line-height: 1.18;
        margin-top: 18px;
      }
      .muted-heading {
        color: var(--subtle-text);
      }
      .section-lead {
        max-width: 440px;
        font-size: 15px;
      }
      .section-top {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 36px;
        margin-bottom: 45px;
      }
      .section-index {
        font-size: 11px;
        letter-spacing: 0.12em;
        color: var(--subtle-text);
        font-family: Consolas, monospace;
      }
      .section-divider {
        border-top: 1px solid var(--border);
      }
      .button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 13px;
        min-height: 51px;
        padding: 13px 23px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 650;
        transition:
          background 0.25s,
          transform 0.25s,
          border-color 0.25s;
        line-height: 1.4;
      }
      .button:hover {
        transform: translateY(-3px);
      }
      .button-primary {
        background: var(--primary-bg);
        color: var(--primary-text);
        box-shadow: 0 5px 24px var(--accent-surface);
      }
      .button-primary:hover {
        background: var(--primary-hover);
      }
      .button-secondary {
        background: var(--bg-alt);
        border-color: var(--border);
      }
      .button-secondary:hover {
        background: var(--surface-hover);
        border-color: var(--border-hover);
      }
      .button .icon {
        width: 17px;
        height: 17px;
      }
      .text-link {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        font-size: 13px;
        font-weight: 600;
      }
      .text-link:hover {
        color: var(--cyan);
      }
      .text-link .icon {
        width: 17px;
        height: 17px;
      }
      .skip-link {
        position: fixed;
        top: 12px;
        left: 12px;
        z-index: 100;
        transform: translateY(-160%);
        background: var(--primary-bg);
        color: var(--primary-text);
        padding: 10px 16px;
        border-radius: 6px;
      }
      .skip-link:focus {
        transform: none;
      }
      /* NAVIGATION */
      .header {
        position: sticky;
        top: 0;
        z-index: 50;
        border-bottom: 1px solid transparent;
        transition:
          background 0.3s,
          border-color 0.3s;
        isolation: isolate;
      }
      .header:has(#menu-check:checked) {
        background: var(--header-bg);
        border-color: var(--border);
        backdrop-filter: blur(18px);
      }
      .header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 90px;
        gap: 24px;
      }
      .logo {
        font-size: 26px;
        font-weight: 750;
        letter-spacing: -0.08em;
        line-height: 1;
      }
      .logo span {
        color: var(--cyan);
      }
      .brand {
        display: flex;
        align-items: center;
        gap: 14px;
      }
      .brand-caption {
        font-size: 9px;
        line-height: 1.55;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--subtle-text);
        border-left: 1px solid var(--border);
        padding-left: 14px;
      }
      .nav {
        display: flex;
        align-items: center;
        gap: 28px;
      }
      .nav a {
        position: relative;
        font-size: 12px;
        font-weight: 500;
        color: var(--soft-text);
        padding-block: 12px;
        transition: color 0.2s;
      }
      .nav a::after {
        position: absolute;
        content: "";
        height: 2px;
        bottom: 4px;
        left: 0;
        right: 0;
        background: var(--cyan);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.25s;
      }
      .nav a:hover,
      .nav a.active {
        color: var(--text);
      }
      .nav a:hover::after,
      .nav a.active::after {
        transform: scaleX(1);
      }
      .header-cta {
        min-height: 40px;
        padding: 9px 17px;
        font-size: 11px;
        border-color: var(--border);
        background: var(--bg-alt);
      }
      .menu-toggle {
        display: none;
        width: 44px;
        height: 44px;
        border: 1px solid var(--border);
        background: var(--bg-alt);
        border-radius: 8px;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 5px;
      }
      /* HERO */
      .hero {
        padding-top: 70px;
        padding-bottom: 0;
        position: relative;
      }
      .hero-grid {
        display: grid;
        grid-template-columns: 1.16fr 1fr;
        gap: 65px;
        align-items: center;
      }
      .hero-copy {
        padding-bottom: 20px;
      }
      .student-badge {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 7px 12px;
        border: 1px solid var(--border);
        border-radius: 100px;
        background: var(--accent-surface);
        color: var(--soft-text);
        font-size: 10px;
        letter-spacing: 0.08em;
      }
      .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--cyan);
        box-shadow: 0 0 12px var(--ambient);
      }
      .hero-intro {
        font-size: 18px;
        color: var(--soft-text);
        letter-spacing: -0.01em;
        margin-top: 27px;
        margin-bottom: 9px;
      }
      .hero h1 {
        font-size: clamp(58px, 6.4vw, 85px);
        font-weight: 650;
        letter-spacing: -0.065em;
        line-height: 1.06;
      }
      .hero h1 span {
        display: block;
        color: var(--cyan);
      }
      .role-line {
        margin-top: 21px;
        font-size: clamp(15px, 1.8vw, 20px);
        font-weight: 500;
        letter-spacing: -0.025em;
        min-height: 34px;
        color: var(--soft-text);
      }
      .role-text {
        display: inline-block;
        transition:
          opacity 0.25s,
          transform 0.25s;
      }
      .role-text.changing {
        opacity: 0;
        transform: translateY(5px);
      }
      .role-cursor {
        color: var(--cyan);
        font-weight: 300;
        margin-left: 5px;
        animation: blink 1.2s step-end infinite;
      }
      .hero-description {
        font-size: 15px;
        line-height: 1.85;
        max-width: 430px;
        margin-top: 16px;
      }
      .hero-actions {
        display: flex;
        gap: 13px;
        flex-wrap: wrap;
        margin-top: 29px;
      }
      .hero-note {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 29px;
        color: var(--subtle-text);
        font-size: 11px;
      }
      .hero-note .icon {
        width: 16px;
        height: 16px;
        color: var(--subtle-text);
      }
      .hero-note span + span {
        padding-left: 12px;
        border-left: 1px solid var(--border);
      }
      .portrait-stage {
        position: relative;
        padding: 19px 20px 24px 6px;
        isolation: isolate;
      }
      .portrait-stage::before {
        content: "";
        position: absolute;
        inset: 0 0 45px 26px;
        border: 1px solid var(--border-hover);
        border-radius: 160px 24px 24px 24px;
        z-index: -1;
      }
      .portrait-frame {
        height: 500px;
        overflow: hidden;
        border-radius: 145px 18px 18px 18px;
        border: 1px solid var(--border-hover);
        background: linear-gradient(140deg, var(--portrait-start), var(--bg-alt));
        box-shadow: 0 25px 80px var(--shadow);
        position: relative;
      }
      .portrait-frame::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(0deg, var(--photo-overlay), transparent 36%);
        pointer-events: none;
      }
      .portrait-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: 50% 63%;
        transition: transform 1.2s var(--ease);
      }
      .portrait-frame:hover img {
        transform: scale(1.025);
      }
      .photo-caption {
        position: absolute;
        bottom: 22px;
        left: 26px;
        right: 24px;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .photo-caption small {
        display: block;
        font-size: 9px;
        letter-spacing: 0.15em;
        color: var(--photo-muted);
        text-transform: uppercase;
      }
      .photo-caption strong {
        font-size: 16px;
        font-weight: 550;
        letter-spacing: -0.03em;
      }
      .photo-caption .icon {
        width: 25px;
        height: 25px;
        color: var(--photo-text);
      }
      .floating-note {
        display: flex;
        align-items: center;
        gap: 12px;
        position: absolute;
        background: var(--note-bg);
        border: 1px solid var(--border);
        backdrop-filter: blur(16px);
        border-radius: 12px;
        box-shadow: 0 12px 30px var(--shadow);
        padding: 13px 17px;
        z-index: 2;
      }
      .floating-note .icon {
        color: var(--cyan);
        width: 23px;
        height: 23px;
      }
      .floating-note strong {
        display: block;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.5;
      }
      .floating-note small {
        display: block;
        color: var(--subtle-text);
        font-size: 9px;
      }
      .note-design {
        top: 101px;
        right: -17px;
      }
      .note-data {
        bottom: 1px;
        left: -27px;
      }
      .portrait-label {
        position: absolute;
        right: -6px;
        bottom: 92px;
        writing-mode: vertical-rl;
        font-family: Consolas, monospace;
        font-size: 8px;
        color: var(--subtle-text);
        letter-spacing: 0.22em;
      }
      .hero-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 64px;
        padding-block: 24px;
        border-top: 1px solid var(--border);
        font-size: 10px;
        color: var(--subtle-text);
      }
      .hero-bottom .scroll-prompt {
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: 0.06em;
      }
      .scroll-prompt .icon {
        width: 15px;
        height: 15px;
        color: var(--cyan);
      }
      .hero-bottom .coordinates {
        font-family: Consolas, monospace;
        font-size: 10px;
      }
      .hero-bottom .coordinates span {
        color: var(--soft-text);
      }
      /* ABOUT */
      .about-grid {
        display: grid;
        grid-template-columns: 0.9fr 1.1fr;
        gap: 100px;
        align-items: start;
      }
      .about-copy .section-heading {
        max-width: 400px;
      }
      .about-text {
        font-size: 15px;
        line-height: 1.9;
      }
      .about-text p + p {
        margin-top: 18px;
      }
      .about-signature {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 29px;
      }
      .signature {
        color: var(--text);
        font-family: Georgia, serif;
        font-size: 26px;
        font-style: italic;
        letter-spacing: -0.04em;
      }
      .signature-label {
        font-size: 10px;
        line-height: 1.6;
        padding-left: 17px;
        border-left: 1px solid var(--border);
        color: var(--subtle-text);
      }
      .strength-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-top: 51px;
      }
      .strength-card {
        border: 1px solid var(--border);
        background: linear-gradient(140deg, var(--card), var(--bg-alt));
        border-radius: 13px;
        padding: 25px;
        transition:
          transform 0.3s,
          border-color 0.3s,
          background 0.3s;
      }
      .strength-card:hover {
        transform: translateY(-5px);
        border-color: var(--border-hover);
        background: var(--surface-hover);
      }
      .icon-box {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border: 1px solid var(--accent-border);
        background: var(--accent-surface);
        color: var(--cyan);
        border-radius: 10px;
        margin-bottom: 22px;
      }
      .strength-card h3 {
        font-size: 16px;
        font-weight: 550;
        letter-spacing: -0.02em;
        margin-bottom: 11px;
      }
      .strength-card p {
        font-size: 12px;
        line-height: 1.8;
      }
      /* EDUCATION */
      .education-section {
        background: linear-gradient(180deg, var(--bg-alt), var(--bg-alt));
      }
      .education-grid {
        display: grid;
        grid-template-columns: 0.8fr 1.2fr;
        gap: 90px;
      }
      .education-intro p {
        margin-top: 22px;
        font-size: 14px;
        max-width: 330px;
      }
      .education-footnote {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 29px;
        color: var(--subtle-text);
        font-size: 10px;
      }
      .education-footnote .icon {
        color: var(--cyan);
        width: 17px;
      }
      .timeline {
        position: relative;
        padding-left: 29px;
        border-left: 1px solid var(--border);
        margin-left: 6px;
      }
      .education-card {
        position: relative;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 15px;
        padding: 30px;
        transition: border-color 0.3s;
      }
      .education-card + .education-card {
        margin-top: 24px;
      }
      .education-card::before {
        content: "";
        position: absolute;
        left: -35px;
        top: 34px;
        width: 10px;
        height: 10px;
        background: var(--cyan);
        border: 3px solid var(--bg);
        border-radius: 50%;
        box-shadow: 0 0 0 1px var(--border-hover);
      }
      .education-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
      }
      .academic-label {
        font-size: 9px;
        color: var(--accent-text);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 5px 9px;
        border: 1px solid var(--accent-border);
        border-radius: 5px;
        background: var(--accent-surface);
      }
      .education-meta time {
        font-size: 10px;
        color: var(--muted);
      }
      .education-card > .icon {
        width: 29px;
        height: 29px;
        color: var(--subtle-text);
        margin-bottom: 17px;
      }
      .education-card h3 {
        font-size: 24px;
        font-weight: 550;
        letter-spacing: -0.035em;
      }
      .degree {
        font-size: 13px;
        color: var(--soft-text);
        margin-top: 10px;
        line-height: 1.6;
      }
      .education-card .description {
        margin-top: 17px;
        font-size: 12px;
        line-height: 1.8;
      }
      .coursework {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 18px 0 0;
        padding: 0;
        list-style: none;
      }
      .coursework li {
        font-size: 11px;
        border: 1px solid var(--border);
        border-radius: 5px;
        padding: 4px 9px;
      }
      /* SKILLS */
      .skills-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
      }
      .skill-card {
        padding: 32px;
        border: 1px solid var(--border);
        border-radius: 16px;
        background: linear-gradient(130deg, var(--card), var(--bg-alt));
        position: relative;
        overflow: hidden;
        transition:
          border-color 0.3s,
          transform 0.3s;
      }
      .skill-card:hover {
        transform: translateY(-5px);
        border-color: var(--border-hover);
      }
      .skill-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 34px;
      }
      .skill-card-top .icon-box {
        margin: 0;
        width: 48px;
        height: 48px;
      }
      .skill-number {
        font-size: 12px;
        color: var(--subtle-text);
        font-family: Consolas, monospace;
      }
      .skill-card h3 {
        font-size: 29px;
        font-weight: 550;
        letter-spacing: -0.04em;
      }
      .skill-subtitle {
        margin-top: 9px;
        font-size: 12px;
        color: var(--soft-text);
      }
      .skill-description {
        font-size: 13px;
        line-height: 1.85;
        margin-top: 17px;
        max-width: 420px;
      }
      .skill-chips {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 26px;
      }
      .skill-chip {
        border: 1px solid var(--accent-border);
        background: var(--accent-surface);
        color: var(--accent-text);
        font-size: 11px;
        padding: 6px 12px;
        border-radius: 6px;
        transition: background 0.25s;
      }
      .skill-chip:hover {
        background: var(--accent-hover);
      }
      .skill-focus {
        display: flex;
        align-items: center;
        gap: 9px;
        border-top: 1px solid var(--border);
        padding-top: 19px;
        margin-top: 26px;
        font-size: 10px;
        color: var(--subtle-text);
      }
      .skill-focus .icon {
        width: 14px;
        height: 14px;
        color: var(--cyan);
      }
      .skill-focus strong {
        font-weight: 500;
        color: var(--soft-text);
      }
      .skills-note {
        font-size: 10px;
        color: var(--subtle-text);
        margin-top: 19px;
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .skills-note::before {
        content: "";
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--subtle-text);
      }
      /* INTERESTS */
      .interests-section {
        padding-top: 0;
      }
      .interests-section .container {
        padding-top: 85px;
      }
      .interests-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
      }
      .interest-card {
        padding: 31px;
        border: 1px solid var(--border);
        border-radius: 15px;
        position: relative;
        overflow: hidden;
        min-height: 262px;
        transition:
          transform 0.3s,
          border-color 0.3s;
        background: var(--bg-alt);
      }
      .interest-card:hover {
        transform: translateY(-5px);
        border-color: var(--border-hover);
      }
      .interest-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 30px;
      }
      .interest-head > .icon {
        color: var(--cyan);
        width: 27px;
        height: 27px;
      }
      .interest-tag {
        font-size: 9px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--subtle-text);
      }
      .interest-card h3 {
        font-size: 23px;
        font-weight: 550;
      }
      .interest-card p {
        max-width: 365px;
        margin-top: 14px;
        font-size: 12px;
        line-height: 1.85;
      }
      /* CONTACT */
      .contact-section {
        position: relative;
        background:
          radial-gradient(ellipse at 5% 80%, var(--ambient), transparent 65%),
          var(--bg-alt);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
      }
      .contact-grid {
        display: grid;
        grid-template-columns: 0.95fr 1.05fr;
        gap: 85px;
      }
      .contact-copy .section-heading {
        font-size: clamp(35px, 4vw, 49px);
        max-width: 440px;
      }
      .contact-copy .section-heading em {
        font-style: normal;
        color: var(--cyan);
      }
      .contact-copy > p {
        margin-top: 23px;
        max-width: 370px;
        font-size: 14px;
        line-height: 1.85;
      }
      .contact-options {
        margin-top: 32px;
        display: grid;
        gap: 21px;
      }
      .contact-item {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
      }
      .contact-item > .icon {
        width: 19px;
        height: 19px;
        color: var(--subtle-text);
      }
      .contact-item small {
        font-size: 9px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--subtle-text);
        display: block;
        margin-bottom: 3px;
      }
      .contact-item a,
      .contact-item .contact-value {
        font-size: 13px;
        color: var(--text);
        overflow-wrap: anywhere;
      }
      .contact-item a:hover {
        color: var(--cyan);
      }
      .social-links {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 28px;
      }
      .social-links a {
        font-size: 11px;
        color: var(--subtle-text);
        display: flex;
        align-items: center;
        gap: 7px;
      }
      .social-links .icon {
        width: 15px;
        height: 15px;
      }
      .social-links a:hover {
        color: var(--cyan);
      }
      .direct-email {
        margin-top: 32px;
      }
      .contact-form {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 17px;
        padding: 29px;
      }
      .form-heading {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 10px;
      }
      .form-heading h3 {
        font-size: 18px;
        font-weight: 550;
        letter-spacing: -0.025em;
      }
      .form-heading .icon {
        width: 19px;
        color: var(--cyan);
      }
      .form-note {
        font-size: 11px;
        line-height: 1.8;
        margin-bottom: 25px;
        color: var(--subtle-text);
      }
      .form-note a {
        color: var(--accent-text);
        text-decoration: underline;
        text-underline-offset: 3px;
      }
      .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
      }
      .form-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 0;
      }
      .form-field.full {
        grid-column: 1/-1;
      }
      .form-field label {
        font-size: 10px;
        font-weight: 550;
        letter-spacing: 0.02em;
        color: var(--text);
      }
      .form-field label span {
        color: var(--subtle-text);
        font-size: 9px;
        font-weight: 400;
        margin-left: 3px;
      }
      input,
      textarea {
        width: 100%;
        background: var(--input-bg);
        color: var(--text);
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 11px 12px;
        font-size: 12px;
        transition:
          border-color 0.2s,
          box-shadow 0.2s;
        min-height: 43px;
      }
      input::placeholder,
      textarea::placeholder {
        color: var(--subtle-text);
        opacity: 1;
      }
      input:focus,
      textarea:focus {
        outline: none;
        border-color: var(--cyan);
        box-shadow: 0 0 0 3px var(--accent-surface);
      }
      textarea {
        resize: vertical;
        min-height: 112px;
        max-height: 400px;
      }
      input[aria-invalid="true"],
      textarea[aria-invalid="true"] {
        border-color: var(--error-border);
      }
      .field-error {
        font-size: 10px;
        color: var(--error);
      }
      .form-submit {
        width: 100%;
        margin-top: 20px;
        font-size: 12px;
        min-height: 46px;
      }
      .form-privacy {
        font-size: 9px;
        text-align: center;
        line-height: 1.7;
        margin-top: 12px;
        color: var(--subtle-text);
      }
      .form-status {
        font-size: 12px;
        padding: 13px 15px;
        border: 1px solid var(--notice-border);
        border-radius: 7px;
        color: var(--notice-text);
        background: var(--notice-bg);
        margin-bottom: 20px;
        scroll-margin-top: 115px;
      }
      .form-status.success {
        border-color: var(--success-border);
        color: var(--success-text);
        background: var(--success-bg);
      }
      .hp-field {
        position: absolute;
        left: -10000px;
        top: auto;
        width: 1px;
        height: 1px;
        overflow: hidden;
      }
      .contact-form.submitting .form-submit .icon {
        animation: send-pulse 1s ease-in-out infinite;
      }
      /* FOOTER & MOTION */
      .footer {
        padding-block: 34px;
      }
      .footer-main {
        display: flex;
        justify-content: space-between;
        gap: 24px;
        align-items: center;
      }
      .footer-brand {
        display: flex;
        align-items: center;
        gap: 17px;
      }
      .footer-brand .logo {
        font-size: 24px;
      }
      .footer-tagline {
        font-size: 10px;
        color: var(--subtle-text);
      }
      .footer-links {
        display: flex;
        align-items: center;
        gap: 24px;
        font-size: 11px;
        color: var(--subtle-text);
      }
      .footer-links a:hover {
        color: var(--cyan);
      }
      .to-top {
        display: inline-flex;
        align-items: center;
        gap: 7px;
      }
      .to-top .icon {
        width: 14px;
        height: 14px;
      }
      .footer-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: 26px;
        padding-top: 22px;
        border-top: 1px solid var(--border);
        font-size: 9px;
        color: var(--subtle-text);
      }
      .footer-bottom span:last-child {
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .footer-bottom .dot {
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--cyan);
      }
      /* Only observed, offscreen elements are hidden. No JS means visible content. */
      .reveal {
        --reveal-x: 0px;
        --reveal-y: 22px;
        --reveal-scale: 1;
      }
      .reveal.from-left { --reveal-x: -24px; --reveal-y: 0px; }
      .reveal.from-right { --reveal-x: 24px; --reveal-y: 0px; }
      .reveal.image-reveal { --reveal-y: 12px; --reveal-scale: 0.975; }
      .reveal.reveal-pending:not(.is-visible) {
        opacity: 0;
        transform: translate(var(--reveal-x), var(--reveal-y)) scale(var(--reveal-scale));
      }
      .reveal.reveal-entering {
        transition: opacity 650ms var(--ease), transform 650ms var(--ease);
        transition-delay: var(--reveal-delay, 0ms);
      }
      .reveal.is-visible { opacity: 1; }
      .education-card.reveal-pending::before { transform: scale(0); }
      .education-card::before { transition: transform 600ms var(--ease); }
      @keyframes blink {
        50% {
          opacity: 0;
        }
      }
      @keyframes send-pulse {
        50% {
          transform: translate(3px, -3px);
          opacity: 0.6;
        }
      }
      /* RESPONSIVE */
      @media (min-width: 1500px) {
        .hero {
          padding-top: 95px;
        }
        .portrait-frame {
          height: 540px;
        }
        .hero-grid {
          gap: 100px;
        }
        .hero-bottom {
          margin-top: 80px;
        }
      }
      @media (max-width: 1100px) {
        .container {
          width: calc(100% - 64px);
        }
        .nav {
          gap: 19px;
        }
        .brand-caption {
          display: none;
        }
        .hero-grid {
          gap: 35px;
          grid-template-columns: 1.1fr 1fr;
        }
        .hero h1 {
          font-size: 68px;
        }
        .portrait-frame {
          height: 460px;
        }
        .note-design {
          right: -9px;
        }
        .about-grid {
          gap: 55px;
        }
        .education-grid {
          gap: 50px;
        }
        .contact-grid {
          gap: 44px;
        }
        .section {
          padding-block: 85px;
        }
        .interests-section {
          padding-top: 0;
        }
      }
      @media (max-width: 850px) {
        .container {
          width: calc(100% - 48px);
        }
        .header-inner {
          height: 76px;
          gap: 15px;
        }
        .nav {
          gap: 16px;
        }
        .nav a {
          font-size: 10px;
        }
        .header-cta {
          padding: 9px 11px;
          font-size: 10px;
        }
        .hero {
          padding-top: 45px;
        }
        .hero-grid {
          gap: 28px;
        }
        .hero h1 {
          font-size: 58px;
        }
        .hero-intro {
          font-size: 16px;
        }
        .hero-description {
          font-size: 13px;
        }
        .hero-actions {
          gap: 9px;
        }
        .hero-actions .button {
          font-size: 11px;
          padding: 12px 14px;
          min-height: 47px;
        }
        .portrait-frame {
          height: 420px;
          border-top-left-radius: 110px;
        }
        .portrait-stage::before {
          border-top-left-radius: 125px;
        }
        .floating-note {
          padding: 10px 12px;
          gap: 8px;
        }
        .floating-note strong {
          font-size: 10px;
        }
        .floating-note small {
          font-size: 8px;
        }
        .note-data {
          left: -13px;
        }
        .hero-note {
          flex-wrap: wrap;
          font-size: 10px;
        }
        .about-grid {
          gap: 35px;
        }
        .about-text {
          font-size: 13px;
        }
        .strength-card {
          padding: 21px;
        }
        .strength-card h3 {
          font-size: 14px;
        }
        .education-grid {
          gap: 35px;
          grid-template-columns: 0.85fr 1.15fr;
        }
        .education-card {
          padding: 25px;
        }
        .section-top {
          gap: 25px;
        }
        .section-lead {
          font-size: 13px;
          max-width: 310px;
        }
        .skill-card {
          padding: 27px;
        }
        .contact-grid {
          gap: 30px;
          grid-template-columns: 0.9fr 1.1fr;
        }
        .contact-form {
          padding: 23px;
        }
        .form-grid {
          grid-template-columns: 1fr;
        }
        .form-field.full {
          grid-column: auto;
        }
        .footer-brand {
          gap: 12px;
        }
        .footer-links {
          gap: 16px;
        }
      }
      @media (max-width: 700px) {
        html {
          scroll-padding-top: 90px;
        }
        .container {
          width: calc(100% - 40px);
        }
        .header-inner {
          height: 72px;
        }
        .header-actions {
          margin-left: auto;
        }
        .header-cta {
          min-height: 38px;
          padding: 9px 13px;
        }
        .menu-toggle {
          display: flex;
        }
        .brand-caption { display: none; }
        .nav {
          position: absolute;
          top: 71px;
          left: 0;
          right: 0;
          display: flex;
          align-items: stretch;
          gap: 0;
          flex-direction: column;
          padding: 12px 20px 20px;
          border-bottom: 1px solid var(--border);
          background: var(--menu-bg);
          box-shadow: 0 20px 30px var(--shadow);
          visibility: hidden;
          opacity: 0;
          transform: translateY(-8px);
          transition:
            opacity 0.22s,
            transform 0.22s,
            visibility 0.22s;
        }
        .header:has(#menu-check:checked) .nav {
          visibility: visible;
          opacity: 1;
          transform: none;
        }
        .nav a {
          font-size: 14px;
          padding: 13px 12px;
          border-radius: 6px;
        }
        .nav a::after {
          left: 12px;
          right: auto;
          width: 22px;
          bottom: 7px;
        }
        .nav a:hover {
          background: var(--surface-hover);
        }
        .hero {
          padding-top: 35px;
        }
        .hero-grid {
          grid-template-columns: 1fr;
          gap: 38px;
        }
        .hero-copy {
          padding-bottom: 0;
        }
        .student-badge {
          font-size: 9px;
        }
        .hero-intro {
          margin-top: 23px;
        }
        .hero h1 {
          font-size: clamp(58px, 13vw, 86px);
        }
        .role-line {
          font-size: 18px;
          margin-top: 19px;
        }
        .hero-description {
          max-width: 490px;
          font-size: 14px;
        }
        .hero-actions {
          margin-top: 25px;
        }
        .hero-actions .button {
          font-size: 12px;
          min-height: 49px;
          padding: 12px 20px;
        }
        .hero-note {
          margin-top: 23px;
        }
        .portrait-stage {
          width: min(100% - 16px, 410px);
          margin-inline: auto;
          padding-right: 16px;
          padding-bottom: 24px;
        }
        .portrait-frame {
          height: 470px;
          border-top-left-radius: 130px;
        }
        .portrait-stage::before {
          border-top-left-radius: 145px;
        }
        .note-design {
          top: 92px;
          right: -8px;
        }
        .note-data {
          bottom: 3px;
          left: -8px;
        }
        .floating-note {
          padding: 12px 15px;
        }
        .floating-note strong {
          font-size: 11px;
        }
        .floating-note small {
          font-size: 9px;
        }
        .hero-bottom {
          margin-top: 35px;
          padding-block: 21px;
        }
        .hero-bottom .coordinates {
          font-size: 8px;
        }
        .hero-bottom .scroll-prompt {
          font-size: 9px;
        }
        .section {
          padding-block: 68px;
        }
        .section-heading {
          font-size: 36px;
        }
        .about-grid,
        .education-grid,
        .contact-grid {
          grid-template-columns: 1fr;
          gap: 30px;
        }
        .about-copy .section-heading {
          max-width: 430px;
        }
        .about-text {
          font-size: 14px;
        }
        .about-signature {
          margin-top: 22px;
        }
        .strength-grid {
          grid-template-columns: 1fr;
          margin-top: 31px;
          gap: 12px;
        }
        .strength-card {
          position: relative;
          padding: 21px 22px 21px 82px;
          min-height: 112px;
        }
        .strength-card .icon-box {
          position: absolute;
          left: 22px;
          top: 24px;
          width: 40px;
          height: 40px;
          margin: 0;
        }
        .strength-card h3 {
          font-size: 15px;
          margin-bottom: 8px;
        }
        .strength-card p {
          font-size: 12px;
        }
        .education-intro p {
          max-width: 440px;
        }
        .education-footnote {
          margin-top: 20px;
        }
        .timeline {
          margin-top: 8px;
        }
        .education-card {
          padding: 26px;
        }
        .education-card h3 {
          font-size: 24px;
        }
        .section-top {
          display: block;
          margin-bottom: 29px;
        }
        .section-lead {
          margin-top: 20px;
          max-width: 450px;
        }
        .skills-grid,
        .interests-grid {
          grid-template-columns: 1fr;
          gap: 16px;
        }
        .skill-card {
          padding: 28px;
        }
        .skill-card-top {
          margin-bottom: 24px;
        }
        .skill-card h3 {
          font-size: 28px;
        }
        .skill-description {
          font-size: 13px;
        }
        .interests-section {
          padding-top: 0;
        }
        .interests-section .container {
          padding-top: 65px;
        }
        .interest-card {
          min-height: 235px;
          padding: 27px;
        }
        .interest-head {
          margin-bottom: 26px;
        }
        .contact-copy .section-heading {
          font-size: 39px;
        }
        .contact-copy > p {
          max-width: 440px;
        }
        .contact-options {
          gap: 19px;
        }
        .direct-email {
          margin-top: 26px;
        }
        .contact-grid {
          gap: 36px;
        }
        .contact-form {
          padding: 25px;
        }
        .form-grid {
          grid-template-columns: repeat(2, minmax(0, 1fr));
          gap: 16px;
        }
        .form-field.full {
          grid-column: 1/-1;
        }
        .form-field label {
          font-size: 11px;
        }
        .form-note {
          font-size: 12px;
        }
        input,
        textarea {
          font-size: 16px;
          padding: 11px 12px;
        }
        .footer-main {
          flex-direction: column;
          align-items: flex-start;
          gap: 25px;
        }
        .footer-links {
          width: 100%;
          justify-content: space-between;
          gap: 15px;
        }
        .footer-bottom {
          align-items: flex-start;
          line-height: 1.8;
        }
        .footer-bottom span:last-child {
          text-align: right;
          justify-content: flex-end;
          font-size: 8px;
        }
        .footer {
          padding-block: 30px;
        }
      }
      @media (max-width: 380px) {
        .container {
          width: calc(100% - 32px);
        }
        .brand-caption {
          display: none;
        }
        .header-cta {
          padding: 9px 11px;
        }
        .hero h1 {
          font-size: 57px;
        }
        .hero-actions .button {
          padding: 12px 16px;
        }
        .hero-note {
          gap: 8px;
        }
        .hero-note span + span {
          padding-left: 8px;
        }
        .portrait-frame {
          height: 420px;
        }
        .hero-bottom .coordinates {
          max-width: 120px;
          text-align: right;
        }
        .section-heading {
          font-size: 33px;
        }
        .contact-copy .section-heading {
          font-size: 35px;
        }
        .contact-form {
          padding: 20px;
        }
        .form-grid {
          grid-template-columns: 1fr;
        }
        .form-field.full {
          grid-column: auto;
        }
        .footer-bottom {
          flex-direction: column;
        }
        .footer-bottom span:last-child {
          text-align: left;
        }
      }
      @media (prefers-reduced-motion: reduce) {
        html {
          scroll-behavior: auto;
        }
        *,
        *::before,
        *::after {
          animation: none !important;
          transition: none !important;
        }
        .reveal.reveal-pending:not(.is-visible) {
          opacity: 1;
          transform: none;
        }
        .role-cursor {
          display: none;
        }
      }
      /* Shared interaction and finish: one palette, restrained depth. */
      body, .header, .nav, .button, .student-badge, .floating-note,
      .strength-card, .education-card, .skill-card, .interest-card,
      .contact-section, .contact-form, .skill-chip, .academic-label,
      input, textarea, .icon-button {
        transition: background-color 250ms ease, color 250ms ease,
          border-color 250ms ease, box-shadow 250ms ease, transform 250ms var(--ease);
      }
      .header { background: var(--header-bg); backdrop-filter: blur(18px); }
      .header-inner { gap: 20px; }
      .header-actions { display: flex; align-items: center; gap: 10px; }
      .header-cta { white-space: nowrap; }
      .icon-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: var(--bg-alt);
        color: var(--soft-text);
      }
      .icon-button:hover { color: var(--cyan); border-color: var(--border-hover); }
      .theme-toggle[hidden] { display: none; }
      .theme-toggle .moon-icon { display: none; }
      :root:has(#theme-check:checked) .theme-toggle .sun-icon { display: none; }
      :root:has(#theme-check:checked) .theme-toggle .moon-icon { display: block; }
      .menu-toggle .close-icon { display: none; }
      .header:has(#menu-check:checked) .menu-icon { display: none; }
      .header:has(#menu-check:checked) .close-icon { display: block; }
      .button:active, .icon-button:active { transform: translateY(1px); }
      .button:disabled { opacity: 0.65; transform: none; box-shadow: none; }
      .button .icon { transition: transform 250ms var(--ease); }
      .button:hover:not(:disabled) .icon { transform: translate(2px, -1px); }
      .photo-caption { color: var(--photo-text); }
      .photo-caption small { color: var(--photo-muted); }
      .portrait-frame { box-shadow: 0 24px 65px var(--shadow); }
      .portrait-frame img { aspect-ratio: 1242 / 2208; }
      .role-cursor { animation-iteration-count: 5; }
      .strength-card, .skill-card, .education-card, .interest-card {
        background: var(--card);
        display: flex;
        flex-direction: column;
      }
      .strength-card:hover, .skill-card:hover, .education-card:hover, .interest-card:hover {
        transform: translateY(-4px);
        border-color: var(--border-hover);
        box-shadow: 0 14px 32px var(--shadow);
      }
      .skill-focus { margin-top: auto; }
      .skill-chips { margin-bottom: 26px; }
      .icon-box { color: var(--soft-text); }
      article:hover .icon-box { color: var(--cyan); }
      .icon-box { transition: color 250ms ease; }
      .eyebrow, .text-link:hover, .contact-item a:hover,
      .social-links a:hover, .footer-links a:hover { color: var(--accent-text); }
      .image-reveal.is-visible .portrait-frame {
        animation: portrait-reveal 700ms var(--ease) both;
      }
      @keyframes portrait-reveal {
        from { opacity: 0.35; transform: translateY(8px) scale(0.985); }
        to { opacity: 1; transform: none; }
      }
      .section-lead, .about-text, .hero-description { font-size: 1rem; }
      .strength-card p, .interest-card p, .skill-description, .education-card .description {
        font-size: 0.875rem;
      }
      .nav a { font-size: 0.8125rem; }
      .section-heading { font-size: clamp(2.15rem, 4vw, 3.125rem); }
      .hero h1 { font-size: clamp(3.4rem, 6.4vw, 5.3125rem); }
      .section-index, .eyebrow { font-size: 0.75rem; }
      .form-field label { font-size: 0.8125rem; }
      .form-field label span, .form-privacy { font-size: 0.6875rem; }
      .form-note { font-size: 0.8125rem; }
      input, textarea { font-size: 1rem; }
      .contact-item small { font-size: 0.6875rem; }
      .contact-item a, .contact-item .contact-value { font-size: 0.875rem; }
      .form-status .text-link { text-decoration: underline; text-underline-offset: 3px; }
      .hero-grid > *, .about-grid > *, .contact-grid > *, .education-grid > * { min-width: 0; }
      .role-line { min-height: 2.8em; }
      @media (max-width: 1100px) {
        .header-inner { gap: 14px; }
        .nav { gap: 16px; }
        .nav a { font-size: 0.75rem; }
      }
      @media (min-width: 701px) and (max-width: 850px) {
        .header-cta { display: none; }
      }
      @media (max-width: 700px) {
        .header-inner { gap: 10px; }
        .header-actions { gap: 8px; }
        .header-cta { min-height: 44px; }
        .nav a { font-size: 0.9375rem; min-height: 48px; }
        .nav { max-height: calc(100svh - 72px); overflow-y: auto; }
        .hero h1 { font-size: clamp(3.4rem, 13vw, 5.375rem); }
        .section-lead, .about-text, .hero-description { font-size: 0.9375rem; }
        .role-line { font-size: clamp(1rem, 4.5vw, 1.25rem); }
        .reveal.from-left, .reveal.from-right { --reveal-x: 0px; --reveal-y: 18px; }
        .footer-links a { padding-block: 12px; }
      }
      @media (max-width: 380px) {
        .header-cta { font-size: 10px; padding-inline: 9px; gap: 7px; }
        .hero h1 { font-size: clamp(2.8rem, 14vw, 3.5rem); }
      }
      @media (prefers-reduced-motion: reduce) {
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
  </head>
  <body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="header" id="header">
      <div class="container header-inner">
        <a class="brand" href="#home" aria-label="<?= e($profile['name']) ?> — home">
          <span class="logo">KD<span>.</span></span>
          <span class="brand-caption">A personal<br />perspective</span>
        </a>
        <nav class="nav" id="primary-nav" aria-label="Main navigation">
          <?php foreach ($navigation as $link): ?>
          <a href="#<?= e($link['id']) ?>"><?= e($link['label']) ?></a>
          <?php endforeach; ?>
        </nav>
        <div class="header-actions">
          <input type="checkbox" id="theme-check" class="sr-check" aria-label="Switch between dark and light theme">
          <label for="theme-check" class="icon-button theme-toggle" title="Switch theme">
            <svg class="icon sun-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M2 12h2m16 0h2M5 5l1.4 1.4m11.2 11.2L19 19M5 19l1.4-1.4M17.6 6.4 19 5"/></svg><svg class="icon moon-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.8 13A9 9 0 0 1 11 3.2 9 9 0 1 0 20.8 13Z"/></svg>
          </label>
        <a class="button header-cta" href="#contact"
          >Let’s Connect
          <svg
            class="icon"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.6"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true"
          >
            <path d="M7 17 17 7M7 7h10v10" /></svg
        ></a>
        <input type="checkbox" id="menu-check" class="sr-check" aria-label="Open or close navigation" aria-controls="primary-nav">
        <label for="menu-check" class="menu-toggle">
          <svg class="icon menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"/></svg><svg class="icon close-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 6 12 12M6 18 18 6"/></svg>
        </label>
        </div>
      </div>
    </header>

    <main id="main">
      <!-- 01 / IDENTITY -->
      <section class="hero container" id="home" aria-labelledby="hero-title">
        <div class="hero-grid">
          <div class="hero-copy reveal from-left">
            <div class="student-badge">
              <span class="status-dot" aria-hidden="true"></span> IT STUDENT
              &amp; CREATIVE THINKER
            </div>
            <p class="hero-intro">Hello, I’m</p>
            <h1 id="hero-title"><?= e($profile['first_name']) ?><span><?= e($profile['last_name']) ?>.</span></h1>
            <div class="role-line">
              <span class="role-rotator">
                <?php foreach ($profile['roles'] as $roleIndex => $roleName): ?>
                <span class="role-item" style="--i: <?= (int) $roleIndex ?>"><?= e($roleName) ?></span>
                <?php endforeach; ?>
              </span>
            </div>
            <p class="hero-description"><?= e($profile['hero_description']) ?></p>
            <div class="hero-actions">
              <a href="#about" class="button button-primary"
                >Explore My Profile
                <svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path d="M4 12h16m-6-6 6 6-6 6" /></svg
              ></a>
              <a href="#contact" class="button button-secondary"
                ><svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <rect x="3" y="5" width="18" height="14" rx="3" />
                  <path d="m3 7 9 6 9-6" />
                </svg>
                Contact Me</a
              >
            </div>
            <div class="hero-note">
              <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path
                  d="m2 9 10-5 10 5-10 5-10-5Zm4 2v6c4 3 8 3 12 0v-6m4-2v8"
                /></svg
              ><span><?= e($education[0]['institution']) ?></span><span><?= e($profile['field']) ?></span>
            </div>
          </div>
          <div class="portrait-stage reveal image-reveal">
            <div class="portrait-frame">
              <img
                src="<?= e($profile['photo']) ?>"
                alt="<?= e($profile['photo_alt']) ?>"
                width="1242"
                height="2208"
                fetchpriority="high"
                decoding="async"
              />
              <div class="photo-caption">
                <div>
                  <small>Beyond the screen</small
                  ><strong>A little more me.</strong>
                </div>
                <svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <circle cx="12" cy="12" r="9"/><path d="m16 8-2.5 5.5L8 16l2.5-5.5L16 8Z"/>
                </svg>
              </div>
            </div>
            <div class="floating-note note-design" aria-hidden="true">
              <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path d="m14 4 6 6-8 8-8 2 2-8 8-8Z" />
                <path d="m12 6 6 6M4 20l5-5" />
                <circle cx="10" cy="14" r="1" />
              </svg>
              <div>
                <strong>Design with intention.</strong
                ><small>People at the center</small>
              </div>
            </div>
            <div class="floating-note note-data" aria-hidden="true">
              <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path d="M4 4v16h16M8 15v-4m5 4V7m5 8v-6" />
              </svg>
              <div>
                <strong>Curious by nature.</strong
                ><small>Inspired by data</small>
              </div>
            </div>
            <span class="portrait-label" aria-hidden="true"
              >DESIGN · DATA · POSSIBILITY</span
            >
          </div>
        </div>
        <div class="hero-bottom">
          <a href="#about" class="scroll-prompt"
            ><svg
              class="icon"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.6"
              stroke-linecap="round"
              stroke-linejoin="round"
              aria-hidden="true"
            >
              <path d="M12 4v16m-6-6 6 6 6-6" />
            </svg>
            Scroll to get to know me</a
          >
          <div class="coordinates">
            <span>Thoughtful design.</span> Meaningful insights.
          </div>
        </div>
      </section>

      <!-- 02 / ABOUT -->
      <section class="section" id="about" aria-labelledby="about-title">
        <div class="container">
          <div class="about-grid">
            <div class="about-copy reveal from-left">
              <div class="eyebrow">01 / About me</div>
              <h2 class="section-heading" id="about-title">
                A creative eye.<br /><span class="muted-heading"
                  >A curious mind.</span
                >
              </h2>
            </div>
            <div class="about-text reveal from-right">
              <?php foreach ($profile['biography'] as $paragraph): ?>
              <p><?= e($paragraph) ?></p>
              <?php endforeach; ?>
              <div class="about-signature">
                <span class="signature"><?= e($profile['first_name']) ?></span
                ><span class="signature-label"
                  >Learning with purpose.<br />Creating with care.</span
                >
              </div>
            </div>
          </div>
          <div class="strength-grid">
            <?php foreach ($strengths as $strength): ?>
            <article class="strength-card reveal">
              <div class="icon-box">
                <?= portfolioIcon($strength['icon']) ?>
              </div>
              <h3><?= e($strength['title']) ?></h3>
              <p><?= e($strength['description']) ?></p>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- 03 / EDUCATION -->
      <section
        class="section education-section section-divider"
        id="education"
        aria-labelledby="education-title"
      >
        <div class="container education-grid">
          <div class="education-intro reveal from-left">
            <div class="eyebrow">02 / Education</div>
            <h2 class="section-heading" id="education-title">
              Where curiosity<br /><span class="muted-heading"
                >finds direction.</span
              >
            </h2>
            <p>
              Every next step starts with a foundation. Here’s the academic path
              behind my growing interest in technology.
            </p>
            <div class="education-footnote">
              <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path
                  d="M12 6c-3-2-6-2-9-1v14c3-1 6-1 9 1 3-2 6-2 9-1V5c-3-1-6-1-9 1Zm0 0v14"
                />
              </svg>
              A foundation for what comes next
            </div>
          </div>
          <div class="timeline">
            <?php foreach ($education as $entry): ?>
            <article class="education-card reveal">
              <div class="education-meta">
                <span class="academic-label"><?= e($entry['label']) ?></span>
              </div>
              <?= portfolioIcon($entry['icon']) ?>
              <h3><?= e($entry['institution']) ?></h3>
              <p class="degree"><?= e($entry['degree']) ?></p>
              <p class="description"><?= e($entry['description']) ?></p>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- 04 / SKILLS -->
      <section
        class="section section-divider"
        id="skills"
        aria-labelledby="skills-title"
      >
        <div class="container">
          <div class="section-top reveal">
            <div>
              <div class="eyebrow">03 / Skills &amp; focus</div>
              <h2 class="section-heading" id="skills-title">
                Two perspectives.<br /><span class="muted-heading"
                  >One thoughtful approach.</span
                >
              </h2>
            </div>
            <p class="section-lead">
              Bringing a visual perspective and an analytical curiosity to the
              way I explore technology.
            </p>
          </div>
          <div class="skills-grid">
            <?php foreach ($skills as $index => $skill): ?>
            <article class="skill-card reveal">
              <div class="skill-card-top">
                <div class="icon-box">
                  <?= portfolioIcon($skill['icon']) ?>
                </div>
                <span class="skill-number">/ <?= e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)) ?></span>
              </div>
              <h3><?= e($skill['title']) ?></h3>
              <p class="skill-subtitle"><?= e($skill['subtitle']) ?></p>
              <p class="skill-description"><?= e($skill['description']) ?></p>
              <div class="skill-chips">
                <?php foreach ($skill['tags'] as $tag): ?>
                <span class="skill-chip"><?= e($tag) ?></span>
                <?php endforeach; ?>
              </div>
              <div class="skill-focus">
                <svg
                  class="icon"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  aria-hidden="true"
                >
                  <path d="M7 17 17 7M7 7h10v10" /></svg
                ><span>Growing toward <strong><?= e($skill['focus']) ?></strong></span>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
          <p class="skills-note">
            A growing skill set, guided by curiosity and continuous learning.
          </p>
        </div>
      </section>

      <!-- 05 / INTERESTS -->
      <section
        class="section interests-section"
        id="interests"
        aria-labelledby="interests-title"
      >
        <div class="container section-divider">
          <div class="section-top reveal">
            <div>
              <div class="eyebrow">04 / Hobbies &amp; interests</div>
              <h2 class="section-heading" id="interests-title">
                What keeps me curious.
              </h2>
            </div>
            <p class="section-lead">
              The ideas I’m drawn to, and the directions I want to explore
              further.
            </p>
          </div>
          <div class="interests-grid">
            <?php foreach ($interests as $interest): ?>
            <article class="interest-card reveal">
              <div class="interest-head">
                <?= portfolioIcon($interest['icon']) ?><span class="interest-tag"><?= e($interest['tag']) ?></span>
              </div>
              <h3><?= e($interest['title']) ?></h3>
              <p><?= e($interest['description']) ?></p>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- 06 / CONTACT -->
      <section
        class="section contact-section"
        id="contact"
        aria-labelledby="contact-title"
      >
        <div class="container contact-grid">
          <div class="contact-copy reveal from-left">
            <div class="eyebrow">05 / Let’s connect</div>
            <h2 class="section-heading" id="contact-title">
              Have an opportunity<br />in mind?<br /><em>Let’s talk.</em>
            </h2>
            <p>
              For an internship, a creative collaboration, or a conversation
              about design and data — I’d love to hear from you.
            </p>
            <div class="contact-options">
              <?php foreach ($contacts as $contact): ?>
              <div class="contact-item">
                <?= portfolioIcon($contact['icon']) ?>
                <div>
                  <small><?= e($contact['label']) ?></small
                  ><a href="<?= e($contact['href']) ?>"<?php if ($contact['external']): ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>
                    ><?= e($contact['value']) ?><?php if ($contact['external']): ?>
                    <?= portfolioIcon('external') ?><?php endif; ?></a>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="social-links"></div>
            <a
              class="text-link direct-email"
              href="mailto:<?= e($profile['email']) ?>"
              >Prefer email? Say hello directly
              <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path d="M7 17 17 7M7 7h10v10" /></svg
            ></a>
          </div>
          <form
            class="contact-form reveal from-right"
            id="contact-form"
            method="post"
            action="mailto:<?= e($profile['email']) ?>"
            enctype="text/plain"
          >
            <div class="form-heading">
              <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <rect x="3" y="5" width="18" height="14" rx="3" />
                <path d="m3 7 9 6 9-6" />
              </svg>
              <h3>Send a little hello.</h3>
            </div>
            <p class="form-note" id="delivery-note">
              Check your message below, then open a draft in your email app. You
              can also
              <a href="mailto:<?= e($profile['email']) ?>">email me directly</a>. All
              fields are required.
            </p>
            <div class="form-grid">
              <div class="form-field">
                <label for="name">Full name <span>(required)</span></label
                ><input
                  id="name"
                  name="name"
                  type="text"
                  placeholder="Your name"
                  autocomplete="name"
                  required
                  minlength="2"
                  maxlength="100"
                  value=""
                />
              </div>
              <div class="form-field">
                <label for="email">Email address <span>(required)</span></label
                ><input
                  id="email"
                  name="email"
                  type="email"
                  placeholder="you@example.com"
                  autocomplete="email"
                  required
                  maxlength="254"
                  value=""
                />
              </div>
              <div class="form-field full">
                <label for="subject">Subject <span>(required)</span></label
                ><input
                  id="subject"
                  name="subject"
                  type="text"
                  placeholder="What’s on your mind?"
                  required
                  minlength="2"
                  maxlength="150"
                  value=""
                />
              </div>
              <div class="form-field full">
                <label for="message">Your message <span>(required)</span></label
                ><textarea
                  id="message"
                  name="message"
                  rows="4"
                  placeholder="Tell me a little about your idea or opportunity…"
                  required
                  minlength="10"
                  maxlength="5000"
                ></textarea>
              </div>
            </div>
            <button
              type="submit"
              class="button button-primary form-submit"
              aria-describedby="delivery-note"
            >
              <span>Open Email Draft</span
              ><svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path d="M7 17 17 7M7 7h10v10" />
              </svg>
            </button>
            <p class="form-privacy">
              Nothing is sent or stored by this site. You send the message from
              your email app.
            </p>
          </form>
        </div>
      </section>
    </main>

    <footer class="footer">
      <div class="container">
        <div class="footer-main">
          <div class="footer-brand">
            <a
              href="#home"
              class="logo"
              aria-label="Back to <?= e($profile['name']) ?>’s introduction"
              >KD<span>.</span></a
            ><span class="footer-tagline"
              >Design, data &amp; a world of possibility.</span
            >
          </div>
          <nav class="footer-links" aria-label="Footer navigation">
            <a href="#about">About</a><a href="#skills">Skills</a
            ><a href="#contact">Contact</a
            ><a href="#home" class="to-top"
              >Back to top
              <svg
                class="icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
              >
                <path d="M12 20V4m-6 6 6-6 6 6" /></svg
            ></a>
          </nav>
        </div>
        <div class="footer-bottom">
          <span
            >&copy; <span id="copyright-year"><?= e(date('Y')) ?></span> <?= e($profile['name']) ?>. All
            rights reserved.</span
          ><span
            ><i class="dot" aria-hidden="true"></i> A little curiosity goes a
            long way.</span
          >
        </div>
      </div>
    </footer>

  </body>
</html>
