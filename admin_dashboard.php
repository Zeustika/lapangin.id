<?php
session_start();
include("koneksi.php");

// Redirect to login if not logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("location: login_pengguna.php");
    exit;
}
?>
    <style>
        body {

            background: url('img/nack.avif');
            background-size: 30%;
        }
        .card-body {
            background: url('img/nack.avif');
            border-radius: 10px;
        }
        .card-title {
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
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary:disabled {
            background-color: #343a40;
        }
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="css/yozz.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/bill.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Welcome Admin!</h2>
                <p class="text-center">You are now logged in.</p>
                <div class="list-group">
                    <a href="change_payment_status.php" class="list-group-item list-group-item-action">Status Pembayaran</a>
                    <a href="tambah_lapang.php" class="list-group-item list-group-item-action">Tambah Lapangan</a>
                    <a href="logout.php" class="list-group-item list-group-item-action text-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
