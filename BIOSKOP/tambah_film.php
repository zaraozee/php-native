<h2>Tambah Film</h2>
<form action="simpan_film.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="judul" placeholder="Judul Film" required><br>
    <input type="number" name="durasi" placeholder="Durasi (menit)" required><br>
    <input type="text" name="genre" placeholder="Genre" required><br>
    <input type="file" name="poster" accept="image/*" required><br>
    <button type="submit">Simpan</button>
</form>
