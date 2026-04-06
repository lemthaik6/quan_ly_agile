@extends('layouts.shop')

@section('title', 'OutfitChill Shop')

@section('content')
<div style="text-align: center; padding: 60px 20px;">
    <p style="font-size: 16px; color: #00f5ff; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">Chào Mừng</p>
    <h1 class="glow-text" style="font-size: 64px; margin-bottom: 20px;">OutfitChill Shop</h1>
    <p style="color: #ccc; font-size: 20px; margin-bottom: 50px;">Trải Nghiệm Mua Sắm Tương Lai</p>

    <div style="display: flex; justify-content: center; gap: 20px; margin-bottom: 80px;">
        <a href="{{ route('shop.index') }}" class="btn btn-primary" style="padding: 15px 40px;">
            🛍️ Khám Phá Ngay
        </a>
        <a href="#" class="btn btn-secondary" style="padding: 15px 40px;">
            ℹ️ Chi Tiết
        </a>
    </div>

    <!-- Stats -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; max-width: 800px; margin: 0 auto;">
        <div>
            <div style="font-size: 36px; color: #00f5ff; font-weight: bold; margin-bottom: 10px;">10K+</div>
            <div style="color: #999;">Sản Phẩm</div>
        </div>
        <div>
            <div style="font-size: 36px; color: #00f5ff; font-weight: bold; margin-bottom: 10px;">50K+</div>
            <div style="color: #999;">Khách Hàng</div>
        </div>
        <div>
            <div style="font-size: 36px; color: #00f5ff; font-weight: bold; margin-bottom: 10px;">24/7</div>
            <div style="color: #999;">Hỗ Trợ</div>
        </div>
    </div>
</div>
@endsection
