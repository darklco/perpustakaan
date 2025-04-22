<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')-> insert([
            [
                'judul' => 'Harry Potter',
                'penulis' => 'JK Rowling',
                'penerbit' => 'Bloomsbury',
                'tahun_terbit' => '1997',
                'stok' => '1',
                'category_id' => '1' // Novel

            ],

            [
                'judul' => 'Fisika SMA',
                'penulis' => 'Suyanto',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2018,
                'stok' => 3,
                'category_id' => 2 // Ilmiah
            ],

            [
                'judul' => 'Doraemon',
                'penulis' => 'Fujiko F. Fujio',
                'penerbit' => 'Shogakukan',
                'tahun_terbit' => 1997,
                'stok' => 7,
                'category_id' => 3 // Komik
            ]
            ]);
    }
}
