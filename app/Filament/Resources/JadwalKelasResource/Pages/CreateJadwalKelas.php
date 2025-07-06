<?php

namespace App\Filament\Resources\JadwalKelasResource\Pages;

use App\Filament\Resources\JadwalKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwalKelas extends CreateRecord
{
    protected static string $resource = JadwalKelasResource::class;
    protected static ?string $title = 'Tambah Jadwal Kelas';
}
