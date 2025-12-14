<?php
session_start();
include '../config/koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data pesanan user
$riwayat = mysqli_query($koneksi, "SELECT p.*, f.judul, j.tanggal, j.jam, s.nama_studio 
    FROM pesanan p
    JOIN jadwal j ON p.id_jadwal=j.id_jadwal
    JOIN film f ON j.id_film=f.id_film
    JOIN studio s ON j.id_studio=s.id_studio
    WHERE p.id_user='$id_user'
    ORDER BY p.tanggal_pesan DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan</title>
</head>
<body>
    <h2>Riwayat Pemesanan Tiket</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Film</th>
            <th>Studio</th>
            <th>Jadwal</th>
            <th>Tanggal Pesan</th>
            <th>Kursi</th>
            <th>Aksi</th>
        </tr>
        <?php while($d = mysqli_fetch_array($riwayat)){ ?>
        <tr>
            <td><?= $d['judul'] ?></td>
            <td><?= $d['nama_studio'] ?></td>
            <td><?= $d['tanggal'] ?> <?= $d['jam'] ?></td>
            <td><?= $d['tanggal_pesan'] ?></td>
            <td>
                <?php
                $kursi = mysqli_query($koneksi, "SELECT k.nomor_kursi 
                    FROM pesanan_kursi pk 
                    JOIN kursi k ON pk.id_kursi=k.id_kursi 
                    WHERE pk.id_pesanan='{$d['id_pesanan']}'");
                while($k = mysqli_fetch_array($kursi)){
                    echo $k['nomor_kursi'] . " ";
                }
                ?>
            </td>
            <td>
                <a href="cetak_tiket.php?id=<?= $d['id_pesanan'] ?>" target="_blank">Cetak Tiket</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="index.php">Kembali ke Beranda</a>
</body>
</html>
