<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah terdaftar!');window.location='register.php';</script>";
    } else {
        mysqli_query($koneksi, "INSERT INTO users (nama,username,password,role) 
                                VALUES ('$nama','$username','$password','user')");
        echo "<script>alert('Registrasi berhasil, silakan login!');window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        Nama: <input type="text" name="nama" required><br><br>
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit" name="register">Daftar</button>
    </form>
    <br>
    Sudah punya akun? <a href="login.php">Login</a>
</body>
</html>
