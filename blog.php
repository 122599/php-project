<?php
include "config.php";
//session_start();

$user = $_SESSION['user'] ?? null;
$isAdmin = $user && isset($user['role']) && $user['role'] === 'admin';

// Handle Add Blog Post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'add' && $isAdmin) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author_id = $user["id"];

    $stmt = $conn->prepare("INSERT INTO blogs (title, content, author_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $author_id);
    $stmt->execute();
    header("Location: blog.php");
    exit;
}

// Handle Edit Blog Post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'edit' && $isAdmin) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    $stmt = $conn->prepare("UPDATE blogs SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: blog.php");
    exit;
}

// Handle Delete Blog Post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'delete' && $isAdmin) {
    $id = $_POST["id"];
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: blog.php");
    exit;
}

// Fetch all blogs with author username
$sql = "SELECT blogs.id, blogs.title, blogs.content, users.username 
        FROM blogs 
        JOIN users ON blogs.author_id = users.id 
        ORDER BY blogs.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Blogs - MY BLOG</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    .post-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .post-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,0.15); }
    .btn-primary { transition: background-color 0.3s ease, transform 0.2s ease; }
    .btn-primary:hover { background-color: #ff6f61; transform: scale(1.05); }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
<?php include "navbar.php"; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <h2 class="text-3xl font-bold mb-8 text-center">Latest Blog Posts</h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Static Sample Blog Cards (Same 3 from homepage + 3 more) -->
    <?php
    $sampleBlogs = [
      [
        "title" => "Exploring the Wild",
        "desc" => "Join us on a breathtaking journey through untouched nature.",
        "img" => "https://plus.unsplash.com/premium_photo-1670986971794-1ab9ec4beb28?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGV4cGxvcmluZyUyMHRoZSUyMHdvcmxkfGVufDB8fDB8fHww"
      ],
      [
        "title" => "The Rise of AI",
        "desc" => "Discover how artificial intelligence is transforming industries.",
        "img" => "https://images.unsplash.com/photo-1561347981-969c80cf4463?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHRoZSUyMHJpc2UlMjBvZiUyMEFJJTIwY29kaW5nfGVufDB8fDB8fHww"
      ],
      [
        "title" => "Beach Escapes",
        "desc" => "Here’s our guide to the best beach destinations worldwide.",
        "img" => "https://plus.unsplash.com/premium_photo-1707203459198-8b7285875b0b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8QmVhY2glMjBFc2NhcGVzfGVufDB8fDB8fHww"
      ],
      [
        "title" => "Foodie's Paradise",
        "desc" => "Explore mouth-watering dishes from around the world.",
        "img" => "https://plus.unsplash.com/premium_photo-1728412897938-d70e9c5becd7?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fEZvb2RpZSdzJTIwUGFyYWRpc2V8ZW58MHx8MHx8fDA%3D"
      ],
      [
        "title" => "Urban Life",
        "desc" => "The rhythm of city life captured through lens and words.",
        "img" => "https://plus.unsplash.com/premium_photo-1687514771291-4aca4e90ca24?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8dXJiYXJuJTIwbGlmZXxlbnwwfHwwfHx8MA%3D%3D"
      ],
      [
        "title" => "Mountain Adventures",
        "desc" => "Discover hiking trails and mountain escapes worth your trek.",
        "img" => "https://plus.unsplash.com/premium_photo-1700500733511-b42dfae2897a?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bW91bnRhaW4lMjB2aWV3c3xlbnwwfHwwfHx8MA%3D%3D"
      ]
    ];

    foreach ($sampleBlogs as $sample) {
      echo '
      <div class="bg-white rounded-lg shadow-md overflow-hidden post-card">
        <img src="' . $sample["img"] . '" alt="' . htmlspecialchars($sample["title"]) . '" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-xl font-bold mb-2">' . htmlspecialchars($sample["title"]) . '</h3>
          <p class="text-gray-700 mb-3">' . htmlspecialchars($sample["desc"]) . '</p>
          <a href="#" class="text-blue-600 hover:underline">Read more →</a>
        </div>
      </div>';
    }
    ?>

    <!-- Dynamic Blogs from Database -->
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden post-card">
          <img src="https://source.unsplash.com/800x500/?blog,writing&sig=<?= $row['id'] ?>" class="w-full h-48 object-cover" alt="Blog Image">
          <div class="p-4">
            <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($row['title']) ?></h3>
            <p class="text-gray-700 mb-2"><?= substr(htmlspecialchars($row['content']), 0, 100) ?>...</p>
            <p class="text-sm text-gray-500 mb-2">Author: <?= htmlspecialchars($row['username']) ?></p>
            <?php if ($isAdmin): ?>
              <form method="POST" class="flex space-x-2">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="text-red-600 hover:underline">Delete</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center col-span-3 text-gray-600">No blogs found.</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
