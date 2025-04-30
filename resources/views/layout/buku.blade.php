<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Buku</title>
    <link href="{{ asset('css/bukuu.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-dark" href="#">Librio</a>

        <!-- Tombol Hamburgernya -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbarnya -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#tentang">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#footer">Kontak</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link text-dark p-0">Logout</button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</nav>


<!-- Konten -->
<div class="container mt-4">
    
    <!-- Tombol Kembali -->
    <div class="mb-3">
        <a href="javascript:history.back()" class="btn btn-secondary">&larr; Kembali</a>
    </div>

    @yield('content')

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
