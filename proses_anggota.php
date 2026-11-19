<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form_anggota.php");
    exit;
}

$no_anggota    = isset($_POST["no_anggota"]) ? trim($_POST["no_anggota"]) : "";
$nama          = isset($_POST["nama"]) ? trim($_POST["nama"]) : "";
$email         = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$no_hp         = isset($_POST["no_hp"]) ? trim($_POST["no_hp"]) : "";
$jenis_anggota = isset($_POST["jenis_anggota"]) ? trim($_POST["jenis_anggota"]) : "";
$alamat        = isset($_POST["alamat"]) ? trim($_POST["alamat"]) : "";

$daftar_jenis = array("mahasiswa", "dosen", "tenaga_kependidikan");
$errors       = array();

if (empty($no_anggota)) {
    $errors[] = "No. Anggota tidak boleh kosong.";
}
if (empty($nama)) {
    $errors[] = "Nama lengkap tidak boleh kosong.";
}
if (empty($email)) {
    $errors[] = "Email tidak boleh kosong.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}
if (empty($no_hp)) {
    $errors[] = "No. Handphone tidak boleh kosong.";
} elseif (!ctype_digit($no_hp)) {
    $errors[] = "No. Handphone hanya boleh berisi angka.";
}
if (empty($jenis_anggota)) {
    $errors[] = "Jenis anggota wajib dipilih.";
} elseif (!in_array($jenis_anggota, $daftar_jenis, true)) {
    $errors[] = "Jenis anggota tidak valid.";
}
if (empty($alamat)) {
    $errors[] = "Alamat tidak boleh kosong.";
}

if (empty($errors)) {
    
    require_once "koneksi.php";

    $sql = "INSERT INTO anggota (no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat) 
            VALUES (?, ?, ?, ?, ?, ?)";
            
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $no_anggota, $nama, $email, $no_hp, $jenis_anggota, $alamat);

        if (mysqli_stmt_execute($stmt)) {
            // Berhasil disimpan
            mysqli_stmt_close($stmt);
            mysqli_close($koneksi);
            
            // Redirect kembali ke form dengan status sukses
            header("Location: form_anggota.php?status=sukses");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $errors[] = "Error pada statement query: " . mysqli_error($koneksi);
    }
    
    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Validasi Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        .gagal { background: #fdecea; border-left: 5px solid #c0392b; padding: 10px; }
        a { color: #1f3864; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Data Gagal Disimpan</h1>
    <p class="gagal">Terjadi kesalahan, perbaiki poin berikut:</p>
    <ul>
        <?php foreach ($errors as $pesan) { ?>
            <li><?php echo htmlspecialchars($pesan); ?></li>
        <?php } ?>
    </ul>

    <p><a href="javascript:history.back()">Kembali dan perbaiki data</a></p>
</body>
</html>