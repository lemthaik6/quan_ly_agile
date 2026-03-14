@extends('layouts.admin')

@section('title', 'Thêm Sản Phẩm Mới')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Thêm Sản Phẩm Mới</h1>
    
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold mb-2">Tên sản phẩm *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold mb-2">Mô tả</label>
            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="price" class="block text-sm font-semibold mb-2">Giá bán *</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('price')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cost" class="block text-sm font-semibold mb-2">Giá vốn</label>
                <input type="number" id="cost" name="cost" value="{{ old('cost') }}" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('cost')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="stock" class="block text-sm font-semibold mb-2">Tồn kho *</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('stock')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-semibold mb-2">Danh mục *</label>
                <select id="category_id" name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-semibold mb-2">Hình ảnh</label>
            <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="is_active" class="block text-sm font-semibold mb-2">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                Sản phẩm hoạt động
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Tạo sản phẩm</button>
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Hủy</a>
        </div>
    </form>
</div>
@endsection
