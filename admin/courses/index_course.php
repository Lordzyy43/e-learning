<?php
session_start();
require_once '../../includes/config.php';
require_once '../..//check_admin.php';

$result = mysqli_query($conn, "
  SELECT courses.*, users.nama AS uploader 
  FROM courses 
  JOIN users ON courses.uploader_id = users.id 
  ORDER BY tanggal_upload DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Kursus | Admin Panel</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-inter min-h-screen">
<div class="max-w-6xl mx-auto py-10 px-5">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">📘 Kelola Kursus</h1>
    <a href="add.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">+ Tambah Kursus</a>
  </div>

  <div class="overflow-x-auto bg-white shadow-lg rounded-xl border">
    <table class="min-w-full text-left text-gray-700">
      <thead class="bg-blue-50">
        <tr>
          <th class="py-3 px-4">#</th>
          <th class="py-3 px-4">Judul</th>
          <th class="py-3 px-4">Kategori</th>
          <th class="py-3 px-4">Uploader</th>
          <th class="py-3 px-4">Tanggal Upload</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='border-b hover:bg-gray-50 transition'>
                    <td class='py-2 px-4'>{$no}</td>
                    <td class='py-2 px-4 font-semibold'>{$row['judul']}</td>
                    <td class='py-2 px-4'>{$row['kategori']}</td>
                    <td class='py-2 px-4'>{$row['uploader']}</td>
                    <td class='py-2 px-4'>" . date('d M Y', strtotime($row['tanggal_upload'])) . "</td>
                    <td class='py-2 px-4 text-center space-x-2'>
                      <a href='edit.php?id={$row['id']}' class='bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md'>Edit</a>
                      <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus kursus ini?');\" class='bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md'>Hapus</a>
                    </td>
                  </tr>";
            $no++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
