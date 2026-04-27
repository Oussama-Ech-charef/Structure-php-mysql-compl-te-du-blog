<?php
session_start();
require '../config/connexion.php';
require '../includes/article.php';

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $db = $database->getConnection();

    $post_obj = new Article($db);
    $user = $post_obj->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        // Success: Store user info in Session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['role'] = $user['role']; // This is important!

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tangier Vibes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="auth_page">
        <h2 class="auth_title">Login</h2>
        <?php if ($error): ?>
            <p class="error_msg"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required class="auth_input">
            <input type="password" name="password" placeholder="Password" required class="auth_input">
            <button type="submit" class="auth_btn">Login</button>
        </form>
        <p class="auth_footer">Don't have an account? <a href="register.php" class="auth_link">Register</a></p>
    </main>

    <script src="../assets/js/main.js"></script>
</body>
</html>
