<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Admin Page</h1>

    <div>
        <p>Tambah Kelas</p>

        <form>
            @csrf

            <label>Mata Kuliah</label>
            <input id="matakuliah" type="text" required>

            <label>Pengajar</label>
            <input id="pengajar" type="text" required>

            <label>Tanggal</label>
            <input id="tanggal" type="date" required>

            <label>Kode Sesi</label>
            <input id="kode_sesi" type="text" required>

            <label>Modul</label>
            <input id="link_modul" type="text" required>

            <button type="submit">Tambah Kelas</button>
        </form>
    </div>

    <div>
        <p>List Kelas</p>

        <div>
            <p>Kelas</p>
            <p>Pengajar</p>
            <p>Tanggal</p>
            <p>Modul</p>
            <a>Edit</a>
            <a>Hapus</a>
        </div>
    </div>
</body>
</html>