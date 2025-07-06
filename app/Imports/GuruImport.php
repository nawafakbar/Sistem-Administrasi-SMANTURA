<?php

namespace App\Imports;

use App\Models\Guru;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuruImport implements ToModel, WithHeadingRow, WithValidation
{
    // Nama tabel kustom
    protected $table = 'nawaf_gurus';
    public function model(array $row)
    {
        return new Guru([
            'nama'           => $row['nama'],
            'nip'            => $row['nip'],
            'email'          => $row['email'] ?? null,
            'no_hp'          => $row['no_hp'],
            'gambar'         => $row['gambar'] ?? null, // default null gambar
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nip' => ['required', 'unique:nawaf_gurus,nip'],
            '*.nama' => ['required'],
        ];
    }
}
