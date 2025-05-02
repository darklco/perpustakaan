<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen'; // pastikan nama tabel ini benar
    
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'status'
    ];

    protected $dates = [
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'jatuh_tempo' => 'datetime',
    ];

    public function getJatuhTempoTextAttribute()
    {
        if ($this->tanggal_pinjam) {
            return $this->tanggal_pinjam->addDays(4)->format('d-m-Y');
        }
        return null;
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
