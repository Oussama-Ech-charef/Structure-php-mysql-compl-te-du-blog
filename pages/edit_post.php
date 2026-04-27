<?php
session_start();
require '../config/connexion.php';
require '../includes/article.php';

// Check if user is Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$database = new Database();
$db = $database->getConnection();
$post_obj = new Article($db);

$msg = "";
$error = "";

// 1. Fetch Categories
$categories = $post_obj->getAllCategories();

// 2. Fetch current post data
$post = $post_obj->getByIdAdmin($id);

if (!$post) {
    header("Location: dashboard.php");
    exit();
}

// 3. Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $status = $_POST['status'];

    if ($post_obj->update($id, $title, $category_id, $image, $description, $content, $status)) {
        $msg = "Post updated successfully!";
        // Refresh post data
        $post = $post_obj->getByIdAdmin($id);
    } else {
        $error = "Something went wrong.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Admin</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin_container">
        <div class="admin_header">
            <h1>Edit Post</h1>
            <a href="dashboard.php" style="color: #64748b;">Back to Dashboard</a>
        </div>

        <?php if ($msg): ?>
            <div class="msg_success"><?= $msg ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="msg_error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form_group">
                <label>Post Title</label>
                <input type="text" name="title" class="form_input" value="<?= htmlspecialchars($post['title']) ?>" required>
            </div>

            <div class="form_row">
                <div class="form_group">
                    <label>Category</label>
                    <select name="category_id" class="form_select" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $post['category_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form_group">
                    <label>Status</label>
                    <select name="status" class="form_select" required>
                        <option value="published" <?= ($post['status'] == 'published') ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= ($post['status'] == 'draft') ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>
            </div>

            <div class="form_group">
                <label>Image URL</label>
                <input type="url" name="image" class="form_input" value="<?= htmlspecialchars($post['image']) ?>" required>
            </div>

            <div class="form_group">
                <label>Short Description</label>
                <input type="text" name="description" class="form_input" value="<?= htmlspecialchars($post['description']) ?>" required>
            </div>

            <div class="form_group">
                <label>Full Content</label>
                <textarea name="content" class="form_textarea" required><?= htmlspecialchars($post['content']) ?></textarea>
            </div>

            <button type="submit" class="btn_submit">Update Post</button>
        </form>
    </div>
</body>
</html>
