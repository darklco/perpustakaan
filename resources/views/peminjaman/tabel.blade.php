<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku yang Dipinjam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container">
    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <h1 class="text-center mb-4">Daftar Buku yang Dipinjam</h1>
    
    <div class="mb-3">
        <a href="{{ route('buku') }}" class="btn btn-secondary">← Kembali ke Daftar Buku</a>
    </div>

    <!-- Wrapper for responsive table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $index => $peminjaman)
                    @if($peminjaman->status === 'dipinjam')
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $peminjaman->book->judul ?? '-' }}</td>
                            <td>
                                {{ $peminjaman->tanggal_pinjam ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') : '-' }}
                            </td>
                            <td>
                                {{ $peminjaman->jatuh_tempo ? \Carbon\Carbon::parse($peminjaman->jatuh_tempo)->format('d M Y') : '-' }}
                                @if($peminjaman->jatuh_tempo && now()->toDateString() === \Carbon\Carbon::parse($peminjaman->jatuh_tempo)->toDateString())
                                    <span class="text-danger d-block">Hari ini batas akhir</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('peminjaman.kembalikan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $peminjaman->id }}">
                                    <button type="submit" class="btn btn-warning">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada buku yang sedang dipinjam</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
