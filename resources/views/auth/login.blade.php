@extends('layouts.app')

@section('title', 'Đăng nhập - LEMTHAI')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg mb-4">
                <span class="text-white font-orbitron font-bold text-2xl">L</span>
            </div>
            <h1 class="font-orbitron font-bold text-3xl mb-2 glow-text">LEMTHAI</h1>
            <p class="text-gray-400">Đăng nhập vào tài khoản của bạn</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="card-gradient rounded-lg p-8 space-y-6">
            @csrf
            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold mb-2">Email</label>
                <input type="email" name="email" required class="w-full bg-gray-800 border border-cyan-500/20 rounded-lg px-4 py-2 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 text-white" placeholder="your@email.com">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold mb-2">Mật khẩu</label>
                <input type="password" name="password" required class="w-full bg-gray-800 border border-cyan-500/20 rounded-lg px-4 py-2 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 text-white" placeholder="••••••••">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-cyan-400">
                    <span class="ml-2 text-sm">Ghi nhớ tôi</span>
                </label>
                <a href="#" class="text-sm text-cyan-400 hover:text-cyan-300">Quên mật khẩu?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full btn-primary text-white font-semibold py-3 rounded-lg transition-all hover:shadow-lg" style="background: linear-gradient(135deg, #0066ff, #8b5cf6);">
                Đăng nhập
            </button>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-cyan-500/10"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-gray-900/50 text-gray-400">Hoặc</span>
                </div>
            </div>

            <!-- Social Login -->
            <div class="space-y-3">
                <button type="button" class="w-full btn-secondary text-white font-semibold py-2 rounded-lg flex items-center justify-center gap-2" style="border: 1px solid #00f5ff; color: #00f5ff;">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    </svg>
                    Google
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <p class="text-center text-gray-400 mt-6">
            Bạn chưa có tài khoản?
            <a href="/register" class="text-cyan-400 font-semibold hover:text-cyan-300">Đăng ký ngay</a>
        </p>
    </div>
</div>
@endsection
