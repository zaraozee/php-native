<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <?= $_SESSION['username'] ?> | <a href="logout.php">Logout</a></p>
    <hr>
    <ul>
        <li><a href="kelola_film.php">Kelola Film</a></li>
        <li><a href="kelola_jadwal.php">Kelola Jadwal</a></li>
        <li><a href="laporan.php">Laporan</a></li>
    </ul>
</body>
</html>
