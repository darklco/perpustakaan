<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';
    
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'status'
    ];
    
    // Mendeklarasikan kolom yang harus diparse sebagai tanggal
    protected $dates = [
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'created_at',
        'updated_at'
    ];
    
    // Accessor untuk jatuh_tempo_text
    public function getJatuhTempoTextAttribute()
    {
        return '4 hari setelah peminjaman';
    }

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}