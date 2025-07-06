<?php

namespace App\Filament\Resources;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SiswaKelas;
use App\Filament\Resources\SiswaKelasResource\Pages;
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


class SiswaKelasResource extends Resource
{
    protected static ?string $model = SiswaKelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pembagian Kelas';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('siswa_id')
                ->label('Siswa')
                ->relationship('siswa', 'nama')
                ->required(),

            Forms\Components\Select::make('kelas_id')
                ->label('Kelas')
                ->relationship('kelas', 'nama_kelas')
                ->required(),

            Forms\Components\TextInput::make('tahun_ajaran')
                ->numeric()
                ->minValue(2000)
                ->maxValue(now()->year + 1)
                ->required()
                ->label('Tahun Ajaran'),
        ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('siswa.nama')
                ->label('Siswa')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('kelas.nama_kelas')
                ->label('Kelas')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('tahun_ajaran')
                ->label('Tahun Ajaran')
                ->sortable()
                ->searchable(),
        ])
        ->defaultSort('tahun_ajaran', 'desc')
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ])
        ->headerActions([
        Tables\Actions\Action::make('lihatKelas')
        ->label('Lihat Kelas')
        ->icon('heroicon-o-eye')
        ->url(fn () => route('filament.admin.resources.siswa-kelas.lihat'))
        ->color('secondary'),

        Tables\Actions\Action::make('generateKelas')
            ->label('Generate Kelas Otomatis')
            ->icon('heroicon-o-sparkles')
            ->color('success')
            ->requiresConfirmation()
            ->form([
                Forms\Components\Select::make('tingkat')
                    ->label('Pilih Tingkat Kelas')
                    ->options([
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII',
                    ])
                    ->required(),

                Forms\Components\Select::make('tahun_ajaran')
                    ->label('Pilih Tahun Ajaran')
                    ->options(
                        fn () => Siswa::where('status', 'approved')
                            ->pluck('tahun_masuk')
                            ->unique()
                            ->sortDesc()
                            ->mapWithKeys(fn ($tahun) => [$tahun => $tahun])
                            ->toArray()
                    )
                    ->required(),
            ])
            ->action(function (array $data) {
                $tingkat = $data['tingkat'];
                $tahunAjaran = $data['tahun_ajaran'];

                $kelasList = Kelas::where('tingkat', $tingkat)->get();

                if ($kelasList->isEmpty()) {
                    Notification::make()
                        ->title("Belum ada kelas tingkat {$tingkat}.")
                        ->body("Silakan tambahkan dulu kelas tingkat {$tingkat} di menu Kelas.")
                        ->warning()
                        ->send();
                    return;
                }

                $kapasitasPerKelas = 20;

                $siswaApproved = Siswa::where('status', 'approved')
                    ->where('tahun_masuk', $tahunAjaran)
                    ->whereNotIn('id', SiswaKelas::pluck('siswa_id'))
                    ->get();

                if ($siswaApproved->isEmpty()) {
                    Notification::make()
                        ->title('Tidak ada siswa yang perlu dibagi.')
                        ->body("Tidak ada siswa approved dengan tahun ajaran {$tahunAjaran} yang belum dibagi.")
                        ->info()
                        ->send();
                    return;
                }

                $siswaApproved = $siswaApproved->shuffle();

                foreach ($siswaApproved as $siswa) {
                    $kelasTersedia = $kelasList->filter(function ($kelas) use ($kapasitasPerKelas) {
                        $jumlah = SiswaKelas::where('kelas_id', $kelas->id)->count();
                        return $jumlah < $kapasitasPerKelas;
                    });

                    if ($kelasTersedia->isEmpty()) {
                        Notification::make()
                            ->title('Pembagian selesai sebagian')
                            ->body('Semua kelas sudah penuh. Tidak semua siswa kebagian.')
                            ->warning()
                            ->send();
                        break;
                    }

                    $kelasTerpilih = $kelasTersedia->random();

                    SiswaKelas::create([
                        'siswa_id' => $siswa->id,
                        'kelas_id' => $kelasTerpilih->id,
                        'tahun_ajaran' => $tahunAjaran,
                    ]);
                }

                Notification::make()
                    ->title('Berhasil!')
                    ->body("Siswa tahun ajaran {$tahunAjaran} berhasil dibagi ke kelas secara acak.")
                    ->success()
                    ->send();
            }),
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
            'index' => Pages\ListSiswaKelas::route('/'),
            'create' => Pages\CreateSiswaKelas::route('/create'),
            'edit' => Pages\EditSiswaKelas::route('/{record}/edit'),
            'lihat' => Pages\LihatSiswaKelas::route('/lihat'),
        ];
    }
}
