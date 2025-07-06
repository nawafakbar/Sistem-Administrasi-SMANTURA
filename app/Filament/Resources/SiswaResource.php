<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table as TableComponent;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Schema;
use App\Exports\SiswaTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaResource extends Resource
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $navigationGroup = 'Biodata';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('nisn')
                ->required()
                ->maxLength(20)
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255)
                ->nullable()
                ->unique(ignoreRecord: true),

            Forms\Components\DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->nullable(),

            Forms\Components\Select::make('jenis_kelamin')
                ->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ])
                ->required(),

            Forms\Components\TextInput::make('tahun_masuk')
                ->numeric()
                ->minValue(2000)
                ->maxValue(date('Y'))
                ->required(),

            Forms\Components\FileUpload::make('gambar')
                ->image()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(Siswa::query()->where('status', 'approved'))
        ->columns([
            Tables\Columns\ImageColumn::make('gambar')
                ->square(),

            Tables\Columns\TextColumn::make('nama')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('nisn')
                ->sortable(),

            Tables\Columns\TextColumn::make('email')
                ->sortable(),

            Tables\Columns\TextColumn::make('jenis_kelamin')
                ->label('JK'),

            Tables\Columns\TextColumn::make('tahun_masuk')
                ->searchable(),
            ])
            
            ->defaultSort('created_at', 'desc')
            ->filters([])
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
