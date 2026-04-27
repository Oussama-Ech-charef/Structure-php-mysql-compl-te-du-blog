<?php
session_start();
require '../config/connexion.php';
require '../includes/article.php';

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Validation
    if (empty($name) || strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters long.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If no errors, save to Database
    if (empty($errors)) {
        $database = new Database();
        $db = $database->getConnection();
        $post_obj = new Article($db);
        
        if ($post_obj->emailExists($email)) {
            $errors[] = "This email is already registered.";
        } else {
            // Hash password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            if ($post_obj->createUser($name, $email, $hashed_password)) {
                $_SESSION['success_msg'] = "Registration successful! Please login.";
                header("Location: login.php");
                exit();
            } else {
                $errors[] = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tangier Vibes</title>
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
        <h2 class="auth_title">Register</h2>

        <?php if (!empty($errors)): ?>
            <div class="error_list" style="margin-bottom: 15px;">
                <?php foreach ($errors as $error): ?>
                    <p class="error_msg" style="color: #ef4444; font-size: 13px; margin-bottom: 5px;">• <?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required class="auth_input">
            <input type="email" name="email" placeholder="Email" required class="auth_input">
            <input type="password" name="password" placeholder="Password" required class="auth_input">
            <button type="submit" class="auth_btn">Sign Up</button>
        </form>
        <p class="auth_footer">Already have an account? <a href="login.php" class="auth_link">Login</a></p>
    </main>

    <script src="../assets/js/main.js"></script>
</body>
</html>
