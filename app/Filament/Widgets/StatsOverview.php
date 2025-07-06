<?php

namespace App\Filament\Widgets;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Jumlah Siswa', Siswa::where('status', 'approved')->count())
                ->icon('heroicon-o-user-group')
                ->description('Total siswa terdaftar')
                ->color('primary'),

            Card::make('Jumlah Guru', Guru::count())
                ->icon('heroicon-o-academic-cap')
                ->description('Total guru aktif')
                ->color('success'),

            Card::make('Jumlah Kelas', Kelas::count())
                ->icon('heroicon-o-home-modern')
                ->description('Total kelas yang tersedia')
                ->color('warning'),
        ];
    }
}

