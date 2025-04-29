@extends('layout.buku') <!-- asumsi kamu pakai layout yang sama -->

@section('content')
<div class="container mt-4">

    <h2>Form Peminjaman Buku</h2>

    <!-- Tampilkan error atau success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Peminjaman -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('peminjaman.pinjam') }}" method="POST">
                @csrf

                <input type="hidden" name="id_buku" value="{{ $buku->id }}">

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul" value="{{ $buku->judul }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok Tersedia</label>
                    <input type="text" class="form-control" id="stok" value="{{ $buku->stok }}" disabled>
                </div>

                <button type="submit" class="btn btn-primary" {{ $buku->stok < 1 ? 'disabled' : '' }}>
                    Pinjam Buku
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
