<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiswaKelas;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;

    // Nama tabel khusus
    protected $table = 'nawaf_kelas';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nama_kelas',
        'tingkat',
    ];

}
