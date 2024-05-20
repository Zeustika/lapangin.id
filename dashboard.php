<?php
session_start();

// Periksa apakah pengguna sudah login, jika belum, arahkan ke halaman login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
include 'koneksi.php';

// Query untuk mendapatkan saldo pengguna
$stmt = $mysqli->prepare("SELECT saldo FROM akun_pengguna WHERE id_pengguna = ?");
$stmt->bind_param("i", $_SESSION["id"]);
$stmt->execute();
$stmt->bind_result($saldo);
$stmt->fetch();
$stmt->close();

// Query untuk mendapatkan informasi lapangan yang telah dipesan oleh pengguna
$stmt_lapangan = $mysqli->prepare("SELECT l.nama_lapangan, b.tanggal_booking, b.jam_mulai, b.lama_booking FROM Booking b JOIN Lapangan l ON b.id_lapangan = l.id_lapangan WHERE b.id_pemesan = ?");
$stmt_lapangan->bind_param("i", $_SESSION["id"]);
$stmt_lapangan->execute();
$stmt_lapangan->store_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
            padding: 20px;
        }
        .saldo {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .lapangan-info {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="saldo">Saldo Anda: Rp <?php echo $saldo; ?></div>
        
        <div class="lapangan-info">
            <h2>Informasi Lapangan yang Telah Dipesan</h2>
            <table>
                <tr>
                    <th>Nama Lapangan</th>
                    <th>Tanggal Booking</th>
                    <th>Jam Mulai</th>
                    <th>Lama Booking (jam)</th>
                </tr>
                <?php
                if ($stmt_lapangan->num_rows > 0) {
                    while ($row = $stmt_lapangan->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nama_lapangan"] . "</td>";
                        echo "<td>" . $row["tanggal_booking"] . "</td>";
                        echo "<td>" . $row["jam_mulai"] . "</td>";
                        echo "<td>" . $row["lama_booking"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada informasi lapangan yang dipesan.</td></tr>";
                }
                ?>
            </table>
        </div>
        
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
