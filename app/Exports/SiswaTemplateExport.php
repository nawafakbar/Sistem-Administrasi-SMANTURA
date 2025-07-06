<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                'Budi Santoso',     // nama
                '1234567890',       // nisn
                'budi@mail.com',    // email
                '2007-08-15',       // tanggal_lahir (format: YYYY-MM-DD)
                'L',                // jenis_kelamin (L / P)
                '2023',             // tahun_masuk
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'nama',
            'nisn',
            'email',
            'tanggal_lahir',     // Format: YYYY-MM-DD
            'jenis_kelamin',     // L = Laki-laki, P = Perempuan
            'tahun_masuk',       // Contoh: 2023
        ];
    }
}


