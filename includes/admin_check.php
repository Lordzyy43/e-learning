<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Cek apakah user adalah admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
