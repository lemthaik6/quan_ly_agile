@extends('layouts.shop')

@section('title', 'Trang Chủ')

@section('content')
<div style="width: 100%;">
    
    <!-- HERO SECTION -->
    <section style="position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden;">
        <div style="position: absolute; inset: 0; z-index: 0;">
            <div style="position: absolute; top: -40%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(0,212,255,0.15), transparent); border-radius: 50%; filter: blur(80px); animation: float 8s ease-in-out infinite;"></div>
            <div style="position: absolute; bottom: -30%; right: -5%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(139,92,246,0.12), transparent); border-radius: 50%; filter: blur(100px); animation: float 10s ease-in-out infinite reverse;"></div>
            <div style="position: absolute; top: 30%; right: 10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,0,110,0.08), transparent); border-radius: 50%; filter: blur(90px); animation: pulse 6s ease-in-out infinite;"></div>
        </div>

        <div style="position: relative; z-index: 2; text-align: center; max-width: 1000px; padding: var(--sp-3xl) var(--sp-xl);">
            <div style="animation: slideDown 1s ease-out;">
                <div style="display: inline-block; padding: 10px 24px; background: rgba(0, 212, 255, 0.1); border: 1px solid rgba(0, 212, 255, 0.3); border-radius: 50px; margin-bottom: var(--sp-lg);">
                    <span style="color: var(--laser-blue); font-size: var(--text-sm); font-weight: var(--fw-bold); letter-spacing: 1px;">✨ CHÀO MỪNG ĐẾN VỚI OUTFITCHILL SHOP</span>
                </div>

                <h1 style="font-size: clamp(3rem, 8vw, 5rem); font-weight: var(--fw-bold); line-height: 1.2; margin-bottom: var(--sp-lg); background: linear-gradient(135deg, var(--laser-blue) 0%, var(--electric-violet) 50%, var(--hot-pink) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    THỜI TRANG HIỆN ĐẠI
                </h1>

                <p style="font-size: clamp(1rem, 2.5vw, 1.5rem); color: var(--text-secondary); margin-bottom: var(--sp-2xl); line-height: 1.8; max-width: 700px; margin-left: auto; margin-right: auto;">
                    Khám phá bộ sưu tập độc quyền với chất lượng cao, giá tốt và giao hàng nhanh chóng
                </p>

                <div style="display: flex; gap: var(--sp-lg); justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('shop.index') }}" style="padding: 18px 48px; background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet)); color: var(--obsidian); border: none; border-radius: var(--radius-lg); font-weight: var(--fw-bold); font-size: var(--text-base); text-decoration: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: var(--sp-md); box-shadow: 0 10px 30px rgba(0, 212, 255, 0.25);">
                        🛍️ Khám Phá Ngay
                    </a>
                    <a href="#featured" style="padding: 18px 48px; background: rgba(255,255,255,0.08); border: 1px solid rgba(0, 212, 255, 0.4); color: var(--laser-blue); border-radius: var(--radius-lg); font-weight: var(--fw-bold); font-size: var(--text-base); text-decoration: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: var(--sp-md);">
                        ⭐ Sản Phẩm Nổi Bật
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: var(--sp-xl);">
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02)); border: 1px solid rgba(0,212,255,0.2); border-radius: var(--radius-lg); text-align: center; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.12), rgba(0,212,255,0.05))'; this.style.borderColor='rgba(0,212,255,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02))'; this.style.borderColor='rgba(0,212,255,0.2)';">
                <p style="font-size: var(--text-4xl); font-weight: var(--fw-bold); color: var(--laser-blue); margin-bottom: var(--sp-md);">1000+</p>
                <p style="color: var(--text-secondary); font-size: var(--text-base);">Sản Phẩm Chính Hãng</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02)); border: 1px solid rgba(139,92,246,0.2); border-radius: var(--radius-lg); text-align: center; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.12), rgba(139,92,246,0.05))'; this.style.borderColor='rgba(139,92,246,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02))'; this.style.borderColor='rgba(139,92,246,0.2)';">
                <p style="font-size: var(--text-4xl); font-weight: var(--fw-bold); color: var(--electric-violet); margin-bottom: var(--sp-md);">50k+</p>
                <p style="color: var(--text-secondary); font-size: var(--text-base);">Khách Hàng Hài Lòng</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02)); border: 1px solid rgba(16,185,129,0.2); border-radius: var(--radius-lg); text-align: center; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(16,185,129,0.12), rgba(16,185,129,0.05))'; this.style.borderColor='rgba(16,185,129,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02))'; this.style.borderColor='rgba(16,185,129,0.2)';">
                <p style="font-size: var(--text-4xl); font-weight: var(--fw-bold); color: var(--success); margin-bottom: var(--sp-md);">24/7</p>
                <p style="color: var(--text-secondary); font-size: var(--text-base);">Hỗ Trợ Khách Hàng</p>
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section id="featured" style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: var(--sp-3xl);">
            <div style="display: inline-block; padding: 8px 20px; background: rgba(0, 212, 255, 0.1); border: 1px solid rgba(0, 212, 255, 0.3); border-radius: 50px; margin-bottom: var(--sp-md);">
                <span style="color: var(--laser-blue); font-size: var(--text-xs); font-weight: var(--fw-bold); letter-spacing: 1px; text-transform: uppercase;">⭐ Nổi Bật</span>
            </div>
            <h2 style="font-size: var(--text-4xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Sản Phẩm Được Yêu Thích</h2>
            <p style="color: var(--text-secondary); font-size: var(--text-lg); max-width: 500px; margin: 0 auto;">Những sản phẩm được khách hàng bình chọn cao nhất</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--sp-xl);">
            @forelse($featuredProducts ?? [] as $product)
                <div style="background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); overflow: hidden; transition: all 0.4s; cursor: pointer; display: flex; flex-direction: column; height: 100%;" onmouseover="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05))'; this.style.boxShadow='0 20px 40px rgba(0,212,255,0.15)'; this.style.transform='translateY(-8px)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02))'; this.style.boxShadow=''; this.style.transform='';">
                    <div style="position: relative; height: 320px; background: linear-gradient(135deg, rgba(0,212,255,0.05), rgba(139,92,246,0.03)); overflow: hidden;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.12)';" onmouseout="this.style.transform='';">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--laser-blue); font-size: 80px;">📦</div>
                        @endif
                        @if($product->discount_price)
                            <div style="position: absolute; top: 16px; right: 16px; background: linear-gradient(135deg, var(--hot-pink), #ff4d8f); color: white; padding: 8px 16px; border-radius: var(--radius-md); font-size: var(--text-xs); font-weight: var(--fw-bold); box-shadow: 0 8px 16px rgba(255,0,110,0.3);">
                                -{{ round((1 - $product->discount_price / $product->price) * 100) }}%
                            </div>
                        @endif
                    </div>
                    <div style="padding: var(--sp-xl); flex: 1; display: flex; flex-direction: column;">
                        <p style="color: var(--laser-blue); font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 1.5px; font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">
                            {{ $product->category->name ?? 'Sản Phẩm' }}
                        </p>
                        <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-md); line-height: 1.5; color: var(--text-primary);">
                            {{ \Str::limit($product->name, 45) }}
                        </h3>
                        <div style="display: flex; align-items: center; gap: var(--sp-md); margin-bottom: var(--sp-lg);">
                            <span style="font-size: var(--text-2xl); font-weight: var(--fw-bold); color: var(--laser-blue);">
                                {{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}₫
                            </span>
                            @if($product->discount_price)
                                <span style="font-size: var(--text-sm); color: var(--text-muted); text-decoration: line-through;">
                                    {{ number_format($product->price, 0, ',', '.') }}₫
                                </span>
                            @endif
                        </div>
                        <div style="display: flex; align-items: center; gap: var(--sp-sm); margin-bottom: var(--sp-lg); font-size: var(--text-sm);">
                            <span style="color: var(--warning);">⭐⭐⭐⭐⭐</span>
                            <span style="color: var(--text-muted);">({{ $product->reviews->count() ?? 0 }} đánh giá)</span>
                        </div>
                        <a href="{{ route('product.show', $product->slug) }}" style="display: block; padding: 12px 24px; background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(0,212,255,0.1)); color: var(--laser-blue); border: 1px solid rgba(0,212,255,0.3); border-radius: var(--radius-md); text-align: center; text-decoration: none; font-weight: var(--fw-bold); transition: all 0.3s; margin-top: auto;" onmouseover="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.3), rgba(0,212,255,0.2))'; this.style.borderColor='rgba(0,212,255,0.5)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.2), rgba(0,212,255,0.1))'; this.style.borderColor='rgba(0,212,255,0.3)';">
                            Xem Chi Tiết →
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; padding: var(--sp-3xl); text-align: center; color: var(--text-muted);">
                    Đang cập nhật sản phẩm...
                </div>
            @endforelse
        </div>
    </section>

    <!-- CATEGORIES -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: var(--sp-3xl);">
            <div style="display: inline-block; padding: 8px 20px; background: rgba(139,92,246,0.1); border: 1px solid rgba(139,92,246,0.3); border-radius: 50px; margin-bottom: var(--sp-md);">
                <span style="color: var(--electric-violet); font-size: var(--text-xs); font-weight: var(--fw-bold); letter-spacing: 1px; text-transform: uppercase;">📂 Danh Mục</span>
            </div>
            <h2 style="font-size: var(--text-4xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Khám Phá Danh Mục</h2>
            <p style="color: var(--text-secondary); font-size: var(--text-lg);">Tìm những thứ bạn yêu thích</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--sp-xl);">
            @forelse($categories ?? [] as $category)
                <a href="{{ route('shop.index', ['category' => $category->id]) }}" style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02)); border: 1px solid rgba(139,92,246,0.2); border-radius: var(--radius-lg); text-decoration: none; text-align: center; transition: all 0.4s; display: flex; flex-direction: column; align-items: center; gap: var(--sp-md);" onmouseover="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.15), rgba(139,92,246,0.05))'; this.style.borderColor='rgba(139,92,246,0.5)'; this.style.boxShadow='0 12px 32px rgba(139,92,246,0.12)'; this.style.transform='translateY(-6px)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02))'; this.style.borderColor='rgba(139,92,246,0.2)'; this.style.boxShadow=''; this.style.transform='';">
                    <div style="font-size: 48px;">📦</div>
                    <div>
                        <h3 style="font-size: var(--text-xl); font-weight: var(--fw-bold); color: var(--electric-violet); margin-bottom: var(--sp-sm);">{{ $category->name }}</h3>
                        <p style="color: var(--text-muted); font-size: var(--text-sm);">{{ $category->products_count ?? 0 }} sản phẩm</p>
                    </div>
                </a>
            @empty
                <div style="grid-column: 1 / -1; padding: var(--sp-3xl); text-align: center; color: var(--text-muted);">
                    Chưa có danh mục
                </div>
            @endforelse
        </div>
    </section>

    <!-- BENEFITS -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: var(--sp-3xl);">
            <div style="display: inline-block; padding: 8px 20px; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 50px; margin-bottom: var(--sp-md);">
                <span style="color: var(--success); font-size: var(--text-xs); font-weight: var(--fw-bold); letter-spacing: 1px; text-transform: uppercase;">✨ Lợi Ích</span>
            </div>
            <h2 style="font-size: var(--text-4xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Tại Sao Chọn Chúng Tôi</h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--sp-xl);">
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02)); border: 1px solid rgba(0,212,255,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.12), rgba(0,212,255,0.05))'; this.style.borderColor='rgba(0,212,255,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02))'; this.style.borderColor='rgba(0,212,255,0.2)';">
                <div style="font-size: 48px; margin-bottom: var(--sp-lg);">✅</div>
                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-md); color: var(--laser-blue);">Chính Hãng 100%</h3>
                <p style="color: var(--text-secondary); line-height: 1.6;">Tất cả sản phẩm đều được kiểm định chất lượng và có chứng chỉ xuất xứ rõ ràng</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02)); border: 1px solid rgba(139,92,246,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.12), rgba(139,92,246,0.05))'; this.style.borderColor='rgba(139,92,246,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02))'; this.style.borderColor='rgba(139,92,246,0.2)';">
                <div style="font-size: 48px; margin-bottom: var(--sp-lg);">🚚</div>
                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-md); color: var(--electric-violet);">Giao Hàng Nhanh</h3>
                <p style="color: var(--text-secondary); line-height: 1.6;">Vận chuyển toàn quốc trong 2-3 ngày làm việc với phí giao hàng cạnh tranh</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02)); border: 1px solid rgba(16,185,129,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(16,185,129,0.12), rgba(16,185,129,0.05))'; this.style.borderColor='rgba(16,185,129,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02))'; this.style.borderColor='rgba(16,185,129,0.2)';">
                <div style="font-size: 48px; margin-bottom: var(--sp-lg);">💰</div>
                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-md); color: var(--success);">Giá Cạnh Tranh</h3>
                <p style="color: var(--text-secondary); line-height: 1.6;">Giá tốt nhất thị trường với các chương trình khuyến mãi hấp dẫn thường xuyên</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(245,158,11,0.02)); border: 1px solid rgba(245,158,11,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(245,158,11,0.12), rgba(245,158,11,0.05))'; this.style.borderColor='rgba(245,158,11,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(245,158,11,0.08), rgba(245,158,11,0.02))'; this.style.borderColor='rgba(245,158,11,0.2)';">
                <div style="font-size: 48px; margin-bottom: var(--sp-lg);">🛡️</div>
                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-md); color: var(--warning);">Bảo Hành Uy Tín</h3>
                <p style="color: var(--text-secondary); line-height: 1.6;">Chính sách bảo hành và đổi trả dễ dàng trong vòng 30 ngày</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(239,68,68,0.08), rgba(239,68,68,0.02)); border: 1px solid rgba(239,68,68,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(239,68,68,0.12), rgba(239,68,68,0.05))'; this.style.borderColor='rgba(239,68,68,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(239,68,68,0.08), rgba(239,68,68,0.02))'; this.style.borderColor='rgba(239,68,68,0.2)';">
                <div style="font-size: 48px; margin-bottom: var(--sp-lg);">💬</div>
                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-md); color: var(--error);">Hỗ Trợ 24/7</h3>
                <p style="color: var(--text-secondary); line-height: 1.6;">Đội hỗ trợ khách hàng nhiệt tình sẵn sàng giúp bạn mọi lúc</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto; margin-bottom: var(--sp-3xl);">
        <div style="padding: var(--sp-3xl); background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(139,92,246,0.08), rgba(255,0,110,0.05)); border: 1px solid rgba(0,212,255,0.2); border-radius: var(--radius-lg); text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; inset: 0; opacity: 0.5; pointer-events: none;">
                <div style="position: absolute; top: -50%; left: 10%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(0,212,255,0.15), transparent); border-radius: 50%; filter: blur(80px);"></div>
            </div>
            
            <div style="position: relative; z-index: 1;">
                <h2 style="font-size: var(--text-3xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg); color: var(--text-primary);">Sẵn Sàng Mua Sắm Ngay?</h2>
                <p style="color: var(--text-secondary); font-size: var(--text-lg); margin-bottom: var(--sp-2xl);">Khám phá bộ sưu tập đầy đủ của chúng tôi ngay hôm nay</p>
                <a href="{{ route('shop.index') }}" style="display: inline-block; padding: 18px 52px; background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet)); color: var(--obsidian); border: none; border-radius: var(--radius-lg); font-weight: var(--fw-bold); font-size: var(--text-base); text-decoration: none; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 30px rgba(0, 212, 255, 0.25);">
                    Bắt Đầu Mua Sắm →
                </a>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(30px); }
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.05); opacity: 0.4; }
    }
    @keyframes textGlow {
        0%, 100% { filter: drop-shadow(0 0 20px rgba(0, 212, 255, 0.5)); }
        50% { filter: drop-shadow(0 0 30px rgba(139, 92, 246, 0.5)); }
    }
    @media (max-width: 768px) {
        h1 { font-size: 2.5rem !important; }
        h2 { font-size: 2rem !important; }
    }
</style>
@endsection
