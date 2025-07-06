<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Exports\SiswaExport;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use App\Exports\SiswaTemplateExport;
use Illuminate\Support\Facades;



class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;
    protected static ?string $title = 'Daftar Siswa';

    protected function getHeaderActions(): array
    {
        return [
        Actions\CreateAction::make(),
        Actions\Action::make('downloadTemplate')
        ->label('Download Template Excel')
        ->icon('heroicon-o-document-arrow-down')
        ->color('secondary')
        ->action(function () {
            return Excel::download(new SiswaTemplateExport, 'template_siswa.xlsx');
        }),
        Actions\Action::make('importExcel')
        ->label('Import Excel')
        ->icon('heroicon-o-document-arrow-up')
        ->form([
            FileUpload::make('file')
            ->label('File Excel')
            ->directory('imports') // simpan ke storage/app/imports
            ->disk('local') // pastikan di storage/app, bukan public atau s3
            ->preserveFilenames()
            ->acceptedFileTypes([
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel',
            ])
            ->required(),
        ])
        ->action(function (array $data) {
            $uploadedPath = Storage::disk('local')->path($data['file']); // contoh: imports/nama_file.xlsx

            if (!$uploadedPath) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Silakan upload file terlebih dahulu.')
                    ->danger()
                    ->send();
                return;
            }

            if (!file_exists($uploadedPath)) {
                Notification::make()
                    ->title('Gagal')
                    ->body('File tidak ditemukan. Coba upload ulang.')
                    ->danger()
                    ->send();
                return;
            }

            try {
                Excel::import(new SiswaImport, $uploadedPath);

                Notification::make()
                    ->title('Berhasil!')
                    ->body('Data siswa berhasil diimpor.')
                    ->success()
                    ->send();
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Import Gagal')
                    ->body('Terjadi kesalahan: ' . $e->getMessage())
                    ->danger()
                    ->send();
            }
        }),

        Actions\Action::make('exportExcel')
        ->label('Export Excel')
        ->icon('heroicon-o-arrow-down-tray')
        ->action(function () {
            $fileName = 'data_siswa_'.now()->format('Y_m_d_H_i_s').'.xlsx';

            return Excel::download(new SiswaExport, $fileName);
        }),

        ];
    }
}
