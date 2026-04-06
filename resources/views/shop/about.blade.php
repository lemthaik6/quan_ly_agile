@extends('layouts.shop')

@section('title', 'Về Chúng Tôi')

@section('content')
<div style="width: 100%;">

    <!-- HERO SECTION -->
    <section style="position: relative; min-height: 60vh; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: var(--sp-3xl) var(--sp-xl);">
        <div style="position: absolute; inset: 0; z-index: 0;">
            <div style="position: absolute; top: -40%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(0,212,255,0.15), transparent); border-radius: 50%; filter: blur(80px); animation: float 8s ease-in-out infinite;"></div>
            <div style="position: absolute; bottom: -30%; right: -5%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(139,92,246,0.12), transparent); border-radius: 50%; filter: blur(100px); animation: float 10s ease-in-out infinite reverse;"></div>
        </div>

        <div style="position: relative; z-index: 2; text-align: center; max-width: 900px;">
            <h1 style="font-size: clamp(2.5rem, 8vw, 4rem); font-weight: var(--fw-bold); line-height: 1.2; margin-bottom: var(--sp-lg); background: linear-gradient(135deg, var(--laser-blue) 0%, var(--electric-violet) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                Về OutfitChill Shop
            </h1>
            <p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 0; line-height: 1.8;">
                Khám phá câu chuyện, sứ mệnh và tầm nhìn của chúng tôi
            </p>
        </div>
    </section>

    <!-- STORY SECTION -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-3xl); align-items: center;">
            <!-- Left: Content -->
            <div>
                <div style="display: inline-block; padding: 8px 20px; background: rgba(0, 212, 255, 0.1); border: 1px solid rgba(0, 212, 255, 0.3); border-radius: 50px; margin-bottom: var(--sp-md);">
                    <span style="color: var(--laser-blue); font-size: var(--text-xs); font-weight: var(--fw-bold); letter-spacing: 1px; text-transform: uppercase;">📖 Câu Chuyện</span>
                </div>
                <h2 style="font-size: var(--text-4xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg); color: var(--text-primary);">
                    Khởi Đầu Từ Một Đam Mê
                </h2>
                <p style="font-size: 1.1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: var(--sp-lg);">
                    OutfitChill Shop được thành lập vào năm 2020 với một mục đích đơn giản: mang đến cho khách hàng Việt những sản phẩm thời trang chất lượng cao với giá cả hợp lý. Chúng tôi bắt đầu như một cửa hàng nhỏ, nhưng nhờ vào sự tin tưởng và ủng hộ của các khách hàng, chúng tôi đã phát triển thành một thương hiệu được biết đến rộng rãi.
                </p>
                <p style="font-size: 1.1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: var(--sp-lg);">
                    Hôm nay, OutfitChill Shop tự hào là nơi hội tụ những người yêu thích thời trang, nơi bạn có thể tìm thấy những bộ sưu tập độc quyền từ các nhà thiết kế nổi tiếng cũng như các thương hiệu quốc tế hàng đầu.
                </p>
                <a href="{{ route('shop.index') }}" style="display: inline-flex; align-items: center; gap: var(--sp-md); padding: 14px 32px; background: linear-gradient(135deg, var(--laser-blue), var(--laser-blue-dim)); color: var(--obsidian); border: none; border-radius: var(--radius-lg); font-weight: var(--fw-bold); text-decoration: none; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 30px rgba(0, 212, 255, 0.25);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 40px rgba(0, 212, 255, 0.35)';" onmouseout="this.style.transform=''; this.style.boxShadow='0 10px 30px rgba(0, 212, 255, 0.25)';">
                    🛍️ Khám Phá Sản Phẩm
                </a>
            </div>

            <!-- Right: Image/Stats -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-lg);">
                <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02)); border: 1px solid rgba(0,212,255,0.2); border-radius: var(--radius-lg); text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 200px;">
                    <p style="font-size: 3rem; font-weight: var(--fw-bold); color: var(--laser-blue); margin-bottom: var(--sp-md);">4+</p>
                    <p style="color: var(--text-secondary); font-size: var(--text-base);">Năm Kinh Nghiệm</p>
                </div>
                <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02)); border: 1px solid rgba(139,92,246,0.2); border-radius: var(--radius-lg); text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 200px;">
                    <p style="font-size: 3rem; font-weight: var(--fw-bold); color: var(--electric-violet); margin-bottom: var(--sp-md);">50k+</p>
                    <p style="color: var(--text-secondary); font-size: var(--text-base);">Khách Hàng Hài Lòng</p>
                </div>
                <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02)); border: 1px solid rgba(16,185,129,0.2); border-radius: var(--radius-lg); text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 200px;">
                    <p style="font-size: 3rem; font-weight: var(--fw-bold); color: var(--success); margin-bottom: var(--sp-md);">1000+</p>
                    <p style="color: var(--text-secondary); font-size: var(--text-base);">Sản Phẩm Chính Hãng</p>
                </div>
                <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(245,158,11,0.02)); border: 1px solid rgba(245,158,11,0.2); border-radius: var(--radius-lg); text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 200px;">
                    <p style="font-size: 3rem; font-weight: var(--fw-bold); color: var(--warning); margin-bottom: var(--sp-md);">24/7</p>
                    <p style="color: var(--text-secondary); font-size: var(--text-base);">Hỗ Trợ Khách Hàng</p>
                </div>
            </div>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: var(--sp-3xl);">
            <h2 style="font-size: var(--text-4xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">Sứ Mệnh & Tầm Nhìn</h2>
            <p style="color: var(--text-secondary); font-size: var(--text-lg); max-width: 600px; margin: 0 auto;">Những giá trị cốt lõi định hình hành động của chúng tôi</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--sp-xl);">
            <!-- Mission -->
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02)); border: 1px solid rgba(0,212,255,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.15), rgba(0,212,255,0.05))'; this.style.borderColor='rgba(0,212,255,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02))'; this.style.borderColor='rgba(0,212,255,0.2)';">
                <div style="font-size: 3rem; margin-bottom: var(--sp-lg);">🎯</div>
                <h3 style="font-size: var(--text-2xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg); color: var(--laser-blue);">Sứ Mệnh</h3>
                <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1rem;">
                    Mang đến những sản phẩm thời trang chất lượng cao, giá cả hợp lý và dịch vụ khách hàng tuyệt vời nhất, giúp mỗi khách hàng tự tin thể hiện phong cách cá nhân của mình.
                </p>
            </div>

            <!-- Vision -->
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02)); border: 1px solid rgba(139,92,246,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.15), rgba(139,92,246,0.05))'; this.style.borderColor='rgba(139,92,246,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02))'; this.style.borderColor='rgba(139,92,246,0.2)';">
                <div style="font-size: 3rem; margin-bottom: var(--sp-lg);">🚀</div>
                <h3 style="font-size: var(--text-2xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg); color: var(--electric-violet);">Tầm Nhìn</h3>
                <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1rem;">
                    Trở thành nền tảng thương mại điện tử hàng đầu tại Việt Nam, được khách hàng tin tưởng và yêu thích, nơi họ có thể tìm thấy mọi thứ về thời trang với mục đích nâng cao chất lượng cuộc sống.
                </p>
            </div>

            <!-- Values -->
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02)); border: 1px solid rgba(16,185,129,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(16,185,129,0.15), rgba(16,185,129,0.05))'; this.style.borderColor='rgba(16,185,129,0.4)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02))'; this.style.borderColor='rgba(16,185,129,0.2)';">
                <div style="font-size: 3rem; margin-bottom: var(--sp-lg);">💎</div>
                <h3 style="font-size: var(--text-2xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg); color: var(--success);">Giá Trị</h3>
                <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1rem;">
                    Chất lượng, Uy tín, Chân thành và Đổi mới. Chúng tôi cam kết mang lại giá trị tốt nhất cho mỗi khách hàng.
                </p>
            </div>
        </div>
    </section>

    <!-- CORE VALUES -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <h2 style="font-size: var(--text-4xl); font-weight: var(--fw-bold); text-align: center; margin-bottom: var(--sp-3xl);">Những Giá Trị Cốt Lõi</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--sp-xl);">
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: var(--sp-lg);">✅</div>
                <h3 style="font-size: var(--text-xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Chất Lượng Tuyệt Đối</h3>
                <p style="color: var(--text-secondary);">Mọi sản phẩm đều qua kiểm duyệt kỹ lưỡng để đảm bảo chất lượng tốt nhất cho khách hàng.</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: var(--sp-lg);">🤝</div>
                <h3 style="font-size: var(--text-xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Uy Tín & Trách Nhiệm</h3>
                <p style="color: var(--text-secondary);">Chúng tôi cam kết thực hiện đúng những lời hứa và luôn đặt lợi ích khách hàng lên hàng đầu.</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: var(--sp-lg);">💡</div>
                <h3 style="font-size: var(--text-xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Đổi Mới Liên Tục</h3>
                <p style="color: var(--text-secondary);">Chúng tôi luôn cập nhật xu hướng mới và cải thiện dịch vụ để phục vụ bạn tốt hơn.</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: var(--sp-lg);">❤️</div>
                <h3 style="font-size: var(--text-xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Chân Thành & Lắng Nghe</h3>
                <p style="color: var(--text-secondary);">Chúng tôi lắng nghe feedback của khách hàng và luôn sẵn sàng cải thiện.</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: var(--sp-lg);">🌍</div>
                <h3 style="font-size: var(--text-xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Bảo Vệ Môi Trường</h3>
                <p style="color: var(--text-secondary);">Chúng tôi cam kết sử dụng các biện pháp thân thiện với môi trường trong toàn bộ hoạt động.</p>
            </div>
            <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: var(--sp-lg);">🎁</div>
                <h3 style="font-size: var(--text-xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-md);">Giá Trị Khách Hàng</h3>
                <p style="color: var(--text-secondary);">Khách hàng là trái tim của chúng tôi, mọi quyết định đều vì sự hài lòng của bạn.</p>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <div style="padding: var(--sp-3xl); background: linear-gradient(135deg, rgba(0,212,255,0.15), rgba(139,92,246,0.1)); border: 1px solid rgba(0,212,255,0.3); border-radius: var(--radius-lg); text-align: center;">
            <h2 style="font-size: var(--text-3xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">Bạn Có Câu Hỏi?</h2>
            <p style="color: var(--text-secondary); font-size: 1.1rem; margin-bottom: var(--sp-xl); max-width: 600px; margin-left: auto; margin-right: auto;">
                Hãy liên hệ với chúng tôi bất kỳ lúc nào. Chúng tôi luôn sẵn sàng giúp đỡ bạn.
            </p>
            <div style="display: flex; gap: var(--sp-lg); justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('contact') }}" style="padding: 14px 48px; background: linear-gradient(135deg, var(--laser-blue), var(--laser-blue-dim)); color: var(--obsidian); border: none; border-radius: var(--radius-lg); font-weight: var(--fw-bold); text-decoration: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: var(--sp-md); box-shadow: 0 10px 30px rgba(0, 212, 255, 0.25);">
                    💬 Liên Hệ Với Chúng Tôi
                </a>
            </div>
        </div>
    </section>

</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(30px); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 0.6; }
        50% { opacity: 1; }
    }
    @keyframes slideDown {
        from { 
            opacity: 0;
            transform: translateY(-40px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endsection
