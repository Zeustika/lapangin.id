<?php
session_start();
include 'koneksi.php';

// Redirect to login if not logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("location: login_pengguna.php");
    exit;
}

// Fetch list of bookings that haven't been paid
$sql = "SELECT id_booking FROM Booking WHERE status_pembayaran = 'Belum Bayar'";
$result = $mysqli->query($sql);

// Check if there are any unpaid bookings
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Payment Status</title>
    <link rel="icon" type="image/png" href="img/bill.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Change Payment Status</h1>
        <?php if ($result->num_rows > 0): ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="mt-4">
                <div class="form-group">
                    <label for="id_booking">Select Booking ID:</label>
                    <select name="id_booking" id="id_booking" class="form-control">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <option value="<?php echo $row["id_booking"]; ?>"><?php echo $row["id_booking"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php else: ?>
            <div class="alert alert-warning mt-4" role="alert">
                No unpaid bookings found.
            </div>
        <?php endif; ?>

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>
</html>

<?php
// Check if GET method is used and id_booking is set
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_booking'])) {
    $id_booking = $_GET['id_booking'];
    // Redirect to the payment processing page with the selected booking ID
    header("Location: process_payment.php?id_booking=$id_booking");
    exit();
}
?>
    <style>
        body {

            background: url('img/nack.avif');
            background-size: 30%;
            color: #fff;
        }
        .container {
            background-color: #6c757d;
            border-radius: 5px;
            padding: 30px;
        }
        .table {
            background-color: #6c757d;
            color: #000;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary:disabled {
            background-color: #343a40;
        }
    </style>