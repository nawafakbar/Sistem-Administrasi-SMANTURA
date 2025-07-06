<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Mapel;

class JadwalKelas extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalKelasFactory> */
    use HasFactory;

    protected $table = 'nawaf_jadwal_kelas';

    protected $fillable = [
        'kelas_id',
        'mata_pelajaran_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mata_pelajaran_id');
    }
}
