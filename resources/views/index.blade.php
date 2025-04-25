<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Perpustakaan</title>
          <link rel="stylesheet" href="{{ asset('css/index.css') }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
      </head>
    <body>

        <nav>
            <div class="logo">Perpustakaan</div>
              <div class="menu-toggle" id="menu-toggle">
              <span></span><span></span><span></span>
          </div>
              <ul class="nav-links" id="nav-links">
              <li><a href="#home">Home</a></li>
              <li><a href="#tentang">Tentang Kami</a></li>
              <li><a href="#footer">Kontak</a></li>
              <li>
          <form method="POST" action="{{ route('logout') }}" style="display: inline;">
          @csrf
          <button type="submit">Logout</button>
          </form>
          </li>
        </ul>
      </nav>

          <section id="home" class="home">
          <div>
            <h1>Welcome To Perpustakaan</h1>
            <p>Kami hadir untuk menemani perjalanan belajar dan membukakan jendela dunia lewat setiap halaman buku.</p>
          </div>
          </section>

          <section class="tentang" id="tentang">
            <h2>Tentang Kami</h2>
            <div class="tentang-content">
            <div class="gambar-kecil">
            <img src="/images/bk.jpg" alt="Gambar Kota">
            </div>
          <div class="tentang-text">
            <p>Perpustakaan bukan hanya tempat menyimpan buku, tapi adalah jendela menuju dunia yang lebih luas...</p>
            <a href="{{ route('buku') }}">
          <button class="btn btn-primary">Lihat Buku</button>
        </a>
      </div>
    </div>
  </section>


          <!-- Untuk Footernya -->
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
  </body>
</html>
