<?php
session_start();

// Clear Session
session_unset();
session_destroy();

// Clear Cookies
setcookie('reg_name', '', time() - 3600, "/");
setcookie('reg_email', '', time() - 3600, "/");
setcookie('reg_password', '', time() - 3600, "/");

header("Location: index.php");
exit();
