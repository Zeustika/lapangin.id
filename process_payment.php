<?php
include 'koneksi.php';

// Periksa apakah ID Booking diberikan melalui parameter URL
if (!isset($_GET['id_booking'])) {
    echo "ID Booking tidak diberikan.";
    exit();
}

$id_booking = $_GET['id_booking'];

// Perbarui status pembayaran menjadi 'Sudah Bayar'
$sql = "UPDATE Booking SET status_pembayaran = 'Sudah Bayar' WHERE id_booking = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    // Jika kueri tidak berhasil disiapkan
    echo "Terjadi kesalahan dalam menyiapkan kueri: " . $mysqli->error;
    exit();
}

$stmt->bind_param("i", $id_booking);
$result = $stmt->execute();

if ($result === false) {
    // Jika eksekusi kueri gagal
    echo "Terjadi kesalahan dalam mengeksekusi kueri: " . $mysqli->error;
    exit();
}

// Periksa apakah satu baris data berhasil diperbarui
if ($stmt->affected_rows > 0) {
    echo "Status pembayaran berhasil diperbarui.<br>";
    // Tampilkan tombol untuk kembali ke dashboard admin
    echo "<a href='admin_dashboard.php'>Kembali ke Dashboard Admin</a>";
} else {
    echo "ID Booking tidak ditemukan atau status pembayaran sudah terupdate.";
}

$stmt->close();
?>
    <link rel="icon" type="image/png" href="img/bill.png"/>