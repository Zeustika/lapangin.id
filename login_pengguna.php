<?php
include 'koneksi.php';

session_start();

// Periksa apakah pengguna sudah login, jika ya, arahkan ke halaman dashboard atau halaman lain yang sesuai
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["role"] === 'admin') {
        header("location: process_login_admin.php");
    } else {
        header("location: dashboard.php");
    }
    exit;
}

// Inisialisasi variabel kosong untuk menyimpan username dan password
$username = $password = "";
$username_err = $password_err = "";

// Periksa apakah metode POST digunakan untuk mengirimkan data form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Validasi password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Periksa apakah tidak ada kesalahan validasi sebelum melakukan autentikasi
    if (empty($username_err) && empty($password_err)) {
        // SQL statement untuk memeriksa apakah username dan password sesuai
        $sql = "SELECT id_pengguna, username, password, role FROM akun_pengguna WHERE username = ?";
        
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            
            $param_username = $username;
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                // Periksa apakah username ada dalam database, jika ya, verifikasi password
                if ($stmt->num_rows == 1) {                    
                    $stmt->bind_result($id_pengguna, $db_username, $hashed_password, $role);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Jika password cocok, mulai sesi baru
                            session_start();
                            
                            // Simpan data dalam variabel sesi
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_pengguna"] = $id_pengguna;
                            $_SESSION["username"] = $db_username;
                            $_SESSION["role"] = $role;

                            // Redirect user ke halaman dashboard atau proses login admin
                            if ($role === 'admin') {
                                header("location: process_login_admin.php");
                            } else {
                                header("location: dashboard.php");
                            }
                        } else {
                            // Tampilkan pesan kesalahan jika password tidak valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Tampilkan pesan kesalahan jika username tidak valid
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Tutup statement
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
    <title>Login</title>
    <style>
        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>
