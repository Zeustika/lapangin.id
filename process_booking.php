<?php
include 'koneksi.php';

// Periksa apakah ID Booking diberikan melalui parameter URL
if (!isset($_GET['id_booking'])) {
    echo "ID Booking tidak diberikan.";
    exit();
}

$id_booking = $_GET['id_booking'];

// Di sini Anda dapat melanjutkan dengan proses pembayaran untuk ID Booking yang diberikan
// Misalnya, Anda dapat mengonfirmasi pembayaran dan memperbarui status pembayaran di database
// Anda juga dapat menambahkan logika lain yang diperlukan untuk proses pembayaran

// Contoh: Update status pembayaran menjadi 'Sudah Bayar'
$sql = "UPDATE Booking SET status_pembayaran = 'Sudah Bayar' WHERE id_booking = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_booking);
if ($stmt->execute()) {
    echo "Status pembayaran berhasil diperbarui.";
} else {
    echo "Terjadi kesalahan dalam memperbarui status pembayaran: " . $mysqli->error;
}
$stmt->close();
?>
    <link rel="icon" type="image/png" href="img/bill.png"/>