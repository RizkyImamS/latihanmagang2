<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Penting untuk slug
use Illuminate\Support\Facades\Storage; // Penting untuk hapus gambar

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori_berita')->latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::all();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori_id' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $input = $request->all();
        // Membuat slug otomatis dari judul
        $input['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $input['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($input);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambah');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = KategoriBerita::all();
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori_id' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $input = $request->all();
        // Update slug jika judul berubah
        $input['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage agar tidak memenuhi server
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $input['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($input);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus file gambar dari folder storage sebelum menghapus data di database
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus');
    }

    // --- MANAJEMEN KATEGORI ---

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

        // Cek apakah kategori ini masih digunakan oleh berita
        $cekBerita = Berita::where('kategori_id', $id)->count();
        if ($cekBerita > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki berita!');
        }

        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
