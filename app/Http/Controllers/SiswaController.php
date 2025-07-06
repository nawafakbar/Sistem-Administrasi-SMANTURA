<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.pendaftaran');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:nawaf_siswas,nisn',
            'email' => 'required|email|unique:nawaf_siswas,email',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'tahun_masuk' => 'required|numeric|min:2000|max:' . date('Y'),
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            // Ambil nama asli file
            $originalName = $file->getClientOriginalName();

            // Simpan ke storage/app/public dengan nama asli
            $path = $file->storeAs('', $originalName, 'public'); // <- ini yang kamu simpan ke database

             $validated['gambar'] = $path;
        }

        $validated['status'] = 'pending';

        Siswa::create($validated);

        return redirect()->route('siswa.create')->with('success', 'Pendaftaran berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
