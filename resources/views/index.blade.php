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

                    <p>Peserta Hadir: {{ $k->jumlah_peserta_hadir }}</p>

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

        <h3>Check-In</h3>

        @if (session('success_checkin'))
            <p style="color: green;">{{ session('success_checkin') }}</p>
        @endif

        @if ($errors->checkin->any())
            <ul style="color: red;">
                @foreach ($errors->checkin->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @php $kelasLive = $kelas->where('status_kelas', 'Berlangsung'); @endphp

        @if ($kelasLive->isEmpty())
            <p>Tidak ada kelas yang sedang berlangsung.</p>
        @else
            <form method="POST" action="{{ route('attendance.checkin') }}">
                @csrf

                <label for="kode_kelas">Kelas</label>
                <select id="kode_kelas" name="kode_kelas" required>
                    @foreach ($kelasLive as $live)
                        <option value="{{ $live->kode_kelas }}" @selected(old('kode_kelas') == $live->kode_kelas)>
                            {{ $live->mata_kuliah }}
                        </option>
                    @endforeach
                </select>

                <label for="nama_mahasiswa">Nama Panjang Mahasiswa</label>
                <input id="nama_mahasiswa" type="text" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" required>

                <label for="nim_checkin">NIM Mahasiswa</label>
                <input id="nim_checkin" type="text" name="nim" value="{{ old('nim') }}" required>

                <button type="submit">Check-In</button>
            </form>
        @endif

        <h3>Check-Out</h3>

        @if (session('success_checkout'))
            <p style="color: green;">{{ session('success_checkout') }}</p>
        @endif

        @if ($errors->checkout->any())
            <ul style="color: red;">
                @foreach ($errors->checkout->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('attendance.checkout') }}">
            @csrf

            <label for="nim_checkout">NIM Mahasiswa</label>
            <input id="nim_checkout" type="text" name="nim" required>

            <label for="kode_sesi">Kode Sesi</label>
            <input id="kode_sesi" type="text" name="kode_sesi" required>

            <button type="submit">Check-Out</button>
        </form>
    </div>
</body>

</html>