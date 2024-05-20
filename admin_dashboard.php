<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome Admin!</h2>
    <p>You are now logged in.</p>
    <p><a href="change_payment_status.php">Status Pembayaran</a></p>
    <p><a href="tambah_lapang.php">Tambah lapangan</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
