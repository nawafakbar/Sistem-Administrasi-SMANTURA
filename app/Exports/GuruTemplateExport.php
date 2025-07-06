<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                'Budi Santoso',     // nama
                '1234567890',       // nisn
                'budi@mail.com',    // email
                '0899820873',       // tanggal_lahir (format: YYYY-MM-DD)
                'userpp.png',                // jenis_kelamin (L / P)
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'nama',
            'nip',
            'email',
            'no_hp',     // Format: YYYY-MM-DD
            'gambar',     // L = Laki-laki, P = Perempuan
        ];
    }
}


