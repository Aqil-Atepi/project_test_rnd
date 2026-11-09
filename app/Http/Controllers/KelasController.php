<?php

namespace App\Http\Controllers;

use App\Models\SesiKelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $kelas = SesiKelas::query()
            ->withCount([
                'attendances as hadir_count' => fn ($q) => $q->where('status_attendance', 'Hadir Penuh'),
            ])
            ->when($search, fn ($q) => $q->where('mata_kuliah', 'like', "%{$search}%"))
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get();

        return view('index', compact('kelas', 'search'));
    }
}