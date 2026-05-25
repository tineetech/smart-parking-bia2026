<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parkify – Smart Parking Booking</title>
  <link href="https://fonts.googleapis.com/css2?family=Space Grotesk:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --blue: #2563EB;
      --blue-light: #3B82F6;
      --dark: #0A0A0F;
      --dark2: #111118;
      --dark3: #1A1A24;
      --gray: #6B7280;
      --gray-light: #E5E7EB;
      --white: #FFFFFF;
      --radius: 16px;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--white);
      color: var(--dark);
      overflow-x: hidden;
    }

    /* ───── NAVBAR ───── */
    nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 60px;
      background: rgba(255,255,255,0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(0,0,0,0.06);
      transition: box-shadow .3s;
    }
    nav.scrolled { box-shadow: 0 2px 24px rgba(0,0,0,0.08); }

    .nav-logo {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--dark);
      letter-spacing: -0.5px;
      text-decoration: none;
    }
    .nav-logo span { color: var(--blue); }

    .nav-links {
      display: flex;
      gap: 36px;
      list-style: none;
    }
    .nav-links a {
      font-size: .9rem;
      font-weight: 500;
      color: var(--gray);
      text-decoration: none;
      transition: color .2s;
    }
    .nav-links a:hover { color: var(--dark); }

    .nav-cta {
      background: var(--blue);
      color: var(--white);
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: .9rem;
      padding: 10px 22px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: background .2s, transform .15s;
    }
    .nav-cta:hover { background: var(--blue-light); transform: translateY(-1px); }

    .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
    .hamburger span { width: 24px; height: 2px; background: var(--dark); border-radius: 2px; transition: .3s; }

    /* ───── HERO ───── */
    .hero {
      min-height: 100vh;
      background: var(--dark);
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 120px 20px 80px;
      overflow: hidden;
    }

    /* Map grid background */
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(37,99,235,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37,99,235,0.08) 1px, transparent 1px);
      background-size: 60px 60px;
      opacity: .6;
    }
    .hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse 80% 60% at 50% 40%, rgba(37,99,235,0.18) 0%, transparent 70%);
    }

    /* Floating location pins */
    .pin {
      position: absolute;
      width: 10px; height: 10px;
      background: var(--blue);
      border-radius: 50%;
      box-shadow: 0 0 0 4px rgba(37,99,235,.25);
      animation: pulse 2.5s ease-in-out infinite;
      z-index: 1;
    }
    .pin:nth-child(1) { top: 22%; left: 15%; animation-delay: 0s; }
    .pin:nth-child(2) { top: 35%; right: 18%; animation-delay: .7s; }
    .pin:nth-child(3) { bottom: 28%; left: 25%; animation-delay: 1.2s; }
    .pin:nth-child(4) { bottom: 20%; right: 22%; animation-delay: .3s; }
    .pin:nth-child(5) { top: 55%; left: 42%; animation-delay: 1.8s; }

    @keyframes pulse {
      0%,100% { box-shadow: 0 0 0 4px rgba(37,99,235,.25); }
      50% { box-shadow: 0 0 0 10px rgba(37,99,235,0); }
    }

    /* road lines */
    .road {
      position: absolute;
      background: rgba(255,255,255,0.04);
      z-index: 1;
    }
    .road-h { height: 2px; width: 100%; top: 40%; }
    .road-v { width: 2px; height: 100%; left: 30%; }
    .road-v2 { width: 2px; height: 100%; left: 65%; }
    .road-h2 { height: 2px; width: 100%; top: 68%; }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 720px;
    }

    .hero-content h1 {
      font-family: 'Poppins', sans-serif;
      /* font-size: clamp(2rem, 2vw, 3rem); */
      font-size: 2.5em;
      font-weight: 400;
      color: var(--white);
      /* line-height: 1.15; */
      letter-spacing: -1px;
      margin-bottom: 18px;
      animation: fadeUp .8s ease both;
    }
    .hero-content h1 span { color: var(--blue); }
    
    .hero-content p {
        font-weight: 400;
      font-size: 1rem;
      color: rgba(255,255,255,.55);
      margin-bottom: 36px;
      animation: fadeUp .8s .15s ease both;
    }

    .hero-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--blue);
      color: var(--white);
      font-weight: 600;
      font-size: .95rem;
      padding: 14px 28px;
      border-radius: 10px;
      text-decoration: none;
      animation: fadeUp .8s .3s ease both;
      transition: background .2s, transform .15s, box-shadow .2s;
      box-shadow: 0 4px 20px rgba(37,99,235,.4);
    }
    .hero-btn:hover {
      background: var(--blue-light);
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(37,99,235,.5);
    }
    .hero-btn svg { transition: transform .2s; }
    .hero-btn:hover svg { transform: translateX(4px); }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ───── MARQUEE / PARTNERS ───── */
    .partners {
      padding: 22px 0;
      background: var(--white);
      border-bottom: 1px solid var(--gray-light);
      overflow: hidden;
    }
    .marquee-track {
      display: flex;
      gap: 60px;
      animation: marquee 20s linear infinite;
      width: max-content;
    }
    .marquee-track span {
      font-family: 'Space Grotesk', sans-serif;
      font-size: .85rem;
      font-weight: 700;
      color: var(--gray);
      letter-spacing: 1px;
      text-transform: uppercase;
      white-space: nowrap;
    }
    .marquee-track span b { color: var(--blue); }
    @keyframes marquee {
      from { transform: translateX(0); }
      to { transform: translateX(-50%); }
    }

    /* ───── SECTION BASE ───── */
    section { padding: 96px 60px; }
    .section-tag {
      display: inline-block;
      background: #EFF6FF;
      color: var(--blue);
      font-size: .75rem;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      padding: 5px 12px;
      border-radius: 100px;
      margin-bottom: 16px;
    }
    .section-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(1.8rem, 3.5vw, 2.75rem);
      font-weight: 800;
      line-height: 1.15;
      letter-spacing: -0.5px;
    }
    .section-title span { color: var(--blue); }

    /* ───── FEATURES ───── */
    .features {
      background: #F9FAFB;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 64px;
      align-items: center;
    }
    .features-text p {
      color: var(--gray);
      font-size: .95rem;
      line-height: 1.75;
      margin: 18px 0 32px;
      max-width: 440px;
    }
    .features-text p b { color: var(--blue); font-weight: 600; }
    .features-cta {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--blue);
      color: var(--white);
      font-weight: 600;
      font-size: .9rem;
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      transition: background .2s, transform .15s;
    }
    .features-cta:hover { background: var(--blue-light); transform: translateY(-1px); }

    /* Phone mockups */
    .phones {
      position: relative;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .phone {
      position: absolute;
      width: 180px;
      border-radius: 28px;
      overflow: hidden;
      box-shadow: 0 24px 60px rgba(0,0,0,0.15);
    }
    .phone-back {
      transform: rotate(-6deg) translateX(-60px);
      z-index: 1;
      top: 30px;
    }
    .phone-front {
      transform: rotate(4deg) translateX(40px);
      z-index: 2;
    }
    .phone-screen {
      background: var(--dark2);
      padding: 0;
      aspect-ratio: 9/16;
      display: flex;
      flex-direction: column;
    }
    .phone-notch {
      width: 40px; height: 6px;
      background: rgba(255,255,255,.15);
      border-radius: 3px;
      margin: 10px auto 8px;
    }
    .phone-map {
      flex: 1;
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
      position: relative;
      overflow: hidden;
    }
    .phone-map::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: linear-gradient(rgba(37,99,235,.12) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,.12) 1px,transparent 1px);
      background-size: 20px 20px;
    }
    .map-dot { position: absolute; width:8px;height:8px;background:var(--blue);border-radius:50%;box-shadow:0 0 0 3px rgba(37,99,235,.3); }
    .map-dot:nth-child(1){top:30%;left:40%;}
    .map-dot:nth-child(2){top:55%;left:60%;}
    .map-dot:nth-child(3){top:70%;left:25%;}
    .phone-label {
      background: var(--dark3);
      color: var(--white);
      font-size: .6rem;
      font-weight: 600;
      padding: 6px 10px;
      text-align: center;
    }

    /* Car card phone */
    .phone-car {
      background: var(--dark2);
      padding: 10px;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .car-img {
      width: 100%;
      height: 80px;
      background: linear-gradient(135deg, #1e3a5f, #0a1628);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    /* SVG car shape */
    .car-svg { width: 100px; opacity: .9; }
    .car-info { display: flex; flex-direction: column; gap: 4px; }
    .car-name { font-size: .6rem; font-weight: 700; color: var(--white); }
    .car-sub { font-size: .5rem; color: rgba(255,255,255,.4); }
    .car-badge {
      background: var(--blue);
      color: var(--white);
      font-size: .5rem;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 4px;
      width: fit-content;
    }

    /* ───── SERVICES ───── */
    .services {
      text-align: center;
      background: var(--white);
    }
    .services .section-title { margin-bottom: 56px; }
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      text-align: left;
    }
    .card {
      background: #F9FAFB;
      border: 1px solid var(--gray-light);
      border-radius: var(--radius);
      padding: 36px 28px;
      transition: transform .25s, box-shadow .25s, border-color .25s;
      cursor: default;
    }
    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 50px rgba(0,0,0,0.08);
      border-color: rgba(37,99,235,.2);
    }
    .card-icon {
      width: 52px; height: 52px;
      background: #EFF6FF;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }
    .card-icon svg { width: 26px; height: 26px; }
    .card h3 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 12px;
      line-height: 1.25;
    }
    .card p {
      font-size: .875rem;
      color: var(--gray);
      line-height: 1.7;
      margin-bottom: 20px;
    }
    .card-link {
      color: var(--blue);
      font-size: .85rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: gap .2s;
    }
    .card-link:hover { gap: 10px; }

    /* ───── HOW IT WORKS ───── */
    .how {
      background: var(--dark);
      color: var(--white);
      position: relative;
      overflow: hidden;
    }
    .how::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: linear-gradient(rgba(37,99,235,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,.05) 1px,transparent 1px);
      background-size: 50px 50px;
    }
    .how .section-tag { background: rgba(37,99,235,.2); color: var(--blue-light); }
    .how-grid {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 32px;
      margin-top: 56px;
    }
    .how-step {
      text-align: center;
      padding: 32px 20px;
      border-radius: var(--radius);
      background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.07);
      transition: background .25s, border-color .25s;
    }
    .how-step:hover {
      background: rgba(37,99,235,.1);
      border-color: rgba(37,99,235,.3);
    }
    .step-num {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 3rem;
      font-weight: 800;
      color: rgba(37,99,235,.3);
      line-height: 1;
      margin-bottom: 16px;
    }
    .step-icon {
      width: 56px; height: 56px;
      background: rgba(37,99,235,.15);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 18px;
    }
    .step-icon svg { width: 28px; height: 28px; }
    .how-step h4 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.05rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: var(--white);
    }
    .how-step p { font-size: .85rem; color: rgba(255,255,255,.45); line-height: 1.6; }

    /* ───── STATS ───── */
    .stats {
      padding: 72px 60px;
      background: var(--blue);
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      text-align: center;
    }
    .stat h3 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(2rem, 4vw, 2.8rem);
      font-weight: 800;
      color: var(--white);
    }
    .stat p { font-size: .875rem; color: rgba(255,255,255,.7); margin-top: 6px; }

    /* ───── CTA BANNER ───── */
    .cta-banner {
      padding: 96px 60px;
      background: #F0F6FF;
      text-align: center;
    }
    .cta-banner h2 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(1.8rem, 4vw, 3rem);
      font-weight: 800;
      line-height: 1.2;
      letter-spacing: -0.5px;
      margin-bottom: 18px;
    }
    .cta-banner h2 span { color: var(--blue); }
    .cta-banner p { color: var(--gray); font-size: 1rem; max-width: 480px; margin: 0 auto 36px; }
    .cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
    .btn-primary {
      background: var(--blue);
      color: var(--white);
      font-weight: 600;
      font-size: .95rem;
      padding: 14px 28px;
      border-radius: 10px;
      text-decoration: none;
      transition: background .2s, transform .15s;
      box-shadow: 0 4px 16px rgba(37,99,235,.3);
    }
    .btn-primary:hover { background: var(--blue-light); transform: translateY(-2px); }
    .btn-secondary {
      background: transparent;
      color: var(--blue);
      font-weight: 600;
      font-size: .95rem;
      padding: 14px 28px;
      border-radius: 10px;
      text-decoration: none;
      border: 2px solid var(--blue);
      transition: background .2s, color .2s;
    }
    .btn-secondary:hover { background: var(--blue); color: var(--white); }

    /* ───── FOOTER ───── */
    footer {
      background: var(--dark);
      color: var(--white);
      padding: 72px 60px 40px;
    }
    .footer-top {
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr 1fr;
      gap: 48px;
      padding-bottom: 56px;
      border-bottom: 1px solid rgba(255,255,255,.08);
      margin-bottom: 40px;
    }
    .footer-brand .logo {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.4rem;
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.5px;
      margin-bottom: 14px;
    }
    .footer-brand .logo span { color: var(--blue); }
    .footer-brand p { font-size: .875rem; color: rgba(255,255,255,.45); line-height: 1.65; max-width: 240px; }
    .footer-col h5 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: .85rem;
      font-weight: 700;
      color: rgba(255,255,255,.5);
      letter-spacing: 1.2px;
      text-transform: uppercase;
      margin-bottom: 18px;
    }
    .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 12px; }
    .footer-col ul li a {
      color: rgba(255,255,255,.6);
      font-size: .875rem;
      text-decoration: none;
      transition: color .2s;
    }
    .footer-col ul li a:hover { color: var(--white); }
    .footer-contact p { font-size: .875rem; color: rgba(255,255,255,.6); margin-bottom: 8px; }
    .footer-contact a { color: rgba(255,255,255,.6); text-decoration: none; transition: color .2s; }
    .footer-contact a:hover { color: var(--white); }
    .social-links { display: flex; gap: 10px; margin-top: 18px; }
    .social-links a {
      width: 36px; height: 36px;
      background: rgba(255,255,255,.08);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      transition: background .2s;
    }
    .social-links a:hover { background: var(--blue); }
    .social-links svg { width: 16px; height: 16px; fill: rgba(255,255,255,.7); }

    .footer-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
    }
    .footer-copyright { font-size: .8rem; color: rgba(255,255,255,.3); }

    /* Big footer wordmark */
    .footer-wordmark {
      text-align: center;
      padding: 48px 0 0;
      /* overflow: hidden; */
      /* line-height: 0.85; */
      margin-top: -50px;
    }
    .footer-wordmark span {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(5rem, 40vw, 22rem);
      font-weight: 800;
      color: rgba(255,255,255,1);
      letter-spacing: -4px;
      display: block;
    }
    .footer-wordmark span b { color: #2965DE; }

    .back-top {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      background:var(--dark2);
      padding: 16px 60px;
      border-top: 1px solid rgba(255,255,255,.06);
    }
    .back-top a {
      display: flex;
      align-items: center;
      gap: 8px;
      color: rgba(255,255,255,.4);
      font-size: .8rem;
      font-weight: 500;
      text-decoration: none;
      transition: color .2s;
    }
    .back-top a:hover { color: var(--white); }

    /* ───── SCROLL REVEAL ───── */
    .reveal {
      opacity: 0;
      transform: translateY(32px);
      transition: opacity .65s ease, transform .65s ease;
    }
    .reveal.visible { opacity: 1; transform: none; }
    .reveal-d1 { transition-delay: .1s; }
    .reveal-d2 { transition-delay: .2s; }
    .reveal-d3 { transition-delay: .3s; }
    .reveal-d4 { transition-delay: .4s; }

    /* ───── MOBILE MENU ───── */
    .mobile-menu {
      display: none;
      position: fixed;
      top: 0; right: -100%; bottom: 0;
      width: min(300px, 80vw);
      background: var(--white);
      z-index: 200;
      flex-direction: column;
      padding: 80px 32px 40px;
      gap: 28px;
      transition: right .35s cubic-bezier(.4,0,.2,1);
      box-shadow: -8px 0 40px rgba(0,0,0,.12);
    }
    .mobile-menu.open { right: 0; display: flex; }
    .mobile-menu a {
      font-size: 1.1rem;
      font-weight: 500;
      color: var(--dark);
      text-decoration: none;
      border-bottom: 1px solid var(--gray-light);
      padding-bottom: 16px;
    }
    .mobile-menu .nav-cta { text-align: center; border: none; }
    .overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,.4);
      z-index: 150;
    }
    .overlay.show { display: block; }
    .close-btn {
      position: absolute;
      top: 20px; right: 20px;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--dark);
    }

    /* ───── RESPONSIVE ───── */
    @media (max-width: 1024px) {
      section { padding: 72px 40px; }
      nav { padding: 16px 40px; }
      .nav-links { gap: 24px; }
      .cards-grid { grid-template-columns: repeat(2, 1fr); }
      .how-grid { grid-template-columns: repeat(2, 1fr); }
      .stats { grid-template-columns: repeat(2, 1fr); padding: 60px 40px; }
      .footer-top { grid-template-columns: 1fr 1fr; }
      .footer-brand { grid-column: 1 / -1; }
    }

    @media (max-width: 768px) {
      nav { padding: 14px 20px; }
      .nav-links, .nav-cta { display: none; }
      .hamburger { display: flex; }
      section { padding: 60px 20px; }
      .features { grid-template-columns: 1fr; gap: 40px; }
      .phones { height: 300px; }
      .phone { width: 140px; }
      .cards-grid { grid-template-columns: 1fr; }
      .how-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
      .stats { grid-template-columns: 1fr 1fr; padding: 48px 20px; gap: 16px; }
      .cta-banner { padding: 60px 20px; }
      .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
      footer { padding: 48px 20px 20px; }
      .back-top { padding: 14px 20px; }
    }

    @media (max-width: 480px) {
      .how-grid { grid-template-columns: 1fr; }
      .footer-top { grid-template-columns: 1fr; }
      .footer-wordmark span { letter-spacing: -2px; }
    }
  </style>
</head>
<body>

<!-- ══ NAVBAR ══ -->
<nav id="navbar">
  <a class="nav-logo" href="#">Park<span>ify</span></a>
  <ul class="nav-links">
    <li><a href="#beranda">Beranda</a></li>
    <li><a href="#fitur">Detail Layanan</a></li>
    <li><a href="#layanan">Tentang Kami</a></li>
    <li><a href="#kontak">Hubungi Kami</a></li>
  </ul>
  <a class="nav-cta" href="#beranda">Mulai Sekarang</a>
  <div class="hamburger" id="hamburger">
    <span></span><span></span><span></span>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="overlay" id="overlay"></div>
<div class="mobile-menu" id="mobileMenu">
  <button class="close-btn" id="closeMenu">✕</button>
  <a href="#beranda">Beranda</a>
  <a href="#fitur">Detail Layanan</a>
  <a href="#layanan">Tentang Kami</a>
  <a href="#kontak">Hubungi Kami</a>
  <a class="nav-cta" href="#">Mulai Sekarang</a>
</div>

<!-- ══ HERO ══ -->
<section class="hero" id="beranda">
  <div class="pin"></div>
  <div class="pin"></div>
  <div class="pin"></div>
  <div class="pin"></div>
  <div class="pin"></div>
  <div class="road road-h"></div>
  <div class="road road-h2"></div>
  <div class="road road-v"></div>
  <div class="road road-v2"></div>

  <div class="hero-content">
    <h1>Mulai Pengelolaan Parkir mu<br>Dengan Cerdas Bersama Park<span>ify</span>.</h1>
    <p>Monitoring Slot parkir dan booking parkir mu sekarang !</p>
    <a href="#fitur" class="hero-btn">
      Coba Dan Mulai
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </a>
  </div>
</section>

<!-- ══ PARTNERS MARQUEE ══ -->
<div class="partners">
  <div class="marquee-track">
    <span><b>ROVES</b>123</span>
    <span>LIPPOMALLS</span>
    <span>★ KOTAKUNINGMALL</span>
    <span><b>ROVES</b>123</span>
    <span>LIPPOMALLS</span>
    <span>★ KOTAKUNINGMALL</span>
    <span><b>ROVES</b>123</span>
    <span>LIPPOMALLS</span>
    <span>★ KOTAKUNINGMALL</span>
    <span><b>ROVES</b>123</span>
    <span>LIPPOMALLS</span>
    <span>★ KOTAKUNINGMALL</span>
    <span><b>ROVES</b>123</span>
    <span>LIPPOMALLS</span>
    <span>★ KOTAKUNINGMALL</span>
    <span><b>ROVES</b>123</span>
    <span>LIPPOMALLS</span>
    <span>★ KOTAKUNINGMALL</span>
  </div>
</div>

<!-- ══ FEATURES ══ -->
<section class="features" id="fitur">
  <div class="features-text reveal">
    <span class="section-tag">Fitur Utama</span>
    <h2 class="section-title">Fitur Utama<br>Aplikasi</h2>
    <p>Nikmati <b>kemudahan</b> memantau slot parkir langsung dari genggaman Anda. Temukan lokasi terdekat, cek ketersediaan ruang secara real-time, dan simpan data kendaraan Anda untuk akses masuk yang lebih <b>cepat</b> dan otomatis.</p>
    <a href="#" class="features-cta">
      Mulai Sekarang
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </a>
  </div>

  <div class="phones reveal reveal-d2">
    <!-- Back phone: Map -->
    <div class="phone phone-back">
      <div class="phone-screen">
        <div class="phone-notch"></div>
        <div class="phone-map">
          <div class="map-dot"></div>
          <div class="map-dot"></div>
          <div class="map-dot"></div>
        </div>
        <div class="phone-label">Rotani Square Mall</div>
      </div>
    </div>
    <!-- Front phone: Car -->
    <div class="phone phone-front">
      <div class="phone-screen">
        <div class="phone-notch"></div>
        <div class="phone-car">
          <div class="car-img">
            <svg class="car-svg" viewBox="0 0 120 50" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="10" y="22" width="100" height="20" rx="5" fill="#2563EB" opacity=".8"/>
              <path d="M25 22 L35 10 L85 10 L95 22" fill="#1d4ed8"/>
              <rect x="5" y="30" width="15" height="8" rx="4" fill="#1a1a2e"/>
              <rect x="100" y="30" width="15" height="8" rx="4" fill="#1a1a2e"/>
              <rect x="32" y="13" width="20" height="9" rx="2" fill="#93c5fd" opacity=".5"/>
              <rect x="68" y="13" width="20" height="9" rx="2" fill="#93c5fd" opacity=".5"/>
            </svg>
          </div>
          <div class="car-info">
            <div class="car-name">BMW M4 CS/CSL</div>
            <div class="car-sub">Slot A-12 • Lantai 2</div>
            <div class="car-badge">Tersedia</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ SERVICES ══ -->
<section class="services" id="layanan">
  <span class="section-tag reveal">Layanan Kami</span>
  <h2 class="section-title reveal" style="margin-bottom:16px">Yang Dapat Kami<br>Berikan</h2>

  <div class="cards-grid" style="margin-top:56px">
    <!-- Card 1 -->
    <div class="card reveal reveal-d1">
      <div class="card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
      </div>
      <h3>Reservasi Parkiran</h3>
      <p>Amankan slot parkir Anda bahkan sebelum tiba di lokasi. Cukup pilih gedung tujuan, pesan tempat, dan berkendara tanpa rasa khawatir.</p>
      <a href="#" class="card-link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>

    <!-- Card 2 -->
    <div class="card reveal reveal-d2">
      <div class="card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
      <h3>Informasi Real-Time</h3>
      <p>Dapatkan data akurat mengenai jumlah slot, lengkap dengan navigasi langsung menuju lokasi terdekat. Selalu tahu kondisi parkir sebelum tiba.</p>
      <a href="#" class="card-link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>

    <!-- Card 3 -->
    <div class="card reveal reveal-d3">
      <div class="card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </div>
      <h3>Efisiensi & Waktu</h3>
      <p>Dapatkan rute tercepat menuju slot kosong, lengkap dengan estimasi waktu jalan dan notifikasi otomatis saat slot hampir terisi.</p>
      <a href="#" class="card-link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</section>

<!-- ══ HOW IT WORKS ══ -->
<section class="how">
  <div style="position:relative;z-index:1;text-align:center">
    <span class="section-tag reveal">Cara Kerja</span>
    <h2 class="section-title reveal" style="color:white">Cara Menggunakan<br>Park<span>ify</span></h2>
  </div>
  <div class="how-grid">
    <div class="how-step reveal reveal-d1">
      <div class="step-num">01</div>
      <div class="step-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </div>
      <h4>Buat Akun</h4>
      <p>Daftar dengan email atau nomor telepon dalam hitungan detik.</p>
    </div>
    <div class="how-step reveal reveal-d2">
      <div class="step-num">02</div>
      <div class="step-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </div>
      <h4>Cari Lokasi</h4>
      <p>Temukan gedung parkir terdekat dengan slot yang masih tersedia.</p>
    </div>
    <div class="how-step reveal reveal-d3">
      <div class="step-num">03</div>
      <div class="step-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      </div>
      <h4>Reservasi Slot</h4>
      <p>Pilih slot, pilih waktu, dan konfirmasi reservasi Anda.</p>
    </div>
    <div class="how-step reveal reveal-d4">
      <div class="step-num">04</div>
      <div class="step-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <h4>Parkir & Selesai</h4>
      <p>Tiba di lokasi, scan QR, dan langsung masuk tanpa antre.</p>
    </div>
  </div>
</section>

<!-- ══ STATS ══ -->
<div class="stats">
  <div class="stat reveal"><h3>50+</h3><p>Gedung Parkir Mitra</p></div>
  <div class="stat reveal reveal-d1"><h3>100K+</h3><p>Pengguna Aktif</p></div>
  <div class="stat reveal reveal-d2"><h3>99.9%</h3><p>Uptime Sistem</p></div>
  <div class="stat reveal reveal-d3"><h3>4.9★</h3><p>Rating Pengguna</p></div>
</div>

<!-- ══ CTA BANNER ══ -->
<section class="cta-banner">
  <h2 class="reveal">Siap Parkir Lebih<br><span>Cerdas?</span></h2>
  <p class="reveal">Bergabung dengan ribuan pengguna yang sudah menikmati kemudahan smart parking bersama Parkify.</p>
  <div class="cta-btns reveal">
    <a href="#" class="btn-primary">Mulai Sekarang</a>
    <a href="#fitur" class="btn-secondary">Pelajari Lebih</a>
  </div>
</section>

<!-- ══ FOOTER ══ -->
<footer id="kontak">
  <div class="footer-top">
    <div class="footer-brand">
      <div class="logo">Park<span>ify</span></div>
      <p>Parkify: Solusi Digital Booking parkiran Mu. Kelola parkir lebih cerdas, hemat waktu, dan bebas ribet.</p>
    </div>
    <div class="footer-col">
      <h5>Navigasi</h5>
      <ul>
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#">Berlangganan</a></li>
        <li><a href="#layanan">Tentang Kami</a></li>
        <li><a href="#kontak">Kontak Kami</a></li>
      </ul>
    </div>
    <div class="footer-col footer-contact">
      <h5>Lokasi</h5>
      <p>Jl. Raya Tajur, Kp. Buntar, Kel. Muara Sari, Kec. Bogor Selatan</p>
      <br>
      <h5 style="margin-top:4px">Kontak</h5>
      <p><a href="tel:+62838796300647">+62 838 7963 0647</a></p>
      <p><a href="tel:+628577025310">+62 857 7025 3106</a></p>
      <br>
      <h5 style="margin-top:4px">Email</h5>
      <p><a href="mailto:parkify@gmail.com">parkify@gmail.com</a></p>
      <div class="social-links">
        <a href="#" title="Facebook">
          <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        </a>
        <a href="#" title="Twitter">
          <svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
        </a>
        <a href="#" title="Instagram">
          <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
        </a>
        <a href="#" title="LinkedIn">
          <svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
        </a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p class="footer-copyright">© 2026 Parkify. Semua hak dilindungi.</p>
  </div>

  <div class="footer-wordmark">
    <span>Parki<b>fy</b></span>
  </div>
</footer>

<div class="back-top">
  <a href="#beranda">
    Kembali Ke Halaman Paling Atas
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
  </a>
</div>

<script>
  // Navbar scroll
  const nav = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 20);
  });

  // Mobile menu
  const hamburger = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobileMenu');
  const overlay = document.getElementById('overlay');
  const closeMenu = document.getElementById('closeMenu');

  function openMenu() {
    mobileMenu.classList.add('open');
    overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
  }
  function closeMenuFn() {
    mobileMenu.classList.remove('open');
    overlay.classList.remove('show');
    document.body.style.overflow = '';
  }
  hamburger.addEventListener('click', openMenu);
  overlay.addEventListener('click', closeMenuFn);
  closeMenu.addEventListener('click', closeMenuFn);
  mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenuFn));

  // Scroll reveal
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  reveals.forEach(el => observer.observe(el));
</script>
</body>
</html>