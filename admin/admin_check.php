<?php
<<<<<<< HEAD
session_start();

// kalau belum login sama sekali
if (!isset($_SESSION['role'])) {
=======
// check_admin.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
>>>>>>> 27b21ad70aca052e6dbc824a33fb8440cfdef150
    header("Location: ../login.php");
    exit;
}

<<<<<<< HEAD
// kalau yang login bukan admin
=======
// Cek apakah user bukan admin
>>>>>>> 27b21ad70aca052e6dbc824a33fb8440cfdef150
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
