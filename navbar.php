<?php
//session_start();
$user = $_SESSION['user'] ?? null;
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <a href="index.php" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
        My BLOG
      </a>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center space-x-6">
        <a href="index.php" class="<?= $currentPage === 'index.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Home</a>
        <a href="blog.php" class="<?= $currentPage === 'blog.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Blog</a>

        <?php if ($user && $user['role'] === 'blogger'): ?>
          <a href="dashboard.php" class="<?= $currentPage === 'dashboard.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">My Dashboard</a>
        <?php endif; ?>

        <?php if (!$user): ?>
          <a href="login.php" class="<?= $currentPage === 'login.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Login</a>
          <a href="register.php" class="<?= $currentPage === 'register.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Register</a>
        <?php else: ?>
          <!-- User Dropdown -->
          <div class="relative">
            <button id="userMenuBtn" class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 transition-colors focus:outline-none">
              <span>👤 <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['role']) ?>)</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div id="userDropdown" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border hidden z-10">
              <a href="logout.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-orange-500">Logout</a>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Mobile Menu Button -->
      <button id="menu-btn" class="md:hidden text-gray-600 hover:text-orange-500 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
    <a href="index.php" class="block px-4 py-2 <?= $currentPage === 'index.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Home</a>
    <a href="blog.php" class="block px-4 py-2 <?= $currentPage === 'blog.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Blog</a>

    <?php if ($user && $user['role'] === 'blogger'): ?>
      <a href="dashboard.php" class="block px-4 py-2 <?= $currentPage === 'dashboard.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">My Dashboard</a>
    <?php endif; ?>

    <?php if (!$user): ?>
      <a href="login.php" class="block px-4 py-2 <?= $currentPage === 'login.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Login</a>
      <a href="register.php" class="block px-4 py-2 <?= $currentPage === 'register.php' ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' ?>">Register</a>
    <?php else: ?>
      <a href="logout.php" class="block px-4 py-2 text-gray-600 hover:text-orange-500">Logout</a>
    <?php endif; ?>
  </div>
</nav>

<!-- JS for dropdown and mobile menu -->
<script>
  const menuBtn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const userMenuBtn = document.getElementById('userMenuBtn');
  const userDropdown = document.getElementById('userDropdown');

  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }

  if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener('click', () => {
      userDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
        userDropdown.classList.add('hidden');
      }
    });
  }
</script>
