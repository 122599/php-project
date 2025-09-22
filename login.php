<?php include "config.php"; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        header("Location: blog.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Simple Blog</title>
        <style>
    form {
        max-width: 400px;
        margin: 2rem auto;
        background: #ffffff;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #374151;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        outline: none;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: #2563eb; /* Tailwind blue-600 */
        box-shadow: 0 0 8px rgba(37, 99, 235, 0.4);
    }

    button[type="submit"] {
        width: 100%;
        padding: 0.75rem 1rem;
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        border: none;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: background 0.3s ease;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
    }

    button[type="submit"]:hover {
        background: linear-gradient(90deg, #f97316, #ea580c);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.6);
    }

    p {
        margin-top: 1rem;
        text-align: center;
        font-size: 0.95rem;
        color: #6b7280;
    }

    p a {
        color: #2563eb;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    p a:hover {
        color: #f97316;
        text-decoration: underline;
    }
</style>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <?php include "navbar.php"; ?>
    <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6">Login</h2>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <form method="POST">
    <div class="mb-4">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
    </div>
    <div class="mb-6">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit">Login</button>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</form>
    </div>
</body>
</html>