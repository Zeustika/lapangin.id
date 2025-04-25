<?php
session_start();
include 'koneksi.php';

// Redirect to login if not logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("location: login_pengguna.php");
    exit;
}

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
        $success_message = "Lapangan berhasil ditambahkan.";
    } else {
        $error_message = "Terjadi kesalahan: " . $mysqli->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/bill.png"/>
    <title>Tambah Lapangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {

            background: url('img/nack.avif');
            background-size: 30%;
        }
        .card-body {
            background: url('img/nack.avif');
            border-radius: 10px;
        }
        .text-center {
            color: #fff;
            font-family: "Times New Roman", Times, serif;
        }
        .text-center{
            color: #fff;
        }
        .container {
            background-color: #6c757d;
            border-radius: 5px;
            padding: 30px;
        }
        .btn btn-secondary mt-3{
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Lapangan</h1>
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php elseif (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-4">
            <div class="form-group">
                <label for="nama_lapangan">Nama Lapangan:</label>
                <input type="text" id="nama_lapangan" name="nama_lapangan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jenis_lapangan">Jenis Lapangan:</label>
                <select name="jenis_lapangan" id="jenis_lapangan" class="form-control">
                    <option value="VIP">VIP</option>
                    <option value="Basic">Basic</option>
                </select>
            </div>
            <div class="form-group">
                <label for="harga_sewa">Harga Sewa:</label>
                <input type="number" id="harga_sewa" name="harga_sewa" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Lapangan</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Kembali ke Dashboard Admin</a>
    </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
