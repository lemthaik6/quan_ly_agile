@extends('layouts.auth')

@section('title', 'Đăng nhập - LEMTHAI')

@section('content')
<div class="auth-card">
    <!-- Header -->
    <div class="auth-header">
        <div class="auth-logo">🚀</div>
        <h1 class="auth-title">Welcome Back</h1>
        <p class="auth-subtitle">Đăng nhập vào tài khoản của bạn</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error">
                <strong>Lỗi:</strong> {{ $error }}
            </div>
        @endforeach
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input 
                type="email" 
                id="email"
                name="email" 
                value="{{ old('email') }}" 
                placeholder="your@email.com"
                required 
                class="form-input @error('email') border-red-500 @enderror"
            >
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Mật Khẩu</label>
            <input 
                type="password" 
                id="password"
                name="password" 
                placeholder="••••••••"
                required 
                class="form-input @error('password') border-red-500 @enderror"
            >
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="checkbox-group" style="justify-content: space-between;">
            <label class="checkbox-group" style="margin: 0;">
                <input type="checkbox" name="remember" class="checkbox-input">
                <span>Ghi nhớ tôi</span>
            </label>
            <a href="#" class="text-sm" style="cursor: not-allowed; opacity: 0.5;">Quên mật khẩu?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="auth-button" style="width: 100%; margin-top: 8px;">
            ✓ Đăng Nhập
        </button>
    </form>

    <!-- Divider -->
    <div class="auth-divider">
        <span class="auth-divider-text">Hoặc</span>
    </div>

    <!-- Social Login -->
    <button type="button" onclick="alert('Social login coming soon!')" class="auth-button" style="width: 100%; background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(139,92,246,0.2)); color: var(--laser-blue); border: var(--border-light);">
        🔵 Tiếp Tục Với Google
    </button>

    <!-- Register Link -->
    <div class="auth-link">
        Bạn chưa có tài khoản?
        <a href="{{ route('register') }}">Đăng ký ngay →</a>
    </div>
</div>
@endsection
