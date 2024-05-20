<?php
include 'koneksi.php';

// Proses tambah lapangan jika metode POST digunakan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lapangan = $_POST['nama_lapangan'];
    $jenis_lapangan = $_POST['jenis_lapangan'];
    $harga_sewa = $_POST['harga_sewa'];
    $kapasitas_pemain = $_POST['kapasitas_pemain'];

    // Masukkan data lapangan ke dalam database
    $sql = "INSERT INTO Lapangan (nama_lapangan, jenis_lapangan, harga_sewa, kapasitas_pemain) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssii", $nama_lapangan, $jenis_lapangan, $harga_sewa, $kapasitas_pemain);
    if ($stmt->execute()) {
        echo "Lapangan berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan: " . $mysqli->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lapangan</title>
</head>
<body>
    <h1>Tambah Lapangan</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nama_lapangan">Nama Lapangan:</label><br>
        <input type="text" id="nama_lapangan" name="nama_lapangan" required><br><br>

        <label for="jenis_lapangan">Jenis Lapangan:</label><br>
        <select name="jenis_lapangan" id="jenis_lapangan">
            <option value="Futsal">Futsal</option>
            <option value="Badminton">Badminton</option>
        </select><br><br>

        <label for="harga_sewa">Harga Sewa:</label><br>
        <input type="number" id="harga_sewa" name="harga_sewa" required><br><br>

        <label for="kapasitas_pemain">Kapasitas Pemain:</label><br>
        <input type="number" id="kapasitas_pemain" name="kapasitas_pemain" required><br><br>

        <input type="submit" value="Tambah Lapangan">
    </form>

    <!-- Tombol kembali ke dashboard admin -->
    <a href="admin_dashboard.php">Kembali ke Dashboard Admin</a>
</body>
</html>
