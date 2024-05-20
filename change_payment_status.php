<?php
include 'koneksi.php';

// Pastikan hanya admin yang bisa mengakses halaman ini
// Anda dapat menggunakan sistem autentikasi yang sesuai
// Misalnya, periksa apakah sesi admin telah diinisialisasi
session_start();
if (!isset($_SESSION['admin'])) {
    // Redirect ke halaman login admin jika tidak ada sesi admin
    header("Location: login_admin.php");
    exit();
}

// Ambil daftar booking yang belum dibayar
$sql = "SELECT id_booking FROM Booking WHERE status_pembayaran = 'Belum Bayar'";
$result = $mysqli->query($sql);

// Cek apakah ada booking yang belum dibayar
if ($result->num_rows > 0) {
    // Tampilkan form untuk memilih ID Booking yang akan diubah status pembayarannya
    echo "<h1>Change Payment Status</h1>";
    echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='get'>";
    echo "<label for='id_booking'>Pilih ID Booking:</label><br>";
    echo "<select name='id_booking' id='id_booking'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id_booking"] . "'>" . $row["id_booking"] . "</option>";
    }
    echo "</select><br><br>";
    echo "<input type='submit' value='Pilih'>";
    echo "</form>";
} else {
    echo "Tidak ada booking yang belum dibayar.";
}

// Periksa apakah metode GET digunakan untuk mengambil ID Booking yang dipilih
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_booking'])) {
    $id_booking = $_GET['id_booking'];
    // Redirect ke halaman proses pembayaran dengan menyertakan ID Booking yang dipilih
    header("Location: process_payment.php?id_booking=$id_booking");
    exit();
}
?>
