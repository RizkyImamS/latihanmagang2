@extends('admin.layout')

@section('content')
<h2>Tambah Berita Baru</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="judul">Judul Berita</label>
            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug (URL Otomatis)</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" readonly>
            <small class="text-muted">Slug akan terisi otomatis saat Anda mengetik judul.</small>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Isi Berita</label>
            <textarea name="isi" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Berita</button>
        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');

    judul.addEventListener('keyup', function() {
        let preslug = judul.value;
        preslug = preslug.replace(/[^a-zA-Z0-9\s]/g, ""); // Hapus karakter spesial
        preslug = preslug.toLowerCase();
        preslug = preslug.replace(/\s+/g, '-'); // Ganti spasi dengan tanda hubung
        slug.value = preslug;
    });
</script>
@endsection