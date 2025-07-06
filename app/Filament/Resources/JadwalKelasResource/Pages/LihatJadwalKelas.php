<?php

namespace App\Filament\Resources\JadwalKelasResource\Pages;

use App\Models\JadwalKelas;
use App\Models\Kelas;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\Page;
use Filament\Forms;

class LihatJadwalKelas extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = \App\Filament\Resources\JadwalKelasResource::class;
    protected static string $view = 'filament.resources.jadwal-kelas-resource.pages.lihat-jadwal-kelas';

    public ?string $selectedKelasId = null;

    public function mount(): void
    {
        $this->selectedKelasId = request()->query('kelas');
        $this->form->fill([
            'selectedKelasId' => $this->selectedKelasId,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('selectedKelasId')
            ->label('Pilih Kelas')
            ->options(Kelas::all()->pluck('nama_kelas', 'id'))
            ->live()
            ->required(),
        ];
    }

    public function getGroupedJadwal(): array
    {
        if (!$this->selectedKelasId) {
            return [];
        }

        $jadwal = JadwalKelas::with('mapel')
            ->where('kelas_id', $this->selectedKelasId)
            ->get();

        $grouped = [];

        foreach ($jadwal as $item) {
            $key = "{$item->jam_mulai}-{$item->jam_selesai}";
            $grouped[$key][$item->hari] = $item->mapel->nama_mapel;
        }

        return $grouped;
    }
}
