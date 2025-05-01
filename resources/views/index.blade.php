<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Perpustakaan Librio</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  </head>
  <body>

    <nav>
      <div class="logo">Librio</div>
      <div class="menu-toggle" id="menu-toggle">
        <span></span><span></span><span></span>
      </div>
      <ul class="nav-links" id="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#tentang">Tentang Kami</a></li>
        <li><a href="#footer">Kontak</a></li>
        <li><a href="{{ route('account') }}" class="text-blue-600 hover:underline">Akun Saya</a>

          </form>
        </li>
      </ul>
    </nav>

    <div class="home" id="home">
      <div class="image"></div>
      <div class="content">
        <div>
          <h1>Welcome To Librio</h1>
          <p>Kami hadir untuk menemani perjalanan belajar dan membukakan jendela dunia lewat setiap halaman buku.</p>
        </div>
      </div>
    </div>

    <section class="tentang" id="tentang">
      <h2>Tentang Kami</h2>
      <div class="tentang-content">
        <div class="gambar-kecil">
          <img src="{{ asset('/images/bk.jpg') }}" alt="Gambar Kota">
        </div>
        <div class="tentang-text">
          <p>Perpustakaan bukan hanya tempat menyimpan buku, tapi adalah jendela menuju dunia yang lebih luas...</p>
          <form action="{{ route('buku') }}" method="GET" style="display: inline;">
            <button type="submit" class="btn btn-primary">Lihat Buku</button>
          </form>   
        </div>
      </div>
    </section>

    <section class="best-seller">
      <h2>Buku Best Seller</h2>
      <div class="carousel-track">
        @foreach($bestSellers as $book)
          <div class="card">
            <img src="{{ asset('storage/' . $book->foto) }}" alt="{{ $book->judul }}">
            <p>{{ $book->judul }}</p>
            <div class="card-buttons">
              <a href="{{ route('books.show', $book->id) }}" class="btn-info">Info</a>
              <a href="{{ route('peminjaman.form', $book->id) }}" class="btn-pinjam">Pinjam</a>
            </div>
          </div>
        @endforeach
      </div>
      
    </section>

    <footer id="footer" class="footer">
      <div class="footer-content">
        <p>"Membaca adalah jendela dunia." 🌍📖</p>
        <div class="footer-icons">
          <span><i class="fa-brands fa-instagram"></i> Perpusofficial</span>
          <span><i class="fa fa-phone"></i> +62987654321</span>
          <span><i class="fa fa-envelope"></i> Perpustakaan@indo.com</span>
        </div>
      </div>
    </footer>

    <script>
      const menuToggle = document.querySelector('.menu-toggle');
      const navLinks = document.querySelector('.nav-links');
      menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
      });
    </script>

    <script src="{{ asset('js/script1.js') }}"></script>
  </body>
</html>
