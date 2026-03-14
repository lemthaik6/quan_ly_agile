@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Danh Mục')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Chỉnh Sửa Danh Mục</h1>
    
    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold mb-2">Tên danh mục</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold mb-2">Mô tả</label>
            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="is_active" class="block text-sm font-semibold mb-2">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="mr-2">
                Hoạt động
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cập nhật</button>
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Hủy</a>
        </div>
    </form>
</div>
@endsection
