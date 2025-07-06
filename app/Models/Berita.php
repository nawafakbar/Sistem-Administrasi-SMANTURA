<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    /** @use HasFactory<\Database\Factories\BeritaFactory> */
    use HasFactory;
    // Nama tabel kustom
    protected $table = 'nawaf_beritas';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'tanggal_publish',
    ];

    // (Optional) Cast tanggal_publish ke objek Carbon
    protected $casts = [
        'tanggal_publish' => 'date',
    ];
}
