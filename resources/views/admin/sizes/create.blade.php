@extends('layouts.admin')

@section('title', 'Thêm Size')
@section('page-title', 'Thêm Kích Cỡ')
@section('page-subtitle', 'Tạo kích cỡ có thể chọn khi thêm sản phẩm')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <form method="POST" action="{{ route('admin.sizes.store') }}" style="display: flex; flex-direction: column; gap: var(--sp-2xl);">
        @csrf

        <div class="panel" style="padding: var(--sp-xl);">
            <div style="display: flex; flex-direction: column; gap: var(--sp-lg);">
                <div>
                    <label for="name">Tên size <span style="color: var(--error);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ví dụ: M">
                    @error('name')<p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>@enderror
                </div>

                <label style="display: flex; align-items: center; gap: var(--sp-lg); cursor: pointer; padding: var(--sp-lg); background: linear-gradient(90deg, rgba(0,212,255,0.05), transparent); border-radius: var(--radius-md); border: var(--border-thin);">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    <div>
                        <p style="margin: 0; font-weight: 600; color: var(--text-primary);">Size hoạt động</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: var(--text-muted);">Kích cỡ sẽ hiển thị khi chọn biến thể sản phẩm</p>
                    </div>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: var(--sp-lg); justify-content: flex-end;">
            <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> <span>Hủy</span></a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> <span>Thêm Size</span></button>
        </div>
    </form>
</div>
@endsection
