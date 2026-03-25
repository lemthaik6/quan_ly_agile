@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Sản Phẩm')
@section('page-title', 'Chỉnh Sửa Sản Phẩm')
@section('page-subtitle', 'Cập nhật thông tin sản phẩm')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: var(--sp-2xl);">
        @csrf
        @method('PUT')

        <!-- Basic Information Section -->
        <div class="panel" style="padding: var(--sp-xl);">
            <h3 style="margin: 0 0 var(--sp-xl) 0; font-size: 16px; font-weight: 600;">Thông Tin Cơ Bản</h3>

            <div style="display: flex; flex-direction: column; gap: var(--sp-lg);">
                <div>
                    <label for="name">Tên Sản Phẩm <span style="color: var(--error);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required placeholder="Nhập tên sản phẩm...">
                    @error('name')
                        <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description">Mô Tả</label>
                    <textarea id="description" name="description" rows="4" placeholder="Mô tả chi tiết sản phẩm...">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--sp-lg);">
                    <div>
                        <label for="category_id">Danh Mục <span style="color: var(--error);">*</span></label>
                        <select id="category_id" name="category_id" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit">Đơn Vị Tính</label>
                        <input type="text" id="unit" name="unit" value="{{ old('unit', $product->unit ?? 'cái') }}" placeholder="cái, bộ, hộp...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing & Inventory -->
        <div class="panel" style="padding: var(--sp-xl);">
            <h3 style="margin: 0 0 var(--sp-xl) 0; font-size: 16px; font-weight: 600;">Giá & Tồn Kho</h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--sp-lg);">
                <div>
                    <label for="price">Giá Bán <span style="color: var(--error);">*</span></label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" required placeholder="0">
                    @error('price')
                        <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cost_price">Giá Vốn</label>
                    <input type="number" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" step="0.01" placeholder="0">
                    @error('cost_price')
                        <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="quantity_in_stock">Tồn Kho <span style="color: var(--error);">*</span></label>
                    <input type="number" id="quantity_in_stock" name="quantity_in_stock" value="{{ old('quantity_in_stock', $product->quantity_in_stock) }}" required placeholder="0">
                    @error('quantity_in_stock')
                        <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Image & Media -->
        <div class="panel" style="padding: var(--sp-xl);">
            <h3 style="margin: 0 0 var(--sp-xl) 0; font-size: 16px; font-weight: 600;">Hình Ảnh</h3>

            @if($product->image)
                <div style="margin-bottom: var(--sp-xl);">
                    <p style="margin: 0 0 var(--sp-md) 0; font-size: 12px; font-weight: 600; color: var(--text-muted);">HÌNH ẢNH HIỆN TẠI</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; border-radius: var(--radius-lg); border: var(--border-light);">
                </div>
            @endif

            <div>
                <label for="image">Thay Đổi Hình Ảnh</label>
                <div style="border: 2px dashed var(--border-glow); border-radius: var(--radius-lg); padding: var(--sp-2xl); text-align: center; cursor: pointer; transition: all 0.3s; background: linear-gradient(135deg, rgba(0,212,255,0.05), rgba(0,212,255,0.02));">
                    <input type="file" id="image" name="image" accept="image/*" style="display: none;" onchange="previewImage(event)">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 32px; color: var(--laser-blue); margin-bottom: var(--sp-md); display: block;"></i>
                    <p style="margin: 0 0 var(--sp-sm) 0; font-weight: 600;">Click để chọn hoặc kéo thả</p>
                    <p style="margin: 0; font-size: 12px; color: var(--text-muted);">JPG, PNG, WebP - Tối đa 10MB</p>
                </div>
                <div id="image-preview" style="margin-top: var(--sp-lg); display: none;">
                    <img id="preview-img" src="" alt="Preview" style="max-width: 200px; border-radius: var(--radius-lg); border: var(--border-light);">
                </div>
                @error('image')
                    <p style="color: var(--error); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Settings -->
        <div class="panel" style="padding: var(--sp-xl);">
            <h3 style="margin: 0 0 var(--sp-xl) 0; font-size: 16px; font-weight: 600;">Cấu Hình</h3>

            <div style="display: flex; flex-direction: column; gap: var(--sp-lg);">
                <label style="display: flex; align-items: center; gap: var(--sp-lg); cursor: pointer; padding: var(--sp-lg); background: linear-gradient(90deg, rgba(0,212,255,0.05), transparent); border-radius: var(--radius-md); border: var(--border-thin); transition: all 0.3s;">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    <div>
                        <p style="margin: 0; font-weight: 600; color: var(--text-primary);">Sản Phẩm Hoạt Động</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: var(--text-muted);">Sản phẩm sẽ hiển thị trên cửa hàng</p>
                    </div>
                </label>

                <label style="display: flex; align-items: center; gap: var(--sp-lg); cursor: pointer; padding: var(--sp-lg); background: linear-gradient(90deg, rgba(139,92,246,0.05), transparent); border-radius: var(--radius-md); border: var(--border-thin); transition: all 0.3s;">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                    <div>
                        <p style="margin: 0; font-weight: 600; color: var(--text-primary);">Sản Phẩm Nổi Bật</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: var(--text-muted);">Xuất hiện trong trang chủ và danh sách nổi bật</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="panel" style="padding: var(--sp-xl); background: rgba(239,68,68,0.05); border-color: rgba(239,68,68,0.2);">
            <h3 style="margin: 0 0 var(--sp-xl) 0; font-size: 16px; font-weight: 600; color: var(--error);">Danger Zone</h3>

            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này? Hành động không thể hoàn tác.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    <span>Xóa Sản Phẩm</span>
                </button>
            </form>
        </div>

        <!-- Actions -->
        <div style="display: flex; gap: var(--sp-lg); justify-content: flex-end;">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                <span>Hủy</span>
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                <span>Cập Nhật</span>
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    // Drag & drop
    const dropZone = document.querySelector('[style*="border: 2px dashed"]');
    if (dropZone) {
        dropZone.addEventListener('click', () => document.getElementById('image').click());
        dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = 'var(--laser-blue)'; });
        dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(0,212,255,0.2)'; });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            document.getElementById('image').files = e.dataTransfer.files;
            previewImage({ target: { files: e.dataTransfer.files } });
        });
    }
</script>
@endsection
