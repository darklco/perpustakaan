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

    {{-- Daftar Buku --}}
    <h1 class="mb-4 text-center">Daftar Buku</h1>

    <div class="row">
        @forelse ($books as $book)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if ($book->foto)
                        <img src="{{ asset('storage/' . $book->foto) }}" class="card-img-top" alt="{{ $book->judul }}" style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-book.png') }}" class="card-img-top" alt="Default Buku" style="height: 250px; object-fit: cover;">
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
