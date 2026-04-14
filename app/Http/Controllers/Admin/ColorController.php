<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $query = Color::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $query->orderBy('name', 'asc');
        $colors = $query->paginate(20);

        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors',
            'hex_code' => 'required|string|max:7',
            'is_active' => 'boolean',
        ]);

        Color::create($validated);

        return redirect()->route('admin.colors.index')
            ->with('success', 'Màu đã được thêm thành công!');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors,name,' . $color->id,
            'hex_code' => 'required|string|max:7',
            'is_active' => 'boolean',
        ]);

        $color->update($validated);

        return redirect()->route('admin.colors.index')
            ->with('success', 'Màu đã được cập nhật!');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('admin.colors.index')
            ->with('success', 'Màu đã được xóa!');
    }
}
