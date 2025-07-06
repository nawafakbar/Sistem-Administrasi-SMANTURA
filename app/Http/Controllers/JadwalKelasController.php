<?php

namespace App\Http\Controllers;

use App\Models\JadwalKelas;
use App\Models\SiswaKelas;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelasList = Kelas::all(); // Dropdown Kelas

        $selectedKelasId = $request->query('kelas');
        $selectedTahunMasuk = $request->query('tahun');
        $groupedJadwal = [];

        // Ambil daftar tahun masuk dari siswa yang pernah masuk ke kelas manapun
        $tahunMasukList = SiswaKelas::with('siswa')
            ->get()
            ->pluck('siswa.tahun_masuk')
            ->unique()
            ->sort()
            ->values();

        // Hanya tampilkan jadwal jika kelas & tahun dipilih
        if ($selectedKelasId && $selectedTahunMasuk) {
            // Cek apakah ada siswa tahun tsb di kelas ini
            $adaSiswa = SiswaKelas::where('kelas_id', $selectedKelasId)
                ->whereHas('siswa', fn ($q) => $q->where('tahun_masuk', $selectedTahunMasuk))
                ->exists();

            if ($adaSiswa) {
                $jadwals = JadwalKelas::with('mapel')
                    ->where('kelas_id', $selectedKelasId)
                    ->get();

                foreach ($jadwals as $jadwal) {
                    $jam = Carbon::parse($jadwal->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($jadwal->jam_selesai)->format('H:i');
                    $groupedJadwal[$jam][$jadwal->hari] = $jadwal->mapel->nama_mapel ?? '-';
                }
            }
        }

        return view('siswa.public', compact(
            'kelasList',
            'selectedKelasId',
            'selectedTahunMasuk',
            'tahunMasukList',
            'groupedJadwal'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalKelas $jadwalKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKelas $jadwalKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalKelas $jadwalKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKelas $jadwalKelas)
    {
        //
    }
}
