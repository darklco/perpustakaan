<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'foto', 'category_id'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function peminjaman(){
        return $this->hasmany(peminjaman::class);
    }
    
}
