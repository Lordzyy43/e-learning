<?php
session_start();
require_once 'includes/config.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $kode_admin = $_POST['kode_admin'];

    // default role
    $role = 'user';

    // kalau isi kode admin benar, maka role jadi admin
    if ($kode_admin === 'ADMINKEY2025') {
        $role = 'admin';
    }

    // cek apakah email sudah ada
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $message = "⚠️ Email sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (nama, email, PASSWORD, role) 
                  VALUES ('$nama', '$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            $message = "✅ Akun berhasil dibuat! Silakan login.";
        } else {
            $message = "❌ Gagal mendaftar: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun E-Learning</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 flex items-center justify-center h-screen">

  <form method="POST" class="bg-white shadow-xl p-8 rounded-xl w-96 border border-gray-200">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Buat Akun Baru</h2>

    <?php if ($message): ?>
      <p class="bg-blue-100 text-blue-700 p-3 mb-4 text-center rounded-lg font-medium">
        <?= htmlspecialchars($message) ?>
      </p>
    <?php endif; ?>

    <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
    <input type="text" name="nama" required class="w-full p-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">

    <label class="block text-gray-700 font-medium mb-1">Email</label>
    <input type="email" name="email" required class="w-full p-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">

    <label class="block text-gray-700 font-medium mb-1">Password</label>
    <input type="password" name="password" required class="w-full p-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">

    <label class="block text-gray-700 font-medium mb-1">Kode Admin (Opsional)</label>
    <input type="text" name="kode_admin" placeholder="Kosongkan jika user biasa"
           class="w-full p-2 mb-6 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">

    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
      Daftar
    </button>

    <p class="text-center text-sm text-gray-600 mt-4">
      Sudah punya akun?
      <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a>
    </p>
  </form>

</body>
</html>
