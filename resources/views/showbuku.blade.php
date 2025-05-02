@extends('layout.buku') {{-- pastikan kamu punya layouts.app, atau ganti sesuai layout-mu --}}

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h3>Detail Buku</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @if($book->foto)
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('storage/' . $book->foto) }}" alt="Foto Buku" class="img-fluid rounded">
                    </div>
                @endif
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th>Judul</th>
                            <td>{{ $book->judul }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>{{ $book->penulis }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $book->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $book->tahun_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $book->stok }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $book->category->nama ?? '-' }}</td>
                        </tr>
                    </table>
                    {{-- <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Kembali</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
