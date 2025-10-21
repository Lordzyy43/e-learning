<?php
session_start();
require_once 'includes/config.php';

// kalau udah login, arahkan langsung
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // verifikasi password (karena di DB kamu HASH)
        if (password_verify($password, $user['PASSWORD'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }
        } else {
            $error = 'Password salah!';
        }
    } else {
        $error = 'Email tidak ditemukan!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 flex items-center justify-center h-screen">

    <form method="POST" class="bg-white shadow-lg rounded-xl p-8 w-96 border border-gray-200">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Login E-Learning</h2>

        <?php if (!empty($error)) : ?>
            <div class="bg-red-100 text-red-600 p-3 mb-4 text-center rounded-lg font-medium">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <label class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" name="email" required class="w-full p-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">

        <label class="block text-gray-700 font-medium mb-1">Password</label>
        <input type="password" name="password" required class="w-full p-2 mb-6 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
            Masuk
        </button>

        <p class="text-center text-sm text-gray-500 mt-4">
            Belum punya akun?
            <a href="register.php" class="text-blue-600 hover:underline">Daftar di sini</a>
        </p>
    </form>

</body>
</html>
