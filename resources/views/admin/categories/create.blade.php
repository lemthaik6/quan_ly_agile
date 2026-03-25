@extends('layouts.admin')

@section('title', 'Thêm Danh Mục')
@section('page-title', 'Thêm Danh Mục Mới')
@section('page-subtitle', 'Tạo danh mục cho sản phẩm')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <form method="POST" action="{{ route('admin.categories.store') }}" style="display: flex; flex-direction: column; gap: var(--sp-2xl);">
        @csrf

        <div class="panel" style="padding: var(--sp-xl);">
            <div style="display: flex; flex-direction: column; gap: var(--sp-lg);">
                <div>
                    <label for="name">Tên Danh Mục <span style="color: var(--error);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Nhập tên danh mục...">
                    @error('name')
                        <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description">Mô Tả</label>
                    <textarea id="description" name="description" rows="4" placeholder="Mô tả danh mục...">{{ old('description') }}</textarea>
                    @error('description')
                        <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <label style="display: flex; align-items: center; gap: var(--sp-lg); cursor: pointer; padding: var(--sp-lg); background: linear-gradient(90deg, rgba(0,212,255,0.05), transparent); border-radius: var(--radius-md); border: var(--border-thin); transition: all 0.3s;">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    <div>
                        <p style="margin: 0; font-weight: 600; color: var(--text-primary);">Danh Mục Hoạt Động</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: var(--text-muted);">Danh mục sẽ hiển thị trên cửa hàng</p>
                    </div>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: var(--sp-lg); justify-content: flex-end;">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                <span>Hủy</span>
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i>
                <span>Tạo Danh Mục</span>
            </button>
        </div>
    </form>
</div>
@endsection
