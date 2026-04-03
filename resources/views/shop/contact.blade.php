@extends('layouts.shop')

@section('title', 'Liên Hệ Với Chúng Tôi')

@section('content')
<div style="width: 100%;">

    <!-- HERO SECTION -->
    <section style="position: relative; min-height: 50vh; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: var(--sp-3xl) var(--sp-xl);">
        <div style="position: absolute; inset: 0; z-index: 0;">
            <div style="position: absolute; top: -40%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(0,212,255,0.15), transparent); border-radius: 50%; filter: blur(80px); animation: float 8s ease-in-out infinite;"></div>
            <div style="position: absolute; bottom: -30%; right: -5%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(139,92,246,0.12), transparent); border-radius: 50%; filter: blur(100px); animation: float 10s ease-in-out infinite reverse;"></div>
        </div>

        <div style="position: relative; z-index: 2; text-align: center; max-width: 800px;">
            <h1 style="font-size: clamp(2.5rem, 8vw, 4rem); font-weight: var(--fw-bold); line-height: 1.2; margin-bottom: var(--sp-lg); background: linear-gradient(135deg, var(--laser-blue) 0%, var(--electric-violet) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                Liên Hệ Với Chúng Tôi
            </h1>
            <p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 0; line-height: 1.8;">
                Chúng tôi đây! Hãy gửi tin nhắn cho chúng tôi, chúng tôi sẽ liên hệ lại sớm nhất.
            </p>
        </div>
    </section>

    <!-- CONTACT CONTENT -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        @if(session('success'))
            <div style="margin-bottom: var(--sp-xl); padding: var(--sp-xl); background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.05)); border: 1px solid rgba(16,185,129,0.3); border-radius: var(--radius-lg); color: var(--success); font-size: 1rem;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-3xl); align-items: start;">
            
            <!-- LEFT: CONTACT INFO -->
            <div>
                <h2 style="font-size: var(--text-3xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-2xl);">Thông Tin Liên Hệ</h2>

                <!-- Contact Items -->
                <div style="display: flex; flex-direction: column; gap: var(--sp-xl);">
                    <!-- Phone -->
                    <div style="padding: var(--sp-xl); background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02)); border: 1px solid rgba(0,212,255,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='linear-gradient(135deg, rgba(0,212,255,0.15), rgba(0,212,255,0.05))';" onmouseout="this.style.borderColor='rgba(0,212,255,0.2)'; this.style.background='linear-gradient(135deg, rgba(0,212,255,0.08), rgba(0,212,255,0.02))';">
                        <div style="display: flex; align-items: flex-start; gap: var(--sp-lg);">
                            <div style="font-size: 1.5rem; color: var(--laser-blue); flex-shrink: 0;">📞</div>
                            <div>
                                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm); color: var(--laser-blue);">Điện Thoại</h3>
                                <p style="color: var(--text-secondary); margin: 0;"><a href="tel:+84901234567" style="color: var(--laser-blue); text-decoration: none;">+84 (90) 123 4567</a></p>
                                <p style="color: var(--text-muted); font-size: var(--text-sm); margin: var(--sp-sm) 0 0 0;">Thứ Hai - Chủ Nhật, 8AM - 10PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div style="padding: var(--sp-xl); background: linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02)); border: 1px solid rgba(139,92,246,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(139,92,246,0.4)'; this.style.background='linear-gradient(135deg, rgba(139,92,246,0.15), rgba(139,92,246,0.05))';" onmouseout="this.style.borderColor='rgba(139,92,246,0.2)'; this.style.background='linear-gradient(135deg, rgba(139,92,246,0.08), rgba(139,92,246,0.02))';">
                        <div style="display: flex; align-items: flex-start; gap: var(--sp-lg);">
                            <div style="font-size: 1.5rem; color: var(--electric-violet); flex-shrink: 0;">📧</div>
                            <div>
                                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm); color: var(--electric-violet);">Email</h3>
                                <p style="color: var(--text-secondary); margin: 0;"><a href="mailto:support@lemthai.com" style="color: var(--electric-violet); text-decoration: none;">support@lemthai.com</a></p>
                                <p style="color: var(--text-muted); font-size: var(--text-sm); margin: var(--sp-sm) 0 0 0;">Chúng tôi sẽ phản hồi trong 24 giờ</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div style="padding: var(--sp-xl); background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02)); border: 1px solid rgba(16,185,129,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(16,185,129,0.4)'; this.style.background='linear-gradient(135deg, rgba(16,185,129,0.15), rgba(16,185,129,0.05))';" onmouseout="this.style.borderColor='rgba(16,185,129,0.2)'; this.style.background='linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02))';">
                        <div style="display: flex; align-items: flex-start; gap: var(--sp-lg);">
                            <div style="font-size: 1.5rem; color: var(--success); flex-shrink: 0;">📍</div>
                            <div>
                                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm); color: var(--success);">Địa Chỉ</h3>
                                <p style="color: var(--text-secondary); margin: 0; line-height: 1.6;">
                                    124/51 Hòe thị <br>
                                    Nam từ niêm - Hà nội<br>
                                    Việt Nam
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div style="padding: var(--sp-xl); background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(245,158,11,0.02)); border: 1px solid rgba(245,158,11,0.2); border-radius: var(--radius-lg); transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(245,158,11,0.4)'; this.style.background='linear-gradient(135deg, rgba(245,158,11,0.15), rgba(245,158,11,0.05))';" onmouseout="this.style.borderColor='rgba(245,158,11,0.2)'; this.style.background='linear-gradient(135deg, rgba(245,158,11,0.08), rgba(245,158,11,0.02))';">
                        <div style="display: flex; align-items: flex-start; gap: var(--sp-lg);">
                            <div style="font-size: 1.5rem; color: var(--warning); flex-shrink: 0;">⏰</div>
                            <div>
                                <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm); color: var(--warning);">Giờ Làm Việc</h3>
                                <p style="color: var(--text-secondary); margin: 0;">Thứ Hai - Thứ Sáu: 8AM - 6PM</p>
                                <p style="color: var(--text-secondary); margin: var(--sp-sm) 0 0 0;">Thứ Bảy - Chủ Nhật: 10AM - 4PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div style="margin-top: var(--sp-2xl); padding-top: var(--sp-2xl); border-top: 1px solid rgba(255,255,255,0.1);">
                    <h3 style="font-size: var(--text-lg); font-weight: var(--fw-bold); margin-bottom: var(--sp-lg);">Theo Dõi Chúng Tôi</h3>
                    <div style="display: flex; gap: var(--sp-lg);">
                        <a href="#" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(59,130,246,0.1)); border: 1px solid rgba(59,130,246,0.3); display: flex; align-items: center; justify-content: center; text-decoration: none; color: #3b82f6; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(59,130,246,0.3), rgba(59,130,246,0.2))'; this.style.borderColor='rgba(59,130,246,0.5)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(59,130,246,0.2), rgba(59,130,246,0.1))'; this.style.borderColor='rgba(59,130,246,0.3)';">
                            f
                        </a>
                        <a href="#" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, rgba(29,185,84,0.2), rgba(29,185,84,0.1)); border: 1px solid rgba(29,185,84,0.3); display: flex; align-items: center; justify-content: center; text-decoration: none; color: #1db954; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(29,185,84,0.3), rgba(29,185,84,0.2))'; this.style.borderColor='rgba(29,185,84,0.5)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(29,185,84,0.2), rgba(29,185,84,0.1))'; this.style.borderColor='rgba(29,185,84,0.3)';">
                            🎵
                        </a>
                        <a href="#" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1)); border: 1px solid rgba(239,68,68,0.3); display: flex; align-items: center; justify-content: center; text-decoration: none; color: #ef4444; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(239,68,68,0.3), rgba(239,68,68,0.2))'; this.style.borderColor='rgba(239,68,68,0.5)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.1))'; this.style.borderColor='rgba(239,68,68,0.3)';">
                            ▶️
                        </a>
                        <a href="#" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, rgba(236,72,153,0.2), rgba(236,72,153,0.1)); border: 1px solid rgba(236,72,153,0.3); display: flex; align-items: center; justify-content: center; text-decoration: none; color: #ec4899; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(236,72,153,0.3), rgba(236,72,153,0.2))'; this.style.borderColor='rgba(236,72,153,0.5)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(236,72,153,0.2), rgba(236,72,153,0.1))'; this.style.borderColor='rgba(236,72,153,0.3)';">
                            📷
                        </a>
                    </div>
                </div>
            </div>

            <!-- RIGHT: CONTACT FORM -->
            <div>
                <div style="padding: var(--sp-2xl); background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg);">
                    <h2 style="font-size: var(--text-2xl); font-weight: var(--fw-bold); margin-bottom: var(--sp-xl);">Gửi Tin Nhắn</h2>
                    
                    <form method="POST" action="{{ route('contact.submit') }}" style="display: flex; flex-direction: column; gap: var(--sp-lg);">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" style="display: block; color: var(--text-primary); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm);">Tên của bạn <span style="color: var(--error);">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Nhập tên..." style="width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); font-family: var(--font-sans); transition: all 0.3s;" onfocus="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='rgba(0,212,255,0.1)';" onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.05)';">
                            @error('name')
                                <p style="color: var(--error); font-size: var(--text-sm); margin-top: var(--sp-sm); margin-bottom: 0;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" style="display: block; color: var(--text-primary); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm);">Email của bạn <span style="color: var(--error);">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="example@email.com" style="width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); font-family: var(--font-sans); transition: all 0.3s;" onfocus="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='rgba(0,212,255,0.1)';" onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.05)';">
                            @error('email')
                                <p style="color: var(--error); font-size: var(--text-sm); margin-top: var(--sp-sm); margin-bottom: 0;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" style="display: block; color: var(--text-primary); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm);">Số điện thoại <span style="color: var(--error);">*</span></label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="0901234567" style="width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); font-family: var(--font-sans); transition: all 0.3s;" onfocus="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='rgba(0,212,255,0.1)';" onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.05)';">
                            @error('phone')
                                <p style="color: var(--error); font-size: var(--text-sm); margin-top: var(--sp-sm); margin-bottom: 0;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" style="display: block; color: var(--text-primary); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm);">Tiêu đề <span style="color: var(--error);">*</span></label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required placeholder="Chủ đề liên hệ..." style="width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); font-family: var(--font-sans); transition: all 0.3s;" onfocus="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='rgba(0,212,255,0.1)';" onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.05)';">
                            @error('subject')
                                <p style="color: var(--error); font-size: var(--text-sm); margin-top: var(--sp-sm); margin-bottom: 0;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" style="display: block; color: var(--text-primary); font-weight: var(--fw-bold); margin-bottom: var(--sp-sm);">Tin nhắn <span style="color: var(--error);">*</span></label>
                            <textarea id="message" name="message" rows="5" required placeholder="Hãy cho chúng tôi biết..." style="width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--text-primary); font-family: var(--font-sans); transition: all 0.3s; resize: vertical;" onfocus="this.style.borderColor='rgba(0,212,255,0.4)'; this.style.background='rgba(0,212,255,0.1)';" onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.05)';">{{ old('message') }}</textarea>
                            @error('message')
                                <p style="color: var(--error); font-size: var(--text-sm); margin-top: var(--sp-sm); margin-bottom: 0;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" style="padding: 14px 32px; background: linear-gradient(135deg, var(--laser-blue), var(--laser-blue-dim)); color: var(--obsidian); border: none; border-radius: var(--radius-lg); font-weight: var(--fw-bold); font-size: var(--text-base); cursor: pointer; transition: all 0.3s; margin-top: var(--sp-lg); box-shadow: 0 10px 30px rgba(0, 212, 255, 0.25);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 40px rgba(0, 212, 255, 0.35)';" onmouseout="this.style.transform=''; this.style.boxShadow='0 10px 30px rgba(0, 212, 255, 0.25)';">
                            ✉️ Gửi Tin Nhắn
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- MAP SECTION (Optional) -->
    <section style="padding: var(--sp-3xl) var(--sp-xl); max-width: 1400px; margin: 0 auto;">
        <h2 style="font-size: var(--text-3xl); font-weight: var(--fw-bold); text-align: center; margin-bottom: var(--sp-xl);">Tìm Chúng Tôi</h2>
        <div style="width: 100%; height: 400px; background: linear-gradient(135deg, rgba(0,212,255,0.1), rgba(139,92,246,0.1)); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
            <div style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: var(--sp-lg);">📍</div>
                <p style="font-size: 1.1rem;">Bản đồ sẽ được thêm vào sớm!</p>
                <p style="color: var(--text-muted); margin-top: var(--sp-sm);">123 Đường Nguyễn Huệ, Quận 1, TP HCM</p>
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
</style>

@endsection
