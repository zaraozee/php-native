<?php
include 'config/koneksi.php';

$judul  = $_POST['judul'];
$durasi = $_POST['durasi'];
$genre  = $_POST['genre'];

$poster = $_FILES['poster']['name'];
$tmp    = $_FILES['poster']['tmp_name'];

move_uploaded_file($tmp, "poster/img2.png" . $poster);

mysqli_query($koneksi, "INSERT INTO film (judul, durasi, genre, poster) 
                        VALUES ('$judul', '$durasi', '$genre', '$poster')");

header("Location: kelola_film.php");
?>
