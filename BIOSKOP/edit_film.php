<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM film WHERE id_film=$id"));
?>

<h2>Edit Film</h2>
<form action="update_film.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_film" value="<?= $data['id_film'] ?>">
    <input type="text" name="judul" value="<?= $data['judul'] ?>" required><br>
    <input type="number" name="durasi" value="<?= $data['durasi'] ?>" required><br>
    <input type="text" name="genre" value="<?= $data['genre'] ?>" required><br>
    <img src="poster/img2.png<?= $data['poster'] ?>" width="80"><br>
    <input type="file" name="poster"><br>
    <button type="submit">Update</button>
</form>
