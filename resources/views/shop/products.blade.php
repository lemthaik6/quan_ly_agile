@extends('layouts.shop')

@section('title', 'Cửa Hàng - Sản Phẩm Premium')

@section('extra-css')
<style>
    .shop-header-section {
        margin-bottom: var(--sp-3xl);
    }

    .shop-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: var(--sp-xl);
    }

    @media (max-width: 1024px) {
        .shop-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .shop-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--sp-lg);
        }

        .filter-suite {
            padding: var(--sp-lg);
        }

        .hero-premium {
            padding: var(--sp-2xl) var(--sp-lg);
        }

        .hero-title {
            font-size: var(--text-3xl);
        }
    }

    @media (max-width: 480px) {
        .shop-grid {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: var(--text-2xl);
        }
    }
</style>
@endsection

@section('content')
<div class="shop-header-section fade-in">
    <!-- Hero Section -->
    <div class="hero-premium">
        <div class="hero-content">
            <div class="hero-subtitle">⚡ Premium Collection 2024</div>
            <h1 class="hero-title">Discover Tomorrow's Style Today</h1>
            <p class="hero-description">
                Curated fashion-tech essentials for the modern, forward-thinking individual. 
                Where luxury meets innovation.
            </p>
            <div style="display: flex; gap: var(--sp-md);">
                <a href="#shop-section" class="btn btn-primary">Explore Collection</a>
                <a href="#" class="btn btn-secondary">Watch Lookbook</a>
            </div>
        </div>
    </div>

    <!-- Filter Panel -->
    <form method="GET" action="{{ route('shop.index') }}" class="filter-suite">
        <div class="filter-grid">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--sp-lg);">
                <!-- Category Filter -->
                <div class="filter-group">
                    <label for="category" class="filter-label">Danh Mục</label>
                    <select id="category" name="category" onchange="this.form.submit()" class="filter-btn" style="height: 40px; padding: 10px 14px;">
                        <option value="">Tất Cả Sản Phẩm</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" 
                                @if(request('category') == $cat->slug) selected @endif>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Filter -->
                <div class="filter-group">
                    <label for="sort" class="filter-label">Sắp Xếp Theo</label>
                    <select id="sort" name="sort" onchange="this.form.submit()" class="filter-btn" style="height: 40px; padding: 10px 14px;">
                        <option value="newest" @if(request('sort') == 'newest') selected @endif>Mới Nhất</option>
                        <option value="price-low" @if(request('sort') == 'price-low') selected @endif>Giá: Thấp Đến Cao</option>
                        <option value="price-high" @if(request('sort') == 'price-high') selected @endif>Giá: Cao Đến Thấp</option>
                        <option value="popular" @if(request('sort') == 'popular') selected @endif>Phổ Biến</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="filter-group">
                    <label for="search" class="filter-label">Tìm Kiếm</label>
                    <input type="text" id="search" name="search" class="filter-btn" style="height: 40px; padding: 10px 14px;" 
                           placeholder="Tìm sản phẩm..."
                           value="{{ request('search') }}"
                           onchange="this.form.submit()">
                </div>
            </div>

            <div class="filter-actions-row">
                <button type="submit" class="btn btn-primary" style="min-width: 120px;">🔍 Lọc</button>
                <a href="{{ route('shop.index') }}" class="btn btn-secondary">↻ Đặt Lại</a>
            </div>
        </div>
    </form>
</div>

<!-- Products Grid -->
<div id="shop-section">
    @if($products->count() > 0)
        <div class="shop-grid">
            @foreach($products as $product)
                <div class="product-card fade-in">
                    <!-- Image Container -->
                    <div class="product-image-container">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <span style="font-size: 60px; color: var(--laser-blue); opacity: 0.3;">📦</span>
                        @endif

                        <!-- Badge Group -->
                        <div class="product-badge-group">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                @php
                                    $discount = round((($product->price - $product->discount_price) / $product->price) * 100);
                                @endphp
                                <div class="product-badge">🔥 -{{ $discount }}%</div>
                            @endif
                            @if($product->quantity_in_stock < 5 && $product->quantity_in_stock > 0)
                                <div class="product-badge" style="background: linear-gradient(135deg, rgba(245,158,11,0.95), rgba(251,191,36,0.85));">⚠ Sắp Hết</div>
                            @endif
                            @if($product->quantity_in_stock == 0)
                                <div class="product-badge" style="background: linear-gradient(135deg, rgba(107,114,128,0.95), rgba(156,163,175,0.85));">Hết Hàng</div>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="product-body">
                        <div class="product-category">{{ $product->category->name ?? 'Không phân loại' }}</div>
                        <h3 class="product-title">{{ $product->name }}</h3>

                        <!-- Meta Info -->
                        <div class="product-meta">
                            <div class="product-rating @if($product->getReviewCountAttribute() > 0) active @endif">
                                @php
                                    $avgRating = $product->getAverageRatingAttribute();
                                    $reviewCount = $product->getReviewCountAttribute();
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= round($avgRating) ? '⭐' : '☆' }}</span>
                                @endfor
                            </div>
                            @if($product->quantity_in_stock > 0)
                                <span class="product-sold">{{ $product->quantity_in_stock }} còn</span>
                            @endif
                        </div>

                        <!-- Pricing -->
                        <div class="product-pricing">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                <span class="product-price-original">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                <span class="product-price-current">{{ number_format($product->discount_price, 0, ',', '.') }}đ</span>
                            @else
                                <span class="product-price-current">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="product-actions">
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-secondary" style="display: flex; align-items: center; justify-content: center;">
                                👁 Xem
                            </a>
                            @if($product->quantity_in_stock > 0)
                                <button onclick="quickAddToCart('{{ $product->id }}', '{{ $product->slug }}', '{{ $product->name }}')" class="btn btn-primary" style="display: flex; align-items: center; justify-content: center;">
                                    + Giỏ
                                </button>
                            @else
                                <button class="btn" style="display: flex; align-items: center; justify-content: center; background: rgba(156,163,175,0.2); color: #9ca3af; cursor: not-allowed;">Hết</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state-display fade-in">
            <div class="empty-icon">🔍</div>
            <h2 class="empty-title">Không Tìm Thấy Sản Phẩm</h2>
            <p class="empty-description">
                Rất tiếc không có sản phẩm nào phù hợp với tìm kiếm của bạn.<br>
                Vui lòng thử lại với tiêu chí khác.
            </p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">← Quay Lại Cửa Hàng</a>
        </div>
    @endif
</div>

<!-- Pagination -->
@if($products->hasPages())
    <div style="display: flex; justify-content: center; gap: 8px; margin-top: var(--sp-3xl); padding: var(--sp-xl); flex-wrap: wrap;">
        @if($products->onFirstPage())
            <button disabled class="btn btn-secondary" style="opacity: 0.5; cursor: not-allowed;">← Trước</button>
        @else
            <a href="{{ $products->previousPageUrl() }}" class="btn btn-secondary">← Trước</a>
        @endif

        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if($page == $products->currentPage())
                <button disabled class="btn btn-primary" style="min-width: 40px;">{{ $page }}</button>
            @else
                <a href="{{ $url }}" class="btn btn-secondary" style="min-width: 40px;">{{ $page }}</a>
            @endif
        @endforeach

        @if($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="btn btn-secondary">Tiếp →</a>
        @else
            <button disabled class="btn btn-secondary" style="opacity: 0.5; cursor: not-allowed;">Tiếp →</button>
        @endif
    </div>
@endif
@endsection

@section('extra-js')
<script>
function quickAddToCart(productId, productSlug, productName) {
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: productId,
            product_slug: productSlug,
            product_name: productName,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Thêm vào giỏ hàng thành công!');
            location.reload();
        } else {
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Lỗi khi thêm vào giỏ hàng');
    });
}
</script>
@endsection
