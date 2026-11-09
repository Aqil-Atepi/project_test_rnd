<?php

namespace App\Http\Controllers;

use App\Models\SesiKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SesiKelasController extends Controller
{
    public function index()
    {
        $kelas = SesiKelas::orderBy('tanggal')->orderBy('jam')->get();

        return view('admin', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah' => 'required|string|max:225',
            'pengajar' => 'required|string|max:225',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'ruang_kelas' => 'required|string|max:125',
            'kode_sesi' => 'required|string|max:125|unique:sesi_kelas,kode_sesi',
            'modul' => 'required|url',
        ]);

        SesiKelas::create($validated + [
            'status_kelas' => 'Belum Mulai',
            'jumlah_peserta_hadir' => 0,
        ]);

        return redirect()->route('admin')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(SesiKelas $kelas)
    {
        return view('admin-edit', compact('kelas'));
    }

    public function update(Request $request, SesiKelas $kelas)
    {
        $validated = $request->validate([
            'mata_kuliah' => 'required|string|max:225',
            'pengajar' => 'required|string|max:225',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'ruang_kelas' => 'required|string|max:125',
            'kode_sesi' => [
                'required',
                'string',
                'max:125',
                Rule::unique('sesi_kelas', 'kode_sesi')->ignore($kelas->kode_kelas, 'kode_kelas'),
            ],
            'modul' => 'required|url',
            'status_kelas' => ['required', Rule::in(['Belum Mulai', 'Berlangsung', 'Selesai'])],
        ]);

        $kelas->update($validated);

        return redirect()->route('admin')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(SesiKelas $kelas)
    {
        DB::transaction(function () use ($kelas) {
            $kelas->attendances()->delete();
            $kelas->delete();
        });

        return redirect()->route('admin')->with('success', 'Kelas berhasil dihapus.');
    }

    public function peserta(SesiKelas $kelas)
    {
        $peserta = $kelas->attendances()->orderBy('nama_mahasiswa')->get();

        return view('admin-peserta', compact('kelas', 'peserta'));
    }
}