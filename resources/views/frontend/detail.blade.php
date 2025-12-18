@extends('frontend.layout')

@section('content')
<style>
    .article-header {
        padding: 40px 0;
        background: #fff;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #4e73df;
    }

    .entry-content {
        font-size: 1.15rem;
        color: #333;
        line-height: 1.8;
        text-align: justify;
    }

    /* Membuat huruf pertama lebih besar (Dropcap) */
    .entry-content::first-letter {
        font-size: 3.5rem;
        font-weight: bold;
        float: left;
        margin-right: 10px;
        line-height: 1;
        color: #4e73df;
    }

    .meta-info {
        display: flex;
        align-items: center;
        gap: 15px;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 15px 0;
        margin: 25px 0;
    }

    .author-badge {
        width: 45px;
        height: 45px;
        background: #4e73df;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: bold;
    }

    .share-buttons {
        margin-top: 40px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }
</style>

<div class="article-header shadow-sm mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold text-dark mb-3">{{ $berita->judul }}</h1>
                <span class="badge bg-primary px-3 py-2 rounded-pill">{{ $berita->kategori_berita->nama_kategori ?? 'Umum' }}</span>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-9">

            @if($berita->gambar)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/'.$berita->gambar) }}" class="img-fluid rounded shadow-lg" style="width: 100%; max-height: 500px; object-fit: cover;">
                <p class="text-muted small mt-2"><i class="fas fa-camera"></i> Ilustrasi: {{ $berita->judul }}</p>
            </div>
            @endif

            <div class="meta-info text-muted">
                <div class="author-badge">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <small class="d-block">Ditulis oleh:</small>
                    <strong class="text-dark">Administrator</strong>
                </div>
                <div class="ms-auto text-end">
                    <small class="d-block">Diterbitkan pada:</small>
                    <strong class="text-dark">{{ $berita->created_at->format('d F Y') }}</strong>
                </div>
            </div>

            <div class="entry-content mb-5">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            <div class="share-buttons text-center">
                <p class="fw-bold mb-3">Bagikan Berita Ini:</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="#" class="btn btn-primary rounded-circle"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-info text-white rounded-circle"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-success rounded-circle"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top">
                <a href="{{ url('/') }}" class="btn btn-outline-primary px-4 py-2" style="border-radius: 25px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</div>
@endsection