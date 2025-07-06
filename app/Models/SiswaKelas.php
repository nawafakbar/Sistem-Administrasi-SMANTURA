<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaKelas extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaKelasFactory> */
    use HasFactory;

    protected $table = 'nawaf_siswa_kelas';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tahun_ajaran',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }


}
