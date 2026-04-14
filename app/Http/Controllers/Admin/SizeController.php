<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        $query = Size::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $query->orderBy('name', 'asc');
        $sizes = $query->paginate(20);

        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes',
            'is_active' => 'boolean',
        ]);

        Size::create($validated);

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Kích cỡ đã được thêm thành công!');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name,' . $size->id,
            'is_active' => 'boolean',
        ]);

        $size->update($validated);

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Kích cỡ đã được cập nhật!');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Kích cỡ đã được xóa!');
    }
}
