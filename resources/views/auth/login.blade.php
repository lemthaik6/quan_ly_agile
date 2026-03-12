<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Quản Lý Agile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent mb-2">
                Agile
            </h1>
            <p class="text-slate-400">Hệ Thống Quản Lý</p>
        </div>

        <!-- Login Card -->
        <div class="backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-6">Đăng Nhập</h2>

            @if($errors->any())
                <div class="bg-red-900/20 border border-red-700/50 rounded-lg p-4 mb-6">
                    <p class="text-red-400 text-sm">{{ $errors->first('email') ?? $errors->first() }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-900/20 border border-red-700/50 rounded-lg p-4 mb-6">
                    <p class="text-red-400 text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500/50 focus:bg-slate-700/80 transition"
                        placeholder="admin@example.com"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Mật Khẩu</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500/50 focus:bg-slate-700/80 transition"
                        placeholder="Nhập mật khẩu"
                    >
                </div>

                <!-- Remember Me -->
                <label class="flex items-center text-sm text-slate-400 cursor-pointer hover:text-slate-300 transition">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-700 border-slate-600 text-cyan-500 cursor-pointer">
                    <span class="ml-2">Ghi nhớ tôi</span>
                </label>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-600 hover:to-purple-700 text-white font-semibold py-3 rounded-lg transition duration-300 mt-6"
                >
                    Đăng Nhập
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center gap-4 my-6">
                <div class="flex-1 h-px bg-slate-700"></div>
                <span class="text-slate-500 text-sm">hoặc</span>
                <div class="flex-1 h-px bg-slate-700"></div>
            </div>

            <!-- Register Link -->
            <p class="text-center text-slate-400">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition">
                    Đăng ký ngay
                </a>
            </p>

            <!-- Demo Credentials -->
            <div class="mt-6 p-4 bg-slate-700/30 border border-slate-600/30 rounded-lg">
                <p class="text-xs text-slate-400 mb-2">📝 Tài khoản demo:</p>
                <p class="text-xs text-slate-300">Email: <code class="text-cyan-300">admin@lemthai.com</code></p>
                <p class="text-xs text-slate-300">Password: <code class="text-cyan-300">admin123</code></p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-slate-500 text-sm mt-6">
            © 2026 Quản Lý Agile. Tất cả quyền được bảo lưu.
        </p>
    </div>
</body>
</html>
