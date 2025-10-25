<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- ======== SIDEBAR ======== -->
<aside 
  data-aos="fade-right"
  data-aos-duration="700"
  class="w-64 bg-gradient-to-b from-blue-700 to-blue-800 text-white flex flex-col shadow-xl fixed h-full transition-all duration-300 z-50">

  <!-- LOGO -->
  <div class="p-5 border-b border-blue-600 flex items-center gap-3">
    <img src="https://cdn-icons-png.flaticon.com/512/906/906334.png" class="w-8 h-8 animate-pulse" alt="Logo">
    <span class="text-2xl font-bold tracking-wide">E-Learning</span>
  </div>

  <!-- MENU -->
  <nav class="flex-1 p-4 space-y-2 text-sm">
    <a href="/E-LEARNING/admin/dashboard.php"
       class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 hover:scale-[1.05] hover:shadow-md hover:bg-blue-700 
       <?= ($current_page === 'dashboard.php') ? 'bg-blue-600 shadow-lg' : '' ?>">
      <i class="fa-solid fa-house w-5 text-white/90"></i>
      Dashboard
    </a>

    <a href="/E-LEARNING/admin/courses/index_course.php"
       class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 hover:scale-[1.05] hover:shadow-md hover:bg-blue-700 
       <?= ($current_page === 'index_course.php') ? 'bg-blue-600 shadow-lg' : '' ?>">
      <i class="fa-solid fa-book-open w-5 text-white/90"></i>
      Kelola Kursus
    </a>

    <a href="/E-LEARNING/admin/materials/materials.php"
       class="flex items-center gap-3 py-2 px-3 rounded-lg transition-all duration-200 hover:scale-[1.05] hover:shadow-md hover:bg-blue-700 
       <?= ($current_page === 'materials.php') ? 'bg-blue-600 shadow-lg' : '' ?>">
      <i class="fa-solid fa-chalkboard-user w-5 text-white/90"></i>
      Kelola Materi
    </a>
  </nav>

  <!-- LOGOUT -->
  <div class="p-4 border-t border-blue-600 mt-auto">
    <a href="/E-LEARNING/logout.php"
       class="flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded-lg transition-all duration-200 hover:scale-[1.05] shadow-md hover:shadow-lg">
      <i class="fa-solid fa-right-from-bracket"></i>
      Logout
    </a>
  </div>
</aside>

<!-- ======== MOBILE TOGGLE BUTTON ======== -->
<button id="toggleSidebar" class="md:hidden fixed top-4 left-4 bg-blue-700 text-white p-2 rounded-lg shadow-lg z-50">
  <i class="fa-solid fa-bars"></i>
</button>

<script>
  const sidebar = document.querySelector('aside');
  const toggleBtn = document.getElementById('toggleSidebar');
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
  });
</script>
