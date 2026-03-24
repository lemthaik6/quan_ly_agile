@extends('layouts.shop')

@section('title', 'Giỏ Hàng')

@section('extra-css')
<style>
    .cart-page-header {
        text-align: center;
        margin-bottom: var(--sp-3xl);
    }

    .cart-page-header h1 {
        font-size: var(--text-3xl);
        margin-bottom: var(--sp-md);
    }

    .cart-layout {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: var(--sp-3xl);
        align-items: start;
    }

    .cart-items-container {
        display: flex;
        flex-direction: column;
        gap: var(--sp-lg);
    }

    .cart-item-row {
        background: linear-gradient(135deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
        border: var(--border-light);
        border-radius: var(--radius-lg);
        padding: var(--sp-lg);
        display: grid;
        grid-template-columns: 100px 1fr auto auto;
        gap: var(--sp-lg);
        align-items: center;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .cart-item-row:hover {
        border-color: rgba(0,212,255,0.2);
        background: linear-gradient(135deg, rgba(0,212,255,0.05), rgba(139,92,246,0.02));
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .cart-item-image {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(139,92,246,0.04));
        border: var(--border-thin);
        border-radius: var(--radius-md);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-item-details h3 {
        color: var(--laser-blue);
        font-size: var(--text-lg);
        font-weight: var(--fw-semibold);
        margin-bottom: var(--sp-sm);
        line-height: 1.3;
    }

    .cart-item-details p {
        font-size: var(--text-sm);
        color: var(--text-secondary);
        margin-bottom: 4px;
    }

    .cart-item-details a {
        color: var(--laser-blue);
        text-decoration: none;
        transition: color 0.3s;
    }

    .cart-item-details a:hover {
        color: var(--electric-violet);
    }

    .quantity-control-cart {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        background: rgba(255,255,255,0.02);
        border: var(--border-thin);
        border-radius: var(--radius-md);
        padding: 4px;
    }

    .qty-btn-compact {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: var(--laser-blue);
        cursor: pointer;
        font-weight: var(--fw-bold);
        transition: all 0.3s;
        border-radius: 4px;
    }

    .qty-btn-compact:hover {
        background: rgba(0,212,255,0.1);
    }

    .qty-display-compact {
        width: 40px;
        text-align: center;
        color: var(--laser-blue);
        font-weight: var(--fw-semibold);
        font-size: var(--text-sm);
    }

    .cart-item-price {
        text-align: right;
        min-width: 100px;
    }

    .cart-item-price-value {
        font-size: 18px;
        font-weight: var(--fw-bold);
        background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .cart-item-remove {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.2);
        border-radius: var(--radius-md);
        color: #fca5a5;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 18px;
    }

    .cart-item-remove:hover {
        background: rgba(239,68,68,0.2);
        border-color: rgba(239,68,68,0.4);
    }

    .summary-sticky {
        background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
        border: var(--border-glow);
        border-radius: var(--radius-lg);
        padding: var(--sp-xl);
        position: sticky;
        top: 120px;
        height: fit-content;
        backdrop-filter: var(--backdrop) var(--backdrop-saturate);
    }

    .summary-title {
        font-size: var(--text-lg);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
        margin-bottom: var(--sp-lg);
        padding-bottom: var(--sp-lg);
        border-bottom: var(--border-thin);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--sp-md) 0;
        font-size: var(--text-base);
        color: var(--text-secondary);
        border-bottom: var(--border-thin);
    }

    .summary-row.total {
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

    .summary-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: var(--sp-md);
        margin-top: var(--sp-xl);
        padding-top: var(--sp-xl);
        border-top: var(--border-thin);
    }

    .summary-actions .btn {
        height: 48px;
        font-size: var(--text-base);
        font-weight: var(--fw-semibold);
    }

    .empty-cart-display {
        text-align: center;
        padding: var(--sp-3xl) var(--sp-2xl);
        background: linear-gradient(135deg, rgba(0,212,255,0.05), rgba(139,92,246,0.02));
        border: var(--border-glow);
        border-radius: var(--radius-lg);
        backdrop-filter: var(--backdrop);
    }

    .empty-icon {
        font-size: 80px;
        margin-bottom: var(--sp-xl);
        animation: float 3s ease-in-out infinite;
    }

    .empty-title {
        font-size: var(--text-2xl);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
        margin-bottom: var(--sp-md);
    }

    .empty-text {
        font-size: var(--text-base);
        color: var(--text-secondary);
        margin-bottom: var(--sp-xl);
        line-height: 1.6;
    }

    @media (max-width: 1024px) {
        .cart-layout {
            grid-template-columns: 1fr;
        }

        .summary-sticky {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .cart-item-row {
            grid-template-columns: 80px 1fr;
            gap: var(--sp-md);
            padding: var(--sp-md);
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
        }

        .cart-item-price,
        .cart-item-remove {
            grid-column: 2;
        }

        .quantity-control-cart {
            grid-column: 2;
            width: fit-content;
        }
    }

    @media (max-width: 480px) {
        .cart-page-header h1 {
            font-size: var(--text-2xl);
        }

        .cart-item-row {
            grid-template-columns: 1fr;
        }

        .cart-item-image,
        .cart-item-price,
        .cart-item-remove,
        .quantity-control-cart {
            grid-column: auto;
        }

        .cart-item-details h3 {
            font-size: var(--text-base);
        }

        .empty-icon {
            font-size: 60px;
        }
    }
</style>
@endsection

@section('content')
<div style="margin-top: var(--sp-2xl);">
    <!-- Page Header -->
    <div class="cart-page-header fade-in">
        <h1>🛒 Giỏ Hàng Của Bạn</h1>
        <p style="color: var(--text-secondary);">Kiểm tra và chỉnh sửa đơn hàng của bạn trước khi thanh toán</p>
    </div>

    @php
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    @endphp

    @if(count($cart) > 0)
        <div class="cart-layout">
            <!-- Cart Items -->
            <div class="cart-items-container">
                @foreach($cart as $cartKey => $item)
                    <div class="cart-item-row fade-in">
                        <!-- Image -->
                        <div class="cart-item-image">
                            @if($item['product_image'])
                                <img src="{{ asset('storage/' . $item['product_image']) }}" alt="{{ $item['product_name'] }}">
                            @else
                                <span style="font-size: 40px; color: var(--laser-blue); opacity: 0.5;">📦</span>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="cart-item-details">
                            <h3>
                                <a href="{{ route('product.show', $item['product_slug']) }}">
                                    {{ $item['product_name'] }}
                                </a>
                            </h3>
                            @if($item['color'])
                                <p>🎨 {{ $item['color'] }}</p>
                            @endif
                            @if($item['size'])
                                <p>📏 {{ $item['size'] }}</p>
                            @endif
                            <p style="margin-top: var(--sp-sm); color: var(--laser-blue); font-weight: var(--fw-semibold);">
                                {{ number_format($item['price'], 0, ',', '.') }}đ/cái
                            </p>
                        </div>

                        <!-- Quantity Control -->
                        <div class="quantity-control-cart">
                            <button onclick="updateQuantity('{{ $cartKey }}', 'minus')" class="qty-btn-compact">−</button>
                            <div class="qty-display-compact">{{ $item['quantity'] }}</div>
                            <button onclick="updateQuantity('{{ $cartKey }}', 'plus')" class="qty-btn-compact">+</button>
                        </div>

                        <!-- Price -->
                        <div class="cart-item-price">
                            <div style="font-size: var(--text-xs); color: var(--text-muted); margin-bottom: 4px;">Cộng:</div>
                            <div class="cart-item-price-value">
                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                            </div>
                        </div>

                        <!-- Remove -->
                        <button onclick="removeItem('{{ $cartKey }}')" class="cart-item-remove" title="Xóa sản phẩm">✕</button>
                    </div>
                @endforeach
            </div>

            <!-- Summary Panel -->
            <div>
                <div class="summary-sticky">
                    <div class="summary-title">💰 Tóm Tắt Đơn Hàng</div>

                    <div class="summary-row">
                        <span>Tạm tính:</span>
                        <span class="summary-value">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>

                    <div class="summary-row">
                        <span>Phí vận chuyển:</span>
                        <span class="summary-value" style="color: var(--laser-blue);">{{ number_format(30000, 0, ',', '.') }}đ</span>
                    </div>

                    <div class="summary-row">
                        <span>Khuyến mãi:</span>
                        <span class="summary-value">0đ</span>
                    </div>

                    <div class="summary-row total">
                        <span>Tổng Cộng:</span>
                        <span>{{ number_format($total + 30000, 0, ',', '.') }}đ</span>
                    </div>

                    <div class="summary-actions">
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                            💳 Tiến Hành Thanh Toán
                        </a>
                        <a href="{{ route('shop.index') }}" class="btn btn-secondary">
                            ← Tiếp Tục Mua Sắm
                        </a>
                        <button onclick="clearCart()" class="btn" style="background: rgba(239, 68, 68, 0.1); border: 2px solid rgba(239, 68, 68, 0.3); color: #fca5a5;">
                            🗑️ Xóa Giỏ Hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart-display fade-in">
            <div class="empty-icon">🛒</div>
            <h2 class="empty-title">Giỏ Hàng Của Bạn Trống</h2>
            <p class="empty-text">
                Hãy khám phá bộ sưu tập độc quyền của chúng tôi<br>
                và tìm những sản phẩm yêu thích của bạn
            </p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary" style="display: inline-block;">
                🛍️ Bắt Đầu Mua Sắm
            </a>
        </div>
    @endif
</div>

<script>
function updateQuantity(cartKey, action) {
    const QtyDisplay = event.target.closest('.quantity-control-cart').querySelector('.qty-display-compact');
    const currentQty = parseInt(QtyDisplay.textContent);
    const newQty = action === 'plus' ? currentQty + 1 : Math.max(1, currentQty - 1);

    fetch('{{ route("cart.update", ":cartKey") }}'.replace(':cartKey', cartKey), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

function removeItem(cartKey) {
    if (confirm('Bạn chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        fetch('{{ route("cart.remove", ":cartKey") }}'.replace(':cartKey', cartKey), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function clearCart() {
    if (confirm('Bạn chắc chắn muốn xóa toàn bộ giỏ hàng?')) {
        fetch('{{ route("cart.clear") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>
@endsection
