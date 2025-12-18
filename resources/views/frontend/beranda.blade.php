@extends('frontend.layout')

@section('content')
<style>
    /* Custom Styling */
    .hero-section {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        padding: 100px 0;
        color: white;
        margin-bottom: 50px;
        clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
    }

    .card-news {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-news:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .card-news img {
        height: 220px;
        object-fit: cover;
    }

    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-read {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .news-title {
        height: 55px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
</style>

<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Portal Warta Magang</h1>
        <p class="lead opacity-75 mb-0">Temukan berita terkini seputar teknologi, edukasi, dan update kegiatan magang hari ini.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold border-start border-primary border-4 ps-3">Berita Terbaru</h3>
        <hr class="flex-grow-1 ms-3 d-none d-md-block opacity-25">
    </div>

    <div class="row">
        @forelse($berita as $item)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm card-news">
                <span class="badge bg-white text-primary category-badge">
                    {{ $item->kategori_berita->nama_kategori ?? 'Umum' }}
                </span>

                @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                @else
                <img src="https://images.unsplash.com/photo-1504711432869-efd5971ee142?q=80&w=1000&auto=format&fit=crop" class="card-img-top">
                @endif

                <div class="card-body p-4">
                    <div class="text-muted small mb-2">
                        <i class="far fa-calendar-alt me-1"></i> {{ $item->created_at->format('d M Y') }}
                    </div>
                    <h5 class="card-title fw-bold news-title">{{ $item->judul }}</h5>
                    <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($item->isi), 90) }}</p>

                    <div class="d-grid">
                        <a href="{{ url('/berita/'.$item->slug) }}" class="btn btn-outline-primary btn-read">
                            Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/gray/no-messages.svg" alt="Empty" style="width: 200px" class="mb-4">
            <h4 class="text-muted">Oops! Belum ada berita saat ini.</h4>
        </div>
        @endforelse
    </div>
</div>
@endsection