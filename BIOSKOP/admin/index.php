<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <?= $_SESSION['username']; ?> 👋</p>
    <hr>

    <h3>Menu</h3>
    <ul>
        <li><a href="kelola_film.php">Kelola Film</a></li>
        <li><a href="kelola_jadwal.php">Kelola Jadwal</a></li>
        <li><a href="laporan.php">Laporan Pemesanan</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
