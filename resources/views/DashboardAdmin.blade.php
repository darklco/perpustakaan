<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/da.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="sidebar">
        <img src="{{ asset('img/bk.jpg') }}" alt="Admin Profile" class="profile-img">
        <h2>Admin</h2>
        <ul>
            <li><a href="#" onclick="showContent('admin')"><i class="fas fa-home"></i> Admin</a></li>
            <li><a href="#" onclick="showContent('tambah')"><i class="fas fa-plus-circle"></i> Tambah Buku</a></li>
            <li><a href="#" onclick="showContent('riwayat')"><i class="fas fa-history"></i> Riwayat Peminjaman</a></li>
            <li><a href="#" onclick="showContent('hapus')"><i class="fas fa-trash-alt"></i> Kelola Buku</a></li>
        </ul>
    </div>

    <div class="main-content">
        <!-- Halaman Welcome -->
        <div id="admin" class="content-section">
            <h1>Welcome to Admin Librio</h1>
            <p>Pilihan menu di sebelah kiri.</p>
        </div>

        <!-- Halaman Tambah Buku -->
        <div id="tambah" class="content-section" style="display: none;">
            <h2>Tambah Buku</h2>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label>Category</label>
                  <select name="category_id" id="category" class="form-control">
                    @foreach ($categories as $c)
                      <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                  </select>
              </div>
                <div class="mb-3">
                    <label>Foto Buku</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Tambah Buku</button>
            </form>
        </div>

        <!-- Halaman Riwayat Peminjaman -->
        <div id="riwayat" class="content-section" style="display: none;">
            <h2>Riwayat Peminjaman</h2>
            <p>Belum ada data peminjaman.</p>
        </div>

        <!-- Halaman Kelola Buku -->
        <div id="hapus" class="content-section" style="display: none;">
            <h2>Kelola Buku</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>
                            @if ($book->foto)
                                <img src="{{ asset('storage/' . $book->foto) }}" width="60" alt="Foto Buku">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                        <td>{{ $book->judul }}</td>
                        <td>{{ $book->penulis }}</td>
                        <td>{{ $book->penerbit }}</td>
                        <td>{{ $book->tahun_terbit }}</td>
                        <td>{{ $book->stok }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
