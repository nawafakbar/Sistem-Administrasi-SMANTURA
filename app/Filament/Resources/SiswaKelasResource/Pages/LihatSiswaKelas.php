<?php

namespace App\Filament\Resources\SiswaKelasResource\Pages;

use App\Models\Kelas;
use App\Models\SiswaKelas;
use Filament\Forms\Components\Select;
use Filament\Forms;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;

class LihatSiswaKelas extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = \App\Filament\Resources\SiswaKelasResource::class;
    protected static string $view = 'filament.resources.jadwal-kelas-resource.pages.lihat-kelas';

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

    public function getSiswaByKelas(): \Illuminate\Support\Collection
    {
        $no=1;
        if (! $this->selectedKelasId) {
            return collect();
        }

        return SiswaKelas::with('siswa')
            ->where('kelas_id', $this->selectedKelasId)
            ->get()
            ->sortBy(fn ($item) => strtolower($item->siswa->nama)); // urut alfabet
    }

    public function getNoStart(): int
    {
        return 1;
    }


}
