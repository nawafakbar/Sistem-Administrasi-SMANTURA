<?php

namespace App\Filament\Resources\SiswaKelasResource\Pages;

use App\Filament\Resources\SiswaKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiswaKelas extends ListRecords
{
    protected static string $resource = SiswaKelasResource::class;
    protected static ?string $title = 'Daftar Kelas Siswa';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
