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

        .table {
            background-color: #fff8e1;
        }

        .table th {
            background-color: #6b4c3b; 
            color: white;
        }

        .table td {
            color: #6b4c3b; 
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f5e1c0;
        }

        .btn-warning {
            background-color: #6b4c3b !important; 
            color: white !important; 
            border: none !important; 
        }

        .btn-warning:hover {
            background-color: #5a3f2f !important; 
        }

        .alert-success {
            background-color: #6b4c3b; 
            color: white; 
        }

        .btn-secondary {
            background-color: #6b4c3b; 
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a3f2f; 
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
</body>
</html>
