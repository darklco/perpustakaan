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
              <li>
              <form method="POST" action="{{ route('logout') }}" style="display: inline;">
              @csrf
              <button type="submit">Logout</button>
            </form>
          </li>
        </ul>
      </nav>

          <div class="home">
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
              <img src="/img/bk.jpg" alt="Gambar Kota">
              </div>
              <div class="tentang-text">
              <p>Perpustakaan bukan hanya tempat menyimpan buku, tapi adalah jendela menuju dunia yang lebih luas...</p>
            <button class="btn btn-primary">Lihat Buku</button>   
        </div>
      </div>
    </section>

          <section class="best-seller">
            <h2>Buku Best Seller</h2>
            <div class="carousel-container">
              <button class="carousel-btn left">&#10094;</button>
                <div class="carousel-track">
                  <div class="card"><img src="/images/cov1.jpg" alt="Buku 1"><p>Cursed By The Black Heart</p></div>
                      <div class="card"><img src="/images/cov2.jpg" alt="Buku 2"><p>Cursed By Gold</p></div>
                      <div class="card"><img src="/images/cov3.jpg" alt="Buku 3"><p>Cursed By Fate</p></div>
                      <div class="card"><img src="/images/cov4.jpg" alt="Buku 4"><p>The Phantom Prince</p></div>
                      <div class="card"><img src="/images/cov5.jpg" alt="Buku 5"><p>Cursed By Sirens Kiss</p></div>
                      <div class="card"><img src="/images/cov6.jpg" alt="Buku 6"><p>Cursed By Malignant Magic</p></div>
                      <div class="card"><img src="/images/cov7.jpg" alt="Buku 7"><p>Cursed By Darkness</p></div>
                  </div>
              <button class="carousel-btn right">&#10095;</button>
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

<script src="script1.js"></script>
  </body>
</html>
