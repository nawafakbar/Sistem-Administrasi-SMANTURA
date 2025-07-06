<?php

namespace App\Filament\Pages;

use App\Models\Siswa;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table as TableComponent;
use Illuminate\Contracts\View\View;

class SiswaApproval extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';
    protected static string $view = 'filament.pages.siswa-approval';
    protected static ?string $title = 'Approval Siswa';

    public function table(TableComponent $table): TableComponent
{
    return $table
        ->query(Siswa::query()->where('status', 'pending'))
        ->columns([
            Tables\Columns\ImageColumn::make('gambar')
                ->label('Foto')
                ->square()
                ->size(60),

            Tables\Columns\TextColumn::make('nama')->searchable(),
            Tables\Columns\TextColumn::make('nisn'),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('jenis_kelamin')->label('JK'),
            Tables\Columns\TextColumn::make('tahun_masuk'),
        ])
        ->actions([
            Tables\Actions\Action::make('view')
                ->label('Detail')
                ->modalHeading('Detail Siswa')
                ->modalSubheading(fn (Siswa $record) => "NISN: {$record->nisn}")
                ->modalContent(fn (Siswa $record): View => view('filament.pages.partials.siswa-detail', ['record' => $record]))
                ->modalSubmitActionLabel(false)
                ->action(fn (Siswa $record) => $record->update(['status' => 'approved']))
                ->color('primary')
                ->icon('heroicon-o-eye'),

            Tables\Actions\Action::make('approve')
                ->label('Approve')
                ->color('success')
                ->icon('heroicon-o-check')
                ->requiresConfirmation()
                ->action(fn (Siswa $record) => $record->update(['status' => 'approved'])),

            Tables\Actions\Action::make('reject')
                ->label('Reject')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->action(fn (Siswa $record) => $record->delete()),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approve_selected')
                ->label('Approve Semua')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->action(function ($records) {
                    foreach ($records as $record) {
                        $record->update(['status' => 'approved']);
                    }
                })
                ->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('reject_selected')
                ->label('Reject Semua')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->action(function ($records) {
                    foreach ($records as $record) {
                        $record->delete();
                    }
                })
                ->deselectRecordsAfterCompletion(),

                ]),
        ]);
}

}
