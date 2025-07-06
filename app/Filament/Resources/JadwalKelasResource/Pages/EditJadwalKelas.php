<?php

namespace App\Filament\Resources\JadwalKelasResource\Pages;

use App\Filament\Resources\JadwalKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalKelas extends EditRecord
{
    protected static string $resource = JadwalKelasResource::class;
    protected static ?string $title = 'Edit Jadwal Kelas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
