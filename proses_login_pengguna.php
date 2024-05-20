<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah login sebagai admin
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    }

    // Kueri SQL untuk memeriksa apakah pengguna ada di tabel akun_pengguna
    $stmt = $mysqli->prepare("SELECT id_pengguna, username, password FROM akun_pengguna WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id_pengguna, $db_username, $db_password);
        $stmt->fetch();
        // Verifikasi password
        if (password_verify($password, $db_password)) {
            // Sesi login pengguna
            $_SESSION['id_pengguna'] = $id_pengguna;
            $_SESSION['username'] = $db_username;
            header("Location: dashboard_pengguna.php");
            exit();
        } else {
            // Jika password tidak cocok
            echo "Invalid username or password";
        }
    } else {
        // Jika pengguna tidak ditemukan dalam tabel akun_pengguna
        echo "Invalid username or password";
    }

    $stmt->close();
} else {
    // Jika metode HTTP bukan POST, arahkan ke halaman login pengguna
    header("Location: login_pengguna.php");
    exit();
}
?>
