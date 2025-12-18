@extends('admin.layout')

@section('content')
<h2>Edit Berita</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul Berita</label>
            <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}" {{ $berita->kategori_id == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Isi Berita</label>
            <textarea name="isi" class="form-control" rows="8" required>{{ $berita->isi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar (Biarkan kosong jika tidak diganti)</label>
            <br>
            @if($berita->gambar)
            <img src="{{ asset('storage/'.$berita->gambar) }}" width="150" class="mb-2 rounded">
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Berita</button>
        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection