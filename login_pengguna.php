<?php
include 'koneksi.php';

// Initialize variables for username and password
$username = $password = "";
$username_err = $password_err = "";

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check for validation errors before authenticating
    if (empty($username_err) && empty($password_err)) {
        // SQL statement to check username and password
        $sql = "SELECT id_pengguna, username, password, role FROM akun_pengguna WHERE username = ?";
        
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            
            $param_username = $username;
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {                    
                    $stmt->bind_result($id_pengguna, $db_username, $hashed_password, $role);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // If password is correct, start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_pengguna"] = $id_pengguna;
                            $_SESSION["username"] = $db_username;
                            $_SESSION["role"] = $role;

                            // Redirect user to dashboard or admin page based on role
                            if ($role === 'admin') {
                                header("location: admin_dashboard.php");
                            } else {
                                header("location: index.php");
                            }
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billiard Billing - Status Ketersediaan Lapangan</title>
    <link rel="icon" type="image/png" href="img/bill.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="css/yozz.min.css" rel="stylesheet">
    <style>
        body {
            background: url('img/nack.avif');
            background-color: black;
            background-size: 30%;
            color: #fff;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
            color: #fff;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
        }
        .card-title {
            color: #fff;
        }
        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-primary:hover {
            background-color: #004494;
            border-color: #004494;
        }
        .text-danger {
            color: #ff4d4d;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login</h2>
                        <p class="text-center">Please fill in your credentials to login.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                <span class="help-block text-danger"><?php echo $username_err; ?></span>
                            </div>    
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                                <span class="help-block text-danger"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value="Login">
                            </div>
                            <p class="text-center">Don't have an account? <a href="register.php" class="text-info">Sign up now</a>.</p>
                        </form>
                    </div>
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
