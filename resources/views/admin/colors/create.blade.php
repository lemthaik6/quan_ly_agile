@extends('layouts.admin')

@section('title', 'Thêm Màu')
@section('page-title', 'Thêm Màu Sắc')
@section('page-subtitle', 'Tạo màu có thể chọn khi thêm sản phẩm')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <form method="POST" action="{{ route('admin.colors.store') }}" style="display: flex; flex-direction: column; gap: var(--sp-2xl);">
        @csrf

        <div class="panel" style="padding: var(--sp-xl);">
            <div style="display: flex; flex-direction: column; gap: var(--sp-lg);">
                <div>
                    <label for="name">Tên màu <span style="color: var(--error);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ví dụ: Trắng">
                    @error('name')<p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="hex_code">Mã HEX <span style="color: var(--error);">*</span></label>
                    <input type="text" id="hex_code" name="hex_code" value="{{ old('hex_code', '#000000') }}" required placeholder="#000000">
                    @error('hex_code')<p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>@enderror
                </div>

                <label style="display: flex; align-items: center; gap: var(--sp-lg); cursor: pointer; padding: var(--sp-lg); background: linear-gradient(90deg, rgba(0,212,255,0.05), transparent); border-radius: var(--radius-md); border: var(--border-thin);">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    <div>
                        <p style="margin: 0; font-weight: 600; color: var(--text-primary);">Màu hoạt động</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: var(--text-muted);">Màu sẽ hiển thị khi chọn biến thể sản phẩm</p>
                    </div>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: var(--sp-lg); justify-content: flex-end;">
            <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> <span>Hủy</span></a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> <span>Thêm Màu</span></button>
        </div>
    </form>
</div>
@endsection
