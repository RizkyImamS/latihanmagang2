<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = KategoriBerita::latest()->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_beritas,nama_kategori'
        ]);

        KategoriBerita::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function kategori()
    {
        $kategori = KategoriBerita::latest()->get();
        return view('admin.berita.kategori', compact('kategori'));
    }

    public function kategori_store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_beritas,nama_kategori'
        ]);

        KategoriBerita::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function kategori_destroy($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
