<?php
require_once "koneksi.php";

$sql = "SELECT * FROM anggota";
$hasil = mysqli_query($koneksi, $sql);
$jumlah = mysqli_num_rows($hasil);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #333333;
            padding: 10px 12px;
            text-align: left;
        }
    </style>
</head>
<body>
    <a href="form_anggota.php">Kembali ke Form Anggota</a>
    <table>
        <tr>
            <th>Id</th><th>No.Anggota</th><th>Nama Lengkap</th><th>Email</th><th>No.HP</th><th>Jenis Anggota</th><th>Alamat</th><th>Aksi</th>
        </tr>
        <?php $no = 1; while ($baris = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($baris['no_anggota']); ?></td>
            <td><?php echo htmlspecialchars($baris['nama_lengkap']); ?></td>
            <td><?php echo htmlspecialchars($baris['email']); ?></td>
            <td><?php echo htmlspecialchars($baris['no_hp']); ?></td>
            <td><?php echo htmlspecialchars($baris['jenis_anggota']); ?></td>
            <td><?php echo htmlspecialchars($baris['alamat']); ?></td>
            <td>
                <a href="edit_anggota.php?id=<?= $baris['id']; ?>">
                    Edit
                </a>
                <a href="detail.php?id=<?php echo (int) $baris["id"]; ?>">Detail</a><br>

                <form action="hapus_anggota.php" method="post" style="display:inline;"
                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                <input type="hidden" name="id" value="<?= (int) $baris['id']; ?>">
                <button type="submit">Hapus</button>
            </form>
            </td>
        </tr>
        <?php } ?>
    </table>  
    <?php mysqli_free_result($hasil); ?>
</body>
</html>