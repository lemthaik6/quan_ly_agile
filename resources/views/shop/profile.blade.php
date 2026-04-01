@extends('layouts.shop')

@section('title', 'Tài Khoản Của Tôi')

@section('content')
<div class="min-h-screen pt-24 pb-16" style="background: linear-gradient(135deg, rgba(0, 212, 255, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);">
    <div style="max-width: 900px; margin: 0 auto; padding: 0 var(--sp-md);">
        <!-- Page Header -->
        <div style="margin-bottom: var(--sp-xl);">
            <h1 style="color: var(--text-primary); font-size: 2.5rem; font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">
                Tài Khoản Của Tôi
            </h1>
            <p style="color: var(--text-secondary); font-size: var(--text-base);">
                Quản lý thông tin cá nhân và tài khoản của bạn
            </p>
        </div>

        <!-- Profile Content -->
        <div style="display: grid; grid-template-columns: 1fr; gap: var(--sp-xl); margin-bottom: var(--sp-xl);">
            <!-- User Information Card -->
            <div style="
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(0, 212, 255, 0.2);
                border-radius: var(--radius-lg);
                padding: var(--sp-lg);
                backdrop-filter: blur(10px);
            ">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--sp-lg);">
                    <h2 style="color: var(--text-primary); font-size: var(--text-lg); font-weight: var(--fw-bold);">
                        Thông Tin Cá Nhân
                    </h2>
                    <a href="#" style="
                        color: var(--laser-blue);
                        text-decoration: none;
                        font-size: var(--text-sm);
                        padding: var(--sp-sm) var(--sp-md);
                        border: 1px solid rgba(0, 212, 255, 0.3);
                        border-radius: var(--radius-md);
                        transition: all 0.3s;
                        display: inline-block;
                    ">
                        Chỉnh Sửa
                    </a>
                </div>

                <!-- Profile Information Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-lg);">
                    <!-- Full Name -->
                    <div>
                        <label style="display: block; color: var(--text-secondary); font-size: var(--text-sm); margin-bottom: var(--sp-sm);">
                            Họ Và Tên
                        </label>
                        <p style="color: var(--text-primary); font-size: var(--text-base); font-weight: 500;">
                            {{ $user->name }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label style="display: block; color: var(--text-secondary); font-size: var(--text-sm); margin-bottom: var(--sp-sm);">
                            Email
                        </label>
                        <p style="color: var(--text-primary); font-size: var(--text-base); font-weight: 500;">
                            {{ $user->email }}
                        </p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label style="display: block; color: var(--text-secondary); font-size: var(--text-sm); margin-bottom: var(--sp-sm);">
                            Số Điện Thoại
                        </label>
                        <p style="color: var(--text-primary); font-size: var(--text-base); font-weight: 500;">
                            {{ $user->phone ?? 'Chưa cập nhật' }}
                        </p>
                    </div>

                    <!-- Role -->
                    <div>
                        <label style="display: block; color: var(--text-secondary); font-size: var(--text-sm); margin-bottom: var(--sp-sm);">
                            Vai Trò
                        </label>
                        <p style="color: var(--text-primary); font-size: var(--text-base); font-weight: 500;">
                            {{ $user->role === 'admin' ? 'Quản Trị Viên' : ($user->role === 'staff' ? 'Nhân Viên' : 'Khách Hàng') }}
                        </p>
                    </div>

                    <!-- Address -->
                    <div style="grid-column: 1 / -1;">
                        <label style="display: block; color: var(--text-secondary); font-size: var(--text-sm); margin-bottom: var(--sp-sm);">
                            Địa Chỉ
                        </label>
                        <p style="color: var(--text-primary); font-size: var(--text-base); font-weight: 500;">
                            {{ $user->address ?? 'Chưa cập nhật' }}
                        </p>
                    </div>

                    <!-- City -->
                    <div>
                        <label style="display: block; color: var(--text-secondary); font-size: var(--text-sm); margin-bottom: var(--sp-sm);">
                            Tỉnh/Thành Phố
                        </label>
                        <p style="color: var(--text-primary); font-size: var(--text-base); font-weight: 500;">
                            {{ $user->city ?? 'Chưa cập nhật' }}
                        </p>
                    </div>

                    <!-- District -->
                    <div>
                        <label style="display: block; color: var(--text-secondary); font-size: var(--text-sm); margin-bottom: var(--sp-sm);">
                            Quận/Huyện
                        </label>
                        <p style="color: var(--text-primary); font-size: var(--text-base); font-weight: 500;">
                            {{ $user->district ?? 'Chưa cập nhật' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Account Security Card -->
            <div style="
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(139, 92, 246, 0.2);
                border-radius: var(--radius-lg);
                padding: var(--sp-lg);
                backdrop-filter: blur(10px);
            ">
                <h2 style="color: var(--text-primary); font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">
                    Bảo Mật Tài Khoản
                </h2>
                <div style="display: flex; flex-direction: column; gap: var(--sp-md);">
                    <a href="#" style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        padding: var(--sp-md);
                        background: rgba(0, 212, 255, 0.05);
                        border: 1px solid rgba(0, 212, 255, 0.2);
                        border-radius: var(--radius-md);
                        color: var(--text-primary);
                        text-decoration: none;
                        transition: all 0.3s;
                    ">
                        <span>Thay Đổi Mật Khẩu</span>
                        <span style="color: var(--laser-blue);">→</span>
                    </a>
                    <a href="#" style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        padding: var(--sp-md);
                        background: rgba(139, 92, 246, 0.05);
                        border: 1px solid rgba(139, 92, 246, 0.2);
                        border-radius: var(--radius-md);
                        color: var(--text-primary);
                        text-decoration: none;
                        transition: all 0.3s;
                    ">
                        <span>Xác Thực Hai Yếu Tố</span>
                        <span style="color: var(--electric-violet);">→</span>
                    </a>
                </div>
            </div>

            <!-- Account Actions Card -->
            <div style="
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 0, 110, 0.2);
                border-radius: var(--radius-lg);
                padding: var(--sp-lg);
                backdrop-filter: blur(10px);
            ">
                <h2 style="color: var(--text-primary); font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">
                    Hành Động Tài Khoản
                </h2>
                <div style="display: flex; gap: var(--sp-md); flex-direction: column;">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="
                            width: 100%;
                            padding: var(--sp-md) var(--sp-lg);
                            background: rgba(255, 0, 110, 0.2);
                            border: 1px solid var(--hot-pink);
                            color: var(--hot-pink);
                            border-radius: var(--radius-md);
                            cursor: pointer;
                            font-size: var(--text-base);
                            font-weight: var(--fw-bold);
                            transition: all 0.3s;
                        ">
                            Đăng Xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div style="
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(200, 200, 200, 0.1);
            border-radius: var(--radius-lg);
            padding: var(--sp-lg);
        ">
            <h3 style="color: var(--text-primary); font-size: var(--text-base); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">
                Liên Kết Nhanh
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--sp-md);">
                <a href="{{ route('order.list') }}" style="
                    color: var(--laser-blue);
                    text-decoration: none;
                    font-size: var(--text-sm);
                    padding: var(--sp-md);
                    border: 1px solid rgba(0, 212, 255, 0.2);
                    border-radius: var(--radius-md);
                    text-align: center;
                    transition: all 0.3s;
                ">
                    Lịch Sử Đơn Hàng
                </a>
                <a href="{{ route('shop.index') }}" style="
                    color: var(--electric-violet);
                    text-decoration: none;
                    font-size: var(--text-sm);
                    padding: var(--sp-md);
                    border: 1px solid rgba(139, 92, 246, 0.2);
                    border-radius: var(--radius-md);
                    text-align: center;
                    transition: all 0.3s;
                ">
                    Tiếp Tục Mua Sắm
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        h1 {
            font-size: 1.75rem !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }

        [style*="grid-template-columns: repeat"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
