@extends('layouts.auth')

@section('title', 'Đăng ký - OutfitChill Shop')

@section('content')
<div class="auth-card">
    <!-- Header -->
    <div class="auth-header">
        <div class="auth-logo">✨</div>
        <h1 class="auth-title">Join Us</h1>
        <p class="auth-subtitle">Tạo tài khoản mới của bạn</p>
    </div>

    <!-- Success Messages -->
    @if (session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error">
                <strong>Lỗi:</strong> {{ $error }}
            </div>
        @endforeach
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="form-label">Họ Tên</label>
            <input 
                type="text" 
                id="name"
                name="name" 
                value="{{ old('name') }}" 
                placeholder="Nhập họ tên đầy đủ"
                required 
                class="form-input @error('name') border-red-500 @enderror"
            >
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

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

        <!-- Phone -->
        <div class="form-group">
            <label for="phone" class="form-label">Số Điện Thoại</label>
            <input 
                type="tel" 
                id="phone"
                name="phone" 
                value="{{ old('phone') }}" 
                placeholder="+84 9xx xxx xxx"
                class="form-input @error('phone') border-red-500 @enderror"
            >
            @error('phone')
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

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu</label>
            <input 
                type="password" 
                id="password_confirmation"
                name="password_confirmation" 
                placeholder="••••••••"
                required 
                class="form-input @error('password_confirmation') border-red-500 @enderror"
            >
            @error('password_confirmation')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Terms & Conditions -->
        <div class="checkbox-group">
            <input type="checkbox" name="terms" id="terms" required class="checkbox-input">
            <label for="terms" style="margin: 0; cursor: pointer;">
                Tôi đồng ý với <a href="#" target="_blank">Điều khoản sử dụng</a> và <a href="#" target="_blank">Chính sách bảo mật</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="auth-button" style="width: 100%; margin-top: 8px;">
            ✓ Tạo Tài Khoản
        </button>
    </form>

    <!-- Divider -->
    <div class="auth-divider">
        <span class="auth-divider-text">Hoặc</span>
    </div>

    <!-- Social Register -->
    <button type="button" onclick="alert('Social register coming soon!')" class="auth-button" style="width: 100%; background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(139,92,246,0.2)); color: var(--laser-blue); border: var(--border-light);">
        🔵 Đăng Ký Với Google
    </button>

    <!-- Login Link -->
    <div class="auth-link">
        Bạn đã có tài khoản?
        <a href="{{ route('login') }}">Đăng nhập →</a>
    </div>
</div>
@endsection
