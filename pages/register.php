<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Validate Name
    if (empty($name) || strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters long.";
    }

    // 2. Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // 3. Validate Password
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If no errors, save and redirect
    if (empty($errors)) {
        $_SESSION['reg_name'] = $name;
        $_SESSION['reg_email'] = $email;
        $_SESSION['reg_password'] = $password;

        setcookie('reg_name', $name, time() + (86400 * 30), "/");
        setcookie('reg_email', $email, time() + (86400 * 30), "/");
        setcookie('reg_password', $password, time() + (86400 * 30), "/");

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Tangier Vibes</title>
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

</body>
</html>
