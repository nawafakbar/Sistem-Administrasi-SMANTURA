<?php

namespace App\Filament\Pages;

use Filament\Pages\Page; // ⬅️ Ini yang penting
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Filament\Widgets\StatsOverview;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
