<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'nawaf_siswas';

    protected $fillable = [
        'nama',
        'nisn',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'tahun_masuk',
        'gambar',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_masuk' => 'integer',
    ];

    // Relasi ke mata pelajaran melalui nilai
    public function mapels()
    {
        return $this->belongsToMany(Mapel::class, 'nawaf_nilai_siswas', 'siswa_id', 'mapel_id')
            ->withPivot('nilai', 'semester', 'tahun_ajaran')
            ->withTimestamps();
    }

    // Relasi langsung ke model NilaiSiswa
    public function nilaiSiswas()
    {
        return $this->hasMany(NilaiSiswa::class, 'siswa_id');
    }
}
