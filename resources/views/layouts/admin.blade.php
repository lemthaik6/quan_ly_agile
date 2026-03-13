<!DOCTYPE html>
<html lang="vi" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Trị Viên') - LEMTHAI</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        
        :root {
            --bg-primary: #f8f9fa;
            --bg-secondary: #ffffff;
            --blue-primary: #2563eb;
            --blue-glow: #3b82f6;
            --purple-glow: #7c3aed;
            --magenta-glow: #ec4899;
        }
        
        .font-orbitron { font-family: 'Orbitron', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        
        body {
            background: var(--bg-primary);
            color: #1f2937;
        }
        
        .glass-effect {
            background: #ffffff;
            backdrop-filter: blur(20px);
            border: 1px solid #e5e7eb;
        }
        
        .sidebar-nav {
            background: #ffffff;
            backdrop-filter: blur(20px);
            border-right: 1px solid #e5e7eb;
        }
        
        .nav-link {
            position: relative;
            color: #6b7280;
            transition: all 0.3s ease;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-link:hover {
            color: #2563eb;
            background: #eff6ff;
            padding-left: 24px;
        }
        
        .nav-link.active {
            color: #2563eb;
            background: #dbeafe;
            border-left: 3px solid #2563eb;
            padding-left: 17px;
        }
        
        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
        }
        
        .stat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
        
        .btn-secondary {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #4b5563;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        
        .btn-secondary:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.3);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        thead tr {
            background: #f3f4f6;
        }
        
        th {
            padding: 12px;
            text-align: left;
            color: #1f2937;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        tbody tr:hover {
            background: #f9fafb;
        }
        
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }
        
        .input-group label {
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }
        
        .input-group input,
        .input-group textarea,
        .input-group select {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 10px 12px;
            color: #1f2937;
            font-family: 'Inter', sans-serif;
        }
        
        .input-group input:focus,
        .input-group textarea:focus,
        .input-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
        
        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }
        
        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }
        
        .pagination {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            justify-content: center;
        }
        
        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #4b5563;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .pagination a:hover {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #3b82f6;
        }
        
        .pagination .active {
            background: #3b82f6;
            color: #fff;
            border-color: #3b82f6;
        }
    </style>
    @yield('extra-css')
</head>
<body class="h-full bg-gray-50">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="w-64 sidebar-nav fixed h-full overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-blue-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10">
                        <svg viewbox="0 0 40 40" class="w-full h-full">
                            <defs>
                                <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#2563eb" />
                                    <stop offset="100%" stop-color="#7c3aed" />
                                </linearGradient>
                            </defs>
                            <polygon points="20,2 38,32 2,32" fill="none" stroke="url(#logoGrad)" stroke-width="2" />
                            <circle cx="20" cy="20" r="6" fill="url(#logoGrad)" opacity="0.8" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-orbitron font-bold text-lg text-blue-600">LEMTHAI</div>
                        <div class="text-xs text-blue-600/60">Quản Trị</div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="py-6">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="mt-8">
                    <div class="px-6 py-2 text-xs font-orbitron text-blue-600/50 uppercase tracking-wider">Sản Phẩm</div>
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-box-open w-5"></i>
                        <span>Danh sách</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-folder w-5"></i>
                        <span>Danh mục</span>
                    </a>
                </div>
                
                <div class="mt-8">
                    <div class="px-6 py-2 text-xs font-orbitron text-blue-600/50 uppercase tracking-wider">Bán Hàng</div>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart w-5"></i>
                        <span>Đơn hàng</span>
                    </a>
                </div>
                
                <div class="mt-8">
                    <div class="px-6 py-2 text-xs font-orbitron text-blue-600/50 uppercase tracking-wider">Lập Báo Cáo</div>
                    <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Thống kê</span>
                    </a>
                </div>

                <hr class="my-8 border-blue-200">
                
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Đăng xuất</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 flex-1 flex flex-col h-full">
            <!-- Top Header -->
            <div class="glass-effect px-8 py-4 border-b">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-orbitron font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', '')</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <div class="text-sm text-gray-700">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ auth()->user()->role === 'quan_tri' ? 'Quản Trị Viên' : 'Khách Hàng' }}</div>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=dbeafe&color=2563eb" alt="Avatar" class="w-10 h-10 rounded-full border border-blue-300">
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="flex-1 overflow-auto p-8">
                @if ($errors->any())
                    <div class="alert alert-danger mb-6">
                        <strong>Lỗi!</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    @yield('extra-js')
</body>
</html>
