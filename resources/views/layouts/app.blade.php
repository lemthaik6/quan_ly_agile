<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OutfitChill Shop')</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        
        body {
            background: linear-gradient(135deg, #030014 0%, #0a0a1f 50%, #030014 100%);
            color: #e5e7eb;
            font-family: 'Inter', sans-serif;
        }
        
        .font-orbitron { font-family: 'Orbitron', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #00f5ff, #0066ff);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0066ff, #8b5cf6);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            box-shadow: 0 0 30px rgba(0, 102, 255, 0.6);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            border: 1px solid #00f5ff;
            color: #00f5ff;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: rgba(0, 245, 255, 0.1);
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.4);
        }
        
        .card-gradient {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 245, 255, 0.2);
        }
        
        .card-gradient:hover {
            border-color: rgba(0, 245, 255, 0.5);
            box-shadow: 0 0 20px rgba(0, 102, 255, 0.3);
        }
        
        .glow-text {
            color: #00f5ff;
            text-shadow: 0 0 10px rgba(0, 245, 255, 0.6);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
<body class="font-inter antialiased">
    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-orbitron font-bold text-lg">O</span>
                    </div>
                    <span class="font-orbitron font-bold text-xl glow-text">OutfitChill</span>
                </a>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link hover:text-cyan-400">Trang chủ</a>
                    <a href="/shop" class="nav-link hover:text-cyan-400">Sản phẩm</a>
                    <a href="/orders" class="nav-link hover:text-cyan-400">Đơn hàng</a>
                    <a href="#" class="nav-link hover:text-cyan-400">Về chúng tôi</a>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-4">
                    <a href="/cart" class="relative p-2 hover:text-cyan-400 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </a>
                    
                    <a href="/login" class="btn-secondary px-4 py-2 rounded-lg text-sm">Đăng nhập</a>
                    <a href="/register" class="btn-primary px-4 py-2 rounded-lg text-white text-sm">Đăng ký</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-cyan-500/10 mt-20 bg-black/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="font-orbitron font-bold mb-4 glow-text">OutfitChill</h3>
                    <p class="text-gray-400 text-sm">Tái định nghĩa trải nghiệm số với công nghệ tiên tiến.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Sản phẩm</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyan-400">Sản phẩm mới</a></li>
                        <li><a href="#" class="hover:text-cyan-400">Bán chạy nhất</a></li>
                        <li><a href="#" class="hover:text-cyan-400">Khuyến mãi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Hỗ trợ</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-cyan-400">Trợ giúp</a></li>
                        <li><a href="#" class="hover:text-cyan-400">Liên hệ</a></li>
                        <li><a href="#" class="hover:text-cyan-400">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kết nối</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-cyan-400">Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400">Twitter</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-cyan-500/10 pt-8 flex justify-between items-center text-sm text-gray-400">
                <p>&copy; 2024 OutfitChill. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-cyan-400">Privacy</a>
                    <a href="#" class="hover:text-cyan-400">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
