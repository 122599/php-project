<?php
include "config.php";
session_start();

$user = $_SESSION['user'] ?? null;

// Only allow bloggers
if (!$user || $user['role'] !== 'blogger') {
    header("Location: login.php");
    exit;
}

$bloggerId = $user['id'];
$error = null;
$success = null;

// Handle Add Blog Post from Blogger
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'add') {
    // only bloggers can add here
    $title = trim($_POST["title"] ?? '');
    $content = trim($_POST["content"] ?? '');
    $image_url = trim($_POST["image_url"] ?? '');

    if (empty($title) || empty($content)) {
        $error = "Title & content are required.";
    } else {
        // Insert new blog
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, image_url, author_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $content, $image_url, $bloggerId);
        if ($stmt->execute()) {
            $success = "Blog added!";
            // Optionally redirect to avoid form resubmission
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}

// Fetch blogger’s own posts
$stmt2 = $conn->prepare("SELECT id, title, content, image_url FROM blogs WHERE author_id = ? ORDER BY id DESC");
$stmt2->bind_param("i", $bloggerId);
$stmt2->execute();
$result = $stmt2->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blogger Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800">
  <?php include "navbar.php"; ?>

  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-6">My Dashboard</h1>
    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        <?php echo htmlspecialchars($success); ?>
      </div>
    <?php endif; ?>

    <!-- Add Blog Form -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
      <h2 class="text-xl font-semibold mb-4">Add New Blog</h2>
      <form method="POST">
        <input type="hidden" name="action" value="add">
        <div class="mb-4">
          <label class="block font-medium mb-1">Title</label>
          <input type="text" name="title" required class="w-full px-3 py-2 border rounded" value="<?php echo htmlspecialchars($_POST['title'] ?? '') ?>">
        </div>
        <div class="mb-4">
          <label class="block font-medium mb-1">Image URL (optional)</label>
          <input type="url" name="image_url" class="w-full px-3 py-2 border rounded" placeholder="https://images.unsplash.com/..." value="<?php echo htmlspecialchars($_POST['image_url'] ?? '') ?>">
        </div>
        <div class="mb-4">
          <label class="block font-medium mb-1">Content</label>
          <textarea name="content" rows="5" required class="w-full px-3 py-2 border rounded"><?php echo htmlspecialchars($_POST['content'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Add Blog</button>
      </form>
    </div>

    <!-- List of Blogger’s Posts -->
    <div>
      <h2 class="text-xl font-semibold mb-4">My Blog Posts</h2>
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="grid grid-cols-1 gap-6">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="bg-white rounded-lg shadow overflow-hidden">
              <?php if (!empty($row['image_url'])): ?>
                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Blog image" class="w-full h-48 object-cover">
              <?php endif; ?>
              <div class="p-4">
                <h3 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($row['title']); ?></h3>
                <p class="text-gray-700 mb-2"><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
                <!-- Optional: you could provide edit link here -->
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p class="text-gray-600">You have not published any blogs yet.</p>
      <?php endif; ?>
    </div>

  </div>
</body>
</html>
