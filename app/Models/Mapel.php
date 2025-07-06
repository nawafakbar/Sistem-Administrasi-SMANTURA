<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'nawaf_mapels';

    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi ke siswa melalui nilai
    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'nawaf_nilai_siswas', 'mapel_id', 'siswa_id')
            ->withPivot('nilai', 'semester', 'tahun_ajaran')
            ->withTimestamps();
    }

    // Relasi langsung ke model NilaiSiswa
    public function nilaiSiswas()
    {
        return $this->hasMany(NilaiSiswa::class, 'mapel_id');
    }
}
