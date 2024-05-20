<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Ketersediaan Lapangan</title>
    <style>
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
    <h1>Status Ketersediaan Lapangan</h1>
    <table>
        <tr>
            <th>ID Lapangan</th>
            <th>Nama Lapangan</th>
            <th>Jenis Lapangan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT id_lapangan, nama_lapangan, jenis_lapangan, status FROM Lapangan";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_lapangan"] . "</td>";
                echo "<td>" . $row["nama_lapangan"] . "</td>";
                echo "<td>" . $row["jenis_lapangan"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                if ($row["status"] == "Tersedia") {
                    echo "<td><a href='booking.php?id_lapangan=" . $row["id_lapangan"] . "'>Pesan</a></td>";
                } else {
                    echo "<td>-</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>
    <p><a href="login_pengguna.php">Login Pengguna</a></p>
    <p><a href="signup_pengguna.php">Sign Up Pengguna</a></p>
</body>
</html>
