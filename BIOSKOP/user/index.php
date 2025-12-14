<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>
    <h2>Dashboard User</h2>
    <p>Selamat datang, <?= $_SESSION['username']; ?> 👋</p>
    <hr>

    <h3>Menu</h3>
    <ul>
        <li><a href="pesan_tiket.php">Pesan Tiket</a></li>
        <li><a href="riwayat.php">Riwayat Pemesanan</a></li>
        <li><a href="cetak_tiket.php">Cetak Tiket</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
