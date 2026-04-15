@extends('layouts.shop')

@section('title', 'Cửa Hàng - Sản Phẩm Premium')

@section('extra-css')
<style>
    .shop-header-section {
        margin-bottom: var(--sp-3xl);
    }

    .shop-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: var(--sp-xl);
    }

    @media (max-width: 1024px) {
        .shop-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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

    /* Enhanced Hero Banner */
    .hero-premium {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius-xl);
        padding: var(--sp-3xl) var(--sp-3xl);
        margin-bottom: var(--sp-3xl);
        background: linear-gradient(135deg, 
            rgba(0,212,255,0.15) 0%, 
            rgba(139,92,246,0.1) 50%,
            rgba(255,0,110,0.08) 100%);
        border: var(--border-glow);
        backdrop-filter: var(--backdrop) var(--backdrop-saturate);
        min-height: 400px;
        display: flex;
        align-items: center;
    }

    .hero-premium::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(0,212,255,0.2), rgba(139,92,246,0.15), transparent);
        border-radius: 50%;
        pointer-events: none;
        animation: float 12s ease-in-out infinite;
    }

    .hero-premium::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -20%;
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, rgba(255,0,110,0.15), rgba(0,212,255,0.1), transparent);
        border-radius: 50%;
        pointer-events: none;
        animation: float 15s ease-in-out infinite reverse;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 600px;
    }

    .hero-subtitle {
        font-size: var(--text-sm);
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--laser-blue);
        margin-bottom: var(--sp-lg);
        font-weight: var(--fw-bold);
        opacity: 0.9;
    }

    .hero-title {
        font-size: var(--text-4xl);
        font-weight: var(--fw-bold);
        margin-bottom: var(--sp-xl);
        line-height: 1.1;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--laser-blue) 50%, var(--electric-violet) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 0 40px rgba(0,212,255,0.3);
    }

    .hero-description {
        font-size: var(--text-lg);
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: var(--sp-2xl);
        opacity: 0.9;
    }

    .hero-stats {
        display: flex;
        gap: var(--sp-2xl);
        margin-top: var(--sp-xl);
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: var(--text-2xl);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
        display: block;
    }

    .stat-label {
        font-size: var(--text-xs);
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 4px;
    }

    /* Enhanced Product Cards */
    .product-card {
        --product-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
        background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
        border: var(--border-light);
        border-radius: var(--radius-xl);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        backdrop-filter: var(--backdrop);
    }

    .product-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(139,92,246,0.05), rgba(255,0,110,0.03));
        opacity: 0;
        transition: opacity 0.5s;
        pointer-events: none;
        border-radius: var(--radius-xl);
    }

    .product-card:hover {
        border-color: rgba(0,212,255,0.5);
        background: linear-gradient(135deg, rgba(255,255,255,0.12), rgba(255,255,255,0.06));
        transform: translateY(-16px) scale(1.03);
        box-shadow: var(--product-shadow), 0 0 60px rgba(0,212,255,0.2);
    }

    .product-card:hover::before {
        opacity: 1;
    }

    .product-image-container {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1.1;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(0,212,255,0.08) 0%, rgba(139,92,246,0.04) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .product-card:hover .product-image-container img {
        transform: scale(1.15) rotate(3deg);
    }

    .product-badge-group {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 10;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .product-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: linear-gradient(135deg, rgba(255,0,110,0.95), rgba(255,20,100,0.85));
        color: white;
        border-radius: 12px;
        font-size: 12px;
        font-weight: var(--fw-bold);
        letter-spacing: 0.5px;
        backdrop-filter: var(--backdrop);
        border: 1px solid rgba(255,255,255,0.3);
        box-shadow: 0 8px 24px rgba(255,0,110,0.4);
        animation: badge-pulse 3s ease-in-out infinite;
    }

    @keyframes badge-pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 8px 24px rgba(255,0,110,0.4); }
        50% { transform: scale(1.05); box-shadow: 0 12px 32px rgba(255,0,110,0.6); }
    }

    .product-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .product-category {
        font-size: var(--text-xs);
        color: var(--laser-blue);
        font-weight: var(--fw-bold);
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
    }

    .product-title {
        font-size: var(--text-lg);
        font-weight: var(--fw-bold);
        color: var(--text-primary);
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .product-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: var(--text-sm);
        padding: 12px 0;
        border-top: var(--border-thin);
        border-bottom: var(--border-thin);
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        color: var(--text-muted);
    }

    .product-rating.active {
        color: #fbbf24;
        font-weight: var(--fw-semibold);
    }

    .product-sold {
        font-size: var(--text-xs);
        color: var(--text-muted);
        background: rgba(255,255,255,0.05);
        padding: 4px 8px;
        border-radius: 8px;
    }

    .product-pricing {
        display: flex;
        align-items: baseline;
        gap: 12px;
        margin: 12px 0;
    }

    .product-price-original {
        font-size: var(--text-base);
        color: var(--text-muted);
        text-decoration: line-through;
        opacity: 0.7;
    }

    .product-price-current {
        font-size: 24px;
        font-weight: var(--fw-bold);
        background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .product-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: auto;
    }

    .product-actions .btn {
        height: 44px;
        padding: 0;
        font-size: var(--text-sm);
        font-weight: var(--fw-semibold);
        border-radius: var(--radius-md);
    }

    /* Enhanced Filter Panel */
    .filter-suite {
        background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.04) 100%);
        border: var(--border-glow);
        border-radius: var(--radius-xl);
        padding: var(--sp-2xl);
        margin-bottom: var(--sp-3xl);
        backdrop-filter: var(--backdrop) var(--backdrop-saturate);
        box-shadow: 0 16px 48px rgba(0,0,0,0.3);
    }

    .filter-grid {
        display: grid;
        gap: var(--sp-xl);
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: var(--sp-md);
    }

    .filter-label {
        font-size: var(--text-sm);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .filter-btn {
        padding: 14px 18px;
        background: rgba(255,255,255,0.06);
        border: var(--border-light);
        border-radius: var(--radius-lg);
        color: var(--text-secondary);
        font-size: var(--text-base);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-transform: capitalize;
        font-weight: var(--fw-medium);
        backdrop-filter: var(--backdrop);
    }

    .filter-btn:hover,
    .filter-btn:focus {
        border-color: var(--laser-blue);
        background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(139,92,246,0.1));
        color: var(--laser-blue);
        box-shadow: 0 8px 24px rgba(0,212,255,0.3);
        transform: translateY(-2px);
    }

    .filter-actions-row {
        display: flex;
        gap: var(--sp-lg);
        margin-top: var(--sp-xl);
        padding-top: var(--sp-xl);
        border-top: var(--border-glow);
    }

    /* Enhanced Empty State */
    .empty-state-display {
        text-align: center;
        padding: var(--sp-3xl) var(--sp-2xl);
        background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(139,92,246,0.05), rgba(255,0,110,0.03));
        border: var(--border-glow);
        border-radius: var(--radius-xl);
        backdrop-filter: var(--backdrop);
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }

    .empty-icon {
        font-size: 80px;
        margin-bottom: var(--sp-xl);
        animation: float 4s ease-in-out infinite;
        filter: drop-shadow(0 0 20px rgba(0,212,255,0.3));
    }

    .empty-title {
        font-size: var(--text-3xl);
        font-weight: var(--fw-bold);
        color: var(--laser-blue);
        margin-bottom: var(--sp-lg);
        background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-description {
        font-size: var(--text-lg);
        color: var(--text-secondary);
        margin-bottom: var(--sp-2xl);
        line-height: 1.6;
        opacity: 0.9;
    }

    /* Fade in animation */
    .fade-in {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stagger animation for product cards */
    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.2s; }
    .product-card:nth-child(3) { animation-delay: 0.3s; }
    .product-card:nth-child(4) { animation-delay: 0.4s; }
    .product-card:nth-child(5) { animation-delay: 0.5s; }
    .product-card:nth-child(6) { animation-delay: 0.6s; }
</style>
@endsection

@section('content')
<div class="shop-header-section fade-in">
    <!-- Hero Section -->
    <div class="hero-premium">
        <div class="hero-content">
            <div class="hero-subtitle">✨ Premium Collection 2024</div>
            <h1 class="hero-title">Elevate Your Style with Tomorrow's Fashion</h1>
            <p class="hero-description">
                Discover curated fashion-tech essentials that blend luxury craftsmanship with cutting-edge design. 
                Where innovation meets elegance in every piece.
            </p>
            <div style="display: flex; gap: var(--sp-lg); flex-wrap: wrap;">
                <a href="#shop-section" class="btn btn-primary">Explore Collection</a>
                <a href="#" class="btn btn-secondary">Watch Lookbook</a>
                <a href="{{ route('about') }}" class="btn btn-ghost">Our Story</a>
            </div>
            
            <!-- Hero Stats -->
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $products->total() }}</span>
                    <span class="stat-label">Products</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $categories->count() }}</span>
                    <span class="stat-label">Categories</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">4.8</span>
                    <span class="stat-label">Rating</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Panel -->
    <form method="GET" action="{{ route('shop.index') }}" class="filter-suite">
        <div class="filter-grid">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: var(--sp-lg);">
                <!-- Category Filter -->
                <div class="filter-group">
                    <label for="category" class="filter-label">📂 Danh Mục</label>
                    <select id="category" name="category" onchange="this.form.submit()" class="filter-btn">
                        <option value="">Tất Cả Sản Phẩm</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" 
                                @if(request('category') == $cat->slug) selected @endif>
                                {{ $cat->name }} ({{ $cat->products_count ?? 0 }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Filter -->
                <div class="filter-group">
                    <label for="sort" class="filter-label">🔄 Sắp Xếp Theo</label>
                    <select id="sort" name="sort" onchange="this.form.submit()" class="filter-btn">
                        <option value="newest" @if(request('sort') == 'newest') selected @endif>🆕 Mới Nhất</option>
                        <option value="price-low" @if(request('sort') == 'price-low') selected @endif>💰 Giá: Thấp → Cao</option>
                        <option value="price-high" @if(request('sort') == 'price-high') selected @endif>💎 Giá: Cao → Thấp</option>
                        <option value="popular" @if(request('sort') == 'popular') selected @endif>⭐ Phổ Biến</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="filter-group">
                    <label for="search" class="filter-label">🔍 Tìm Kiếm</label>
                    <input type="text" id="search" name="search" class="filter-btn" 
                           placeholder="Tìm sản phẩm..."
                           value="{{ request('search') }}"
                           onchange="this.form.submit()">
                </div>
            </div>

            <div class="filter-actions-row">
                <button type="submit" class="btn btn-primary" style="min-width: 140px;">🎯 Lọc Sản Phẩm</button>
                <a href="{{ route('shop.index') }}" class="btn btn-secondary">🔄 Đặt Lại</a>
            </div>
        </div>
    </form>
</div>

<!-- Products Grid -->
<div id="shop-section">
    @if($products->count() > 0)
        <div class="shop-grid">
            @foreach($products as $index => $product)
                <div class="product-card fade-in" style="animation-delay: {{ ($index % 6) * 0.1 }}s;">
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
