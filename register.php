<?php 
include "config.php";
// session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"] ?? '');
    $password_raw = $_POST["password"];
    $role = 'blogger'; // Force role to 'blogger'

    // Basic validations
    if (empty($username) || empty($email) || empty($password_raw)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "This email is already registered.";
        } else {
            $password = password_hash($password_raw, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $password, $role);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registered successfully. Please login.";
                header("Location: login.php");
                exit;
            } else {
                $error = "Error: " . $conn->error;
            }
        }
        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Simple Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800">
    <?php include "navbar.php"; ?>
    <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6">Register as Blogger</h2>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" novalidate>
            <div class="mb-4">
                <label for="username" class="block font-medium mb-1">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required
                    class="w-full px-3 py-2 border rounded" value="<?php echo htmlspecialchars($_POST['username'] ?? '') ?>" />
            </div>
            <div class="mb-4">
                <label for="email" class="block font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required
                    class="w-full px-3 py-2 border rounded" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" />
            </div>
            <div class="mb-6">
                <label for="password" class="block font-medium mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required
                    class="w-full px-3 py-2 border rounded" />
            </div>

            <!-- Removed role selector -->

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-orange-500 transition">
                Register as Blogger
            </button>

            <p class="mt-4 text-center">
                Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Login here</a>.
            </p>
        </form>
    </div>
</body>
</html>
