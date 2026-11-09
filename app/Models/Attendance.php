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

    public function sesiKelas(): BelongsTo
    {
        return $this->belongsTo(SesiKelas::class, 'kode_kelas', 'kode_kelas');
    }
}