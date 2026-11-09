<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>

<body>
    <h1>Admin Page</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        <p>Tambah Kelas</p>

        <form method="POST" action="{{ route('admin.kelas.store') }}">
            @csrf

            <label for="mata_kuliah">Mata Kuliah</label>
            <input id="mata_kuliah" type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}" required>

            <label for="pengajar">Pengajar</label>
            <input id="pengajar" type="text" name="pengajar" value="{{ old('pengajar') }}" required>

            <label for="tanggal">Tanggal</label>
            <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal') }}" required>

            <label for="jam">Jam</label>
            <input id="jam" type="time" name="jam" value="{{ old('jam') }}" required>

            <label for="ruang_kelas">Ruang Kelas</label>
            <input id="ruang_kelas" type="text" name="ruang_kelas" value="{{ old('ruang_kelas') }}" required>

            <label for="kode_sesi">Kode Sesi (untuk Check-Out)</label>
            <input id="kode_sesi" type="text" name="kode_sesi" value="{{ old('kode_sesi') }}" required>

            <label for="modul">Link Modul</label>
            <input id="modul" type="url" name="modul" value="{{ old('modul') }}" required>

            <button type="submit">Tambah Kelas</button>
        </form>
    </div>

    <div>
        <p>List Kelas</p>

        @forelse ($kelas as $k)
            <div>
                <p>Kelas: {{ $k->mata_kuliah }} ({{ $k->kode_sesi }})</p>
                <p>Pengajar: {{ $k->pengajar }}</p>
                <p>Tanggal: {{ $k->tanggal->format('d M Y') }}, {{ \Carbon\Carbon::parse($k->jam)->format('H:i') }}</p>
                <p>Ruang: {{ $k->ruang_kelas }}</p>
                <p>Status: {{ $k->status_kelas }}</p>
                <p>Modul: {{ $k->modul ?: '-' }}</p>
                <a href="{{ route('admin.kelas.edit', $k->kode_kelas) }}">Edit</a>

                <form method="POST" action="{{ route('admin.kelas.destroy', $k->kode_kelas) }}" style="display:inline;"
                    onsubmit="return confirm('Hapus kelas {{ $k->mata_kuliah }}? Data presensi kelas ini juga akan terhapus.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </div>
        @empty
            <p>Belum ada kelas.</p>
        @endforelse
    </div>
</body>

</html>