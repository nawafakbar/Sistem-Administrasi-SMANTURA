<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    /** @use HasFactory<\Database\Factories\GuruFactory> */
    use HasFactory;

    // Nama tabel kustom
    protected $table = 'nawaf_gurus';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama',
        'nip',
        'email',
        'no_hp',
        'gambar',
    ];
}
