<?php
session_start();

// Check if username and password are correct
if ($_POST['username'] === 'admin' && $_POST['password'] === 'adminpassword') {
    $_SESSION['admin'] = true;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Invalid username or password";
}
?>
