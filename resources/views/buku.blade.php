@extends('layout.buku')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Daftar Buku</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

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
                            <a href="{{ route('showbuku', $book->id) }}" class="btn btn-info btn-sm w-100 mb-2">Lihat</a>
                            
                            @csrf
                            <a href="{{ route('peminjaman.form', $book->id) }}" class="btn btn-success">
                                Pinjam Buku Ini
                            </a>
                                
                            </form>
                            
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
@endsection
