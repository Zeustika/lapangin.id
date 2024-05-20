<?php
// Start the session
session_start();

// Check if both username and password are provided
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Check if username and password are correct and user has admin role
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'iyusganteng') {
        // Set session variables for admin
        $_SESSION['admin'] = true;
        $_SESSION['role'] = 'admin'; // Set the role here
        header("Location: admin_dashboard.php");
        exit();
    }
}

// If username or password is incorrect or not provided, display error message
echo "Invalid username or password";
?>
