<?php
include 'config/koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM film WHERE id_film=$id");

header("Location: kelola_film.php");
?>
