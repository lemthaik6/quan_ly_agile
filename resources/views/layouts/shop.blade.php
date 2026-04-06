<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - OutfitChill Shop</title>
    <style>
        /* ============================================
           PREMIUM CYBER-LUXE DESIGN SYSTEM
           ============================================ */

        /* CSS VARIABLES - Design Tokens */
        :root {
            /* Colors */
            --obsidian: #080808;
            --midnight: #0f1118;
            --carbon: #1a1f2e;
            --slate: #2d3142;
            --glass-light: rgba(255,255,255,0.08);
            --glass-lighter: rgba(255,255,255,0.12);
            --glass-lightest: rgba(255,255,255,0.16);
            
            --laser-blue: #00d4ff;
            --laser-blue-dim: #0099cc;
            --hot-pink: #ff006e;
            --electric-violet: #8b5cf6;
            
            --text-primary: #f0f0f0;
            --text-secondary: #b0b0c0;
            --text-muted: #808090;
            
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            
            /* Typography */
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-display: 'Plus Jakarta Sans', 'Inter', sans-serif;
            
            --text-xs: 12px;
            --text-sm: 13px;
            --text-base: 15px;
            --text-lg: 16px;
            --text-xl: 18px;
            --text-2xl: 24px;
            --text-3xl: 32px;
            --text-4xl: 42px;
            
            --fw-normal: 400;
            --fw-medium: 500;
            --fw-semibold: 600;
            --fw-bold: 700;
            
            /* Spacing */
            --sp-xs: 6px;
            --sp-sm: 12px;
            --sp-md: 16px;
            --sp-lg: 20px;
            --sp-xl: 24px;
            --sp-2xl: 32px;
            --sp-3xl: 48px;
            
            /* Borders & Radius */
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 20px;
            
            --border-thin: 1px solid rgba(255,255,255,0.08);
            --border-light: 1px solid rgba(255,255,255,0.12);
            --border-glow: 1px solid rgba(0,212,255,0.2);
            
            /* Shadows */
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.3);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.4);
            --shadow-lg: 0 16px 48px rgba(0,0,0,0.5);
            --shadow-glow: 0 0 20px rgba(0,212,255,0.15), 0 0 40px rgba(0,212,255,0.08);
            
            /* Backdrop */
            --backdrop: blur(20px);
            --backdrop-saturate: saturate(1.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-sans);
            background: linear-gradient(135deg, var(--obsidian) 0%, #1a1f3a 50%, #2d1f4a 100%);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(ellipse 800px 600px at 20% 50%, rgba(0, 212, 255, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse 600px 800px at 80% 80%, rgba(139, 92, 246, 0.06) 0%, transparent 60%),
                radial-gradient(circle at 50% 0%, rgba(0, 212, 255, 0.02) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
            filter: blur(40px);
        }

        /* ============================================
           NAVIGATION - Premium Header
           ============================================ */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--sp-lg) var(--sp-3xl);
            background: linear-gradient(180deg, rgba(8,8,8,0.95) 0%, rgba(8,8,8,0.85) 100%);
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
            border-bottom: var(--border-thin);
            position: relative;
        }

        .nav::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,212,255,0.3), transparent);
        }

        .logo {
            font-size: 20px;
            font-weight: var(--fw-bold);
            background: linear-gradient(135deg, var(--laser-blue) 0%, var(--electric-violet) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: var(--font-display);
            text-decoration: none;
            cursor: pointer;
            letter-spacing: -0.5px;
            transition: all 0.3s;
        }

        .logo:hover {
            filter: brightness(1.2);
        }

        .nav-links {
            display: flex;
            gap: var(--sp-2xl);
            align-items: center;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: var(--text-sm);
            font-weight: var(--fw-medium);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            padding-bottom: 2px;
        }

        .nav-link:hover {
            color: var(--laser-blue);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--laser-blue), var(--electric-violet));
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--hot-pink), #d80066);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: var(--text-xs);
            font-weight: var(--fw-bold);
            min-width: 20px;
            height: 20px;
            animation: pulse-badge 2s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .btn-nav {
            background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
            border: none;
            color: var(--obsidian);
            padding: 10px 22px;
            border-radius: var(--radius-lg);
            cursor: pointer;
            font-size: var(--text-sm);
            font-weight: var(--fw-semibold);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .btn-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 212, 255, 0.35);
        }

        .btn-nav:hover::before {
            left: 100%;
        }

        /* ============================================
           MAIN CONTENT AREA
           ============================================ */
        .main-content {
            padding-top: 90px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--sp-2xl);
        }

        /* ============================================
           SURFACE/CARD SYSTEM - Multi-level elevation
           ============================================ */
        .surface {
            --elevation: 1;
            background: linear-gradient(135deg, var(--glass-light), var(--glass-lighter));
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
            border: var(--border-light);
            border-radius: var(--radius-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .surface.elevation-1 {
            background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.06));
            border: var(--border-thin);
        }

        .surface.elevation-2 {
            background: linear-gradient(135deg, var(--glass-light), var(--glass-lighter));
            border: var(--border-light);
        }

        .surface.elevation-3 {
            background: linear-gradient(135deg, var(--glass-lighter), var(--glass-lightest));
            border: var(--border-glow);
            box-shadow: var(--shadow-sm);
        }

        .card {
            padding: var(--sp-xl);
            background: linear-gradient(135deg, rgba(255,255,255,0.05), rgba(255,255,255,0.08));
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
            border: var(--border-light);
            border-radius: var(--radius-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.12));
            border-color: rgba(0,212,255,0.3);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm), var(--shadow-glow);
        }

        /* ============================================
           GRID LAYOUTS
           ============================================ */
        .grid {
            display: grid;
            gap: var(--sp-lg);
        }

        .grid-auto-fill {
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-cols-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        /* ============================================
           TYPOGRAPHY - Clear Hierarchy
           ============================================ */
        h1 {
            font-size: var(--text-4xl);
            font-weight: var(--fw-bold);
            font-family: var(--font-display);
            letter-spacing: -1px;
            line-height: 1.2;
            margin-bottom: var(--sp-md);
            background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        h2 {
            font-size: var(--text-3xl);
            font-weight: var(--fw-bold);
            font-family: var(--font-display);
            letter-spacing: -0.5px;
            line-height: 1.25;
            margin-bottom: var(--sp-md);
        }

        h3 {
            font-size: var(--text-xl);
            font-weight: var(--fw-semibold);
            line-height: 1.4;
            margin-bottom: var(--sp-sm);
        }

        p {
            font-size: var(--text-base);
            line-height: 1.6;
            color: var(--text-secondary);
        }

        .text-muted {
            color: var(--text-muted);
            font-size: var(--text-sm);
        }

        .text-sm {
            font-size: var(--text-sm);
        }

        .text-xs {
            font-size: var(--text-xs);
        }

        /* ============================================
           BUTTONS - Premium States
           ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            border: none;
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-weight: var(--fw-semibold);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            gap: 8px;
        }

        .btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s;
        }

        .btn:hover::before {
            transform: translateX(100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
            color: var(--obsidian);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 212, 255, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--laser-blue);
            color: var(--laser-blue);
        }

        .btn-secondary:hover {
            background: rgba(0, 212, 255, 0.1);
            box-shadow: 0 8px 24px rgba(0, 212, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--laser-blue);
            border: none;
            padding: 8px 12px;
        }

        .btn-ghost:hover {
            background: rgba(0, 212, 255, 0.08);
        }

        .btn-small {
            padding: 8px 16px;
            font-size: var(--text-sm);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff4757, #ff6b6b);
            color: white;
        }

        .btn-danger:hover {
            box-shadow: 0 12px 32px rgba(255, 71, 87, 0.35);
        }

        /* ============================================
           PREMIUM PRODUCT CARD SYSTEM
           ============================================ */
        .product-card {
            --product-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border: var(--border-light);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(0,212,255,0.05), transparent);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
        }

        .product-card:hover {
            border-color: rgba(0,212,255,0.4);
            background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04));
            transform: translateY(-12px) scale(1.02);
            box-shadow: var(--product-shadow), var(--shadow-glow);
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-image-container {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(0,212,255,0.06) 0%, rgba(139,92,246,0.03) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .product-card:hover .product-image-container img {
            transform: scale(1.12) rotate(2deg);
        }

        .product-badge-group {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .product-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            background: linear-gradient(135deg, rgba(255,0,110,0.95), rgba(255,20,100,0.85));
            color: white;
            border-radius: 8px;
            font-size: 11px;
            font-weight: var(--fw-bold);
            letter-spacing: 0.5px;
            backdrop-filter: var(--backdrop);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 8px 24px rgba(255,0,110,0.3);
        }

        .product-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .product-title {
            font-size: var(--text-base);
            font-weight: var(--fw-semibold);
            color: var(--text-primary);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-category {
            font-size: var(--text-xs);
            color: var(--laser-blue);
            font-weight: var(--fw-medium);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.8;
        }

        .product-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: var(--text-sm);
            padding: 10px 0;
            border-top: var(--border-thin);
            border-bottom: var(--border-thin);
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            color: var(--text-muted);
        }

        .product-rating.active {
            color: #fbbf24;
            font-weight: var(--fw-semibold);
        }

        .product-sold {
            font-size: var(--text-xs);
            color: var(--text-muted);
        }

        .product-pricing {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin: 8px 0;
        }

        .product-price-original {
            font-size: var(--text-sm);
            color: var(--text-muted);
            text-decoration: line-through;
            opacity: 0.6;
        }

        .product-price-current {
            font-size: 18px;
            font-weight: var(--fw-bold);
            background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .product-price-discount {
            font-size: 11px;
            color: var(--hot-pink);
            font-weight: var(--fw-bold);
            background: rgba(255,0,110,0.1);
            padding: 3px 8px;
            border-radius: 4px;
        }

        .product-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: auto;
        }

        .product-actions .btn {
            height: 40px;
            padding: 0;
            font-size: var(--text-sm);
        }

        /* ============================================
           HERO SECTION - Premium Presentation
           ============================================ */
        .hero-premium {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-xl);
            padding: var(--sp-3xl) var(--sp-3xl);
            margin-bottom: var(--sp-3xl);
            background: linear-gradient(135deg, 
                rgba(0,212,255,0.1) 0%, 
                rgba(139,92,246,0.06) 50%,
                rgba(0,212,255,0.04) 100%);
            border: var(--border-glow);
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
        }

        .hero-premium::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0,212,255,0.12), transparent);
            border-radius: 50%;
            pointer-events: none;
            animation: float 8s ease-in-out infinite;
        }

        .hero-premium::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: 10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(139,92,246,0.08), transparent);
            border-radius: 50%;
            pointer-events: none;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
        }

        .hero-subtitle {
            font-size: var(--text-sm);
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--laser-blue);
            margin-bottom: var(--sp-md);
            font-weight: var(--fw-semibold);
        }

        .hero-title {
            font-size: var(--text-4xl);
            font-weight: var(--fw-bold);
            margin-bottom: var(--sp-lg);
            line-height: 1.2;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--laser-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: var(--text-lg);
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: var(--sp-xl);
        }

        /* ============================================
           FILTER PANEL - Premium Elegance
           ============================================ */
        .filter-suite {
            background: linear-gradient(135deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.03) 100%);
            border: var(--border-light);
            border-radius: var(--radius-lg);
            padding: var(--sp-2xl);
            margin-bottom: var(--sp-3xl);
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
        }

        .filter-grid {
            display: grid;
            gap: var(--sp-lg);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: var(--sp-md);
        }

        .filter-label {
            font-size: var(--text-sm);
            font-weight: var(--fw-semibold);
            color: var(--laser-blue);
            letter-spacing: 0.3px;
        }

        .filter-controls {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: var(--sp-md);
        }

        .filter-btn {
            padding: 10px 16px;
            background: rgba(255,255,255,0.04);
            border: var(--border-thin);
            border-radius: var(--radius-md);
            color: var(--text-secondary);
            font-size: var(--text-sm);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: capitalize;
            font-weight: var(--fw-medium);
        }

        .filter-btn:hover,
        .filter-btn.active {
            border-color: var(--laser-blue);
            background: rgba(0,212,255,0.15);
            color: var(--laser-blue);
            box-shadow: 0 4px 12px rgba(0,212,255,0.2);
        }

        .filter-actions-row {
            display: flex;
            gap: var(--sp-md);
            margin-top: var(--sp-lg);
            padding-top: var(--sp-lg);
            border-top: var(--border-thin);
        }

        /* ============================================
           PREMIUM TRACKING TIMELINE
           ============================================ */
        .timeline {
            position: relative;
            padding: var(--sp-xl) 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, var(--laser-blue), var(--electric-violet));
        }

        .timeline-item {
            margin-bottom: var(--sp-xl);
            padding-left: var(--sp-3xl);
            position: relative;
        }

        .timeline-dot {
            position: absolute;
            left: 8px;
            top: 6px;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
            border: 3px solid var(--obsidian);
            border-radius: 50%;
            box-shadow: 0 0 16px rgba(0,212,255,0.4);
        }

        .timeline-item.completed .timeline-dot {
            background: var(--success);
        }

        .timeline-content {
            background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border: var(--border-light);
            border-radius: var(--radius-md);
            padding: var(--sp-lg);
            backdrop-filter: var(--backdrop);
        }

        .timeline-title {
            font-weight: var(--fw-semibold);
            color: var(--laser-blue);
            margin-bottom: var(--sp-sm);
        }

        .timeline-time {
            font-size: var(--text-sm);
            color: var(--text-muted);
        }

        /* ============================================
           CHECKOUT FORM PREMIUM
           ============================================ */
        .form-section {
            background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border: var(--border-light);
            border-radius: var(--radius-lg);
            padding: var(--sp-xl);
            margin-bottom: var(--sp-xl);
            backdrop-filter: var(--backdrop);
        }

        .form-section-title {
            font-size: var(--text-lg);
            font-weight: var(--fw-semibold);
            color: var(--laser-blue);
            margin-bottom: var(--sp-lg);
            display: flex;
            align-items: center;
            gap: var(--sp-md);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--sp-lg);
            margin-bottom: var(--sp-lg);
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .required-indicator {
            color: var(--hot-pink);
        }

        /* ============================================
           SUMMARY PANEL - Sticky Premium
           ====================================== */
        .summary-premium {
            background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
            border: var(--border-glow);
            border-radius: var(--radius-lg);
            padding: var(--sp-xl);
            position: sticky;
            top: 120px;
            height: fit-content;
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
        }

        .summary-title {
            font-size: var(--text-lg);
            font-weight: var(--fw-bold);
            color: var(--laser-blue);
            margin-bottom: var(--sp-lg);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--sp-md) 0;
            border-bottom: var(--border-thin);
            font-size: var(--text-base);
            color: var(--text-secondary);
        }

        .summary-item.total {
            border-bottom: none;
            padding-top: var(--sp-lg);
            font-size: var(--text-xl);
            font-weight: var(--fw-bold);
            color: var(--laser-blue);
        }

        .summary-item-value {
            font-weight: var(--fw-semibold);
            color: var(--text-primary);
        }

        /* ============================================
           EMPTY STATE - Beautiful Emptiness
           ============================================ */
        .empty-state-display {
            text-align: center;
            padding: var(--sp-3xl) var(--sp-2xl);
            background: linear-gradient(135deg, rgba(0,212,255,0.05), rgba(139,92,246,0.02));
            border: var(--border-glow);
            border-radius: var(--radius-lg);
            backdrop-filter: var(--backdrop);
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: var(--sp-xl);
            animation: float 3s ease-in-out infinite;
        }

        .empty-title {
            font-size: var(--text-2xl);
            font-weight: var(--fw-bold);
            color: var(--laser-blue);
            margin-bottom: var(--sp-md);
        }

        .empty-description {
            font-size: var(--text-base);
            color: var(--text-secondary);
            margin-bottom: var(--sp-xl);
            line-height: 1.6;
        }

        /* ============================================
           RESPONSIVE UPLIFTS
           ============================================ */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: var(--sp-lg);
        }

        label {
            display: block;
            margin-bottom: var(--sp-sm);
            font-size: var(--text-sm);
            color: var(--text-secondary);
            font-weight: var(--fw-medium);
            letter-spacing: 0.3px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            background: linear-gradient(135deg, rgba(255,255,255,0.05), rgba(255,255,255,0.08));
            border: var(--border-light);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-family: inherit;
            font-size: var(--text-base);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: var(--backdrop);
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--text-muted);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--laser-blue);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1), inset 0 0 0 1px rgba(0, 212, 255, 0.2);
            background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.12));
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2300d4ff' stroke-width='2'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 18px;
            padding-right: 40px;
            cursor: pointer;
        }

        /* ============================================
           ALERTS & MESSAGES
           ============================================ */
        .alert {
            padding: var(--sp-lg);
            border-radius: var(--radius-lg);
            margin-bottom: var(--sp-lg);
            border-left: 3px solid;
            background-color: rgba(255,255,255,0.02);
            backdrop-filter: var(--backdrop);
            display: flex;
            gap: var(--sp-md);
            align-items: flex-start;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            border-left-color: var(--success);
            color: #86efac;
            background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.05));
        }

        .alert-error {
            border-left-color: var(--error);
            color: #fca5a5;
            background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(239,68,68,0.05));
        }

        .alert-warning {
            border-left-color: var(--warning);
            color: #fde047;
            background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(245,158,11,0.05));
        }

        /* ============================================
           BADGES & TAGS
           ============================================ */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: var(--radius-xl);
            font-size: var(--text-xs);
            font-weight: var(--fw-semibold);
            letter-spacing: 0.3px;
            background: rgba(0,212,255,0.15);
            color: var(--laser-blue);
            border: 1px solid rgba(0,212,255,0.3);
        }

        .badge-hot {
            background: linear-gradient(135deg, rgba(255,0,110,0.2), rgba(255,0,110,0.1));
            color: #ff4d8f;
            border-color: rgba(255,0,110,0.3);
        }

        .badge-success {
            background: rgba(16,185,129,0.15);
            color: #10b981;
            border-color: rgba(16,185,129,0.3);
        }

        /* ============================================
           ANIMATIONS
           ============================================ */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-left {
            animation: slideInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-right {
            animation: slideInRight 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes glow-soft {
            0%, 100% {
                text-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
            }
            50% {
                text-shadow: 0 0 40px rgba(0, 212, 255, 0.6);
            }
        }

        .glow-text {
            animation: glow-soft 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        .shimmer-loading {
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.1) 50%, transparent 100%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        /* ============================================
           UTILITIES
           ============================================ */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .flex {
            display: flex;
        }

        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flex-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .flex-col {
            flex-direction: column;
        }

        .gap-sm { gap: var(--sp-sm); }
        .gap-md { gap: var(--sp-md); }
        .gap-lg { gap: var(--sp-lg); }

        .mb-xs { margin-bottom: var(--sp-xs); }
        .mb-sm { margin-bottom: var(--sp-sm); }
        .mb-md { margin-bottom: var(--sp-md); }
        .mb-lg { margin-bottom: var(--sp-lg); }
        .mb-xl { margin-bottom: var(--sp-xl); }

        .mt-xs { margin-top: var(--sp-xs); }
        .mt-sm { margin-top: var(--sp-sm); }
        .mt-md { margin-top: var(--sp-md); }
        .mt-lg { margin-top: var(--sp-lg); }
        .mt-xl { margin-top: var(--sp-xl); }

        .px-md { padding-left: var(--sp-md); padding-right: var(--sp-md); }
        .py-lg { padding-top: var(--sp-lg); padding-bottom: var(--sp-lg); }

        .relative {
            position: relative;
        }

        /* ============================================
           RESPONSIVE DESIGN
           ============================================ */
        @media (max-width: 1024px) {
            .container {
                padding: 0 var(--sp-xl);
            }

            .grid-cols-3 {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-cols-4 {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            :root {
                --sp-3xl: 24px;
            }

            .nav {
                padding: var(--sp-md) var(--sp-xl);
                flex-direction: column;
                gap: var(--sp-md);
            }

            .nav-links {
                gap: var(--sp-md);
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
                order: 3;
            }

            .logo {
                order: 1;
            }

            .main-content {
                padding-top: 140px;
            }

            .container {
                padding: 0 var(--sp-lg);
            }

            h1 {
                font-size: var(--text-3xl);
            }

            h2 {
                font-size: var(--text-2xl);
            }

            .grid-cols-2 {
                grid-template-columns: 1fr;
            }

            .grid-cols-3 {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-cols-4 {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-auto-fill {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            :root {
                --text-3xl: 28px;
                --text-4xl: 32px;
                --sp-3xl: 16px;
            }

            h1 {
                font-size: var(--text-3xl);
            }

            h2 {
                font-size: var(--text-xl);
            }

            p {
                font-size: var(--text-sm);
            }

            .btn {
                width: 100%;
            }

            .grid-auto-fill,
            .grid-cols-2,
            .grid-cols-3,
            .grid-cols-4 {
                grid-template-columns: 1fr;
            }

            .nav-links {
                flex-direction: column;
            }

            .btn-nav {
                width: 100%;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Navigation -->
    <nav class="nav">
        <a href="{{ route('home') }}" class="logo">OutfitChill</a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">Trang Chủ</a>
            <a href="{{ route('shop.index') }}" class="nav-link">Shop</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('contact') }}" class="nav-link">Contact</a>

            <a href="{{ route('cart.index') }}" class="nav-link" style="position: relative;">
                🛒 Giỏ Hàng
                @php
                    $cartCount = count(session()->get('cart', []));
                @endphp
                @if($cartCount > 0)
                    <span class="nav-badge" style="position: absolute; top: -8px; right: -12px;">{{ $cartCount }}</span>
                @endif
            </a>

            @auth
                <div style="display: flex; gap: 10px; align-items: center;">
                    <span style="font-size: 13px; color: #00f5ff;">{{ auth()->user()->name }}</span>
                    <a href="{{ route('order.list') }}" class="nav-link">Đơn Hàng</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-nav" style="font-size: 12px; padding: 8px 16px;">Đăng Xuất</button>
                    </form>
                </div>
            @else
                <a href="/login" class="btn-nav">Đăng Nhập</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            @if($message = session()->get('success'))
                <div class="alert alert-success fade-in">{{ $message }}</div>
            @endif
            @if($message = session()->get('error'))
                <div class="alert alert-error fade-in">{{ $message }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer style="background: linear-gradient(180deg, rgba(8,8,8,0.8) 0%, rgba(0,0,0,0.95) 100%); border-top: var(--border-glow); padding: var(--sp-3xl) var(--sp-xl); margin-top: var(--sp-3xl); position: relative; z-index: 2;">
        <div style="max-width: 1400px; margin: 0 auto;">
            <!-- Footer Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--sp-2xl); margin-bottom: var(--sp-3xl);">
                <!-- Brand -->
                <div>
                    <a href="{{ route('home') }}" style="font-size: 20px; font-weight: var(--fw-bold); background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-decoration: none; display: inline-block; margin-bottom: var(--sp-lg);">
                        OutfitChill Shop
                    </a>
                    <p style="color: var(--text-secondary); font-size: var(--text-sm); line-height: 1.6;">
                        Nơi tin cậy để mua sắm thời trang chất lượng cao với giá cạnh tranh nhất.
                    </p>
                </div>
                
                <!-- Shop Links -->
                <div>
                    <h4 style="color: var(--text-primary); font-size: var(--text-base); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">Cửa Hàng</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--sp-md);">
                        <li><a href="{{ route('shop.index') }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Tất Cả Sản Phẩm</a></li>
                        <li><a href="{{ route('shop.index', ['sort' => 'popular']) }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Sản Phẩm Phổ Biến</a></li>
                        <li><a href="{{ route('shop.index', ['sort' => 'latest']) }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Sản Phẩm Mới</a></li>
                    </ul>
                </div>
                
                <!-- Company Links -->
                <div>
                    <h4 style="color: var(--text-primary); font-size: var(--text-base); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">Công Ty</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--sp-md);">
                        <li><a href="{{ route('about') }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Về Chúng Tôi</a></li>
                        <li><a href="{{ route('contact') }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Liên Hệ</a></li>
                        <li><a href="#" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Blog</a></li>
                    </ul>
                </div>
                
                <!-- Account Links -->
                <div>
                    <h4 style="color: var(--text-primary); font-size: var(--text-base); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">Tài Khoản</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--sp-md);">
                        @auth
                            <li><a href="{{ route('order.list') }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Đơn Hàng Của Tôi</a></li>
                            <li><a href="{{ route('profile.show') }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Tài Khoản</a></li>
                        @else
                            <li><a href="{{ route('login') }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Đăng Nhập</a></li>
                            <li><a href="{{ route('register') }}" style="color: var(--text-secondary); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Đăng Ký</a></li>
                        @endauth
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 style="color: var(--text-primary); font-size: var(--text-base); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">Liên Hệ</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--sp-md);">
                        <li style="color: var(--text-secondary); font-size: var(--text-sm);">📧 support@outfitchill.com</li>
                        <li style="color: var(--text-secondary); font-size: var(--text-sm);">📱 1800-0000</li>
                        <li style="color: var(--text-secondary); font-size: var(--text-sm);">📍 123 Đường ABC, Hà Nội</li>
                    </ul>
                </div>
            </div>
            
            <!-- Divider -->
            <div style="border-top: var(--border-thin); margin-bottom: var(--sp-2xl);"></div>
            
            <!-- Bottom -->
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: var(--sp-lg);">
                <p style="color: var(--text-muted); font-size: var(--text-sm);">© 2024 OutfitChill Shop. All rights reserved.</p>
                <div style="display: flex; gap: var(--sp-xl); flex-wrap: wrap;">
                    <a href="#" style="color: var(--text-muted); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Chính Sách Bảo Mật</a>
                    <a href="#" style="color: var(--text-muted); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Điều Khoản Sử Dụng</a>
                    <a href="#" style="color: var(--text-muted); text-decoration: none; font-size: var(--text-sm); transition: color 0.3s;">Hỗ Trợ Khách Hàng</a>
                </div>
            </div>
        </div>
    </footer>

    @yield('extra-js')
</body>
</html>
