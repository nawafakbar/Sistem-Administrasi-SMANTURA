<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    // Nama tabel kustom
    protected $table = 'nawaf_siswas';
    public function model(array $row)
    {
        
        return new Siswa([
            'nama'           => $row['nama'],
            'nisn'           => $row['nisn'],
            'email'          => $row['email'] ?? null,
            'tanggal_lahir'  => $row['tanggal_lahir'],
            'jenis_kelamin'  => $row['jenis_kelamin'],
            'tahun_masuk'    => $row['tahun_masuk'],
            'status'         => 'pending', // default status
            'gambar'         => $row['gambar'], // default null gambar
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nisn' => ['required', 'unique:nawaf_siswas,nisn'],
            '*.nama' => ['required'],
            '*.jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            '*.tahun_masuk' => ['required', 'numeric'],
        ];
    }
}
