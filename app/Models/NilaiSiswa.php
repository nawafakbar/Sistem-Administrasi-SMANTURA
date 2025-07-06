<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiswaKelas;
use App\Models\Mapel;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $table = 'nawaf_nilai_siswas';

    protected $fillable = [
        'siswa_kelas_id',
        'mapel_id',
        'nilai',
        'semester',
    ];

    public function siswaKelas()
    {
        return $this->belongsTo(SiswaKelas::class, 'siswa_kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}
