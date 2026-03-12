<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - Quản Lý Agile</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        <!-- Register Card -->
        <div class="backdrop-blur-xl bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-6">Tạo Tài Khoản</h2>

            @if($errors->any())
                <div class="bg-red-900/20 border border-red-700/50 rounded-lg p-4 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-red-400 text-sm">• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tên Đầy Đủ</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500/50 focus:bg-slate-700/80 transition"
                        placeholder="Nhập tên của bạn"
                    >
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500/50 focus:bg-slate-700/80 transition"
                        placeholder="your@email.com"
                    >
                </div>

                <!-- Phone Field -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Số Điện Thoại (Tùy Chọn)</label>
                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500/50 focus:bg-slate-700/80 transition"
                        placeholder="0123456789"
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
                        placeholder="Tối thiểu 6 ký tự"
                    >
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Xác Nhận Mật Khẩu</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500/50 focus:bg-slate-700/80 transition"
                        placeholder="Nhập lại mật khẩu"
                    >
                </div>

                <!-- Register Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-600 hover:to-purple-700 text-white font-semibold py-3 rounded-lg transition duration-300 mt-6"
                >
                    Đăng Ký
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center gap-4 my-6">
                <div class="flex-1 h-px bg-slate-700"></div>
                <span class="text-slate-500 text-sm">hoặc</span>
                <div class="flex-1 h-px bg-slate-700"></div>
            </div>

            <!-- Login Link -->
            <p class="text-center text-slate-400">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition">
                    Đăng nhập
                </a>
            </p>
        </div>

        <!-- Footer -->
        <p class="text-center text-slate-500 text-sm mt-6">
            © 2026 Quản Lý Agile. Tất cả quyền được bảo lưu.
        </p>
    </div>
</body>
</html>
