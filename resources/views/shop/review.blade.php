@extends('layouts.shop')

@section('title', 'Đánh Giá Sản Phẩm - ' . $product->name)

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
    <!-- Breadcrumb -->
    <div style="margin-bottom: 30px; display: flex; align-items: center; gap: 8px;">
        <a href="{{ route('product.show', $product->slug) }}" style="color: #00d4ff; text-decoration: none; font-size: 14px; font-weight: 600;">← Quay Lại Sản Phẩm</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px; align-items: start;">
        
        <!-- Product Info Card -->
        <div>
            <div style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; backdrop-filter: blur(20px); overflow: hidden; padding: 0; transition: all 0.3s;">
                <!-- Product Image -->
                <div style="width: 100%; aspect-ratio: 1; background: rgba(0,212,255,0.1); overflow: hidden;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #00d4ff; font-size: 80px;">📦</div>
                    @endif
                </div>

                <!-- Product Details -->
                <div style="padding: 24px;">
                    <h2 style="font-size: 16px; font-weight: 700; background: linear-gradient(135deg, #f0f0f0, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">{{ $product->name }}</h2>
                    <p style="color: #b0b0c0; font-size: 13px; line-height: 1.6; margin-bottom: 16px;">{{ Str::limit($product->short_description, 150) }}</p>

                    <!-- Purchase Badge -->
                    <div style="background: linear-gradient(135deg, rgba(16,185,129,0.15), rgba(16,185,129,0.05)); border: 1px solid rgba(16,185,129,0.3); border-radius: 10px; padding: 12px; border-left: 3px solid #10b981;">
                        <p style="color: #86efac; font-size: 12px; font-weight: 600; margin-bottom: 4px;">✓ Bạn Đã Mua Sản Phẩm Này</p>
                        <p style="color: #b0b0c0; font-size: 12px;">Chia sẻ trải nghiệm của bạn với những khách hàng khác</p>
                    </div>

                    <!-- Current Rating (if exists) -->
                    @if($existingReview)
                        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(0,212,255,0.2);">
                            <p style="font-size: 12px; color: #808090; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Đánh Giá Hiện Tại</p>
                            <div style="font-size: 24px; letter-spacing: 4px;">
                                @for($i = 1; $i <= 5; $i++)
                                    <span style="color: {{ $i <= $existingReview->rating ? '#fbbf24' : 'rgba(255,255,255,0.1)' }};">★</span>
                                @endfor
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Review Form -->
        <div>
            <div style="margin-bottom: 32px;">
                <h1 style="font-size: 42px; font-weight: 700; background: linear-gradient(135deg, #f0f0f0, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">✍️ Đánh Giá Sản Phẩm</h1>
                <p style="color: #b0b0c0; font-size: 14px;">Giúp cộng đồng đưa ra quyết định tốt hơn</p>
            </div>

            <form action="{{ route('review.store') }}" method="POST" id="review-form" style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; backdrop-filter: blur(20px); padding: 32px;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <!-- Star Rating Section -->
                <div style="margin-bottom: 32px;">
                    <label style="font-size: 13px; font-weight: 600; color: #00d4ff; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 16px;">Chọn Số Sao *</label>

                    <div id="star-rating" style="display: flex; gap: 12px; font-size: 48px;">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}" onclick="setRating({{ $i }})" style="cursor: pointer; transition: all 0.2s; color: rgba(255,255,255,0.2); user-select: none;" onmouseover="updateStarsHover({{ $i }})" onmouseout="updateStars(parseInt(document.getElementById('rating').value))">★</span>
                        @endfor
                    </div>

                    <input type="hidden" name="rating" id="rating" value="{{ old('rating', $existingReview?->rating ?? 5) }}">

                    @error('rating')
                        <p style="color: #fca5a5; font-size: 12px; margin-top: 8px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Comment Section -->
                <div style="margin-bottom: 32px;">
                    <label style="font-size: 13px; font-weight: 600; color: #00d4ff; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 12px;">Viết Nhận Xét</label>
                    <textarea name="comment" rows="6" placeholder="Chia sẻ trải nghiệm của bạn với sản phẩm này... (Tối đa 1000 ký tự)" style="width: 100%; padding: 12px 14px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; color: #f0f0f0; font-family: inherit; font-size: 14px; resize: vertical; transition: all 0.3s;" onfocus="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='rgba(255,255,255,0.05)';" onblur="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.background='rgba(255,255,255,0.03)';">{{ old('comment', $existingReview?->comment) }}</textarea>
                    @error('comment')
                        <p style="color: #fca5a5; font-size: 12px; margin-top: 8px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 12px;">
                    <button type="submit" style="flex: 1; background: linear-gradient(135deg, #00d4ff, #8b5cf6); color: #080808; border: none; border-radius: 10px; padding: 12px 24px; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(0,212,255,0.4)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
                        {{ $existingReview ? '✓ Cập Nhật Đánh Giá' : '✍️ Gửi Đánh Giá' }}
                    </button>
                    <a href="{{ route('product.show', $product->slug) }}" style="flex: 1; background: linear-gradient(135deg, rgba(0,212,255,0.15), rgba(0,212,255,0.08)); color: #00d4ff; border: 1px solid rgba(0,212,255,0.3); border-radius: 10px; padding: 12px 24px; text-align: center; text-decoration: none; font-weight: 600; font-size: 15px; transition: all 0.3s; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.background='rgba(0,212,255,0.2)'; this.style.borderColor='rgba(0,212,255,0.5)';" onmouseout="this.style.background='rgba(0,212,255,0.15)'; this.style.borderColor='rgba(0,212,255,0.3)';">
                        Hủy
                    </a>
                </div>

                <!-- Info Message -->
                @if($existingReview)
                    <div style="margin-top: 20px; padding: 12px 14px; background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.05)); border-left: 3px solid #10b981; border-radius: 6px; font-size: 12px; color: #86efac;">
                        ℹ️ Bạn đã đánh giá sản phẩm này. Cập nhật dưới đây để thay đổi đánh giá của mình.
                    </div>
                @endif
            </form>

            <!-- Other Reviews -->
            <div style="margin-top: 40px; padding-top: 40px; border-top: 1px solid rgba(0,212,255,0.2);">
                <h3 style="font-size: 16px; font-weight: 700; color: #f0f0f0; margin-bottom: 20px;">💬 Đánh Giá Từ Khách Hàng Khác</h3>

                @php
                    $otherReviews = $product->reviews()
                        ->where('is_verified_purchase', true)
                        ->where('user_id', '!=', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                @endphp

                @if($otherReviews->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 12px; max-height: 450px; overflow-y: auto;">
                        @foreach($otherReviews as $review)
                            <div style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; padding: 16px; transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(0,212,255,0.3)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)';">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                    <div>
                                        <div style="color: #f0f0f0; font-weight: 600; font-size: 14px;">{{ $review->user->name }}</div>
                                        <div style="font-size: 16px; letter-spacing: 2px; margin-top: 6px;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span style="color: {{ $i <= $review->rating ? '#fbbf24' : 'rgba(255,255,255,0.1)' }};">★</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <div style="font-size: 12px; color: #808090;">{{ $review->created_at->diffForHumans() }}</div>
                                </div>

                                @if($review->comment)
                                    <p style="color: #b0b0c0; font-size: 13px; line-height: 1.6;">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 30px; color: #b0b0c0; font-size: 14px;">
                        Chưa có đánh giá từ khách hàng khác
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function setRating(value) {
    document.getElementById('rating').value = value;
    updateStars(value);
}

function updateStarsHover(value) {
    document.querySelectorAll('.star').forEach((star, index) => {
        star.style.color = index < value ? '#fbbf24' : 'rgba(255,255,255,0.2)';
    });
}

function updateStars(rating) {
    document.querySelectorAll('.star').forEach((star, index) => {
        star.style.color = index < rating ? '#fbbf24' : 'rgba(255,255,255,0.2)';
    });
}

// Initialize stars on page load
const initialRating = parseInt(document.getElementById('rating').value);
updateStars(initialRating);
</script>
@endsection
