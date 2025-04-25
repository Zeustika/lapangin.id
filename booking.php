<?php
session_start();
include 'koneksi.php';

// Inisialisasi variabel kosong untuk menyimpan data input dari pengguna
$id_lapangan = $id_pengguna = $username = $tanggal_booking = $jam_mulai = $lama_booking = "";
$tgl_err = $jam_err = $lama_err = "";

// Periksa apakah metode POST digunakan untuk mengirimkan data form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_lapangan = trim($_POST["id_lapangan"]);
    $id_pengguna = trim($_POST["id_pengguna"]);
    $username = trim($_POST["username"]);

    // Validasi tanggal booking
    if (empty(trim($_POST["tanggal_booking"]))) {
        $tgl_err = "Please enter tanggal.";
    } else {
        $tanggal_booking = trim($_POST["tanggal_booking"]);
    }

    // Validasi jam mulai
    if (empty(trim($_POST["jam_mulai"]))) {
        $jam_err = "Please enter jam mulai.";
    } else {
        $jam_mulai = trim($_POST["jam_mulai"]);
    }

    // Validasi lama booking
    if (empty(trim($_POST["lama_booking"]))) {
        $lama_err = "Please enter lama booking.";
    } else {
        $lama_booking = trim($_POST["lama_booking"]);
    }

    // Periksa apakah tidak ada kesalahan validasi sebelum menambahkan booking baru ke database
    if (empty($tgl_err) && empty($jam_err) && empty($lama_err)) {
        // SQL statement untuk menambahkan booking baru ke database
        $sql = "INSERT INTO booking (id_lapangan, id_pengguna, username, tanggal_booking, jam_mulai, lama_booking) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("iissss", $param_idlapangan, $param_idpengguna, $param_username, $param_tanggalbooking, $param_jammulai, $param_lamabooking);
            
            // Atur parameter
            $param_idlapangan = $id_lapangan;
            $param_idpengguna = $id_pengguna;
            $param_username = $username;
            $param_tanggalbooking = $tanggal_booking;
            $param_jammulai = $jam_mulai;

            // Jika lama_booking adalah "Personal", atur sebagai teks, bukan angka
            $param_lamabooking = ($lama_booking === "Personal") ? "Personal" : $lama_booking;
            
            // Eksekusi statement
            if ($stmt->execute()) {
                // Update status lapangan
                $sql_update = "UPDATE Lapangan SET status = 'Dipesan' WHERE id_lapangan = ?";
                if ($stmt_update = $mysqli->prepare($sql_update)) {
                    $stmt_update->bind_param("i", $id_lapangan);
                    $stmt_update->execute();
                    $stmt_update->close();
                }

                echo "<div class='alert alert-success' role='alert'>Lapangan berhasil dipesan.</div>";
                // Redirect ke halaman setelah pendaftaran berhasil
                header("location: index.php");
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Oops! Something went wrong. Please try again later.</div>";
            }

            // Tutup statement
            $stmt->close();
        }
    }

    // Tutup koneksi
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('img/nack.avif') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .card {
            background-color: rgba(0, 0, 0 , 0.7);
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Form Booking Lapangan</h1>
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="id_lapangan" id="id_lapangan" value="<?php echo $_GET['id_lapangan']; ?>">
                    <input type="hidden" name="id_pengguna" id="id_pengguna" value="<?php echo $_SESSION['id_pengguna']; ?>">

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input class="form-control" type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" required readonly>
                    </div>

                    <div class="mb-3 <?php echo (!empty($tgl_err)) ? 'has-error' : ''; ?>">
                        <label for="tanggal_booking" class="form-label">Tanggal Booking:</label>
                        <input class="form-control" type="date" id="tanggal_booking" name="tanggal_booking" value="<?php echo $tanggal_booking; ?>" required>
                        <span class="text-danger"><?php echo $tgl_err; ?></span>
                    </div>

                    <div class="mb-3 <?php echo (!empty($jam_err)) ? 'has-error' : ''; ?>">
                        <label for="jam_mulai" class="form-label">Jam Mulai:</label>
                        <input class="form-control" type="time" id="jam_mulai" name="jam_mulai" value="<?php echo $jam_mulai; ?>" required>
                        <span class="text-danger"><?php echo $jam_err; ?></span>
                    </div>

                    <div class="mb-3 <?php echo (!empty($lama_err)) ? 'has-error' : ''; ?>">
                        <label for="lama_booking" class="form-label">Lama Booking (jam):</label>
                        <select class="form-select" id="lama_booking" name="lama_booking" required>
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                            <option value="5">5 Jam</option>
                            <option value="6">6 Jam</option>
                            <option value="Personal">Personal</option>
                        </select>
                        <span class="text-danger"><?php echo $lama_err; ?></span>
                    </div>

                    <button class="btn btn-primary" type="submit">PESAN</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>