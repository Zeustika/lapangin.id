<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billiard Billing - Status Ketersediaan Lapangan</title>
    <link rel="icon" type="image/png" href="img/bill.png"/>
    <!-- Tautan ke file CSS Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang */
            font-family: Arial, sans-serif; /* Gaya font */
        }
        .wrapper {
            width: 400px;
            padding: 20px;
            margin: 0 auto;
            background-color: #ffffff; 
            border-radius: 10px; /
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary:hover {
            background-color: #007bff; /* Warna tombol saat dihover */
        }
        .btn-secondary:hover {
            background-color: #6c757d; /* Warna tombol sekunder saat dihover */
        }
        a:hover {
            color: #0056b3; /* Warna tautan saat dihover */
        }
        body {

            background: url('img/nack.avif');
            background-size: 30%;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 10px;
        }
        .table {
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
        }
        .mb-3{
            color: #000;
        }
        .btn-secondary:disabled {
            background-color: #343a40;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 class="mb-3">Sign Up</h2>
        <p>Please fill in this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo isset($username) ? $username : ''; ?>">
                <span class="text-danger"><?php echo isset($username_err) ? $username_err : ''; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>">
                <span class="text-danger"><?php echo isset($email_err) ? $email_err : ''; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo isset($password) ? $password : ''; ?>">
                <span class="text-danger"><?php echo isset($password_err) ? $password_err : ''; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo isset($confirm_password) ? $confirm_password : ''; ?>">
                <span class="text-danger"><?php echo isset($confirm_password_err) ? $confirm_password_err : ''; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary mr-2" value="Submit">
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div>
            <p>Already have an account? <a href="login_pengguna.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
