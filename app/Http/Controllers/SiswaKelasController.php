<?php

namespace App\Http\Controllers;

use App\Models\SiswaKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelasList = Kelas::all()->pluck('nama_kelas', 'id');
        $selectedKelasId = $request->query('kelas');
        $selectedTahunMasuk = $request->query('tahun');
        $siswaList = collect();

        // Ambil tahun masuk unik
        $tahunMasukList = SiswaKelas::with('siswa')
            ->get()
            ->pluck('siswa.tahun_masuk') // pastikan relasi 'siswa' punya field 'tahun_masuk'
            ->unique()
            ->sort()
            ->values();

        if ($selectedKelasId) {
            $siswaQuery = SiswaKelas::with('siswa')
                ->where('kelas_id', $selectedKelasId);

            if ($selectedTahunMasuk) {
                $siswaQuery->whereHas('siswa', function ($q) use ($selectedTahunMasuk) {
                    $q->where('tahun_masuk', $selectedTahunMasuk);
                });
            }

            $siswaList = $siswaQuery->get()
                ->sortBy(fn ($item) => strtolower($item->siswa->nama));
        }

        return view('siswa.daftar_kelas', compact(
            'kelasList',
            'tahunMasukList',
            'selectedKelasId',
            'selectedTahunMasuk',
            'siswaList'
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
    public function show(SiswaKelas $siswaKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SiswaKelas $siswaKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SiswaKelas $siswaKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiswaKelas $siswaKelas)
    {
        //
    }
}
