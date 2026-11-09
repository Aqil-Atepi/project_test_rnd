<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SesiKelas;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $data = $request->validateWithBag('checkin', [
            'kode_kelas' => 'required|integer|exists:sesi_kelas,kode_kelas',
            'nama_mahasiswa' => 'required|string|max:225',
            'nim' => 'required|string|max:125',
        ]);

        $kelas = SesiKelas::findOrFail($data['kode_kelas']);

        if ($kelas->isSelesai()) {
            return $this->failIn('Sesi kelas telah ditutup.');
        }

        if (!$kelas->isBerlangsung()) {
            return $this->failIn('Sesi kelas belum dimulai.');
        }

        $already = Attendance::where('kode_kelas', $kelas->kode_kelas)
            ->where('nim', $data['nim'])
            ->exists();

        if ($already) {
            return $this->failIn('NIM sudah terdaftar di sesi kelas ini.');
        }

        Attendance::create([
            'kode_kelas' => $kelas->kode_kelas,
            'nama_mahasiswa' => $data['nama_mahasiswa'],
            'nim' => $data['nim'],
            'status_attendance' => 'Check-In (Di Kelas)',
        ]);

        return back()->with('success_checkin', 'Check-In berhasil. Jangan lupa Check-Out di akhir sesi!');
    }

    public function checkOut(Request $request)
    {
        $data = $request->validateWithBag('checkout', [
            'nim' => 'required|string|max:125',
            'kode_sesi' => 'required|string|max:125',
        ]);

        $kelas = SesiKelas::where('kode_sesi', $data['kode_sesi'])->first();

        if (!$kelas) {
            return $this->failOut('Kode sesi tidak valid!.');
        }

        $attendance = Attendance::where('kode_kelas', $kelas->kode_kelas)
            ->where('nim', $data['nim'])
            ->first();

        if (!$attendance) {
            return $this->failOut('NIM belum tercatat melakukan Check-In di kelas ini.');
        }

        if ($attendance->status_attendance === 'Hadir Penuh') {
            return $this->failOut('NIM ini sudah melakukan Check-Out.');
        }

        $attendance->update(['status_attendance' => 'Hadir Penuh']);

        return back()->with('success_checkout', 'Check-Out berhasil. Status kamu: Hadir Penuh.');
    }

    private function failIn(string $message)
    {
        return back()->withErrors(['checkin' => $message], 'checkin')->withInput();
    }

    private function failOut(string $message)
    {
        return back()->withErrors(['checkout' => $message], 'checkout')->withInput();
    }
}