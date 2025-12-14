<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// Ambil data pesanan
$data = mysqli_fetch_array(mysqli_query($koneksi, 
    "SELECT p.*, u.nama, f.judul, j.tanggal, j.jam, s.nama_studio 
     FROM pesanan p
     JOIN users u ON p.id_user = u.id_user
     JOIN jadwal j ON p.id_jadwal = j.id_jadwal
     JOIN film f ON j.id_film = f.id_film
     JOIN studio s ON j.id_studio = s.id_studio
     WHERE p.id_pesanan = '$id'"));

// Ambil kursi yang dipesan
$kursi = mysqli_query($koneksi, 
    "SELECT k.nama_kursi 
     FROM pesanan_kursi pk 
     JOIN kursi k ON pk.id_kursi = k.id_kursi
     WHERE pk.id_pesanan = '$id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Tiket</title>
</head>
<body onload="window.print()">
    <h2>Tiket Bioskop</h2>
    <p><b>Nama:</b> <?= $data['nama'] ?></p>
    <p><b>Film:</b> <?= $data['judul'] ?></p>
    <p><b>Studio:</b> <?= $data['nama_studio'] ?></p>
    <p><b>Jadwal:</b> <?= $data['tanggal'] ?> <?= $data['jam'] ?></p>
    <p><b>Kursi:</b> 
        <?php while($k = mysqli_fetch_array($kursi)){ echo $k['nama_kursi']." "; } ?>
    </p>
    <p><i>Tunjukkan tiket ini saat masuk studio</i></p>
</body>
</html>
