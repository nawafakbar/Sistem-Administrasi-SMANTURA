<?php

namespace App\Filament\Resources\JadwalKelasResource\Pages;

use App\Filament\Resources\JadwalKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use App\Models\JadwalKelas;
use App\Models\Kelas;
use App\Models\Mapel;
use Filament\Notifications\Notification;

class ListJadwalKelas extends ListRecords
{
    protected static string $resource = JadwalKelasResource::class;
    protected static ?string $title = 'Daftar Jadwal Kelas';

    protected function getHeaderActions(): array
{
    return [
        Action::make('Lihat Jadwal Visual')
            ->label('Lihat Jadwal Kelas')
            ->icon('heroicon-o-eye')
            ->action(fn () => redirect()->to(route('filament.admin.resources.jadwal-kelas.lihat-jadwal'))),

        Action::make('Generate Otomatis')
            ->label('Generate Otomatis')
            ->icon('heroicon-o-cog')
            ->form([
                Select::make('tingkat')
                    ->label('Pilih Tingkat')
                    ->options([
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII',
                    ])
                    ->required(),

                Select::make('slot_per_hari')
                    ->label('Jumlah Mata Pelajaran per Hari (Senin-Kamis)')
                    ->options([
                        2 => '2 Slot',
                        3 => '3 Slot',
                        4 => '4 Slot',
                    ])
                    ->default(3)
                    ->required(),
            ])
            ->action(function (array $data) {
    $tingkat = $data['tingkat'];
    $slotPerHari = (int) $data['slot_per_hari'];

    $kelasList = \App\Models\Kelas::where('tingkat', $tingkat)->get();

    $kodePrefix = match ($tingkat) {
        'X' => '00',
        'XI' => '01',
        'XII' => '11',
    };

    // Mapel Wajib: xx01 - xx09
    $mapelWajib = \App\Models\Mapel::whereBetween('kode_mapel', [
        $kodePrefix . '01',
        $kodePrefix . '09',
    ])->get();

    // Mapel IPA: xx11 - xx19
    $mapelIPA = \App\Models\Mapel::whereBetween('kode_mapel', [
        $kodePrefix . '11',
        $kodePrefix . '19',
    ])->get();

    // Mapel IPS: xx21 - xx29
    $mapelIPS = \App\Models\Mapel::whereBetween('kode_mapel', [
        $kodePrefix . '21',
        $kodePrefix . '29',
    ])->get();

    $jamMap = [
        1 => ['07:00', '09:00'],
        2 => ['09:00', '11:00'],
        3 => ['12:00', '14:00'],
        4 => ['14:00', '16:00'],
    ];

    $hariSlotMap = [
        'Senin' => $slotPerHari,
        'Selasa' => $slotPerHari,
        'Rabu' => $slotPerHari,
        'Kamis' => $slotPerHari,
        'Jumat' => 2,
    ];

    foreach ($kelasList as $kelas) {
        $isIPA = stripos($kelas->nama_kelas, 'IPA') !== false;

        // Siapkan daftar mapel beserta jumlah pertemuannya
        $mapelTerjadwal = [];

        foreach ($mapelWajib as $mapel) {
            $mapelTerjadwal[] = [
                'mapel' => $mapel,
                'jumlah' => 1,
            ];
        }

        $mapelJurusan = $isIPA ? $mapelIPA : $mapelIPS;
        foreach ($mapelJurusan as $mapel) {
            $mapelTerjadwal[] = [
                'mapel' => $mapel,
                'jumlah' => 2,
            ];
        }

        // Buat slot kosong mingguan
        $weeklySlots = [];
        foreach ($hariSlotMap as $hari => $slotCount) {
            for ($i = 1; $i <= $slotCount; $i++) {
                $weeklySlots[] = [
                    'hari' => $hari,
                    'jam_mulai' => $jamMap[$i][0],
                    'jam_selesai' => $jamMap[$i][1],
                ];
            }
        }

        shuffle($weeklySlots); // Supaya distribusi acak

        foreach ($mapelTerjadwal as $item) {
    $mapel = $item['mapel'];
    $target = $item['jumlah'];
    $count = 0;

    // 🔁 Dapatkan salinan acak dari weeklySlots
    $availableSlots = $weeklySlots;
    shuffle($availableSlots);

    foreach ($availableSlots as $index => $slot) {
        // Cek apakah waktu ini sudah dipakai mapel lain
        $bentrok = \App\Models\JadwalKelas::where('mata_pelajaran_id', $mapel->id)
            ->where('hari', $slot['hari'])
            ->where('jam_mulai', $slot['jam_mulai'])
            ->exists();

        if (!$bentrok) {
            \App\Models\JadwalKelas::updateOrCreate([
                'kelas_id' => $kelas->id,
                'mata_pelajaran_id' => $mapel->id,
                'hari' => $slot['hari'],
                'jam_mulai' => $slot['jam_mulai'],
            ], [
                'jam_selesai' => $slot['jam_selesai'],
            ]);

            // Hapus slot dari weeklySlots utama agar tidak dipakai dua kali
            foreach ($weeklySlots as $key => $ws) {
                if ($ws['hari'] === $slot['hari'] && $ws['jam_mulai'] === $slot['jam_mulai']) {
                    unset($weeklySlots[$key]);
                    break;
                }
            }
            $weeklySlots = array_values($weeklySlots); // reindex

            $count++;
            if ($count >= $target) {
                break;
            }
        }
    }

    if ($count < $target) {
        \Log::warning("❗ Mapel {$mapel->nama_mapel} hanya terjadwal {$count}/{$target} kali di kelas {$kelas->nama}");
    }
}

    }

    \Filament\Notifications\Notification::make()
        ->title("Jadwal tingkat $tingkat berhasil digenerate")
        ->success()
        ->send();
}),
    ];
}

}
