@extends('layouts.shop')

@section('title', 'Thanh Toán')

@section('extra-css')
<style>
    .checkout-process {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-bottom: var(--sp-3xl);
        max-width: 500px;
    }

    .process-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: var(--sp-sm);
        position: relative;
    }

    .process-step::after {
        content: '';
        position: absolute;
        top: 30px;
        right: -50%;
        width: 100%;
        height: 2px;
        background: rgba(0,212,255,0.2);
    }

    .process-step:last-child::after {
        display: none;
    }

    .step-number {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,212,255,0.1);
        border: 2px solid rgba(0,212,255,0.3);
        border-radius: 50%;
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
        z-index: 2;
        position: relative;
    }

    .step-number.active {
        background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
        border-color: var(--laser-blue);
        color: var(--obsidian);
        box-shadow: 0 0 16px rgba(0,212,255,0.3);
    }

    .step-label {
        font-size: var(--text-xs);
        color: var(--text-secondary);
        text-align: center;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: var(--sp-3xl);
        align-items: start;
    }

    .form-wrapper {
        display: flex;
        flex-direction: column;
        gap: var(--sp-xl);
    }

    .checkout-form-section {
        background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
        border: var(--border-light);
        border-radius: var(--radius-lg);
        padding: var(--sp-xl);
        backdrop-filter: var(--backdrop);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: var(--sp-md);
        margin-bottom: var(--sp-lg);
        padding-bottom: var(--sp-lg);
        border-bottom: var(--border-thin);
    }

    .section-icon {
        font-size: 24px;
    }

    .section-title {
        font-size: var(--text-lg);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
    }

    .section-subtitle {
        font-size: var(--text-xs);
        color: var(--text-muted);
        margin-top: 2px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--sp-lg);
    }

    .form-grid.full {
        grid-template-columns: 1fr;
    }

    .form-group-checkout {
        display: flex;
        flex-direction: column;
        gap: var(--sp-sm);
    }

    .form-group-checkout label {
        font-size: var(--text-sm);
        font-weight: var(--fw-medium);
        color: var(--laser-blue);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .required-mark {
        color: var(--hot-pink);
        font-weight: var(--fw-bold);
    }

    .form-group-checkout input,
    .form-group-checkout select,
    .form-group-checkout textarea {
        padding: 12px 14px;
        background: rgba(255,255,255,0.03);
        border: var(--border-thin);
        border-radius: var(--radius-md);
        color: var(--text-primary);
        font-family: inherit;
        font-size: var(--text-base);
        transition: all 0.3s;
    }

    .form-group-checkout input:focus,
    .form-group-checkout select:focus,
    .form-group-checkout textarea:focus {
        outline: none;
        border-color: var(--laser-blue);
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1), inset 0 0 0 1px rgba(0, 212, 255, 0.2);
        background: rgba(255,255,255,0.05);
    }

    .payment-methods {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        margin-top: var(--sp-lg);
    }

    .payment-method-option {
        position: relative;
        cursor: pointer;
    }

    .payment-method-label {
        display: block;
        padding: var(--sp-lg);
        background: rgba(255,255,255,0.03);
        border: 2px solid var(--border-thin);
        border-radius: var(--radius-md);
        text-align: center;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .payment-method-option input[type="radio"] {
        display: none;
    }

    .payment-method-option input[type="radio"]:checked + .payment-method-label {
        border-color: var(--laser-blue);
        background: rgba(0,212,255,0.1);
        box-shadow: 0 0 16px rgba(0,212,255,0.2), inset 0 0 0 1px rgba(0,212,255,0.3);
        transform: translateY(-2px);
    }

    .payment-method-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: var(--sp-md);
    }

    .payment-icon {
        font-size: 32px;
    }

    .payment-name {
        font-weight: var(--fw-semibold);
        color: var(--laser-blue);
    }

    .payment-description {
        font-size: var(--text-xs);
        color: var(--text-muted);
    }

    .order-review-sticky {
        background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
        border: var(--border-glow);
        border-radius: var(--radius-lg);
        padding: var(--sp-xl);
        position: sticky;
        top: 120px;
        height: fit-content;
        backdrop-filter: var(--backdrop) var(--backdrop-saturate);
    }

    .order-review-title {
        font-size: var(--text-lg);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
        padding-bottom: var(--sp-lg);
        border-bottom: var(--border-thin);
        margin-bottom: var(--sp-lg);
    }

    .order-items-list {
        max-height: 250px;
        overflow-y: auto;
        margin-bottom: var(--sp-lg);
        padding-bottom: var(--sp-lg);
        border-bottom: var(--border-thin);
    }

    .order-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--sp-sm) 0;
        font-size: var(--text-sm);
        color: var(--text-secondary);
    }

    .order-item-name {
        flex: 1;
        color: var(--text-primary);
    }

    .order-item-qty {
        color: var(--text-muted);
        margin: 0 var(--sp-sm);
    }

    .order-item-price {
        color: var(--laser-blue);
        font-weight: var(--fw-semibold);
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--sp-md) 0;
        border-bottom: var(--border-thin);
        font-size: var(--text-base);
        color: var(--text-secondary);
    }

    .summary-line.total {
        border-bottom: none;
        padding-top: var(--sp-lg);
        font-size: var(--text-xl);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
    }

    .summary-value {
        font-weight: var(--fw-semibold);
        color: var(--text-primary);
    }

    .order-actions {
        display: flex;
        flex-direction: column;
        gap: var(--sp-md);
        margin-top: var(--sp-xl);
        padding-top: var(--sp-lg);
        border-top: var(--border-thin);
    }

    .order-actions button,
    .order-actions a {
        width: 100%;
    }

    .trust-badges {
        display: flex;
        flex-direction: column;
        gap: var(--sp-md);
        margin-top: var(--sp-xl);
        padding-top: var(--sp-lg);
        border-top: var(--border-thin);
    }

    .badge-item {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        font-size: var(--text-xs);
        color: var(--text-secondary);
    }

    .badge-icon {
        font-size: 18px;
    }

    .error-message {
        background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(239,68,68,0.05));
        border-left: 3px solid var(--error);
        border-radius: var(--radius-md);
        padding: var(--sp-lg);
        color: #fca5a5;
        margin-bottom: var(--sp-lg);
    }

    @media (max-width: 1024px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .order-review-sticky {
            position: static;
            margin-top: var(--sp-xl);
        }

        .payment-methods {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .checkout-process {
            margin-bottom: var(--sp-xl);
        }

        .step-label {
            font-size: 11px;
        }

        .section-title {
            font-size: var(--text-base);
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .checkout-form-section {
            padding: var(--sp-lg);
        }

        .payment-methods {
            gap: var(--sp-md);
        }
    }
</style>
@endsection

@section('content')
<div style="margin-top: var(--sp-2xl);">
    <!-- Page Title -->
    <div style="text-align: center; margin-bottom: var(--sp-3xl);">
        <h1 style="font-size: var(--text-3xl); margin-bottom: var(--sp-md);">💳 Hoàn Tất Đơn Hàng</h1>
        <p style="color: var(--text-secondary);">Vui lòng kiểm tra và xác nhận thông tin trước khi thanh toán</p>
    </div>

    <!-- Process Steps -->
    <div class="checkout-process fade-in">
        <div class="process-step">
            <div class="step-number active">1</div>
            <div class="step-label">Thông Tin</div>
        </div>
        <div class="process-step">
            <div class="step-number">2</div>
            <div class="step-label">Thanh Toán</div>
        </div>
        <div class="process-step">
            <div class="step-number">3</div>
            <div class="step-label">Xác Nhận</div>
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="error-message fade-in">
            <strong>⚠️ Vui lòng sửa các lỗi sau:</strong>
            <ul style="margin-top: var(--sp-md); margin-bottom: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Checkout Form -->
    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form" class="checkout-grid fade-in">
        @csrf

        <div class="form-wrapper">
            <!-- Shipping Information -->
            <div class="checkout-form-section">
                <div class="section-header">
                    <div class="section-icon">📍</div>
                    <div>
                        <div class="section-title">Thông Tin Giao Hàng</div>
                        <div class="section-subtitle">Điền đầy đủ để giao hàng nhanh chóng</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group-checkout">
                        <label>Họ và Tên <span class="required-mark">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user?->name) }}" required>
                    </div>

                    <div class="form-group-checkout">
                        <label>Email <span class="required-mark">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user?->email) }}" required>
                    </div>

                    <div class="form-group-checkout">
                        <label>Số Điện Thoại <span class="required-mark">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone', $user?->phone) }}" required>
                    </div>

                    <div class="form-group-checkout">
                        <label>Thành Phố <span class="required-mark">*</span></label>
                        <input type="text" name="city" value="{{ old('city', $user?->city) }}" required>
                    </div>

                    <div class="form-group-checkout">
                        <label>Quận/Huyện <span class="required-mark">*</span></label>
                        <input type="text" name="district" value="{{ old('district', $user?->district) }}" required>
                    </div>
                </div>

                <div class="form-grid full">
                    <div class="form-group-checkout">
                        <label>Địa Chỉ Cụ Thể <span class="required-mark">*</span></label>
                        <input type="text" name="address" value="{{ old('address', $user?->address) }}" placeholder="Số nhà, tên đường, tòa nhà..." required>
                    </div>
                </div>

                <div class="form-grid full">
                    <div class="form-group-checkout">
                        <label>Ghi Chú Đơn Hàng (Tùy Chọn)</label>
                        <textarea name="notes" rows="3" placeholder="Ví dụ: Giao vào giờ cụ thể, để tại cửa...">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="checkout-form-section">
                <div class="section-header">
                    <div class="section-icon">💰</div>
                    <div>
                        <div class="section-title">Phương Thức Thanh Toán</div>
                        <div class="section-subtitle">Chọn một phương thức phù hợp</div>
                    </div>
                </div>

                <div class="payment-methods">
                    <label class="payment-method-option">
                        <input type="radio" name="payment_method" value="cod" required checked>
                        <span class="payment-method-label">
                            <div class="payment-icon">🚚</div>
                            <div class="payment-name">Thanh Toán Khi Nhận</div>
                            <div class="payment-description">Trả tiền tại nhà</div>
                        </span>
                    </label>

                    <label class="payment-method-option">
                        <input type="radio" name="payment_method" value="bank_transfer" required>
                        <span class="payment-method-label">
                            <div class="payment-icon">🏦</div>
                            <div class="payment-name">Chuyển Khoản</div>
                            <div class="payment-description">Trước thanh toán</div>
                        </span>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="height: 52px; font-size: var(--text-lg); font-weight: var(--fw-bold); width: 100%;">
                ✓ Xác Nhận Đơn Hàng
            </button>
        </div>

        <!-- Order Summary Sidebar -->
        <div>
            <div class="order-review-sticky">
                <div class="order-review-title">📦 Tóm Tắt Đơn Hàng</div>

                @php
                    $subtotal = 0;
                    $itemCount = 0;
                    foreach($cart as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                        $itemCount += $item['quantity'];
                    }
                    $shipping = 30000;
                    $total = $subtotal + $shipping;
                @endphp

                <!-- Items List -->
                <div class="order-items-list">
                    @foreach($cart as $item)
                        <div class="order-item-row">
                            <span class="order-item-name">{{ Str::limit($item['product_name'], 25) }}</span>
                            <span class="order-item-qty">×{{ $item['quantity'] }}</span>
                            <span class="order-item-price">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="summary-line">
                    <span>Tạm tính:</span>
                    <span class="summary-value">{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                </div>

                <div class="summary-line">
                    <span>Phí vận chuyển:</span>
                    <span class="summary-value">{{ number_format($shipping, 0, ',', '.') }}đ</span>
                </div>

                <div class="summary-line">
                    <span>Giảm giá:</span>
                    <span class="summary-value">0đ</span>
                </div>

                <div class="summary-line total">
                    <span>Tổng Cộng:</span>
                    <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                </div>

                <!-- Trust Badges -->
                <div class="trust-badges">
                    <div class="badge-item">
                        <div class="badge-icon">🔒</div>
                        <span>Thanh toán an toàn 256-bit SSL</span>
                    </div>
                    <div class="badge-item">
                        <div class="badge-icon">↩️</div>
                        <span>Đổi trả miễn phí 30 ngày</span>
                    </div>
                    <div class="badge-item">
                        <div class="badge-icon">🌍</div>
                        <span>Giao hàng toàn quốc</span>
                    </div>
                    <div class="badge-item">
                        <div class="badge-icon">💬</div>
                        <span>Hỗ trợ khách hàng 24/7</span>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="order-actions">
                    <a href="{{ route('cart.index') }}" class="btn btn-secondary">
                        ← Quay Lại Giỏ Hàng
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Smooth form validation
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let hasErrors = false;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('error');
            hasErrors = true;
        } else {
            field.classList.remove('error');
        }
    });

    if (hasErrors) {
        e.preventDefault();
        alert('⚠️ Vui lòng điền đầy đủ các trường bắt buộc');
    }
});
</script>
@endsection
