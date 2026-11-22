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
        th {
            background-color: #2c3e50;
            color: #ffffff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        .inline {
            display: inline-block;
            margin: 0;
        }
        a {
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
            margin-right: 8px;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
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
                <a href="detail.php?id=<?php echo (int) $baris["id"]; ?>">Detail</a><br>
                <form class="inline" action="hapus.php" method="post"
                onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                <input type="hidden" name="id" value="<?php echo (int) $baris["id"]; ?>">
                <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($hasil); ?>
</body>
</html>