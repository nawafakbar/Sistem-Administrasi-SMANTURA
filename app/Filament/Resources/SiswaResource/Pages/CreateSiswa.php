<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;
    protected static ?string $title = 'Tambah Siswa';

    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'pending';
        return $data;
    }
}
