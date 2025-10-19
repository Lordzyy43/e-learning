<?php
session_start();
require_once '../includes/config.php';
require_once 'check_admin.php';

// Ambil data dari database
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$total_courses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM courses"))['total'];
$total_materials = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM materials"))['total'];
$total_progress = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM progress WHERE status='selesai'"))['total'];

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin | E-Learning</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-blue-700 text-white flex flex-col shadow-lg">
    <div class="p-5 text-2xl font-bold border-b border-blue-500">Admin Panel</div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="dashboard.php" class="block py-2 px-3 rounded-lg bg-blue-600 hover:bg-blue-800 transition">📊 Dashboard</a>
      <a href="courses.php" class="block py-2 px-3 rounded-lg hover:bg-blue-600 transition">🎓 Kelola Kursus</a>
      <a href="materials.php" class="block py-2 px-3 rounded-lg hover:bg-blue-600 transition">📚 Kelola Materi</a>
      <a href="../logout.php" class="block py-2 px-3 rounded-lg bg-red-600 hover:bg-red-700 transition mt-auto">🚪 Logout</a>
    </nav>
  </aside>

  <!-- Konten utama -->
  <main class="flex-1 p-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?> 👋</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl transition">
        <h2 class="text-gray-500 text-sm font-semibold">Total Pengguna</h2>
        <p class="text-4xl font-bold text-blue-600 mt-2"><?= $total_users; ?></p>
      </div>

      <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl transition">
        <h2 class="text-gray-500 text-sm font-semibold">Total Kursus</h2>
        <p class="text-4xl font-bold text-green-600 mt-2"><?= $total_courses; ?></p>
      </div>

      <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl transition">
        <h2 class="text-gray-500 text-sm font-semibold">Total Materi</h2>
        <p class="text-4xl font-bold text-indigo-600 mt-2"><?= $total_materials; ?></p>
      </div>

      <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl transition">
        <h2 class="text-gray-500 text-sm font-semibold">Progress Selesai</h2>
        <p class="text-4xl font-bold text-amber-600 mt-2"><?= $total_progress; ?></p>
      </div>
    </div>

    <!-- Section tambahan -->
    <section class="bg-white rounded-xl p-6 shadow-md border border-gray-200">
      <h2 class="text-2xl font-semibold text-gray-700 mb-4">Aktivitas Terbaru</h2>
      <p class="text-gray-500 italic">Belum ada aktivitas terbaru. Tambahkan kursus dan materi untuk mulai melacak progress siswa!</p>
    </section>
  </main>

</body>
</html>

