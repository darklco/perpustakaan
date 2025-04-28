@extends('layout.buku')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Peminjaman Buku</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($buku->cover_image)
                                <img src="{{ asset('storage/' . $buku->cover_image) }}" class="img-fluid rounded" alt="{{ $buku->judul }}">
                            @else
                                <div class="bg-light rounded d-flex justify-content-center align-items-center" style="height: 200px;">
                                    <span class="text-muted">No Cover Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $buku->judul }}</h4>
                            <p class="text-muted">Penulis: {{ $buku->penulis }}</p>
                            <p class="text-muted">Kategori: {{ $buku->category->nama ?? 'Tidak ada kategori' }}</p>
                            <p class="text-muted">Stok tersedia: {{ $buku->stok }}</p>
                            <p class="mb-0">{{ Str::limit($buku->deskripsi ?? '', 150) }}</p>
                        </div>
                    </div>

                    @if($buku->stok > 0)
                        <form method="POST" action="{{ route('pinjam.store') }}">
                            @csrf
                            <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                            
                            <div class="mb-3">
                                <p><strong>Informasi Peminjaman:</strong></p>
                                <ul>
                                    <li>Tanggal peminjaman: {{ now()->format('d M Y') }}</li>
                                    <li>Jatuh tempo pengembalian: {{ now()->addDays(4)->format('d M Y') }}</li>
                                    <li>Denda keterlambatan: Rp1.000 per hari</li>
                                </ul>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input @error('persetujuan') is-invalid @enderror" 
                                    type="checkbox" id="persetujuan" name="persetujuan" required>
                                <label class="form-check-label" for="persetujuan">
                                    Saya menyetujui untuk mengembalikan buku tepat waktu dan dalam kondisi baik
                                </label>
                                @error('persetujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('buku') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <p class="mb-0">Maaf, stok buku ini sedang kosong. Silakan coba lagi nanti.</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('buku') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection