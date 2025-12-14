<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_array($cek);

    if ($data) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['id_users'] = $data['id_users'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $data['role'];

            if ($data['role'] == 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../user/index.php");
            }
            exit;
        } else {
            echo "<script>alert('Password salah!');window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
    <br>
    Belum punya akun? <a href="register.php">Daftar</a>
</body>
</html>
