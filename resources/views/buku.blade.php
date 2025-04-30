@extends('layout.buku')

@section('content')
<div class="container py-5">

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Filter Kategori dan Pencarian --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="kategori-sidebar d-flex flex-wrap gap-2">
            <a href="#" class="btn btn-outline-secondary btn-sm active">Semua</a>
            <a href="#" class="btn btn-outline-secondary btn-sm">Novel</a>
            <a href="#" class="btn btn-outline-secondary btn-sm">Ilmiah</a>
            <a href="#" class="btn btn-outline-secondary btn-sm">Komik</a>
            <a href="#" class="btn btn-outline-secondary btn-sm">Biografi</a>
        </div>
        <form action="#" method="GET" class="d-flex mt-2 mt-md-0">
            <input type="text" name="query" class="form-control me-2" placeholder="Cari judul buku..." />
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    {{-- Daftar Buku --}}
    <h1 class="mb-4 text-center">Daftar Buku</h1>
    
    <div id="book-container">
    </div>
    <div class="container-fluid">
        <div class="book-grid">
            @forelse ($books as $book)
                <div class="book-card px-2">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($book->foto)
                            <img src="{{ asset('storage/' . $book->foto) }}" class="card-img-top" alt="{{ $book->judul }}">
                        @else
                            <img src="{{ asset('images/default-book.png') }}" class="card-img-top" alt="Default Buku">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->judul }}</h5>
                            <p class="card-text text-muted mb-1">{{ $book->penulis }}</p>
                            <p class="card-text"><small class="badge bg-secondary">{{ $book->kategori }}</small></p>

                            <div class="mt-auto">
                                <a href="{{ route('showbuku', $book->id) }}" class="btn btn-info btn-sm w-100 mb-2">Lihat Detail</a>
                                <a href="{{ route('peminjaman.form', $book->id) }}" class="btn btn-success btn-sm w-100">Pinjam Buku Ini</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Tidak ada buku yang tersedia saat ini.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Daftar Peminjaman --}}
    <hr class="my-5">
    <h2 class="mb-4 text-center">Daftar Buku yang Dipinjam</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $peminjaman)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peminjaman->book->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->jatuh_tempo)->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('peminjaman.kembalikan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $peminjaman->id }}">
                                <button type="submit" class="btn btn-warning btn-sm">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada buku yang dipinjam.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
