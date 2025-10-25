<?php
session_start();
require_once '../../includes/config.php';
require_once '../../includes/check_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = mysqli_real_escape_string($conn, $_POST['judul']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
  $thumbnail = mysqli_real_escape_string($conn, $_POST['thumbnail']);
  $uploader_id = $_SESSION['user_id'];

  mysqli_query($conn, "INSERT INTO courses (judul, deskripsi, kategori, thumbnail, uploader_id, tanggal_upload)
                       VALUES ('$judul', '$deskripsi', '$kategori', '$thumbnail', '$uploader_id', NOW())");

  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Kursus</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-inter min-h-screen">
<div class="max-w-xl mx-auto py-10">
  <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Kursus Baru</h1>
  <form method="POST" class="space-y-4 bg-white p-6 rounded-xl shadow-md">
    <div>
      <label class="block text-sm font-medium text-gray-600">Judul Kursus</label>
      <input type="text" name="judul" required class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-blue-200">
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
      <textarea name="deskripsi" rows="4" required class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-blue-200"></textarea>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-600">Kategori</label>
      <input type="text" name="kategori" required class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-blue-200">
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-600">Thumbnail (URL)</label>
      <input type="text" name="thumbnail" class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-blue-200">
    </div>
    <div class="flex justify-between items-center">
      <a href="index.php" class="text-gray-500 hover:underline">Kembali</a>
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Simpan</button>
    </div>
  </form>
</div>
</body>
</html>
