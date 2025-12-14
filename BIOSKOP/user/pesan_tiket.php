<?php
session_start();
include '../config/koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Kalau user klik pesan tiket
if (isset($_POST['pesan'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $kursi = $_POST['kursi']; // array kursi yang dipilih
    $tgl_pesan = date("Y-m-d H:i:s");

    // Hitung total harga (contoh fix harga Rp 35.000 per kursi)
    $harga_per_kursi = 35000;
    $total_harga = count($kursi) * $harga_per_kursi;

    // Simpan ke tabel pesanan
    mysqli_query($koneksi, "INSERT INTO pesanan (id_user, id_jadwal, tanggal_pesan, status, total_harga) VALUES 
    ('$id_user','$id_jadwal','$tgl_pesan','paid','$total_harga')");

    $id_pesanan = mysqli_insert_id($koneksi);

    // Simpan kursi yang dipilih
    foreach ($kursi as $k) {
        mysqli_query($koneksi, "INSERT INTO pesanan_kursi (id_pesanan, id_kursi) VALUES 
        ('$id_pesanan','$k')");
    }

    echo "<script>alert('Tiket berhasil dipesan!');window.location='riwayat.php';</script>";
}

// Tampilkan daftar jadwal film
$jadwal = mysqli_query($koneksi, "SELECT j.*, f.judul, s.nama_studio 
    FROM jadwal j 
    JOIN film f ON j.id_film=f.id_film 
    JOIN studio s ON j.id_studio=s.id_studio");
?>

<h2>Pilih Jadwal Film</h2>
<form method="POST">
    <select name="id_jadwal" required>
        <?php while($d = mysqli_fetch_array($jadwal)){ ?>
            <option value="<?= $d['id_jadwal'] ?>">
                <?= $d['judul'] ?> | <?= $d['tanggal'] ?> <?= $d['jam'] ?> | Studio: <?= $d['nama_studio'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    Pilih Kursi: <br>
    <?php
    // Tampilkan kursi yang belum dipesan
    $kursi = mysqli_query($koneksi, "
        SELECT k.* FROM kursi k
        WHERE k.id_kursi NOT IN (
            SELECT pk.id_kursi FROM pesanan_kursi pk
        )
    ");
    while($k = mysqli_fetch_array($kursi)){
        echo "<input type='checkbox' name='kursi[]' value='{$k['id_kursi']}'> {$k['nama_kursi']} ";
    }
    ?>
    <br><br>
    <button type="submit" name="pesan">Pesan Tiket</button>
</form>
