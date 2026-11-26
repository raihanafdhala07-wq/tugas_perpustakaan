<?php
require_once "koneksi.php";

$id = $_GET['id'];

$query = "SELECT * FROM anggota WHERE id = ? ";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($result);

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
        input[type="text"], select, textarea {width: 320px; padding: 6px; }
        button {margin-top: 16px; padding: 8px 20px; }
        .sukses { background: #e6f4ea; border-left: 5px solid #2e7d32; padding: 10px; width: 320px; }
    </style>
</head>
<body>
    <h1>Edit Data Anggota</h1>

    <form action="proses_update.php" method="post">
        <input type="hidden" name="id"
            value="<?= $data['id']; ?>">

        <label for="no_anggota">No. Anggota</label><br>
        <input type="text" id="no_anggota" name="no_anggota"
            value="<?= htmlspecialchars($data['no_anggota']); ?>"
            maxlength="15" required><br>

        <label for="nama">Nama Lengkap</label><br>
        <input type="text" name="nama_lengkap"
            value="<?= htmlspecialchars($data['nama_lengkap']); ?>"><br>

        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"
            value="<?= htmlspecialchars($data['email']); ?>"><br>

        <label for="no_hp">No. Handphone</label><br>
        <input type="text" name="no_hp" id="no_hp"
            value="<?= htmlspecialchars($data['no_hp']); ?>"><br>

        <label for="jenis_anggota">Jenis Anggota</label>
        <select id="jenis_anggota" name="jenis_anggota" required>

            <option value="mahasiswa"
                <?= $data['jenis_anggota'] == "Mahasiswa" ? "selected" : ""; ?>>Mahasiswa
            </option>

            <option value="dosen"
                <?= $data['jenis_anggota'] == "Dosen" ? "selected" : ""; ?>> Dosen
            </option>
                 
            <option value="Tenaga Kependidikan"
                <?= $data['jenis_anggota'] == "Tenaga Kependidikan" ? "selected" : ""; ?>> Tenaga Kependidikan
            </option>
                
        </select><br>

         <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="4"><?php echo htmlspecialchars($data['alamat']); ?></textarea><br>

        <button type="submit">Simpan</button><br>

        <a href="data.php">Kembali</a>
    </form>
    
</body>
</html>