<?php
include '../config/koneksi.php';

// --- Tambah / Update Jadwal ---
if (isset($_POST['simpan'])) {
    $film_id = $_POST['film_id'];
    $studio_id = $_POST['studio_id'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    if ($_POST['id_jadwal'] == "") {
        // Tambah jadwal baru
        mysqli_query($koneksi, "INSERT INTO jadwal (film_id, studio_id, tanggal, jam) 
                                VALUES ('$film_id','$studio_id','$tanggal','$jam')");
    } else {
        // Update jadwal
        $id = $_POST['id_jadwal'];
        mysqli_query($koneksi, "UPDATE jadwal SET film_id='$film_id', studio_id='$studio_id', 
                                tanggal='$tanggal', jam='$jam' WHERE id_jadwal=$id");
    }

    header("Location: kelola_jadwal.php");
    exit;
}

// --- Hapus Jadwal ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal=$id");
    header("Location: kelola_jadwal.php");
    exit;
}

// --- Ambil Data untuk Edit ---
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal=$id"));
}

// --- Ambil List Film & Studio untuk Dropdown ---
$filmList = mysqli_query($koneksi, "SELECT * FROM film ORDER BY judul ASC");
$studioList = mysqli_query($koneksi, "SELECT * FROM studio ORDER BY nama ASC");
?>

<h2>Kelola Jadwal</h2>

<!-- Form Tambah / Edit Jadwal -->
<form action="" method="POST">
    <input type="hidden" name="id_jadwal" value="<?= $editData['id_jadwal'] ?? '' ?>">

    <label>Film</label><br>
    <select name="film_id" required>
        <option value="">-- Pilih Film --</option>
        <?php while($f = mysqli_fetch_array($filmList)) { ?>
            <option value="<?= $f['id_film'] ?>" <?= ($editData && $editData['film_id'] == $f['id_film']) ? 'selected' : '' ?>>
                <?= $f['judul'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>Studio</label><br>
    <select name="studio_id" required>
        <option value="">-- Pilih Studio --</option>
        <?php while($s = mysqli_fetch_array($studioList)) { ?>
            <option value="<?= $s['id_studio'] ?>" <?= ($editData && $editData['studio_id'] == $s['id_studio']) ? 'selected' : '' ?>>
                <?= $s['nama'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="<?= $editData['tanggal'] ?? '' ?>" required><br><br>

    <label>Jam</label><br>
    <input type="time" name="jam" value="<?= $editData['jam'] ?? '' ?>" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<hr>

<!-- Daftar Jadwal -->
<h3>Daftar Jadwal</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Film</th>
        <th>Studio</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Aksi</th>
    </tr>
    <?php
    $jadwal = mysqli_query($koneksi, "SELECT j.*, f.judul, s.nama 
                                      FROM jadwal j
                                      JOIN film f ON j.film_id=f.id_film
                                      JOIN studio s ON j.studio_id=s.id_studio
                                      ORDER BY j.tanggal DESC, j.jam DESC");
    while ($data = mysqli_fetch_array($jadwal)) { ?>
        <tr>
            <td><?= $data['judul'] ?></td>
            <td><?= $data['nama'] ?></td>
            <td><?= $data['tanggal'] ?></td>
            <td><?= $data['jam'] ?></td>
            <td>
                <a href="kelola_jadwal.php?edit=<?= $data['id_jadwal'] ?>">Edit</a> | 
                <a href="kelola_jadwal.php?hapus=<?= $data['id_jadwal'] ?>" onclick="return confirm('Hapus jadwal ini?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>
