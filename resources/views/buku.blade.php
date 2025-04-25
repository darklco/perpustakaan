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

            <div class="burger" id="burger">
            <span></span>
            <span></span>
            <span></span>
            </div>

            <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row min-vh-100">
        
        <!-- Sidebarnya -->
        <div class="sidebar p-3">
            <h4 class="libro-title">Libro</h4>
            <h5>Kategori Buku</h5>
            <ul id="kategoriList" class="list-unstyled">
                <li><a href="#" data-kategori="Semua">Semua</a></li>
                <li><a href="#" data-kategori="Novel">Novel</a></li>
                <li><a href="#" data-kategori="Ilmiah">Ilmiah</a></li>
                <li><a href="#" data-kategori="Komik">Komik</a></li>
                <li><a href="#" data-kategori="Biografi">Biografi</a></li>
                <li><a href="#" data-kategori="Fiksi">Fiksi</a></li>
            </ul>
        </div>

                <div class="content flex-fill p-3">
             @yield('content')
            </div>
        </div>
    </div>

        <!-- Scriptnya -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        const burger = document.getElementById('burger');
        const sidebar = document.querySelector('.sidebar');

        burger.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        });
        </script>

     </body>
</html>
