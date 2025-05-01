{{-- resources/views/peminjaman/tabel.blade.php --}}
@extends('layout.buku')

@section('content')
<div class="container py-5">

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <h2 class="mb-4 text-center">Daftar Buku yang Dipinjam</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $peminjaman)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peminjaman->book->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                        @php
                            $jatuhTempo = \Carbon\Carbon::parse($peminjaman->jatuh_tempo);
                            $now = \Carbon\Carbon::now();
                            $selisihHari = $now->diffInDays($jatuhTempo, false);
                        @endphp

                        <td class="{{ $selisihHari < 0 ? 'bg-danger text-white' : '' }}">
                            {{ $jatuhTempo->format('d M Y') }}
                            <br>
                            <small>
                                @if ($selisihHari > 0)
                                    {{ $selisihHari }} hari tersisa
                                @elseif ($selisihHari === 0)
                                    <span class="text-warning">Hari ini batas akhir</span>
                                @else
                                    <span class="text-warning">{{ abs($selisihHari) }} hari terlambat</span>
                                @endif
                            </small>
                        </td>

                        <td>
                            <form action="{{ route('peminjaman.kembalikan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $peminjaman->id }}">
                                <button type="submit" class="btn btn-warning btn-sm">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada buku yang dipinjam.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
