<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check against Session OR Cookies (Our Database)
    $reg_email = $_SESSION['reg_email'] ?? $_COOKIE['reg_email'] ?? '';
    $reg_pass = $_SESSION['reg_password'] ?? $_COOKIE['reg_password'] ?? '';
    $reg_name = $_SESSION['reg_name'] ?? $_COOKIE['reg_name'] ?? '';

    if ($email === $reg_email && $password === $reg_pass && !empty($reg_email)) {
        $_SESSION['username'] = $reg_name;
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
    <title>Login - Tangier Vibes</title>
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

</body>
</html>
