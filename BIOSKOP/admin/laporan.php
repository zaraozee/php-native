<?php
include '../config/koneksi.php';

$query = "
    SELECT p.*, u.nama, f.judul, j.tanggal, j.jam, s.nama_studio 
    FROM pesanan p
    JOIN users u ON p.id_user = u.id_user
    JOIN jadwal j ON p.id_jadwal = j.id_jadwal
    JOIN film f ON j.id_film = f.id_film
    JOIN studio s ON j.id_studio = s.id_studio
    ORDER BY p.tanggal_pesan DESC
";
$laporan = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemesanan</title>
</head>
<body>
    <h2>Laporan Pemesanan Tiket</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr style="background:#eee;">
            <th>Nama User</th>
            <th>Film</th>
            <th>Studio</th>
            <th>Jadwal</th>
            <th>Tanggal Pesan</th>
        </tr>
        <?php while($d = mysqli_fetch_array($laporan)) { ?>
        <tr>
            <td><?= $d['nama'] ?></td>
            <td><?= $d['judul'] ?></td>
            <td><?= $d['nama_studio'] ?></td>
            <td><?= $d['tanggal'] ?> <?= $d['jam'] ?></td>
            <td><?= $d['tanggal_pesan'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
