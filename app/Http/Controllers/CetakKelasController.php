<?php

namespace App\Http\Controllers;

use App\Models\SiswaKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use PDF;

class CetakKelasController extends Controller
{
    public function cetakPDF(Request $request)
    {
        $kelasId = $request->get('kelas');
        $kelas = Kelas::findOrFail($kelasId);

        $siswaKelas = SiswaKelas::with('siswa')
            ->where('kelas_id', $kelasId)
            ->get()
            ->sortBy(fn ($item) => strtolower($item->siswa->nama));

        $pdf = PDF::loadView('exports.kelas', [
            'kelas' => $kelas,
            'data' => $siswaKelas,
        ])->setPaper('A4', 'portrait');

        $num = 1;
        return $pdf->stream("Kelas-{$kelas->nama_kelas}.pdf");
    }
}
