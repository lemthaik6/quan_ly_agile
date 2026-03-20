@extends('layouts.auth')

@section('title', 'Đăng ký - LEMTHAI')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="font-orbitron font-bold text-3xl mb-2 glow-text">LEMTHAI</h1>
            <p class="text-gray-400">Tạo tài khoản mới của bạn</p>
        </div>

        <!-- Success Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 rounded-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-300 font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-red-400 font-semibold mb-2">Lỗi xác thực</h3>
                        <ul class="text-red-300 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="card-gradient rounded-lg p-8 space-y-4">
            @csrf
            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold mb-2">Họ tên</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-gray-800 border {{ $errors->has('name') ? 'border-red-500' : 'border-cyan-500/20' }} rounded-lg px-4 py-2 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 text-white" placeholder="Nhập họ tên">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-gray-800 border {{ $errors->has('email') ? 'border-red-500' : 'border-cyan-500/20' }} rounded-lg px-4 py-2 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 text-white" placeholder="your@email.com">
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold mb-2">Số điện thoại</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full bg-gray-800 border {{ $errors->has('phone') ? 'border-red-500' : 'border-cyan-500/20' }} rounded-lg px-4 py-2 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 text-white" placeholder="+84 9xx xxx xxx">
                @error('phone')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold mb-2">Mật khẩu</label>
                <input type="password" name="password" required class="w-full bg-gray-800 border {{ $errors->has('password') ? 'border-red-500' : 'border-cyan-500/20' }} rounded-lg px-4 py-2 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 text-white" placeholder="••••••••">
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-semibold mb-2">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" required class="w-full bg-gray-800 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-cyan-500/20' }} rounded-lg px-4 py-2 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 text-white" placeholder="••••••••">
                @error('password_confirmation')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Terms -->
            <label class="flex items-start">
                <input type="checkbox" name="terms" required class="w-4 h-4 rounded accent-cyan-400 mt-1">
                <span class="ml-2 text-sm text-gray-400">
                    Tôi đồng ý với
                    <a href="#" class="text-cyan-400 hover:text-cyan-300">Điều khoản sử dụng</a>
                </span>
            </label>

            <!-- Submit Button -->
            <button type="submit" class="w-full btn-primary text-white font-semibold py-3 rounded-lg transition-all hover:shadow-lg mt-6" style="background: linear-gradient(135deg, #0066ff, #8b5cf6);">
                Đăng ký
            </button>

            <!-- Divider -->
            <div class="relative my-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-cyan-500/10"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-gray-900/50 text-gray-400">Hoặc</span>
                </div>
            </div>

            <!-- Social Register -->
            <button type="button" class="w-full btn-secondary text-white font-semibold py-2 rounded-lg flex items-center justify-center gap-2 text-sm" style="border: 1px solid #00f5ff; color: #00f5ff;">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                </svg>
                Đăng ký với Google
            </button>
        </form>

        <!-- Login Link -->
        <p class="text-center text-gray-400 mt-6">
            Bạn đã có tài khoản?
            <a href="/login" class="text-cyan-400 font-semibold hover:text-cyan-300">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection
