<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalKelasResource\Pages;
use App\Filament\Resources\JadwalKelasResource\RelationManagers;
use App\Models\JadwalKelas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JadwalKelasResource extends Resource
{
    protected static ?string $model = JadwalKelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Jadwal Kelas';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('kelas_id')
                ->label('Kelas')
                ->relationship('kelas', 'nama_kelas')
                ->required(),
                
            Forms\Components\Select::make('mata_pelajaran_id')
                ->label('Mata Pelajaran')
                ->relationship('mapel', 'nama_mapel')
                ->required(),

            Forms\Components\Select::make('hari')
                ->required()
                ->options([
                    'Senin' => 'Senin',
                    'Selasa' => 'Selasa',
                    'Rabu' => 'Rabu',
                    'Kamis' => 'Kamis',
                    'Jumat' => 'Jumat',
                    'Sabtu' => 'Sabtu',
                ]),

            Forms\Components\TimePicker::make('jam_mulai')
                ->label('Jam Mulai')
                ->required(),

            Forms\Components\TimePicker::make('jam_selesai')
                ->label('Jam Selesai')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kelas.nama_kelas')->label('Kelas'),
                Tables\Columns\TextColumn::make('mapel.nama_mapel')->label('Mata Pelajaran'),
                Tables\Columns\TextColumn::make('hari')->label('Hari'),
                Tables\Columns\TextColumn::make('jam_mulai')->label('Mulai'),
                Tables\Columns\TextColumn::make('jam_selesai')->label('Selesai'),
            ])
            ->defaultSort('hari')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalKelas::route('/'),
            'create' => Pages\CreateJadwalKelas::route('/create'),
            'edit' => Pages\EditJadwalKelas::route('/{record}/edit'),
            'lihat-jadwal' => Pages\LihatJadwalKelas::route('/lihat-jadwal'),
        ];
    }
}
