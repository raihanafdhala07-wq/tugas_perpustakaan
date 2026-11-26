<?php
require_once "koneksi.php";

$id            = (int) $_POST['id'];
$nama_lengkap  = $_POST['nama_lengkap'];
$email         = $_POST['email'];
$no_hp         = $_POST['no_hp'];
$jenis_anggota = $_POST['jenis_anggota'];
$alamat        = $_POST['alamat'];

$query = "UPDATE anggota 
          SET nama_lengkap = ?, email = ?, no_hp = ?, jenis_anggota = ?, alamat = ? 
          WHERE id = ?";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sssssi", $nama_lengkap, $email, $no_hp, $jenis_anggota, $alamat, $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: data.php");
    exit;
} else {
    die("Gagal mengupdate data: " . mysqli_stmt_error($stmt));
}
?>