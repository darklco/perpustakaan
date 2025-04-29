<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'book_id',
        'judul',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    protected $table = 'peminjamen';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    
    
}
