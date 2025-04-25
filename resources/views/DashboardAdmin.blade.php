<!DOCTYPE html>
  <html lang="en">
    <head>
     <meta charset="UTF-8">
      <title>Dashboard Admin</title>
        <link rel="stylesheet" href="{{ asset('css/da.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
<body>

        <div class="container">
          <!-- Sidebarnya -->
          <div class="sidebar">
            <img src="images/bk.jpg" alt="Admin Profile" class="profile-img">
              <h2>Admin</h2>
                  <ul>
                   <li><a href="#" onclick="showContent('admin')"><i class="fas fa-home"></i> Admin</a></li>
                    <li><a href="#" onclick="showContent('tambah')"><i class="fas fa-plus-circle"></i> Tambah Buku</a></li>
                    <li><a href="#" onclick="showContent('riwayat')"><i class="fas fa-history"></i> Riwayat Peminjaman</a></li>
                    <li><a href="#" onclick="showContent('hapus')"><i class="fas fa-trash-alt"></i> Kelola Buku</a></li>
                  </ul>
          </div>

          <div class="main-content">
            <div id="admin" class="content-section">
              <h1>Welcome to Admin Librio</h1>
                <p>Pilihan menu di sebelah kiri.</p>
                </div>

              <div id="tambah" class="content-section" style="display: none;">
                <h2>Tambah Buku</h2>
                  @include('tambahbuku')
              </div>

              <div id="riwayat" class="content-section" style="display: none;">
              <h2>Riwayat Peminjaman</h2>
                <p>Ganti seperti di tambah buku</p>
              </div>

                <div id="hapus" class="content-section" style="display: none;">
                <h2>Kelola Buku</h2>
                  <p>Ganti seperti di tambah buku</p>
              </div>
          </div>


      <script>
          function showContent(sectionId) {
              const sections = document.querySelectorAll('.content-section');
              sections.forEach(sec => sec.style.display = 'none');
  
              const activeSection = document.getElementById(sectionId);
              activeSection.style.display = 'block';
              }
      </script>

    </body>
</html>
