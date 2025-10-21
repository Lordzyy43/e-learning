<?php
session_start();

// kalau belum login sama sekali
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit;
}

// kalau yang login bukan admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
