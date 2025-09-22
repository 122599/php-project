<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MY BLOG</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #e8dd05ff;
      --accent-color: #ff6f61;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .hero-section {
      background: linear-gradient(135deg, var(--primary-color) 0%, #4a90e2 100%);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
  <?php include "navbar.php"; ?>

  <!-- Hero Section -->
  <div class="hero-section text-white py-16 text-center rounded-b-3xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to My Blog</h1>
      <p class="text-lg md:text-xl">A demo blog site with Admin & Blogger roles. Explore our stories or <a href="blog.php" class="underline text-white hover:text-orange-300">check out the blog</a>.</p>
    </div>
  </div>

  
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-semibold mb-6 text-center">Featured Blogs</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
          <img src="https://plus.unsplash.com/premium_photo-1670986971794-1ab9ec4beb28?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGV4cGxvcmluZyUyMHRoZSUyMHdvcmxkfGVufDB8fDB8fHww" alt="Nature" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-xl font-bold mb-2">Exploring the Wild</h3>
            <p class="text-gray-700 mb-3">Join us on a breathtaking journey through the untouched wilderness, where nature speaks in silence.</p>
            <a href="blog.php" class="text-blue-600 hover:underline">Read more →</a>
          </div>
        </div>

        
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
          <img src="https://images.unsplash.com/photo-1561347981-969c80cf4463?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHRoZSUyMHJpc2UlMjBvZiUyMEFJJTIwY29kaW5nfGVufDB8fDB8fHww" alt="Tech" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-xl font-bold mb-2">The Rise of AI</h3>
            <p class="text-gray-700 mb-3">Artificial Intelligence is reshaping the future. Discover its impact and what's coming next in the tech world.</p>
            <a href="blog.php" class="text-blue-600 hover:underline">Read more →</a>
          </div>
        </div>

       
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
          <img src="https://plus.unsplash.com/premium_photo-1707203459198-8b7285875b0b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8QmVhY2glMjBFc2NhcGVzfGVufDB8fDB8fHww" alt="Travel" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-xl font-bold mb-2">Beach Escapes</h3>
            <p class="text-gray-700 mb-3">Dreaming of sun, sand, and sea? Here’s our guide to the best beach destinations around the globe.</p>
            <a href="blog.php" class="text-blue-600 hover:underline">Read more →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p class="text-sm">&copy; <?php echo date('Y'); ?> My Blog. All rights reserved.</p>
      <p class="text-xs mt-2">
        Designed with ❤️ by You. | <a href="privacy.php" class="underline hover:text-white">Privacy Policy</a> | <a href="terms.php" class="underline hover:text-white">Terms of Service</a>
      </p>
    </div>
  </footer>
</body>
</html>
