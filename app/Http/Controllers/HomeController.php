<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Gallery;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage).
     */
    public function index()
    {
        $menuItems = MenuItem::latest()->take(6)->get();
        $galleryItems = Gallery::latest()->take(6)->get();
        return view('restoran', compact('menuItems', 'galleryItems'));
    }

    /**
     * Menampilkan halaman menu dengan logika filter.
     */
    public function showMenuPage(Request $request)
    {
        // Membuat query dasar
        $query = MenuItem::query();

        // Menerapkan filter berdasarkan kategori jika ada di URL
        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        // Melakukan pagination dan menambahkan parameter filter ke link halaman
        $menuItems = $query->latest()->paginate(9)->appends($request->query());

        return view('menu', compact('menuItems'));
    }

    /**
     * Menampilkan halaman galeri.
     */
    public function showGalleryPage()
    {
        $galleryItems = Gallery::latest()->paginate(12);
        return view('galeri', compact('galleryItems'));
    }
}
