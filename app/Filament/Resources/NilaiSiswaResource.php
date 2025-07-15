<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiSiswaResource\Pages;
use App\Models\NilaiSiswa;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use App\Models\Mapel;
use App\Filament\Resources\SiswaKelasResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class NilaiSiswaResource extends Resource
{
    protected static ?string $model = NilaiSiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Nilai Siswa';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('kelas_id')
    ->label('Kelas')
    ->options(function () {
        return \App\Models\Kelas::all()
            ->mapWithKeys(fn ($kelas) => [$kelas->id => $kelas->nama_kelas]);
    }),


        Forms\Components\Select::make('siswa_kelas_id')
            ->label('Siswa')
            ->options(function (callable $get) {
                $kelasId = $get('kelas_id');
                if (!$kelasId) {
                    return [];
                }

                return SiswaKelas::where('kelas_id', $kelasId)
                    ->with('siswa')
                    ->get()
                    ->pluck('siswa.nama', 'id');
            })
            ->getOptionLabelUsing(function ($value) {
                $siswaKelas = \App\Models\SiswaKelas::with('siswa')->find($value);
                return $siswaKelas?->siswa?->nama;
            })
            ->required()
            ->searchable(),

        Forms\Components\Select::make('mapel_id')
        ->label('Mata Pelajaran')
        ->options(function (callable $get) {
            $kelasId = $get('kelas_id');

            if (!$kelasId) return [];

            $kelas = \App\Models\Kelas::find($kelasId);

            if (!$kelas) return [];

            $tingkat = $kelas->tingkat; // 'X', 'XI', 'XII'
            $jurusan = strtolower($kelas->nama_kelas); // 'ipa', 'ips'

            // Mapel wajib selalu ikut
            $prefixWajib = match ($tingkat) {
                'X' => '000',
                'XI' => '010',
                'XII' => '110',
                default => null,
            };

            // Mapel jurusan
            $prefixJurusan = match (true) {
                stripos($jurusan, 'IPA') !== false => match ($tingkat) {
                    'X' => '001',
                    'XI' => '011',
                    'XII' => '111',
                    default => null,
                },
                stripos($jurusan, 'IPS') !== false => match ($tingkat) {
                    'X' => '002',
                    'XI' => '012',
                    'XII' => '112',
                    default => null,
                },
                default => null,
            };

            $mapels = \App\Models\Mapel::where(function ($query) use ($prefixWajib, $prefixJurusan) {
                    if ($prefixWajib) {
                        $query->where('kode_mapel', 'like', "{$prefixWajib}%");
                    }
                    if ($prefixJurusan) {
                        $query->orWhere('kode_mapel', 'like', "{$prefixJurusan}%");
                    }
                })
                ->pluck('nama_mapel', 'id');

            return $mapels;
        })
        ->getOptionLabelUsing(fn ($value) => \App\Models\Mapel::find($value)?->nama_mapel)
        ->required()
        ->searchable()
        ->reactive(),



        Forms\Components\TextInput::make('nilai')
            ->numeric()
            ->label('Nilai')
            ->required()
            ->minValue(0)
            ->maxValue(100),

        Forms\Components\Select::make('semester')
            ->label('Semester')
            ->options([
                'Ganjil' => 'Ganjil',
                'Genap' => 'Genap',
            ])
            ->required(),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('siswaKelas.siswa.nama')->label('Siswa')->searchable(),
            Tables\Columns\TextColumn::make('siswaKelas.kelas.nama_kelas')->label('Kelas'),
            Tables\Columns\TextColumn::make('mapel.nama_mapel')->label('Mapel'),
            Tables\Columns\TextColumn::make('nilai')->label('Nilai'),
            Tables\Columns\TextColumn::make('semester')->label('Semester'),
        ])->filters([])
          ->actions([
              Tables\Actions\EditAction::make(),
              Tables\Actions\DeleteAction::make(),
          ])
          ->bulkActions([
              Tables\Actions\DeleteBulkAction::make(),
          ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNilaiSiswas::route('/'),
            'create' => Pages\CreateNilaiSiswa::route('/create'),
            'edit' => Pages\EditNilaiSiswa::route('/{record}/edit'),
        ];
    }
}
