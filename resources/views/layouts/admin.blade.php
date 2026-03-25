<!DOCTYPE html>
<html lang="vi" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Control Center') - LEMTHAI Admin</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ============================================
           PREMIUM ADMIN DESIGN SYSTEM - Cyber-Luxe Control Center
           Unified with User-side Brand DNA
           ============================================ */

        /* CSS VARIABLES - Design Tokens */
        :root {
            /* Colors - Dark Backgrounds */
            --obsidian: #080808;
            --midnight: #0f1118;
            --carbon: #1a1f2e;
            --slate: #2d3142;
            --glass-light: rgba(255,255,255,0.08);
            --glass-lighter: rgba(255,255,255,0.12);
            --glass-lightest: rgba(255,255,255,0.16);
            
            /* Accents */
            --laser-blue: #00d4ff;
            --laser-blue-dim: #0099cc;
            --hot-pink: #ff006e;
            --electric-violet: #8b5cf6;
            
            /* Text */
            --text-primary: #f0f0f0;
            --text-secondary: #b0b0c0;
            --text-muted: #808090;
            
            /* Status */
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            
            /* Fonts */
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-display: 'Plus Jakarta Sans', 'Inter', sans-serif;
            
            /* Spacing */
            --sp-xs: 6px;
            --sp-sm: 12px;
            --sp-md: 16px;
            --sp-lg: 20px;
            --sp-xl: 24px;
            --sp-2xl: 32px;
            
            /* Radius */
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 20px;
            
            /* Borders */
            --border-thin: 1px solid rgba(255,255,255,0.08);
            --border-light: 1px solid rgba(255,255,255,0.12);
            --border-glow: 1px solid rgba(0,212,255,0.2);
            
            /* Shadows */
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.3);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.4);
            --shadow-lg: 0 16px 48px rgba(0,0,0,0.5);
            --shadow-glow: 0 0 20px rgba(0,212,255,0.15), 0 0 40px rgba(0,212,255,0.08);
            
            /* Effects */
            --backdrop: blur(20px);
            --backdrop-saturate: saturate(1.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: var(--font-sans);
        }

        body {
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
                radial-gradient(ellipse 800px 600px at 20% 50%, rgba(0, 212, 255, 0.05) 0%, transparent 60%),
                radial-gradient(ellipse 600px 800px at 80% 80%, rgba(139, 92, 246, 0.04) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
            filter: blur(40px);
        }

        /* ============================================
           SIDEBAR - Premium Dark Navigation
           ============================================ */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, rgba(8,8,8,0.98) 0%, rgba(15,17,24,0.95) 100%);
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
            border-right: var(--border-thin);
            overflow-y: auto;
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            right: -1px;
            height: 100%;
            width: 1px;
            background: linear-gradient(180deg, transparent, rgba(0,212,255,0.3), transparent);
        }

        .sidebar-logo {
            padding: var(--sp-2xl) var(--sp-xl);
            border-bottom: var(--border-thin);
            flex-shrink: 0;
        }

        .sidebar-logo-content {
            display: flex;
            align-items: center;
            gap: var(--sp-lg);
        }

        .sidebar-logo-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
            border-radius: var(--radius-lg);
            flex-shrink: 0;
            font-weight: 700;
            color: var(--obsidian);
            font-size: 20px;
            font-family: var(--font-display);
        }

        .sidebar-logo-text h3 {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-primary);
            font-family: var(--font-display);
            letter-spacing: -0.5px;
        }

        .sidebar-logo-text p {
            font-size: 11px;
            color: var(--laser-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: var(--sp-xl) var(--sp-lg);
        }

        .nav-section {
            margin-bottom: var(--sp-2xl);
        }

        .nav-section-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--laser-blue-dim);
            letter-spacing: 1px;
            padding: 0 var(--sp-lg);
            margin-bottom: var(--sp-lg);
            display: block;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: var(--sp-lg);
            padding: var(--sp-lg);
            margin-bottom: var(--sp-sm);
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-weight: 500;
            font-size: 14px;
        }

        .nav-link:hover {
            color: var(--laser-blue);
            background: linear-gradient(90deg, rgba(0,212,255,0.1), transparent);
            padding-left: calc(var(--sp-lg) + 4px);
        }

        .nav-link.active {
            color: var(--laser-blue);
            background: linear-gradient(90deg, rgba(0,212,255,0.15), transparent);
            border-left: 3px solid var(--laser-blue);
            padding-left: calc(var(--sp-lg) - 3px);
            font-weight: 600;
        }

        .nav-link i {
            width: 18px;
            opacity: 0.9;
        }

        .sidebar-footer {
            padding: var(--sp-xl) var(--sp-lg);
            border-top: var(--border-thin);
            flex-shrink: 0;
        }

        /* ============================================
           TOPBAR - Premium Control Header
           ============================================ */
        .topbar {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 80px;
            background: linear-gradient(180deg, rgba(8,8,8,0.95) 0%, rgba(8,8,8,0.85) 100%);
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
            border-bottom: var(--border-thin);
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 var(--sp-2xl);
        }

        .topbar::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,212,255,0.2), transparent);
        }

        .topbar-title {
            flex: 1;
        }

        .topbar-title h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            font-family: var(--font-display);
            letter-spacing: -0.5px;
            margin-bottom: 2px;
        }

        .topbar-title p {
            font-size: 12px;
            color: var(--text-muted);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: var(--sp-xl);
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .user-role {
            font-size: 11px;
            color: var(--laser-blue);
            margin-top: 2px;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-lg);
            border: var(--border-light);
            background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(139,92,246,0.2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--laser-blue);
            font-size: 16px;
        }

        /* ============================================
           MAIN CONTENT AREA
           ============================================ */
        .main {
            margin-left: 280px;
            margin-top: 80px;
            min-height: calc(100vh - 80px);
            padding: var(--sp-2xl);
            position: relative;
            z-index: 1;
        }

        .main-content {
            max-width: 1600px;
            margin: 0 auto;
        }

        /* ============================================
           SURFACE/PANEL SYSTEM - Elevation Levels
           ============================================ */
        .panel {
            background: linear-gradient(135deg, var(--glass-light), var(--glass-lighter));
            backdrop-filter: var(--backdrop) var(--backdrop-saturate);
            border: var(--border-light);
            border-radius: var(--radius-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .panel-elevated {
            background: linear-gradient(135deg, var(--glass-lighter), var(--glass-lightest));
            border: var(--border-glow);
            box-shadow: var(--shadow-sm);
        }

        .panel-elevated:hover {
            background: linear-gradient(135deg, var(--glass-lightest), rgba(255,255,255,0.2));
            border-color: rgba(0,212,255,0.4);
            box-shadow: var(--shadow-sm), var(--shadow-glow);
        }

        /* ============================================
           TYPOGRAPHY
           ============================================ */
        h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            font-family: var(--font-display);
            letter-spacing: -0.5px;
        }

        h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-primary);
            font-family: var(--font-display);
        }

        h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        p {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* ============================================
           BUTTONS - Premium States
           ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 22px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            gap: var(--sp-sm);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--laser-blue), var(--laser-blue-dim));
            color: var(--obsidian);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .btn-secondary {
            background: transparent;
            border: var(--border-light);
            color: var(--text-secondary);
        }

        .btn-secondary:hover {
            background: linear-gradient(90deg, rgba(0,212,255,0.1), transparent);
            border-color: var(--laser-blue);
            color: var(--laser-blue);
        }

        .btn-danger {
            background: rgba(239,68,68,0.2);
            border: 1px solid rgba(239,68,68,0.4);
            color: var(--error);
        }

        .btn-danger:hover {
            background: rgba(239,68,68,0.3);
            border-color: var(--error);
        }

        /* ============================================
           FORMS
           ============================================ */
        input, textarea, select {
            background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.06));
            border: var(--border-light);
            border-radius: var(--radius-md);
            padding: 10px 14px;
            color: var(--text-primary);
            font-family: var(--font-sans);
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        input::placeholder, textarea::placeholder {
            color: var(--text-muted);
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--laser-blue);
            background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.04));
            box-shadow: var(--shadow-glow);
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--sp-sm);
        }

        /* ============================================
           BADGES & TAGS
           ============================================ */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: rgba(16,185,129,0.2);
            color: var(--success);
            border: 1px solid rgba(16,185,129,0.3);
        }

        .badge-error {
            background: rgba(239,68,68,0.2);
            color: var(--error);
            border: 1px solid rgba(239,68,68,0.3);
        }

        .badge-warning {
            background: rgba(245,158,11,0.2);
            color: var(--warning);
            border: 1px solid rgba(245,158,11,0.3);
        }

        .badge-info {
            background: rgba(0,212,255,0.2);
            color: var(--laser-blue);
            border: 1px solid rgba(0,212,255,0.3);
        }

        .badge-primary {
            background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(139,92,246,0.2));
            color: var(--laser-blue);
            border: 1px solid rgba(0,212,255,0.3);
        }

        .badge-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* ============================================
           TABLES - Premium Data Visualization
           ============================================ */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead {
            background: linear-gradient(90deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border-bottom: var(--border-light);
        }

        th {
            padding: var(--sp-lg);
            text-align: left;
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 12px;
        }

        td {
            padding: var(--sp-lg);
            border-bottom: var(--border-thin);
            color: var(--text-primary);
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, rgba(0,212,255,0.05), transparent);
            border-bottom-color: rgba(0,212,255,0.1);
        }

        /* ============================================
           ALERTS
           ============================================ */
        .alert {
            padding: var(--sp-xl);
            border-radius: var(--radius-lg);
            border-left: 4px solid;
            margin-bottom: var(--sp-xl);
            display: flex;
            align-items: flex-start;
            gap: var(--sp-lg);
        }

        .alert-success {
            background: rgba(16,185,129,0.1);
            border-left-color: var(--success);
            color: var(--success);
        }

        .alert-error {
            background: rgba(239,68,68,0.1);
            border-left-color: var(--error);
            color: var(--error);
        }

        .alert-warning {
            background: rgba(245,158,11,0.1);
            border-left-color: var(--warning);
            color: var(--warning);
        }

        .alert-info {
            background: rgba(0,212,255,0.1);
            border-left-color: var(--laser-blue);
            color: var(--laser-blue);
        }

        /* ============================================
           PAGINATION
           ============================================ */
        .pagination {
            display: flex;
            gap: var(--sp-sm);
            justify-content: center;
            margin-top: var(--sp-2xl);
        }

        .pagination a, .pagination span {
            padding: 8px 12px;
            border: var(--border-light);
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: linear-gradient(135deg, rgba(0,212,255,0.1), transparent);
            border-color: var(--laser-blue);
            color: var(--laser-blue);
        }

        .pagination .active {
            background: linear-gradient(135deg, var(--laser-blue), var(--laser-blue-dim));
            border-color: var(--laser-blue);
            color: var(--obsidian);
            font-weight: 600;
        }

        /* ============================================
           UTILITIES
           ============================================ */
        .text-muted {
            color: var(--text-muted);
        }

        .text-secondary {
            color: var(--text-secondary);
        }

        .gap-xs { gap: var(--sp-xs) !important; }
        .gap-sm { gap: var(--sp-sm) !important; }
        .gap-md { gap: var(--sp-md) !important; }
        .gap-lg { gap: var(--sp-lg) !important; }
        .gap-xl { gap: var(--sp-xl) !important; }

        .p-xs { padding: var(--sp-xs) !important; }
        .p-sm { padding: var(--sp-sm) !important; }
        .p-md { padding: var(--sp-md) !important; }
        .p-lg { padding: var(--sp-lg) !important; }
        .p-xl { padding: var(--sp-xl) !important; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            .topbar {
                left: 0;
            }
            .main {
                margin-left: 0;
                padding: var(--sp-lg);
            }
            .topbar-user {
                gap: var(--sp-md);
            }
            .topbar-title h1 {
                font-size: 18px;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-content">
                <div class="sidebar-logo-icon">LT</div>
                <div class="sidebar-logo-text">
                    <h3>LEMTHAI</h3>
                    <p>Control</p>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="nav-section">
                <label class="nav-section-label">Sản Phẩm</label>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box-open"></i>
                    <span>Danh sách</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    <span>Danh mục</span>
                </a>
            </div>

            <div class="nav-section">
                <label class="nav-section-label">Bán Hàng</label>
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Đơn hàng</span>
                </a>
            </div>

            <div class="nav-section">
                <label class="nav-section-label">Báo Cáo</label>
                <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Thống kê</span>
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-title">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <p>@yield('page-subtitle', '')</p>
        </div>
        <div class="topbar-user">
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ auth()->user()->role === 'quan_tri' ? 'Admin' : 'User' }}</div>
            </div>
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="main-content">
            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Lỗi!</strong>
                        <ul style="margin-top: 6px; margin-left: 20px; list-style: disc;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @yield('extra-js')
</body>
</html>
