<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mahasiswa</title>
</head>

<body>
    <h1>List Mahasiswa</h1>

    <p>Kelas: {{ $kelas->mata_kuliah }} ({{ $kelas->kode_sesi }})</p>
    <p>Pengajar: {{ $kelas->pengajar }}</p>
    <p>Tanggal: {{ $kelas->tanggal->format('d M Y') }}, {{ \Carbon\Carbon::parse($kelas->jam)->format('H:i') }}</p>
    <p>Status Kelas: {{ $kelas->status_kelas }}</p>
    <p>Total peserta: {{ $peserta->count() }}</p>

    <a href="{{ route('admin') }}">Kembali</a>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peserta as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_mahasiswa }}</td>
                    <td>{{ $p->nim }}</td>
                    <td>
                        @if ($p->status_attendance === 'Hadir Penuh')
                            Hadir Penuh
                        @else
                            Check-In (Belum Check-Out)
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada peserta di kelas ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>