<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SesiKelas extends Model
{
    protected $table = 'sesi_kelas';
    protected $primaryKey = 'kode_kelas';
    public $timestamps = false;

    protected $fillable = [
        'kode_sesi',
        'mata_kuliah',
        'pengajar',
        'tanggal',
        'jam',
        'ruang_kelas',
        'status_kelas',
        'jumlah_peserta_hadir',
        'modul',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'kode_kelas', 'kode_kelas');
    }

    // Convenience helpers for the module lock logic
    public function isSelesai(): bool
    {
        return $this->status_kelas === 'Selesai';
    }

    public function isBerlangsung(): bool
    {
        return $this->status_kelas === 'Berlangsung';
    }
}