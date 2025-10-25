<?php
session_start();
require_once '../includes/config.php';

// Proteksi login dan role admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit;
}

// Ambil data real dari database
function getCount($conn, $table, $condition = null) {
  $query = "SELECT COUNT(*) AS total FROM $table";
  if ($condition) $query .= " WHERE $condition";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

$total_users = getCount($conn, 'users');
$total_courses = getCount($conn, 'courses');
$total_materials = getCount($conn, 'materials');
$total_progress = getCount($conn, 'progress', "status='selesai'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin | E-Learning</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/906/906334.png">
</head>
<body class="bg-gray-100 min-h-screen font-inter flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-800 text-white flex flex-col shadow-lg fixed h-full">
    <div class="p-5 border-b border-blue-600 flex items-center gap-3">
      <img src="https://cdn-icons-png.flaticon.com/512/906/906334.png" class="w-8 h-8" alt="Logo">
      <span class="text-2xl font-bold">E-Learning</span>
    </div>

    <nav class="flex-1 p-4 space-y-3 text-sm">
      <a href="dashboard.php" class="flex items-center gap-2 py-2 px-3 rounded-lg bg-blue-600 hover:bg-blue-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9m0 0l9 9M4 10h16v10H4V10z"/>
        </svg>
        Dashboard
      </a>
      <a href="courses/index_course.php" class="flex items-center gap-2 py-2 px-3 rounded-lg hover:bg-blue-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8M4 6h16v12H4z"/>
        </svg>
        Kelola Kursus
      </a>
      <a href="materials.php" class="flex items-center gap-2 py-2 px-3 rounded-lg hover:bg-blue-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-6 0h6"/>
        </svg>
        Kelola Materi
      </a>
    </nav>

    <div class="p-4 border-t border-blue-600 mt-auto">
      <a href="../logout.php" class="flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded-lg transition w-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
        </svg>
        Logout
      </a>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 ml-64 p-10">
    <header class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-gray-500 text-sm">Selamat datang kembali, <?= htmlspecialchars($_SESSION['nama']); ?> 👋</p>
      </div>
      <div class="flex items-center gap-4">
        <input type="text" placeholder="Cari sesuatu..." class="px-4 py-2 rounded-lg border focus:ring focus:ring-blue-200 outline-none text-sm">
        <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full border-2 border-blue-500" alt="Admin">
      </div>
    </header>

    <!-- Statistik Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-sm text-gray-500 font-semibold">Total Pengguna</h2>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3M9 20H4v-2a2 2 0 012-2h3m6 0a2 2 0 01-2-2H9a2 2 0 01-2-2H4m13 4a2 2 0 002-2h1a2 2 0 012 2v2h-5z"/>
          </svg>
        </div>
        <p class="text-4xl font-bold text-blue-700"><?= $total_users; ?></p>
      </div>

      <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-sm text-gray-500 font-semibold">Total Kursus</h2>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-6 0h6"/>
          </svg>
        </div>
        <p class="text-4xl font-bold text-green-700"><?= $total_courses; ?></p>
      </div>

      <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-sm text-gray-500 font-semibold">Total Materi</h2>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8m-6-7h8v14H6V5h2z"/>
          </svg>
        </div>
        <p class="text-4xl font-bold text-indigo-700"><?= $total_materials; ?></p>
      </div>

      <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-sm text-gray-500 font-semibold">Progress Selesai</h2>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
        </div>
        <p class="text-4xl font-bold text-amber-700"><?= $total_progress; ?></p>
      </div>
    </section>

    <!-- Aktivitas -->
    <section class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-2xl shadow-sm p-6">
      <h2 class="text-lg font-semibold text-gray-700 mb-4">Aktivitas Terbaru</h2>
      <div class="text-gray-500 italic">Belum ada aktivitas. Mulailah dengan menambahkan
