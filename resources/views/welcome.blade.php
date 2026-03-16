<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LibraryMS — Library Lending System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --slate-950: #020617;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-700: #334155;
            --slate-400: #94a3b8;
            --slate-300: #cbd5e1;
            --indigo-500: #6366f1;
            --indigo-400: #818cf8;
            --indigo-300: #a5b4fc;
            --white: #ffffff;
        }

        html, body {
            height: 100%;
            background: var(--slate-950);
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Background grid */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(99,102,241,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        /* Glow blob */
        body::after {
            content: '';
            position: fixed;
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 600px;
            background: radial-gradient(ellipse, rgba(99,102,241,0.15) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Nav */
        nav {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 48px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--indigo-500), #8b5cf6);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .nav-logo-text {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: -0.3px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-ghost {
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: var(--slate-300);
            text-decoration: none;
            transition: all 0.15s;
            border: 1px solid transparent;
        }
        .btn-nav-ghost:hover {
            color: var(--white);
            background: rgba(255,255,255,0.06);
        }

        .btn-nav-primary {
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--white);
            text-decoration: none;
            background: var(--indigo-500);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.15s;
        }
        .btn-nav-primary:hover {
            background: #4f46e5;
        }

        /* Hero */
        .hero {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 100px 48px 80px;
            max-width: 860px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 20px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.25);
            font-size: 12px;
            font-weight: 600;
            color: var(--indigo-300);
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(42px, 6vw, 68px);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -1.5px;
            color: var(--white);
            margin-bottom: 24px;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--indigo-400), #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 18px;
            color: var(--slate-400);
            line-height: 1.7;
            max-width: 560px;
            margin: 0 auto 40px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
            background: var(--indigo-500);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.2s;
            box-shadow: 0 0 30px rgba(99,102,241,0.35);
        }
        .btn-hero-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
            box-shadow: 0 0 40px rgba(99,102,241,0.5);
        }

        .btn-hero-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            color: var(--slate-300);
            text-decoration: none;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.2s;
        }
        .btn-hero-ghost:hover {
            background: rgba(255,255,255,0.08);
            color: var(--white);
            transform: translateY(-1px);
        }

        /* Stats strip */
        .stats-strip {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
            gap: 0;
            max-width: 600px;
            margin: 60px auto 80px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            overflow: hidden;
            background: rgba(255,255,255,0.02);
        }

        .stat-item {
            flex: 1;
            padding: 24px 20px;
            text-align: center;
            border-right: 1px solid rgba(255,255,255,0.06);
        }
        .stat-item:last-child { border-right: none; }

        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--slate-400);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Features */
        .features {
            position: relative;
            z-index: 10;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 48px 100px;
        }

        .features-label {
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--indigo-400);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .features-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 36px;
            font-weight: 700;
            text-align: center;
            color: var(--white);
            margin-bottom: 56px;
            letter-spacing: -0.5px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .feature-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 28px;
            transition: all 0.2s;
        }
        .feature-card:hover {
            background: rgba(255,255,255,0.05);
            border-color: rgba(99,102,241,0.3);
            transform: translateY(-2px);
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .feature-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 8px;
        }

        .feature-desc {
            font-size: 13.5px;
            color: var(--slate-400);
            line-height: 1.65;
        }

        /* CTA */
        .cta {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 80px 48px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .cta-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .cta-subtitle {
            font-size: 16px;
            color: var(--slate-400);
            margin-bottom: 36px;
        }

        /* Footer */
        footer {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 24px 48px;
            border-top: 1px solid rgba(255,255,255,0.06);
            font-size: 13px;
            color: var(--slate-400);
        }
    </style>
</head>
<body>

    <!-- Nav -->
    <nav>
        <div class="nav-logo">
            <div class="nav-logo-icon">📚</div>
            <span class="nav-logo-text">LibraryMS</span>
        </div>
        <div class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-nav-primary">Go to Dashboard →</a>
            @else
                <a href="{{ route('login') }}" class="btn-nav-ghost">Sign In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-nav-primary">Get Started</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-badge">📖 Library Lending System</div>
        <h1 class="hero-title">
            Manage Your Library<br>
            <span>Smarter & Faster</span>
        </h1>
        <p class="hero-subtitle">
            A complete library management solution for tracking books, members, and loans — all in one place.
        </p>
        <div class="hero-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-hero-primary">Go to Dashboard →</a>
            @else
                <a href="{{ route('login') }}" class="btn-hero-primary">Get Started →</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-hero-ghost">Create Account</a>
                @endif
            @endauth
        </div>
    </section>

    <!-- Stats Strip -->
    <div class="stats-strip">
        <div class="stat-item">
            <div class="stat-number">∞</div>
            <div class="stat-label">Books Tracked</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">Auto</div>
            <div class="stat-label">Stock Updates</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">PDF</div>
            <div class="stat-label">Reports</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">Real‑time</div>
            <div class="stat-label">Overdue Alerts</div>
        </div>
    </div>

    <!-- Features -->
    <section class="features">
        <div class="features-label">What's Included</div>
        <h2 class="features-title">Everything you need to run a library</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <div class="feature-title">Book Management</div>
                <div class="feature-desc">Add, edit, and organize your entire book catalog with categories, authors, ISBNs, and real-time stock tracking.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <div class="feature-title">Member Management</div>
                <div class="feature-desc">Manage library members with membership validity tracking, contact details, and full loan history per member.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔄</div>
                <div class="feature-title">Loan Transactions</div>
                <div class="feature-desc">Process book borrowing and returns with automatic stock adjustment, due date tracking, and overdue detection.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <div class="feature-title">Dashboard & Stats</div>
                <div class="feature-desc">Get a real-time overview of active loans, overdue books, low stock alerts, and system-wide statistics.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📧</div>
                <div class="feature-title">Email Notifications</div>
                <div class="feature-desc">Automatically send loan confirmation emails to members when a loan is created, processed via background queues.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📄</div>
                <div class="feature-title">PDF Reports</div>
                <div class="feature-desc">Generate and download professional PDF reports for loans and books inventory with a single click.</div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <h2 class="cta-title">Ready to get started?</h2>
        <p class="cta-subtitle">Sign in to access your library dashboard.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn-hero-primary">Go to Dashboard →</a>
        @else
            <a href="{{ route('login') }}" class="btn-hero-primary">Sign In Now →</a>
        @endauth
    </section>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} LibraryMS — Library Lending System. Built with Laravel.</p>
    </footer>

</body>
</html>