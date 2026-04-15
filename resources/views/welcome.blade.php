<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fundepag — Memphis</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@400;500;700;800;900&family=Lora:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            :root {
                --g0: #061510;
                --g1: #0b2a1e;
                --g2: #134229;
                --g3: #1d6642;
                --g4: #2e8f5b;
                --g5: #4dba80;
                --g6: #a8dfc0;
                --g7: #e0f5ea;
                --lime: #c6f135;
                --lime2: #a4d41a;
                --sand: #f7f4ee;
                --sand2: #ede8df;
                --text: #0e1f18;
                --muted: #526b5e;
                --border: #d8e8df;
                --white: #ffffff;
                --font-d: 'Cabinet Grotesk', sans-serif;
                --font-s: 'Lora', serif;
            }

            html { scroll-behavior: smooth; }
            body {
                font-family: var(--font-d);
                background: var(--sand);
                color: var(--text);
                overflow-x: hidden;
            }

            /* ── SCROLLBAR ── */
            ::-webkit-scrollbar { width: 5px; }
            ::-webkit-scrollbar-track { background: var(--sand2); }
            ::-webkit-scrollbar-thumb { background: var(--g3); border-radius: 10px; }

            /* ─────────────────────────────────────────
               NAV
            ───────────────────────────────────────── */
            .nav {
                position: fixed; top: 0; left: 0; right: 0; z-index: 200;
                height: 68px;
                display: flex; align-items: center; justify-content: space-between;
                padding: 0 52px;
                background: rgba(247,244,238,0.88);
                backdrop-filter: blur(18px);
                border-bottom: 1px solid rgba(210,230,218,0.7);
                transition: background 0.3s;
            }

            .nav-logo {
                display: flex; align-items: center; gap: 12px;
                text-decoration: none; color: inherit;
            }
            .nav-logo-mark {
                width: 36px; height: 36px; border-radius: 10px;
                background: var(--g2);
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
            }
            .nav-logo-mark svg { width: 20px; height: 20px; }
            .nav-logo-text { line-height: 1; }
            .nav-logo-name {
                display: block;
                font-size: 16px; font-weight: 900; letter-spacing: -0.01em;
                color: var(--g1);
            }
            .nav-logo-sub {
                display: block;
                font-size: 10px; font-weight: 500; letter-spacing: 0.12em;
                text-transform: uppercase; color: var(--muted);
            }

            .nav-links {
                display: flex; align-items: center; gap: 32px;
                list-style: none;
            }
            .nav-links a {
                font-size: 13px; font-weight: 500; color: var(--muted);
                text-decoration: none; letter-spacing: 0.02em;
                transition: color 0.2s;
            }
            .nav-links a:hover { color: var(--g2); }

            .nav-actions { display: flex; gap: 10px; align-items: center; }

            .btn-nav-ghost {
                padding: 8px 20px; border: 1.5px solid var(--border);
                border-radius: 8px; font-size: 13px; font-weight: 600;
                color: var(--text); text-decoration: none;
                font-family: var(--font-d);
                transition: border-color 0.2s, background 0.2s;
            }
            .btn-nav-ghost:hover { border-color: var(--g4); background: var(--g7); }

            .btn-nav-cta {
                padding: 8px 20px; background: var(--g2);
                border-radius: 8px; font-size: 13px; font-weight: 700;
                color: #fff; text-decoration: none;
                font-family: var(--font-d);
                transition: background 0.2s, transform 0.15s;
            }
            .btn-nav-cta:hover { background: var(--g1); transform: translateY(-1px); }

            /* ─────────────────────────────────────────
               HERO
            ───────────────────────────────────────── */
            .hero {
                min-height: 100vh;
                background: var(--g0);
                position: relative;
                overflow: hidden;
                display: flex; flex-direction: column; justify-content: flex-end;
                padding: 120px 52px 80px;
            }

            /* Organic background shape */
            .hero-shape {
                position: absolute;
                inset: 0; pointer-events: none;
            }
            .hero-shape svg {
                position: absolute; bottom: -2px; right: -2px;
                width: 65%; height: auto; opacity: 0.07;
            }

            /* Grid pattern */
            .hero-grid {
                position: absolute; inset: 0; pointer-events: none;
                background-image:
                    linear-gradient(rgba(46,143,91,0.12) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(46,143,91,0.12) 1px, transparent 1px);
                background-size: 64px 64px;
            }

            /* Glow orbs */
            .orb {
                position: absolute; border-radius: 50%; pointer-events: none;
                filter: blur(80px);
            }
            .orb1 {
                width: 520px; height: 520px;
                top: -80px; right: 5%;
                background: radial-gradient(circle, rgba(46,143,91,0.35) 0%, transparent 70%);
                animation: orbFloat 12s ease-in-out infinite;
            }
            .orb2 {
                width: 360px; height: 360px;
                bottom: 10%; left: 10%;
                background: radial-gradient(circle, rgba(198,241,53,0.15) 0%, transparent 70%);
                animation: orbFloat 18s ease-in-out infinite reverse;
            }
            @keyframes orbFloat {
                0%,100% { transform: translate(0,0); }
                33% { transform: translate(20px, -30px); }
                66% { transform: translate(-15px, 20px); }
            }

            .hero-content { position: relative; z-index: 2; }

            .hero-kicker {
                display: inline-flex; align-items: center; gap: 8px;
                background: rgba(198,241,53,0.12); border: 1px solid rgba(198,241,53,0.25);
                color: var(--lime); font-size: 11px; font-weight: 700;
                letter-spacing: 0.14em; text-transform: uppercase;
                padding: 6px 14px; border-radius: 100px;
                margin-bottom: 36px;
            }
            .hero-kicker-dot {
                width: 5px; height: 5px; border-radius: 50%;
                background: var(--lime);
                animation: blink 2s ease-in-out infinite;
            }
            @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }

            .hero-headline {
                font-family: var(--font-d);
                font-size: clamp(52px, 8vw, 112px);
                font-weight: 900; line-height: 0.95;
                letter-spacing: -0.035em;
                color: #fff;
                margin-bottom: 0;
            }
            .hero-headline em {
                font-family: var(--font-s);
                font-style: italic; font-weight: 400;
                color: var(--lime);
            }

            .hero-bottom {
                display: flex; align-items: flex-end;
                justify-content: space-between;
                margin-top: 64px; gap: 40px;
            }

            .hero-desc {
                font-size: 16px; line-height: 1.75;
                color: rgba(255,255,255,0.55); font-weight: 400;
                max-width: 420px;
            }
            .hero-desc strong { color: rgba(255,255,255,0.85); font-weight: 500; }

            .hero-cta { display: flex; gap: 12px; flex-shrink: 0; }

            .btn-lime {
                display: inline-flex; align-items: center; gap: 8px;
                padding: 14px 32px;
                background: var(--lime); color: var(--g0);
                border-radius: 10px; font-size: 14px; font-weight: 800;
                text-decoration: none; font-family: var(--font-d);
                letter-spacing: -0.01em;
                transition: background 0.2s, transform 0.15s;
            }
            .btn-lime:hover { background: var(--lime2); transform: translateY(-2px); }
            .btn-lime svg { width: 14px; height: 14px; }

            .btn-outline-white {
                display: inline-flex; align-items: center; gap: 8px;
                padding: 14px 32px;
                border: 1.5px solid rgba(255,255,255,0.2);
                border-radius: 10px; font-size: 14px; font-weight: 600;
                color: rgba(255,255,255,0.75); text-decoration: none;
                font-family: var(--font-d);
                transition: border-color 0.2s, color 0.2s, transform 0.15s;
            }
            .btn-outline-white:hover { border-color: rgba(255,255,255,0.5); color: #fff; transform: translateY(-2px); }

            /* Stats strip inside hero */
            .hero-stats {
                position: absolute; bottom: 0; left: 0; right: 0;
                display: flex; border-top: 1px solid rgba(255,255,255,0.06);
            }
            .hero-stat {
                flex: 1; padding: 24px 52px;
                border-right: 1px solid rgba(255,255,255,0.06);
            }
            .hero-stat:last-child { border-right: none; }
            .hero-stat-val {
                font-size: clamp(28px, 3vw, 40px); font-weight: 900;
                color: #fff; line-height: 1; margin-bottom: 4px;
                letter-spacing: -0.03em;
            }
            .hero-stat-val span { color: var(--lime); }
            .hero-stat-label {
                font-size: 12px; color: rgba(255,255,255,0.4);
                font-weight: 400; letter-spacing: 0.03em;
            }

            /* ─────────────────────────────────────────
               ABOUT
            ───────────────────────────────────────── */
            .about {
                display: grid; grid-template-columns: 1fr 1fr;
                gap: 0; background: var(--white);
            }

            .about-left {
                padding: 96px 64px;
                border-right: 1px solid var(--border);
            }

            .section-tag {
                display: inline-flex; align-items: center; gap: 8px;
                font-size: 10px; font-weight: 700; letter-spacing: 0.16em;
                text-transform: uppercase; color: var(--g3);
                margin-bottom: 20px;
            }
            .section-tag::before {
                content: '';
                display: block; width: 20px; height: 2px;
                background: var(--lime2); border-radius: 1px;
            }

            .about-title {
                font-size: clamp(32px, 3.5vw, 52px);
                font-weight: 900; line-height: 1.05;
                letter-spacing: -0.03em; color: var(--g1);
                margin-bottom: 28px;
            }
            .about-title em {
                font-family: var(--font-s);
                font-style: italic; font-weight: 400; color: var(--g3);
            }

            .about-text {
                font-size: 16px; line-height: 1.8; color: var(--muted);
                font-weight: 400; margin-bottom: 20px;
            }

            .about-right {
                padding: 96px 64px;
                background: var(--sand);
            }

            .about-pillars { display: flex; flex-direction: column; gap: 1px; }

            .pillar {
                display: flex; align-items: flex-start; gap: 20px;
                padding: 28px 0; border-bottom: 1px solid var(--border);
            }
            .pillar:last-child { border-bottom: none; }

            .pillar-num {
                font-size: 11px; font-weight: 700; color: var(--g5);
                letter-spacing: 0.1em; min-width: 24px; margin-top: 4px;
            }

            .pillar-body {}
            .pillar-title { font-size: 16px; font-weight: 800; color: var(--g1); margin-bottom: 6px; }
            .pillar-desc { font-size: 14px; line-height: 1.65; color: var(--muted); font-weight: 400; }

            /* ─────────────────────────────────────────
               SETORES
            ───────────────────────────────────────── */
            .setores {
                background: var(--g1);
                padding: 96px 52px;
            }

            .setores-header {
                display: flex; align-items: flex-end;
                justify-content: space-between; margin-bottom: 56px;
            }

            .setores-title {
                font-size: clamp(32px, 4vw, 56px); font-weight: 900;
                letter-spacing: -0.03em; color: #fff; line-height: 1.05;
            }
            .setores-title em {
                font-family: var(--font-s);
                font-style: italic; font-weight: 400; color: var(--lime);
            }

            .setores-grid {
                display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px;
            }

            .setor-card {
                background: rgba(255,255,255,0.04);
                border: 1px solid rgba(255,255,255,0.07);
                padding: 40px 36px;
                position: relative; overflow: hidden;
                transition: background 0.3s, transform 0.25s;
                cursor: default;
            }
            .setor-card::before {
                content: '';
                position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
                background: var(--lime); transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.4s cubic-bezier(0.16,1,0.3,1);
            }
            .setor-card:hover { background: rgba(255,255,255,0.07); transform: translateY(-3px); }
            .setor-card:hover::before { transform: scaleX(1); }

            .setor-icon {
                width: 48px; height: 48px; border-radius: 12px;
                background: rgba(198,241,53,0.1);
                display: flex; align-items: center; justify-content: center;
                margin-bottom: 24px;
            }
            .setor-icon svg { width: 24px; height: 24px; stroke: var(--lime); fill: none; stroke-width: 1.6; stroke-linecap: round; stroke-linejoin: round; }

            .setor-name {
                font-size: 20px; font-weight: 800; color: #fff;
                letter-spacing: -0.02em; margin-bottom: 12px;
            }
            .setor-desc { font-size: 14px; line-height: 1.7; color: rgba(255,255,255,0.45); }

            /* ─────────────────────────────────────────
               NUMBERS MARQUEE
            ───────────────────────────────────────── */
            .ticker {
                background: var(--lime);
                overflow: hidden; height: 52px;
                display: flex; align-items: center;
            }
            .ticker-inner {
                display: flex; gap: 0;
                animation: ticker 28s linear infinite;
                white-space: nowrap;
            }
            @keyframes ticker { from{transform:translateX(0)} to{transform:translateX(-50%)} }

            .ticker-item {
                display: inline-flex; align-items: center; gap: 16px;
                padding: 0 40px; font-size: 13px; font-weight: 700;
                color: var(--g0); letter-spacing: 0.06em; text-transform: uppercase;
            }
            .ticker-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--g2); flex-shrink: 0; }

            /* ─────────────────────────────────────────
               NOTICIAS
            ───────────────────────────────────────── */
            .noticias {
                background: var(--sand); padding: 96px 52px;
            }

            .noticias-header {
                display: flex; align-items: flex-end;
                justify-content: space-between; margin-bottom: 48px;
            }

            .noticias-title {
                font-size: clamp(32px, 4vw, 52px); font-weight: 900;
                letter-spacing: -0.03em; color: var(--g1); line-height: 1.05;
            }
            .noticias-title em {
                font-family: var(--font-s);
                font-style: italic; font-weight: 400; color: var(--g3);
            }

            .btn-link {
                display: inline-flex; align-items: center; gap: 6px;
                font-size: 13px; font-weight: 700; color: var(--g3);
                text-decoration: none; letter-spacing: 0.04em;
                transition: gap 0.2s, color 0.2s;
            }
            .btn-link:hover { gap: 10px; color: var(--g2); }
            .btn-link svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

            .noticias-grid {
                display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 24px;
            }

            .noticia-card {
                background: var(--white);
                border: 1px solid var(--border); border-radius: 16px;
                overflow: hidden; text-decoration: none; color: inherit;
                transition: transform 0.25s, box-shadow 0.25s;
                display: flex; flex-direction: column;
            }
            .noticia-card:hover { transform: translateY(-4px); box-shadow: 0 16px 48px rgba(13,42,30,0.1); }

            .noticia-img {
                width: 100%; aspect-ratio: 16/9;
                background: var(--g7); overflow: hidden;
                position: relative;
            }
            .noticia-img-placeholder {
                width: 100%; height: 100%;
                background: linear-gradient(135deg, var(--g7) 0%, var(--g6) 100%);
                display: flex; align-items: center; justify-content: center;
            }
            .noticia-img-placeholder svg { width: 40px; height: 40px; stroke: var(--g5); fill: none; stroke-width: 1.2; }

            .noticia-body { padding: 24px; flex: 1; display: flex; flex-direction: column; }
            .noticia-tag {
                display: inline-block; font-size: 10px; font-weight: 700;
                letter-spacing: 0.12em; text-transform: uppercase;
                color: var(--g3); margin-bottom: 12px;
            }
            .noticia-title {
                font-size: 16px; font-weight: 800; line-height: 1.35;
                color: var(--g1); letter-spacing: -0.01em; margin-bottom: 10px;
                flex: 1;
            }
            .noticia-card.featured .noticia-title { font-size: 22px; }
            .noticia-excerpt {
                font-size: 13px; line-height: 1.65; color: var(--muted);
                display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
            }
            .noticia-meta {
                margin-top: 16px; font-size: 11px; color: var(--g5); font-weight: 600; letter-spacing: 0.04em;
            }

            /* ─────────────────────────────────────────
               EVENTOS
            ───────────────────────────────────────── */
            .eventos { background: var(--white); padding: 96px 52px; }

            .eventos-header {
                display: flex; align-items: flex-end;
                justify-content: space-between; margin-bottom: 48px;
            }
            .eventos-title {
                font-size: clamp(32px, 4vw, 52px); font-weight: 900;
                letter-spacing: -0.03em; color: var(--g1); line-height: 1.05;
            }
            .eventos-title em { font-family: var(--font-s); font-style: italic; font-weight: 400; color: var(--g3); }

            .eventos-list { display: flex; flex-direction: column; gap: 2px; }

            .evento-row {
                display: grid; grid-template-columns: 80px 1fr auto;
                align-items: center; gap: 32px;
                padding: 28px 32px; background: var(--sand);
                border-radius: 12px;
                text-decoration: none; color: inherit;
                transition: background 0.2s, transform 0.2s;
                border: 1px solid transparent;
            }
            .evento-row:hover { background: var(--g7); border-color: var(--border); transform: translateX(4px); }

            .evento-date {
                text-align: center;
            }
            .evento-day {
                font-size: 36px; font-weight: 900; color: var(--g2);
                letter-spacing: -0.03em; line-height: 1;
            }
            .evento-month {
                font-size: 11px; font-weight: 700; color: var(--muted);
                text-transform: uppercase; letter-spacing: 0.1em;
            }

            .evento-info {}
            .evento-title { font-size: 16px; font-weight: 800; color: var(--g1); margin-bottom: 4px; letter-spacing: -0.01em; }
            .evento-desc { font-size: 13px; color: var(--muted); line-height: 1.5; }

            .evento-arrow {
                width: 36px; height: 36px; border-radius: 50%;
                border: 1.5px solid var(--border);
                display: flex; align-items: center; justify-content: center;
                transition: border-color 0.2s, background 0.2s;
            }
            .evento-row:hover .evento-arrow { border-color: var(--g3); background: var(--g3); }
            .evento-arrow svg { width: 14px; height: 14px; stroke: var(--muted); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; transition: stroke 0.2s; }
            .evento-row:hover .evento-arrow svg { stroke: #fff; }

            /* ─────────────────────────────────────────
               CLIENTES
            ───────────────────────────────────────── */
            .clientes { background: var(--g0); padding: 80px 52px; overflow: hidden; }

            .clientes-tag {
                font-size: 10px; font-weight: 700; letter-spacing: 0.16em;
                text-transform: uppercase; color: rgba(255,255,255,0.3);
                margin-bottom: 36px; display: block;
            }

            .clientes-scroll {
                display: flex; gap: 48px; align-items: center;
                animation: clientScroll 30s linear infinite;
                width: max-content;
            }
            @keyframes clientScroll { from{transform:translateX(0)} to{transform:translateX(-50%)} }

            .cliente-pill {
                background: rgba(255,255,255,0.07);
                border: 1px solid rgba(255,255,255,0.08);
                border-radius: 100px; padding: 10px 24px;
                font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.5);
                letter-spacing: 0.04em; white-space: nowrap;
                transition: background 0.2s, color 0.2s;
            }
            .cliente-pill:hover { background: rgba(255,255,255,0.12); color: rgba(255,255,255,0.85); }

            /* ─────────────────────────────────────────
               TESTIMONIALS
            ───────────────────────────────────────── */
            .depoimentos {
                background: var(--sand); padding: 96px 52px;
            }

            .dep-header { margin-bottom: 56px; }
            .dep-title {
                font-size: clamp(32px, 4vw, 52px); font-weight: 900;
                letter-spacing: -0.03em; color: var(--g1); line-height: 1.05;
            }
            .dep-title em { font-family: var(--font-s); font-style: italic; font-weight: 400; color: var(--g3); }

            .dep-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }

            .dep-card {
                background: var(--white); border: 1px solid var(--border);
                border-radius: 16px; padding: 32px;
            }

            .dep-quote-mark {
                font-family: var(--font-s); font-size: 64px; line-height: 0.6;
                color: var(--lime2); margin-bottom: 20px; display: block;
            }
            .dep-text {
                font-family: var(--font-s); font-size: 15px; line-height: 1.75;
                color: var(--text); font-style: italic; margin-bottom: 24px;
            }
            .dep-author { font-size: 13px; font-weight: 700; color: var(--g2); }
            .dep-role { font-size: 12px; color: var(--muted); margin-top: 2px; }

            /* ─────────────────────────────────────────
               CTA BAND
            ───────────────────────────────────────── */
            .cta-band {
                background: var(--g2);
                padding: 80px 52px;
                display: flex; align-items: center; justify-content: space-between; gap: 40px;
            }
            .cta-band-left {}
            .cta-band-title {
                font-size: clamp(28px, 3.5vw, 48px); font-weight: 900;
                letter-spacing: -0.03em; color: #fff; line-height: 1.05;
                margin-bottom: 12px;
            }
            .cta-band-title em { font-family: var(--font-s); font-style: italic; font-weight: 400; color: var(--lime); }
            .cta-band-sub { font-size: 15px; color: rgba(255,255,255,0.55); font-weight: 400; }
            .cta-band-right { flex-shrink: 0; display: flex; gap: 12px; }

            /* ─────────────────────────────────────────
               FOOTER
            ───────────────────────────────────────── */
            .footer {
                background: var(--g0);
                padding: 64px 52px 40px;
            }

            .footer-top {
                display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr;
                gap: 48px; padding-bottom: 48px;
                border-bottom: 1px solid rgba(255,255,255,0.07);
            }

            .footer-brand { }
            .footer-logo-wrap {
                display: flex; align-items: center; gap: 10px; margin-bottom: 16px;
            }
            .footer-badge {
                width: 32px; height: 32px; border-radius: 8px;
                background: rgba(255,255,255,0.08);
                display: flex; align-items: center; justify-content: center;
            }
            .footer-badge svg { width: 16px; height: 16px; }
            .footer-brand-name { font-size: 16px; font-weight: 900; color: rgba(255,255,255,0.8); }
            .footer-tagline { font-size: 13px; line-height: 1.65; color: rgba(255,255,255,0.35); }

            .footer-col-title {
                font-size: 11px; font-weight: 700; letter-spacing: 0.12em;
                text-transform: uppercase; color: rgba(255,255,255,0.3);
                margin-bottom: 20px;
            }
            .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
            .footer-links a {
                font-size: 14px; color: rgba(255,255,255,0.5); text-decoration: none;
                transition: color 0.2s;
            }
            .footer-links a:hover { color: rgba(255,255,255,0.85); }

            .footer-bottom {
                display: flex; align-items: center; justify-content: space-between;
                padding-top: 32px;
            }
            .footer-copy { font-size: 12px; color: rgba(255,255,255,0.25); }
            .footer-lgpd { font-size: 12px; color: rgba(255,255,255,0.25); }

            /* ─────────────────────────────────────────
               MOBILE
            ───────────────────────────────────────── */
            @media (max-width: 1024px) {
                .nav-links { display: none; }
                .hero { padding: 120px 28px 200px; }
                .hero-bottom { flex-direction: column; align-items: flex-start; }
                .hero-stats { display: none; }
                .about { grid-template-columns: 1fr; }
                .about-left, .about-right { padding: 64px 28px; }
                .about-left { border-right: none; border-bottom: 1px solid var(--border); }
                .setores { padding: 64px 28px; }
                .setores-grid { grid-template-columns: 1fr; }
                .setores-header { flex-direction: column; align-items: flex-start; gap: 24px; }
                .noticias { padding: 64px 28px; }
                .noticias-grid { grid-template-columns: 1fr; }
                .eventos { padding: 64px 28px; }
                .evento-row { grid-template-columns: 64px 1fr auto; padding: 20px; }
                .clientes { padding: 64px 28px; }
                .depoimentos { padding: 64px 28px; }
                .dep-grid { grid-template-columns: 1fr; }
                .cta-band { flex-direction: column; padding: 64px 28px; }
                .footer { padding: 48px 28px 32px; }
                .footer-top { grid-template-columns: 1fr 1fr; gap: 36px; }
                .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
                .nav { padding: 0 24px; }
                .noticias-header, .eventos-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            }

            /* ─────────────────────────────────────────
               ANIMATIONS on scroll (lightweight)
            ───────────────────────────────────────── */
            .reveal {
                opacity: 0; transform: translateY(24px);
                transition: opacity 0.7s ease, transform 0.7s ease;
            }
            .reveal.visible { opacity: 1; transform: translateY(0); }
        </style>
    </head>
    <body>

        <!-- ─── NAV ─── -->
        <nav class="nav">
            <a href="#" class="nav-logo">
                <div class="nav-logo-mark">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3C7 8 4 11.5 4 15a8 8 0 0 0 16 0c0-3.5-3-7-8-12z" fill="#c6f135"/>
                    </svg>
                </div>
                <div class="nav-logo-text">
                    <span class="nav-logo-name">Fundepag</span>
                    <span class="nav-logo-sub">Memphis · Sistema</span>
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="#sobre">A Fundepag</a></li>
                <li><a href="#setores">Setores</a></li>
                <li><a href="#noticias">Notícias</a></li>
                <li><a href="#eventos">Eventos</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
            <div class="nav-actions">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-nav-cta">Ir ao sistema</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-ghost">Entrar</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-nav-cta">Criar conta</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- ─── HERO ─── -->
        <section class="hero">
            <div class="hero-shape">
                <svg viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                    <path d="M300,50 C420,50 530,160 530,300 C530,440 420,550 300,550 C180,550 70,440 70,300 C70,160 180,50 300,50 Z" fill="white"/>
                </svg>
            </div>
            <div class="hero-grid"></div>
            <div class="orb orb1"></div>
            <div class="orb orb2"></div>

            <div class="hero-content">
                <div class="hero-kicker">
                    <span class="hero-kicker-dot"></span>
                    Fundação de Desenvolvimento da Pesquisa do Agronegócio
                </div>
                <h1 class="hero-headline">
                    Conectamos<br>
                    <em>conhecimento.</em><br>
                    Geramos valor.
                </h1>

                <div class="hero-bottom">
                    <p class="hero-desc">
                        Especializados no relacionamento entre <strong>empresas e institutos de pesquisa</strong> — viabilizando projetos de Ciência, Tecnologia e Inovação desde 1978.
                    </p>
                    <div class="hero-cta">
                        <a href="#sobre" class="btn-lime">
                            Conheça a Fundepag
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                        </a>
                        @if (Route::has('login'))
                            @guest
                                <a href="{{ route('login') }}" class="btn-outline-white">Acessar o Hub</a>
                            @endguest
                        @endif
                    </div>
                </div>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-val">46<span>+</span></div>
                    <div class="hero-stat-label">anos de história</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">6<span>mil+</span></div>
                    <div class="hero-stat-label">projetos gerenciados</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">R$ 1,5<span>bi</span></div>
                    <div class="hero-stat-label">em ciência & inovação</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">360<span>+</span></div>
                    <div class="hero-stat-label">pessoas em todo o Brasil</div>
                </div>
            </div>
        </section>

        <!-- ─── ABOUT ─── -->
        <section class="about reveal" id="sobre">
            <div class="about-left">
                <div class="section-tag">Quem somos</div>
                <h2 class="about-title">Olá, nós somos a <em>Fundepag</em></h2>
                <p class="about-text">
                    Somos especializados no relacionamento entre empresas e institutos de pesquisa, contando com uma equipe de experts para a execução de projetos ligados à Ciência, Tecnologia e Inovação.
                </p>
                <p class="about-text">
                    A Fundepag foi criada em 1978 a partir dos esforços de grupos empresariais, representantes da agropecuária, da indústria, do comércio e das finanças — para somar esforços do Estado e da iniciativa privada no desenvolvimento de projetos de pesquisa.
                </p>
            </div>
            <div class="about-right">
                <div class="section-tag">Nossa missão</div>
                <div class="about-pillars">
                    <div class="pillar">
                        <span class="pillar-num">01</span>
                        <div class="pillar-body">
                            <div class="pillar-title">Gestão de excelência</div>
                            <p class="pillar-desc">Gerenciamos a parceria entre instituições públicas e a iniciativa privada com rigor e transparência.</p>
                        </div>
                    </div>
                    <div class="pillar">
                        <span class="pillar-num">02</span>
                        <div class="pillar-body">
                            <div class="pillar-title">Desenvolvimento científico</div>
                            <p class="pillar-desc">Viabilizamos projetos que ampliam negócios e propiciam o avanço científico e tecnológico do País.</p>
                        </div>
                    </div>
                    <div class="pillar">
                        <span class="pillar-num">03</span>
                        <div class="pillar-body">
                            <div class="pillar-title">Inovação aberta</div>
                            <p class="pillar-desc">Promovemos a conexão entre empresas, pesquisadores e o mercado para gerar soluções de impacto real.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ─── TICKER ─── -->
        <div class="ticker">
            <div class="ticker-inner">
                <span class="ticker-item"><span class="ticker-dot"></span>Agronegócio</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Pesquisa & Desenvolvimento</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Inovação Aberta</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Meio Ambiente</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Ciência e Tecnologia</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Sustentabilidade</span>
                <span class="ticker-item"><span class="ticker-dot"></span>PDI</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Agronegócio</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Pesquisa & Desenvolvimento</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Inovação Aberta</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Meio Ambiente</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Ciência e Tecnologia</span>
                <span class="ticker-item"><span class="ticker-dot"></span>Sustentabilidade</span>
                <span class="ticker-item"><span class="ticker-dot"></span>PDI</span>
            </div>
        </div>

        <!-- ─── SETORES ─── -->
        <section class="setores reveal" id="setores">
            <div class="setores-header">
                <h2 class="setores-title">Nossas <em>áreas</em><br>de atuação</h2>
            </div>
            <div class="setores-grid">
                <div class="setor-card">
                    <div class="setor-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2zm0 4c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6z"/><path d="M15 12l-4.5 2.6V9.4L15 12z"/></svg>
                    </div>
                    <div class="setor-name">Agro</div>
                    <p class="setor-desc">Apoio a projetos voltados ao aprimoramento das cadeias produtivas — elevando produtividade, qualidade e competitividade do setor agrícola e pecuário.</p>
                </div>
                <div class="setor-card">
                    <div class="setor-icon">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div class="setor-name">Agroambiental</div>
                    <p class="setor-desc">Projetos que integram produção agrícola e conservação ambiental, promovendo práticas sustentáveis alinhadas às demandas ESG.</p>
                </div>
                <div class="setor-card">
                    <div class="setor-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/><path d="M2 12h2M20 12h2M12 2v2M12 20v2"/></svg>
                    </div>
                    <div class="setor-name">Ambiental</div>
                    <p class="setor-desc">Soluções voltadas à preservação ambiental, gestão de recursos naturais e desenvolvimento de tecnologias para o equilíbrio ecossistêmico.</p>
                </div>
            </div>
        </section>

        <!-- ─── NOTICIAS ─── -->
        <section class="noticias reveal" id="noticias">
            <div class="noticias-header">
                <h2 class="noticias-title">Últimas <em>notícias</em></h2>
                <a href="https://portal.fundepag.br/noticias" class="btn-link">
                    Ver todas
                    <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="noticias-grid">
                <a href="https://portal.fundepag.br/noticia/congresso-raizes-da-inovacao-fortalece-debate-sobre-tecnologias-emergentes-no-brasil" target="_blank" class="noticia-card featured">
                    <div class="noticia-img">
                        <div class="noticia-img-placeholder">
                            <svg viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                        </div>
                    </div>
                    <div class="noticia-body">
                        <span class="noticia-tag">Inovação</span>
                        <div class="noticia-title">Congresso Raízes da Inovação fortalece debate sobre tecnologias emergentes no Brasil</div>
                        <p class="noticia-excerpt">A Fundepag realizou, nos dias 2 e 3 de dezembro, o Congresso Raízes — reunindo pesquisadores, empresas e institutos para debater o futuro da inovação no agronegócio.</p>
                        <div class="noticia-meta">Dezembro 2025</div>
                    </div>
                </a>
                <a href="https://portal.fundepag.br/noticia/relatorio-de-igualdade-salarial-2026" target="_blank" class="noticia-card">
                    <div class="noticia-img" style="aspect-ratio: 16/7;">
                        <div class="noticia-img-placeholder">
                            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                    </div>
                    <div class="noticia-body">
                        <span class="noticia-tag">Institucional</span>
                        <div class="noticia-title">Relatório de Igualdade Salarial 2026</div>
                        <div class="noticia-meta">Março 2026</div>
                    </div>
                </a>
                <a href="https://portal.fundepag.br/noticia/miguel-luiz-menezes-freitas-e-o-novo-presidente-do-conselho-da-fundepag" target="_blank" class="noticia-card">
                    <div class="noticia-img" style="aspect-ratio: 16/7;">
                        <div class="noticia-img-placeholder">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                        </div>
                    </div>
                    <div class="noticia-body">
                        <span class="noticia-tag">Diretoria</span>
                        <div class="noticia-title">Miguel Luiz Menezes Freitas é o novo presidente do Conselho da Fundepag</div>
                        <div class="noticia-meta">Março 2026</div>
                    </div>
                </a>
            </div>
        </section>

        <!-- ─── EVENTOS ─── -->
        <section class="eventos reveal" id="eventos">
            <div class="eventos-header">
                <h2 class="eventos-title">Próximos <em>eventos</em></h2>
                <a href="https://hub.fundepag.br" class="btn-link">
                    Ver todos
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="eventos-list">
                <a href="https://hub.fundepag.br/evento/evento-embalagens-vidro" target="_blank" class="evento-row">
                    <div class="evento-date">
                        <div class="evento-day">21</div>
                        <div class="evento-month">Out</div>
                    </div>
                    <div class="evento-info">
                        <div class="evento-title">Curso: Embalagens de vidro para alimentos e bebidas</div>
                        <div class="evento-desc">Requisitos e ensaios de avaliação da qualidade das embalagens de vidro</div>
                    </div>
                    <div class="evento-arrow">
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                </a>
                <a href="https://hub.fundepag.br/evento/inovacoes-celulosicas-economia-circular" target="_blank" class="evento-row">
                    <div class="evento-date">
                        <div class="evento-day">15</div>
                        <div class="evento-month">Out</div>
                    </div>
                    <div class="evento-info">
                        <div class="evento-title">Inovações em Embalagens Celulósicas: Economia Circular</div>
                        <div class="evento-desc">Tendências, desafios e inovações em embalagens celulósicas</div>
                    </div>
                    <div class="evento-arrow">
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                </a>
                <a href="https://hub.fundepag.br/evento/curso-on-line-de-shelf-life-de-alimentos-metodos-tradicionais-e-acelerados" target="_blank" class="evento-row">
                    <div class="evento-date">
                        <div class="evento-day">14</div>
                        <div class="evento-month">Out</div>
                    </div>
                    <div class="evento-info">
                        <div class="evento-title">Shelf Life de Alimentos — métodos tradicionais e acelerados</div>
                        <div class="evento-desc">Reações em alimentos durante armazenamento e projeção de situações</div>
                    </div>
                    <div class="evento-arrow">
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                </a>
            </div>
        </section>

        <!-- ─── CLIENTES ─── -->
        <section class="clientes">
            <span class="clientes-tag">Nossos clientes e parceiros</span>
            <div style="overflow:hidden;">
                <div class="clientes-scroll">
                    <span class="cliente-pill">3M do Brasil</span>
                    <span class="cliente-pill">Minerva</span>
                    <span class="cliente-pill">BASF</span>
                    <span class="cliente-pill">Dow AgroSciences</span>
                    <span class="cliente-pill">PepsiCo</span>
                    <span class="cliente-pill">Ajinomoto</span>
                    <span class="cliente-pill">Petrobras</span>
                    <span class="cliente-pill">DuPont</span>
                    <span class="cliente-pill">Royal Canin</span>
                    <span class="cliente-pill">Danone</span>
                    <span class="cliente-pill">Bayer</span>
                    <span class="cliente-pill">International Paper</span>
                    <span class="cliente-pill">Zoetis</span>
                    <span class="cliente-pill">Três Corações</span>
                    <!-- duplicado para loop -->
                    <span class="cliente-pill">3M do Brasil</span>
                    <span class="cliente-pill">Minerva</span>
                    <span class="cliente-pill">BASF</span>
                    <span class="cliente-pill">Dow AgroSciences</span>
                    <span class="cliente-pill">PepsiCo</span>
                    <span class="cliente-pill">Ajinomoto</span>
                    <span class="cliente-pill">Petrobras</span>
                    <span class="cliente-pill">DuPont</span>
                    <span class="cliente-pill">Royal Canin</span>
                    <span class="cliente-pill">Danone</span>
                    <span class="cliente-pill">Bayer</span>
                    <span class="cliente-pill">International Paper</span>
                    <span class="cliente-pill">Zoetis</span>
                    <span class="cliente-pill">Três Corações</span>
                </div>
            </div>
        </section>

        <!-- ─── DEPOIMENTOS ─── -->
        <section class="depoimentos reveal">
            <div class="dep-header">
                <h2 class="dep-title">O que dizem nossos<br><em>clientes e parceiros</em></h2>
            </div>
            <div class="dep-grid">
                <div class="dep-card">
                    <span class="dep-quote-mark">"</span>
                    <p class="dep-text">A Fundepag é exemplar entre as fundações que cumprem um papel estruturante para que a inovação tecnológica e a pesquisa científica possam acontecer em nosso país, sendo um importante elemento de ligação entre as instituições de pesquisas e o setor produtivo.</p>
                    <div class="dep-author">Arnaldo Jardim</div>
                    <div class="dep-role">Deputado Federal</div>
                </div>
                <div class="dep-card">
                    <span class="dep-quote-mark">"</span>
                    <p class="dep-text">Trabalhar com a Conexão.f nos trouxe uma excelente visão e oportunidade de trazer mais inovação para o mercado e aproximá-lo da Pesquisa Científica e Institutos.</p>
                    <div class="dep-author">Parceiro Fundepag</div>
                    <div class="dep-role">Empresa do Agronegócio</div>
                </div>
                <div class="dep-card">
                    <span class="dep-quote-mark">"</span>
                    <p class="dep-text">A Fundepag é uma parceira estratégica na prospecção de novos desafios tecnológicos, para os quais os Institutos de Pesquisa podem entregar soluções excelentes e inovadoras ao mercado.</p>
                    <div class="dep-author">Instituto Parceiro</div>
                    <div class="dep-role">Pesquisa & Tecnologia</div>
                </div>
            </div>
        </section>

        <!-- ─── CTA BAND ─── -->
        <div class="cta-band" id="contato">
            <div class="cta-band-left">
                <h2 class="cta-band-title">Pronto para <em>inovar</em><br>junto com a Fundepag?</h2>
                <p class="cta-band-sub">Acesse o Hub para inscrições, editais, ordens de serviço e muito mais.</p>
            </div>
            <div class="cta-band-right">
                <a href="https://hub.fundepag.br" target="_blank" class="btn-lime">
                    Acessar o Hub
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                @if (Route::has('login'))
                    @guest
                        <a href="{{ route('login') }}" class="btn-outline-white" style="border-color:rgba(255,255,255,0.3);color:rgba(255,255,255,0.7);">Memphis Login</a>
                    @endguest
                @endif
            </div>
        </div>

        <!-- ─── FOOTER ─── -->
        <footer class="footer">
            <div class="footer-top">
                <div class="footer-brand">
                    <div class="footer-logo-wrap">
                        <div class="footer-badge">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 3C7 8 4 11.5 4 15a8 8 0 0 0 16 0c0-3.5-3-7-8-12z" fill="#c6f135"/>
                            </svg>
                        </div>
                        <span class="footer-brand-name">Fundepag</span>
                    </div>
                    <p class="footer-tagline">Fundação de Desenvolvimento da Pesquisa do Agronegócio — valor para o agronegócio, o alimento e a vida.</p>
                </div>
                <div>
                    <div class="footer-col-title">A Fundepag</div>
                    <ul class="footer-links">
                        <li><a href="https://portal.fundepag.br/quem-somos" target="_blank">Quem Somos</a></li>
                        <li><a href="https://portal.fundepag.br/o-que-fazemos" target="_blank">O Que Fazemos</a></li>
                        <li><a href="https://portal.fundepag.br/diretoria" target="_blank">Diretoria</a></li>
                        <li><a href="https://portal.fundepag.br/o-conexao-f" target="_blank">Conexão.F</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">Institucional</div>
                    <ul class="footer-links">
                        <li><a href="https://portal.fundepag.br/noticias" target="_blank">Notícias</a></li>
                        <li><a href="https://portal.fundepag.br/eventos" target="_blank">Eventos</a></li>
                        <li><a href="https://portal.fundepag.br/editais" target="_blank">Editais</a></li>
                        <li><a href="https://portal.fundepag.br/transparencia" target="_blank">Transparência</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">Acesso rápido</div>
                    <ul class="footer-links">
                        <li><a href="https://hub.fundepag.br" target="_blank">Hub Fundepag</a></li>
                        <li><a href="https://portal.fundepag.br/carreira" target="_blank">Carreira</a></li>
                        <li><a href="https://portal.fundepag.br/contato" target="_blank">Fale Conosco</a></li>
                        <li><a href="https://portal.fundepag.br/ouvidoria" target="_blank">Ouvidoria</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span class="footer-copy">© {{ date('Y') }} Fundepag — Fundação de Desenvolvimento da Pesquisa do Agronegócio</span>
                <span class="footer-lgpd">Rua Dona Germaine Burchard, 409 – Água Branca – São Paulo/SP · fundepag@fundepag.br</span>
            </div>
        </footer>

        <script>
            // Scroll reveal
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('visible'); }
                });
            }, { threshold: 0.08 });
            reveals.forEach(el => observer.observe(el));

            // Nav scroll style
            const nav = document.querySelector('.nav');
            window.addEventListener('scroll', () => {
                nav.style.background = window.scrollY > 40
                    ? 'rgba(247,244,238,0.97)'
                    : 'rgba(247,244,238,0.88)';
            });
        </script>
    </body>
</html>
