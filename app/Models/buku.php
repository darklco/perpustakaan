<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function peminjaman(){
        return $this->hasmany(peminjaman::class);
    }
    use HasFactory;
}
