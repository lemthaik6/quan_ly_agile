@extends('layouts.shop')

@section('title', 'Chi Tiết Sản Phẩm - ' . $product->name)

@section('extra-css')
<style>
    .product-gallery {
        position: relative;
        width: 100%;
        height: 500px;
        background: rgba(0, 245, 255, 0.05);
        border: 1px solid rgba(0, 245, 255, 0.3);
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .product-gallery img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .variant-selector {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
    }

    .variant-btn {
        padding: 10px;
        border: 2px solid rgba(0, 245, 255, 0.3);
        background: transparent;
        color: #00f5ff;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 12px;
    }

    .variant-btn.active {
        border-color: #00f5ff;
        background: rgba(0, 245, 255, 0.2);
        box-shadow: 0 0 15px rgba(0, 245, 255, 0.3);
    }

    .variant-btn:hover {
        border-color: #00f5ff;
    }

    .color-swatch {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    .review-item {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(0, 245, 255, 0.1);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-rating {
        color: #fbbf24;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div style="margin-top: 40px;">
    <!-- Breadcrumb -->
    <div style="margin-bottom: 30px; color: #999; font-size: 14px;">
        <a href="{{ route('shop.index') }}" style="color: #00f5ff; text-decoration: none;">← Quay lại Shop</a>
    </div>

    <!-- Product Detail -->
    <div class="grid grid-cols-2" style="margin-bottom: 40px;">
        <!-- Left: Product Image -->
        <div>
            <div class="product-gallery">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <span style="font-size: 80px; color: #00f5ff; opacity: 0.3;">📦</span>
                @endif
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="p-20">
            <div style="background: rgba(0, 245, 255, 0.05); border-left: 3px solid #00f5ff; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <span style="color: #00f5ff; font-size: 13px; font-weight: 600;">{{ $product->category->name }}</span>
            </div>

            <h1 class="glow-text" style="font-size: 32px; margin-bottom: 15px;">{{ $product->name }}</h1>

            <!-- Rating -->
            <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                @php
                    $avgRating = $product->getAverageRatingAttribute();
                    $reviewCount = $product->getReviewCountAttribute();
                @endphp
                <div style="font-size: 16px; color: #fbbf24;">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($avgRating) ? '⭐' : '☆' }}
                    @endfor
                    <span style="color: #00f5ff; margin-left: 10px;">{{ number_format($avgRating, 1) }}/5 ({{ $reviewCount }} đánh giá)</span>
                </div>
            </div>

            <!-- Price -->
            <div style="margin-bottom: 30px;">
                @if($product->discount_price)
                    <div style="font-size: 13px; color: #999; text-decoration: line-through; margin-bottom: 5px;">
                        Giá gốc: {{ number_format($product->price, 0, ',', '.') }}đ
                    </div>
                    <div style="font-size: 36px; color: #00f5ff; font-weight: bold; margin-bottom: 5px;">
                        {{ number_format($product->discount_price, 0, ',', '.') }}đ
                    </div>
                    <div style="color: #ff006e; font-size: 14px;">
                        ✂️ Tiết kiệm: {{ number_format($product->price - $product->discount_price, 0, ',', '.') }}đ
                    </div>
                @else
                    <div style="font-size: 36px; color: #00f5ff; font-weight: bold;">
                        {{ number_format($product->price, 0, ',', '.') }}đ
                    </div>
                @endif
            </div>

            <!-- Stock Info -->
            <div style="margin-bottom: 30px; padding: 15px; background: rgba(0, 245, 255, 0.05); border-radius: 8px;">
                @if($product->quantity_in_stock > 10)
                    <span style="color: #22c55e;">✓ Còn hàng ({{ $product->quantity_in_stock }} sản phẩm)</span>
                @elseif($product->quantity_in_stock > 0)
                    <span style="color: #fbbf24;">⚠ Sắp hết ({{ $product->quantity_in_stock }} sản phẩm)</span>
                @else
                    <span style="color: #ef4444;">✗ Hết hàng</span>
                @endif
            </div>

            <!-- Brief Description -->
            <div style="color: #ccc; margin-bottom: 30px; line-height: 1.6;">
                {!! nl2br(e($product->short_description)) !!}
            </div>

            <!-- Color Selector -->
            @if($product->colors->count() > 0)
                <div class="form-group">
                    <label>Chọn Màu Sắc</label>
                    <div class="variant-selector" id="color-selector">
                        @foreach($product->colors as $color)
                            <button type="button" class="variant-btn" onclick="selectVariant('color', '{{ $color->color_name }}', this)">
                                <span class="color-swatch" style="background-color: {{ $color->color_hex }};"></span>
                                {{ $color->color_name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Size Selector -->
            @if($product->sizes->count() > 0)
                <div class="form-group">
                    <label>Chọn Kích Cỡ</label>
                    <div class="variant-selector" id="size-selector">
                        @foreach($product->sizes as $size)
                            <button type="button" class="variant-btn" onclick="selectVariant('size', '{{ $size->size_name }}', this)">
                                {{ $size->size_name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quantity & Add to Cart -->
            <div class="form-group">
                <label>Số Lượng</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button onclick="decreaseQuantity()" class="btn btn-secondary btn-small">−</button>
                    <input type="number" id="quantity" value="1" min="1" max="{{ $product->quantity_in_stock }}"
                           style="width: 80px; text-align: center;">
                    <button onclick="increaseQuantity()" class="btn btn-secondary btn-small">+</button>
                </div>
            </div>

            <!-- Add to Cart Button -->
            <button onclick="addToCart()" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 16px; margin-top: 20px;">
                🛒 Thêm Vào Giỏ Hàng
            </button>

            <!-- Full Description -->
            <div style="margin-top: 30px; padding-top: 30px; border-top: 1px solid rgba(0, 245, 255, 0.2);">
                <h3 style="color: #00f5ff; margin-bottom: 15px;">Mô Tả Chi Tiết</h3>
                <div style="color: #ccc; line-height: 1.8;">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="card fade-in" style="margin: 40px 0;">
        <h2 style="color: #00f5ff; margin-bottom: 20px;">💬 Đánh Giá Sản Phẩm</h2>

        @auth
            <div style="margin-bottom: 30px; padding: 20px; background: rgba(0, 102, 255, 0.1); border: 1px solid rgba(0, 102, 255, 0.3); border-radius: 8px;">
                <a href="{{ route('review.create', $product->slug) }}" class="btn btn-primary">
                    ✍️ Viết Đánh Giá
                </a>
            </div>
        @else
            <div style="margin-bottom: 30px; padding: 20px; background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.3); border-radius: 8px;">
                <p style="color: #fca5a5; margin-bottom: 10px;">Vui lòng đăng nhập để đánh giá sản phẩm</p>
                <a href="/login" class="btn btn-secondary btn-small">Đăng Nhập</a>
            </div>
        @endauth

        @if($product->reviews->count() > 0)
            <div>
                @foreach($product->reviews as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <div>
                                <div style="font-weight: 600; color: #00f5ff;">{{ $review->user->name }}</div>
                                <div class="review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $review->rating ? '⭐' : '☆' }}
                                    @endfor
                                </div>
                            </div>
                            <div style="font-size: 12px; color: #999;">
                                {{ $review->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @if($review->comment)
                            <p style="color: #ccc; margin-top: 10px;">{{ $review->comment }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 30px; color: #999;">
                <p style="margin-bottom: 10px;">Chưa có đánh giá nào cho sản phẩm này</p>
                <p style="font-size: 13px;">Hãy là người đầu tiên đánh giá sản phẩm này!</p>
            </div>
        @endif
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div style="margin: 40px 0;">
            <h2 class="glow-text" style="font-size: 28px; margin-bottom: 20px;">📦 Sản Phẩm Liên Quan</h2>
            <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                @foreach($relatedProducts as $related)
                    <div class="card fade-in">
                        <div style="width: 100%; height: 180px; background: rgba(0, 245, 255, 0.1); border-radius: 8px; margin-bottom: 15px; overflow: hidden;">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #00f5ff;">📦</div>
                            @endif
                        </div>
                        <h4 style="color: #00f5ff; font-size: 14px; margin-bottom: 8px;">
                            <a href="{{ route('product.show', $related->slug) }}" style="text-decoration: none; color: inherit;">
                                {{ Str::limit($related->name, 40) }}
                            </a>
                        </h4>
                        <div style="font-size: 14px; color: #00f5ff; font-weight: bold;">
                            {{ number_format($related->discount_price ?? $related->price, 0, ',', '.') }}đ
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
let selectedColor = null;
let selectedSize = null;

function selectVariant(type, value, element) {
    if (type === 'color') {
        selectedColor = value;
        document.querySelectorAll('#color-selector .variant-btn').forEach(btn => btn.classList.remove('active'));
    } else if (type === 'size') {
        selectedSize = value;
        document.querySelectorAll('#size-selector .variant-btn').forEach(btn => btn.classList.remove('active'));
    }
    element.classList.add('active');
}

function increaseQuantity() {
    const qty = document.getElementById('quantity');
    qty.value = Math.min(parseInt(qty.value) + 1, parseInt(qty.max));
}

function decreaseQuantity() {
    const qty = document.getElementById('quantity');
    qty.value = Math.max(parseInt(qty.value) - 1, 1);
}

function addToCart() {
    const quantity = parseInt(document.getElementById('quantity').value);

    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: {{ $product->id }},
            quantity: quantity,
            color: selectedColor,
            size: selectedSize
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ Sản phẩm đã được thêm vào giỏ hàng!');
            location.reload();
        } else {
            alert('❌ Lỗi: ' + (data.error || 'Không thể thêm sản phẩm'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('❌ Lỗi kết nối');
    });
}
</script>
@endsection
