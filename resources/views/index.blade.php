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

    <div>
        <p>Ini Cursor Guys</p>
    </div>

    <div>
        <p>List Kelas</p>

        <div class="list-kelas">
            <div>
                <p>Kelas</p>
                <p>Pengajar</p>
                <p>Tanggal</p>
                <p>Status</p>
                <p>Modul</p>
            </div>
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