<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Main Page</h1>

    @auth
        <a href="{{ route('admin') }}">Dashboard Admin</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endauth

    <div>
        <p>Ini Cursor Guys</p>
    </div>

    <div>
        <p>List Kelas</p>

        <form method="GET" action="{{ route('home') }}">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari Sesi Kelas...">
            <button type="submit">Cari</button>
        </form>

        <div class="list-kelas">
            @forelse ($kelas as $k)
                <div class="kelas-card">
                    <p>Kelas: {{ $k->mata_kuliah }}</p>
                    <p>Pengajar: {{ $k->pengajar }}</p>
                    <p>Tanggal: {{ $k->tanggal->format('d M Y') }}, {{ \Carbon\Carbon::parse($k->jam)->format('H:i') }}</p>
                    <p>Ruang: {{ $k->ruang_kelas }}</p>

                    <p>Status:
                        @if ($k->isBerlangsung())
                            Berlangsung
                        @elseif ($k->isSelesai())
                            Selesai
                        @else
                            Belum Mulai
                        @endif
                    </p>

                    <p>Peserta Hadir: {{ $k->hadir_count }}</p>

                    <p>Modul:
                        @if ($k->isSelesai() && $k->modul)
                            <a href="{{ $k->modul }}" target="_blank">Download Modul</a>
                        @else
                            Modul dibuka setelah sesi selesai
                        @endif
                    </p>
                </div>
            @empty
                <p>Tidak ada kelas ditemukan.</p>
            @endforelse
        </div>
    </div>

    <div>
        <p>Presensi</p>

        <form>
            @csrf

            <label>Nama Panjang Mahasiswa</label>
            <input id="nama_mahasiswa" type="text" required>

            <label>NIM Mahasiswa</label>
            <input id="nim_mahasiswa" type="text" required>

            <label>Kode Sesi</label>
            <input id="kode_sesi" type="text" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>