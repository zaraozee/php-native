<?php
include 'config/koneksi.php';

$id     = $_POST['id_film'];
$judul  = $_POST['judul'];
$durasi = $_POST['durasi'];
$genre  = $_POST['genre'];

if (!empty($_FILES['poster']['name'])) {
    $poster = $_FILES['poster']['name'];
    $tmp    = $_FILES['poster']['tmp_name'];
    move_uploaded_file($tmp, "poster/img1.png" . $poster);

    mysqli_query($koneksi, "UPDATE film SET judul='$judul', durasi='$durasi', genre='$genre', poster='$poster' WHERE id_film=$id");
} else {
    mysqli_query($koneksi, "UPDATE film SET judul='$judul', durasi='$durasi', genre='$genre' WHERE id_film=$id");
}

header("Location: kelola_film.php");
?>
