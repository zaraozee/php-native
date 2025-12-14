<form action="simpan_film.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="judul" placeholder="Judul Film" required><br>
    <input type="number" name="durasi" placeholder="Durasi (menit)" required><br>
    <input type="text" name="genre" placeholder="Genre" required><br>
    <input type="file" name="poster" accept="image/*" required><br>
    <button type="submit">Simpan</button>
</form>



<?php
include '../config/koneksi.php';
$film = mysqli_query($koneksi, "SELECT * FROM film");

echo "<a href='tambah_film.php'>+ Tambah Film</a><hr>";

while ($data = mysqli_fetch_array($film)) {
    echo "<h3>{$data['judul']}</h3>";
    echo "<p>{$data['durasi']} menit | Genre: {$data['genre']}</p>";
    echo "<img src='../poster/{$data['poster']}' width='80'><br>";
    echo "<a href='edit_film.php?id={$data['id_film']}'>Edit</a> | ";
    echo "<a href='hapus_film.php?id={$data['id_film']}' onclick=\"return confirm('Hapus?')\">Hapus</a>";
    echo "<hr>";
}
?>

<?php
include '../config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM film WHERE id_film=$id"));
?>

<form action="update_film.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_film" value="<?= $data['id_film'] ?>">
    <input type="text" name="judul" value="<?= $data['judul'] ?>" required><br>
    <input type="number" name="durasi" value="<?= $data['durasi'] ?>" required><br>
    <input type="text" name="genre" value="<?= $data['genre'] ?>" required><br>
    <img src="../poster/<?= $data['poster'] ?>" width="80"><br>
    <input type="file" name="poster"><br>
    <button type="submit">Update</button>
</form>

<?php
include '../config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM film WHERE id_film=$id"));
?>

<form action="update_film.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_film" value="<?= $data['id_film'] ?>">
    <input type="text" name="judul" value="<?= $data['judul'] ?>" required><br>
    <input type="number" name="durasi" value="<?= $data['durasi'] ?>" required><br>
    <input type="text" name="genre" value="<?= $data['genre'] ?>" required><br>
    <img src="../poster/<?= $data['poster'] ?>" width="80"><br>
    <input type="file" name="poster"><br>
    <button type="submit">Update</button>
</form>


<?php
include '../config/koneksi.php';

$id = $_POST['id_film'];
$judul = $_POST['judul'];
$durasi = $_POST['durasi'];
$genre = $_POST['genre'];

if ($_FILES['poster']['name']) {
    $poster = $_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'], "../poster/".$poster);
    mysqli_query($koneksi, "UPDATE film SET judul='$judul', durasi='$durasi', genre='$genre', poster='$poster' WHERE id_film=$id");
} else {
    mysqli_query($koneksi, "UPDATE film SET judul='$judul', durasi='$durasi', genre='$genre' WHERE id_film=$id");
}

header("Location: kelola_film.php");
?>

<?php
include '../config/koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM film WHERE id_film=$id");
header("Location: kelola_film.php");
?>



<!-- <?php
include 'config/koneksi.php';
$film = mysqli_query($koneksi, "SELECT * FROM film ORDER BY id_film DESC");
?>

<h2>Kelola Film</h2>
<a href="tambah_film.php">+ Tambah Film</a>
<hr>

<?php while ($data = mysqli_fetch_array($film)) : ?>
    <h3><?= $data['judul']; ?></h3>
    <p><?= $data['durasi']; ?> menit | Genre: <?= $data['genre']; ?></p>
    <img src="poster/img3.png<?= $data['poster']; ?>" width="80"><br>
    <a href="edit_film.php?id=<?= $data['id_film']; ?>">Edit</a> | 
    <a href="hapus_film.php?id=<?= $data['id_film']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    <hr>
<?php endwhile; ?>
 -->
