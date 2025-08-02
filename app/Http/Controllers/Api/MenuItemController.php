<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index()
    {
        $menus = MenuItem::all()->map(function ($menu) {
            $menu->image_url = asset('storage/images/' . $menu->image);
            return $menu;
        });

        return response()->json($menus);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $imageName = basename($imagePath);

        $menuItem = MenuItem::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'] ?? null,
            'price' => $validated['price'],
            'image' => $imageName,
        ]);

        return response()->json([
            'message' => 'Menu berhasil ditambahkan',
            'data' => $menuItem->makeHidden('image')->toArray() + [
                'image_url' => asset('storage/images/' . $imageName)
            ]
        ], 201);
    }

    public function show($id)
    {
        $menu = MenuItem::findOrFail($id);
        $menu->image_url = asset('storage/images/' . $menu->image);
        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image && Storage::exists('public/images/' . $menu->image)) {
                Storage::delete('public/images/' . $menu->image);
            }

            $imagePath = $request->file('image')->store('public/images');
            $validated['image'] = basename($imagePath);
        }

        $menu->update($validated);

        return response()->json([
            'message' => 'Menu berhasil diperbarui',
            'data' => $menu->makeHidden('image')->toArray() + [
                'image_url' => asset('storage/images/' . $menu->image)
            ]
        ]);
    }

    public function destroy($id)
    {
        $menu = MenuItem::findOrFail($id);

        if ($menu->image && Storage::exists('public/images/' . $menu->image)) {
            Storage::delete('public/images/' . $menu->image);
        }

        $menu->delete();

        return response()->json(['message' => 'Menu berhasil dihapus']);
    }
}
