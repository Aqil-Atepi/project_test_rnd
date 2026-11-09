<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'kode_attendance';
    public $timestamps = false;

    protected $fillable = [
        'kode_kelas',
        'nama_mahasiswa',
        'nim',
        'status_attendance',
    ];

    protected static function booted(): void
    {
        static::saved(fn (Attendance $a) => $a->syncJumlahHadir());
        static::deleted(fn (Attendance $a) => $a->syncJumlahHadir());
    }

    public function syncJumlahHadir(): void
    {
        SesiKelas::where('kode_kelas', $this->kode_kelas)->update([
            'jumlah_peserta_hadir' => static::where('kode_kelas', $this->kode_kelas)->count(),
        ]);
    }

    public function sesiKelas(): BelongsTo
    {
        return $this->belongsTo(SesiKelas::class, 'kode_kelas', 'kode_kelas');
    }
}