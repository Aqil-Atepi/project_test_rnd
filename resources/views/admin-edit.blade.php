<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
</head>
<body>
    <h1>Edit Kelas</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.kelas.update', $kelas->kode_kelas) }}">
        @csrf
        @method('PUT')

        <label for="mata_kuliah">Mata Kuliah</label>
        <input id="mata_kuliah" type="text" name="mata_kuliah"
               value="{{ old('mata_kuliah', $kelas->mata_kuliah) }}" required>

        <label for="pengajar">Pengajar</label>
        <input id="pengajar" type="text" name="pengajar"
               value="{{ old('pengajar', $kelas->pengajar) }}" required>

        <label for="tanggal">Tanggal</label>
        <input id="tanggal" type="date" name="tanggal"
               value="{{ old('tanggal', $kelas->tanggal->format('Y-m-d')) }}" required>

        <label for="jam">Jam</label>
        <input id="jam" type="time" name="jam"
               value="{{ old('jam', \Carbon\Carbon::parse($kelas->jam)->format('H:i')) }}" required>

        <label for="ruang_kelas">Ruang Kelas</label>
        <input id="ruang_kelas" type="text" name="ruang_kelas"
               value="{{ old('ruang_kelas', $kelas->ruang_kelas) }}" required>

        <label for="kode_sesi">Kode Sesi </label>
        <input id="kode_sesi" type="text" name="kode_sesi"
               value="{{ old('kode_sesi', $kelas->kode_sesi) }}" required>

        <label for="modul">Link Modul</label>
        <input id="modul" type="url" name="modul"
               value="{{ old('modul', $kelas->modul) }}" required>

        <label for="status_kelas">Status Kelas</label>
        <select id="status_kelas" name="status_kelas" required>
            @foreach (['Belum Mulai', 'Berlangsung', 'Selesai'] as $status)
                <option value="{{ $status }}"
                    @selected(old('status_kelas', $kelas->status_kelas) === $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('admin') }}">Batal</a>
    </form>
</body>
</html>