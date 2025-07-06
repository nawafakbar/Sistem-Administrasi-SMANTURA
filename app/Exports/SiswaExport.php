<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Siswa::select('nama', 'nisn', 'email', 'tanggal_lahir', 'jenis_kelamin', 'tahun_masuk', 'status')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NISN',
            'Email',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Tahun Masuk',
            'Status',
        ];
    }
}

