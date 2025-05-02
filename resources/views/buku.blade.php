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

    {{-- Filter Kategori dan Pencarian --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="kategori-sidebar d-flex flex-wrap gap-2">
            <a href="{{ route('buku') }}" class="btn btn-outline-secondary btn-sm {{ request()->routeIs('buku.index') ? 'active' : '' }}">Semua</a>
            <a href="{{ route('buku.kategori', ['kategori' => 'Novel']) }}" class="btn btn-outline-secondary btn-sm {{ request()->kategori == 'Novel' ? 'active' : '' }}">Novel</a>
            <a href="{{ route('buku.kategori', ['kategori' => 'Ilmiah']) }}" class="btn btn-outline-secondary btn-sm {{ request()->kategori == 'Ilmiah' ? 'active' : '' }}">Ilmiah</a>
            <a href="{{ route('buku.kategori', ['kategori' => 'Komik']) }}" class="btn btn-outline-secondary btn-sm {{ request()->kategori == 'Komik' ? 'active' : '' }}">Komik</a>
            <a href="{{ route('buku.kategori', ['kategori' => 'Biografi']) }}" class="btn btn-outline-secondary btn-sm {{ request()->kategori == 'Biografi' ? 'active' : '' }}">Biografi</a>
        </div>

        <form action="{{ route('search.user') }}" method="GET" class="d-flex mt-2 mt-md-0">
            <input type="text" name="query" value="{{ request('query') }}" class="form-control me-2" placeholder="Cari judul buku..." />
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <div id="book-list" class="container-fluid">
    <div class="book-grid row gx-4 gy-4" id="book-container">
        @foreach ($books as $book)
            <div class="book-card px-2 col-md-3 mb-4">
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
        @endforeach
    </div>

    <div id="scroll-trigger"></div>

    <div id="loader" class="text-center my-3" style="display: none;">
        <div class="spinner-border text-secondary" role="status"></div>
    </div>
</div>


{{-- Infinite Scroll Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let page = 1;
let loading = false; 

$(window).scroll(function () { 
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        if (!loading) {
            loading = true;
            page++;
            $('#loader').show();
            $.ajax({
                url: '/load-more-books?page=' + page,  
                type: 'GET',
                success: function (data) {
                    $('#book-list').append(data);
                    $('#loader').hide();
                    loading = false;
                },
                error: function () {
                    $('#loader').hide();
                    loading = false;
                }
            });
        }
    }
});

</script>
@endsection