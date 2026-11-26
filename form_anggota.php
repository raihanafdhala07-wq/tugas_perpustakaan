<?php
$status = isset($_GET["status"]) ? $_GET["status"] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color : #1f3864; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        label.pilihan { display: inline; font-weight: normal; margin-right: 16px; }
        input[type="text"], select, textarea {width: 320px: padding: 6px; }
        button {margin-top: 16px; padding: 8px 20px; }
        .sukses { background: #e6f4ea; border-left: 5px solid #2e7d32; padding: 10px; width: 320px; }
    </style>
</head>
<body>
    <h1>Pendaftaran Anggota Perpustakaan</h1>

    <?php if ($status=== "sukses") { ?>
        <p class="sukses">Data anggota berhasil disimpan.</p>
        <?php } ?>
        
    <form action="data.php" method="post">
        <button type="submit">Lihat Data Anggota</button>
    </form>    
    <form action="proses_anggota.php" method="post">
        <label for="no_anggota">No. Anggota</label><br>
        <input type="text" id="no_anggota" name="no_anggota"><br>
        <label for="nama">Nama Lengkap</label><br>
        <input type="text" id="nama" name="nama"><br>
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="no_hp">No. Handphone</label><br>
        <input type="text" name="no_hp" id="no_hp"><br>
        <label for="jenis_anggota">Jenis Anggota</label>
        <select id="jenis_anggota" name="jenis_anggota">
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="tenaga_kependidikan">Tenaga Kependidikan</option>
        </select><br>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="4"></textarea><br>

        <button type="submit">Simpan</button>
    </form>
    
</body>
</html>
