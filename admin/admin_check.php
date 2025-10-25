<?php
session_start();

// kalau belum login sama sekali
if (!isset($_SESSION['role'])) {

// check_admin.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// kalau yang login bukan admin
// Cek apakah user bukan admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
}
?>