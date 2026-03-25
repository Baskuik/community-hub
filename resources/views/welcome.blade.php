<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream: #F5F0E8;
            --ink: #1A1814;
            --moss: #3D5A3E;
            --moss-light: #5C7F5D;
            --amber: #C8853A;
            --amber-light: #E8A855;
            --warm-gray: #8A857A;
            --card-bg: #FDFAF4;
            --border: rgba(26,24,20,0.12);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--cream);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            overflow-x: hidden;
            cursor: none;
        }

        /* Custom cursor */
        .cursor {
            width: 10px; height: 10px;
            background: var(--moss);
            border-radius: 50%;
            position: fixed;
            top: 0; left: 0;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.15s ease, width 0.2s, height 0.2s, background 0.2s;
            transform: translate(-50%, -50%);
        }
        .cursor-ring {
            width: 36px; height: 36px;
            border: 1px solid var(--moss);
            border-radius: 50%;
            position: fixed;
            top: 0; left: 0;
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
            transition: all 0.12s ease;
            opacity: 0.5;
        }
        body:has(a:hover) .cursor { transform: translate(-50%, -50%) scale(2); background: var(--amber); }
        body:has(a:hover) .cursor-ring { transform: translate(-50%, -50%) scale(1.5); border-color: var(--amber); opacity: 0.3; }

        /* Nav */
        nav {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 24px 48px;
            mix-blend-mode: multiply;
        }
        .nav-logo {
            font-family: 'Fraunces', serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--ink);
            text-decoration: none;
            opacity: 0;
            animation: fadeDown 0.8s 0.2s forwards;
        }
        .nav-links {
            display: flex; gap: 36px;
            opacity: 0;
            animation: fadeDown 0.8s 0.4s forwards;
        }
        .nav-links a {
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--ink);
            text-decoration: none;
            opacity: 0.6;
            transition: opacity 0.2s;
        }
        .nav-links a:hover { opacity: 1; }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
            overflow: hidden;
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 120px 56px 80px;
            position: relative;
            z-index: 2;
        }

        .hero-eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 28px;
            opacity: 0;
            animation: fadeUp 0.8s 0.5s forwards;
        }

        .hero-title {
            font-family: 'Fraunces', serif;
            font-size: clamp(52px, 6vw, 88px);
            font-weight: 300;
            line-height: 1.0;
            letter-spacing: -0.03em;
            color: var(--ink);
            margin-bottom: 36px;
        }

        .hero-title em {
            font-style: italic;
            color: var(--moss);
        }

        .hero-title .line {
            display: block;
            overflow: hidden;
        }

        .hero-title .line span {
            display: block;
            transform: translateY(110%);
            animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .hero-title .line:nth-child(1) span { animation-delay: 0.6s; }
        .hero-title .line:nth-child(2) span { animation-delay: 0.75s; }
        .hero-title .line:nth-child(3) span { animation-delay: 0.9s; }

        .hero-desc {
            font-size: 16px;
            line-height: 1.75;
            color: var(--warm-gray);
            max-width: 380px;
            margin-bottom: 52px;
            opacity: 0;
            animation: fadeUp 0.8s 1.1s forwards;
        }

        .hero-actions {
            display: flex; gap: 16px; align-items: center;
            opacity: 0;
            animation: fadeUp 0.8s 1.25s forwards;
        }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 10px;
            background: var(--moss);
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.02em;
            padding: 16px 32px;
            border-radius: 2px;
            transition: background 0.25s, transform 0.2s;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--moss-light);
            transform: translateX(-101%);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-primary:hover::after { transform: translateX(0); }
        .btn-primary span { position: relative; z-index: 1; }
        .btn-primary svg { position: relative; z-index: 1; transition: transform 0.2s; }
        .btn-primary:hover svg { transform: translateX(4px); }

        .btn-ghost {
            font-size: 14px;
            font-weight: 400;
            color: var(--ink);
            text-decoration: none;
            opacity: 0.5;
            transition: opacity 0.2s;
            letter-spacing: 0.02em;
        }
        .btn-ghost:hover { opacity: 1; }

        /* Hero right — visual panel */
        .hero-right {
            position: relative;
            background: var(--moss);
            overflow: hidden;
        }

        .hero-right-inner {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 56px;
            opacity: 0;
            animation: fadeIn 1.2s 0.8s forwards;
        }

        /* Geometric pattern */
        .geo {
            position: absolute;
            inset: 0;
            opacity: 0.06;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .stat-block {
            background: rgba(255,255,255,0.05);
            padding: 32px 28px;
            backdrop-filter: blur(4px);
        }

        .stat-num {
            font-family: 'Fraunces', serif;
            font-size: 52px;
            font-weight: 300;
            color: #fff;
            line-height: 1;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
        }

        .hero-right-tag {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            margin-bottom: 24px;
        }

        /* Floating badge */
        .float-badge {
            position: absolute;
            top: 48px;
            left: -24px;
            background: var(--amber);
            color: #fff;
            padding: 14px 20px;
            border-radius: 2px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.04em;
            z-index: 3;
            animation: float 4s ease-in-out infinite;
            box-shadow: 0 8px 32px rgba(200,133,58,0.35);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Scroll indicator */
        .scroll-hint {
            position: absolute;
            bottom: 36px;
            left: 56px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--warm-gray);
            opacity: 0;
            animation: fadeUp 0.8s 1.5s forwards;
        }

        .scroll-line {
            width: 40px;
            height: 1px;
            background: var(--warm-gray);
            position: relative;
            overflow: hidden;
        }
        .scroll-line::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: var(--moss);
            animation: scanline 2s ease-in-out infinite;
        }
        @keyframes scanline { to { left: 100%; } }

        /* Features section */
        .features {
            padding: 140px 56px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 80px;
        }

        .section-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Fraunces', serif;
            font-size: clamp(36px, 4vw, 56px);
            font-weight: 300;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .section-title em { font-style: italic; color: var(--moss); }

        .section-desc {
            max-width: 320px;
            font-size: 15px;
            line-height: 1.75;
            color: var(--warm-gray);
            padding-bottom: 8px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .feature-card {
            background: var(--card-bg);
            padding: 48px 40px;
            position: relative;
            transition: background 0.3s;
            group: true;
        }

        .feature-card:hover { background: #fff; }

        .feature-icon {
            width: 48px; height: 48px;
            background: var(--moss);
            border-radius: 2px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 32px;
            transition: background 0.2s, transform 0.2s;
        }
        .feature-card:hover .feature-icon { background: var(--amber); transform: rotate(-4deg); }

        .feature-icon svg { width: 22px; height: 22px; stroke: #fff; fill: none; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }

        .feature-num {
            position: absolute;
            top: 48px; right: 40px;
            font-family: 'Fraunces', serif;
            font-size: 64px;
            font-weight: 300;
            color: var(--ink);
            opacity: 0.04;
            line-height: 1;
            letter-spacing: -0.04em;
            pointer-events: none;
        }

        .feature-title {
            font-family: 'Fraunces', serif;
            font-size: 24px;
            font-weight: 400;
            letter-spacing: -0.02em;
            margin-bottom: 14px;
            line-height: 1.2;
        }

        .feature-desc {
            font-size: 14px;
            line-height: 1.8;
            color: var(--warm-gray);
        }

        .feature-tag {
            display: inline-block;
            margin-top: 28px;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--moss);
            background: rgba(61,90,62,0.08);
            padding: 5px 12px;
            border-radius: 99px;
        }

        /* Groups showcase */
        .showcase {
            background: var(--ink);
            padding: 140px 56px;
            position: relative;
            overflow: hidden;
        }

        .showcase::before {
            content: '';
            position: absolute;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(61,90,62,0.3) 0%, transparent 70%);
            pointer-events: none;
        }

        .showcase .section-title { color: #fff; }
        .showcase .section-label { color: var(--amber-light); }

        .groups-row {
            display: flex;
            gap: 16px;
            margin-top: 64px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: none;
        }
        .groups-row::-webkit-scrollbar { display: none; }

        .group-pill {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 99px;
            padding: 14px 24px;
            transition: background 0.2s, border-color 0.2s, transform 0.2s;
            cursor: none;
        }
        .group-pill:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.2);
            transform: translateY(-3px);
        }

        .group-pill-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .group-pill-name {
            font-size: 14px;
            font-weight: 400;
            color: rgba(255,255,255,0.8);
            white-space: nowrap;
        }

        .group-pill-count {
            font-size: 12px;
            color: rgba(255,255,255,0.3);
            white-space: nowrap;
        }

        /* CTA */
        .cta {
            padding: 160px 56px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-bg-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Fraunces', serif;
            font-size: 240px;
            font-weight: 700;
            color: var(--ink);
            opacity: 0.025;
            white-space: nowrap;
            pointer-events: none;
            letter-spacing: -0.06em;
            line-height: 1;
        }

        .cta-title {
            font-family: 'Fraunces', serif;
            font-size: clamp(42px, 5vw, 72px);
            font-weight: 300;
            line-height: 1.1;
            letter-spacing: -0.03em;
            margin-bottom: 28px;
            position: relative;
        }

        .cta-title em { font-style: italic; color: var(--moss); }

        .cta-sub {
            font-size: 16px;
            color: var(--warm-gray);
            margin-bottom: 52px;
            position: relative;
        }

        .cta-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            align-items: center;
            position: relative;
        }

        /* Footer */
        footer {
            border-top: 1px solid var(--border);
            padding: 32px 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-logo {
            font-family: 'Fraunces', serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--ink);
            opacity: 0.5;
        }

        .footer-copy {
            font-size: 12px;
            color: var(--warm-gray);
        }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(110%); }
            to { transform: translateY(0); }
        }

        /* Scroll animations */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; }
            .hero-right { min-height: 360px; }
            .features-grid { grid-template-columns: 1fr; }
            .section-header { flex-direction: column; gap: 24px; }
            nav { padding: 20px 24px; }
            .hero-left, .features, .showcase, .cta, footer { padding-left: 24px; padding-right: 24px; }
            .cta-bg-text { font-size: 120px; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<nav>
    <a href="#" class="nav-logo">Community Hub</a>
    <div class="nav-links">
        <a href="#features">Functies</a>
        <a href="#groepen">Groepen</a>
        <a href="{{ route('filament.admin.auth.login') }}">Inloggen</a>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-left">
        <p class="hero-eyebrow">Jouw buurt. Jouw club. Jouw community.</p>

        <h1 class="hero-title">
            <span class="line"><span>Verbind</span></span>
            <span class="line"><span>je <em>community</em></span></span>
            <span class="line"><span>op één plek.</span></span>
        </h1>

        <p class="hero-desc">
            Beheer groepen, organiseer evenementen en breng mensen samen —
            allemaal via één overzichtelijk platform.
        </p>

        <div class="hero-actions">
            <a href="{{ route('filament.admin.auth.login') }}" class="btn-primary">
                <span>Ga naar het panel</span>
                <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="#features" class="btn-ghost">Meer ontdekken →</a>
        </div>

        <div class="scroll-hint">
            <div class="scroll-line"></div>
            Scroll
        </div>
    </div>

    <div class="hero-right">
        <svg class="geo" viewBox="0 0 600 800" preserveAspectRatio="xMidYMid slice">
            <defs>
                <pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
            <circle cx="300" cy="400" r="250" fill="none" stroke="white" stroke-width="0.5"/>
            <circle cx="300" cy="400" r="180" fill="none" stroke="white" stroke-width="0.5"/>
            <circle cx="300" cy="400" r="110" fill="none" stroke="white" stroke-width="0.5"/>
        </svg>

        <div class="float-badge">
            ✦ 142 leden actief
        </div>

        <div class="hero-right-inner">
            <p class="hero-right-tag">Live statistieken</p>
            <div class="stats-grid">
                <div class="stat-block">
                    <div class="stat-num" data-count="142">0</div>
                    <div class="stat-label">Leden</div>
                </div>
                <div class="stat-block">
                    <div class="stat-num" data-count="8">0</div>
                    <div class="stat-label">Groepen</div>
                </div>
                <div class="stat-block">
                    <div class="stat-num" data-count="5">0</div>
                    <div class="stat-label">Evenementen</div>
                </div>
                <div class="stat-block">
                    <div class="stat-num" data-count="23">0</div>
                    <div class="stat-label">Boekingen</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="features" id="features">
    <div class="section-header">
        <div>
            <p class="section-label reveal">Wat je krijgt</p>
            <h2 class="section-title reveal reveal-delay-1">Alles wat een<br><em>community nodig heeft</em></h2>
        </div>
        <p class="section-desc reveal">Een platform gebouwd op Laravel en Filament, met krachtige relaties tussen leden, groepen en evenementen.</p>
    </div>

    <div class="features-grid">
        <div class="feature-card reveal">
            <div class="feature-num">01</div>
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
            <h3 class="feature-title">Groepen & subgroepen</h3>
            <p class="feature-desc">Organiseer je community in groepen en subgroepen. Leden hebben rollen en een joindatum via een pivot tabel.</p>
            <span class="feature-tag">Many-to-Many</span>
        </div>

        <div class="feature-card reveal reveal-delay-1">
            <div class="feature-num">02</div>
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <h3 class="feature-title">Evenementen & boekingen</h3>
            <p class="feature-desc">Plan evenementen per groep. Leden kunnen boeken en je ziet via hasManyThrough alle boekingen per gebruiker.</p>
            <span class="feature-tag">Has Many Through</span>
        </div>

        <div class="feature-card reveal reveal-delay-2">
            <div class="feature-num">03</div>
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
            <h3 class="feature-title">Posts & comments</h3>
            <p class="feature-desc">Posts kunnen op groepen én evenementen staan. Comments werken op posts én evenementen via polymorphic relaties.</p>
            <span class="feature-tag">Polymorphic</span>
        </div>

        <div class="feature-card reveal">
            <div class="feature-num">04</div>
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
            </div>
            <h3 class="feature-title">Tags overal</h3>
            <p class="feature-desc">Tag posts, evenementen en groepen tegelijk via een morphToMany relatie. Filter en zoek door je content.</p>
            <span class="feature-tag">Morph Many-to-Many</span>
        </div>

        <div class="feature-card reveal reveal-delay-1">
            <div class="feature-num">05</div>
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <h3 class="feature-title">Live dashboard</h3>
            <p class="feature-desc">Overzicht van alle statistieken in Filament. Zie leden, boekingen en aankomende evenementen in één oogopslag.</p>
            <span class="feature-tag">Filament</span>
        </div>

        <div class="feature-card reveal reveal-delay-2">
            <div class="feature-num">06</div>
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <h3 class="feature-title">Subgroepen</h3>
            <p class="feature-desc">Een groep kan een parent groep hebben. Zo maak je een hiërarchie van clubs, teams en afdelingen binnen je community.</p>
            <span class="feature-tag">Self-referencing</span>
        </div>
    </div>
</section>

<!-- Groepen showcase -->
<section class="showcase" id="groepen">
    <p class="section-label reveal">Actieve groepen</p>
    <h2 class="section-title reveal reveal-delay-1">Jouw community,<br><em>georganiseerd.</em></h2>

    <div class="groups-row">
        <div class="group-pill reveal">
            <div class="group-pill-dot" style="background:#5C7F5D;"></div>
            <span class="group-pill-name">Sportclub</span>
            <span class="group-pill-count">24 leden</span>
        </div>
        <div class="group-pill reveal reveal-delay-1">
            <div class="group-pill-dot" style="background:#C8853A;"></div>
            <span class="group-pill-name">Buurtvereniging</span>
            <span class="group-pill-count">38 leden</span>
        </div>
        <div class="group-pill reveal reveal-delay-2">
            <div class="group-pill-dot" style="background:#7A5FA0;"></div>
            <span class="group-pill-name">Hobbygroep</span>
            <span class="group-pill-count">19 leden</span>
        </div>
        <div class="group-pill reveal">
            <div class="group-pill-dot" style="background:#4A8FA8;"></div>
            <span class="group-pill-name">Voetbalteam</span>
            <span class="group-pill-count">14 leden</span>
        </div>
        <div class="group-pill reveal reveal-delay-1">
            <div class="group-pill-dot" style="background:#A05F5F;"></div>
            <span class="group-pill-name">Zwemgroep</span>
            <span class="group-pill-count">11 leden</span>
        </div>
        <div class="group-pill reveal reveal-delay-2">
            <div class="group-pill-dot" style="background:#8FA04A;"></div>
            <span class="group-pill-name">Bordspellenclub</span>
            <span class="group-pill-count">16 leden</span>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <div class="cta-bg-text">Hub</div>
    <h2 class="cta-title reveal">Klaar om te beginnen<br>met <em>bouwen?</em></h2>
    <p class="cta-sub reveal">Open het admin panel en begin met het beheren van je community.</p>
    <div class="cta-actions reveal">
        <a href="{{ route('filament.admin.auth.login') }}" class="btn-primary">
            <span>Open admin panel</span>
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>

<footer>
    <span class="footer-logo">Community Hub</span>
    <span class="footer-copy">Gebouwd met Laravel & Filament</span>
</footer>

<script>
    // Custom cursor
    const cursor = document.getElementById('cursor');
    const ring = document.getElementById('cursorRing');
    let mx = 0, my = 0, rx = 0, ry = 0;

    document.addEventListener('mousemove', e => {
        mx = e.clientX; my = e.clientY;
        cursor.style.left = mx + 'px';
        cursor.style.top = my + 'px';
    });

    function animateRing() {
        rx += (mx - rx) * 0.12;
        ry += (my - ry) * 0.12;
        ring.style.left = rx + 'px';
        ring.style.top = ry + 'px';
        requestAnimationFrame(animateRing);
    }
    animateRing();

    // Count up animation
    function countUp(el, target, duration = 1800) {
        let start = 0;
        const step = timestamp => {
            if (!start) start = timestamp;
            const progress = Math.min((timestamp - start) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(ease * target);
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    }

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                if (el.dataset.count) {
                    countUp(el, parseInt(el.dataset.count));
                    observer.unobserve(el);
                }
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('[data-count]').forEach(el => observer.observe(el));

    // Scroll reveal
    const revealObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
</script>

</body>
</html>