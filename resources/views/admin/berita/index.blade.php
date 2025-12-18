@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Berita</h2>
    <a href="{{ route('berita.create') }}" class="btn btn-primary">Tambah Berita</a>
</div>

<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($berita as $no => $item)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td>
                @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" width="80">
                @else
                <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->kategori_berita->nama_kategori ?? 'Tanpa Kategori' }}</td>
            <td>
                <div class="d-flex gap-1">
                    <a href="{{ route('berita.edit', $item->id) }}" class="btn btn-sm btn-warning text-white mr-2">Edit</a>

                    <form action="{{ route('berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection