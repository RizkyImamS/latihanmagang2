<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Konfigurasi;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->take(3)->get(); // Ambil 3 berita terbaru
        $config = Konfigurasi::first();
        return view('frontend.beranda', compact('berita', 'config'));
    }

    public function detail($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('frontend.detail', compact('berita'));
    }
}
