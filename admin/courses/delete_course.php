<?php
session_start();
require_once '../../includes/config.php';
require_once '../../includes/admin_check.php';

$id = $_GET['id'] ?? 0;
mysqli_query($conn, "DELETE FROM courses WHERE id = $id");

header("Location: index_course.php");
exit;
?>
