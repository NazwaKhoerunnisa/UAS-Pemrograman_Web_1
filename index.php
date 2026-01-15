<?php
// index.php - Landing page redirect ke login
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Redirect ke login
header("Location: login.php");
exit();
?>
