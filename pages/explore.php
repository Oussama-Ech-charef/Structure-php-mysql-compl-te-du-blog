<?php
session_start();

require '../config/connexion.php';
require '../article.php';

$database = new Database();
$db = $database->getConnection();

$post_obj = new Article($db);
$posts = $post_obj->readAll();
?>
<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tangier Vibes - Explore</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/explore.css">
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <main class="explore_page">
        <section class="explore_section">

            <div class="explore_header">
                <h1 class="explore_title">Explore by Category</h1>
                <p class="explore_subtitle">Find exactly what you're looking for</p>
            </div>
            <!-- category  -->
            <div class="explore_filters">
                <button class="filter_btn active">All Places</button>
                <button class="filter_btn">Beaches</button>
                <button class="filter_btn">Cafes</button>
                <button class="filter_btn">Hotels</button>
                <button class="filter_btn">Markets</button>
                <button class="filter_btn">Museums</button>
                <button class="filter_btn">Parks</button>
                <button class="filter_btn">Restaurants</button>
                <button class="filter_btn">Tourist Spots</button>
            </div>
            <!-- card post  -->
            <div class="explore_grid">
                <?php foreach ($posts as $post): ?>

                    <div class="explore_card">
                        <div class="card_img_wrapper">
                            <span class="card_badge"><?= htmlspecialchars($post['cat_name']) ?></span>
                            <img src="<?= htmlspecialchars($post['image']) ?>"
                                alt="<?= htmlspecialchars($post['title']) ?> " class="card_img">
                            <button class="card_heart" aria-label="Add to favorites "><i
                                    class="fa-regular fa-heart"></i></button>
                        </div>
                        <div class="card_body">
                            <h3 class="card_title"><?= htmlspecialchars($post['title']) ?> </h3>
                            <p class="card_desc"><?= htmlspecialchars($post['description']) ?></p>
                            <div class="card_footer">
                                <span class="card_views"><i class="fa-regular fa-eye"></i>
                                    <?= htmlspecialchars($post['views']) ?></span>
                                <a href="post_details.php?id=<?= $post['id'] ?>" class="card_link">Read More <i
                                        class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>


                <?php endforeach; ?>
            </div>

            <div class="pagination">
                <button class="page_btn disabled"><i class="fa-solid fa-arrow-left"></i> Previous</button>
                <button class="page_num active">1</button>
                <button class="page_num">2</button>
                <span class="page_text">Page 1 of 2</span>
                <button class="page_btn">Next <i class="fa-solid fa-arrow-right"></i></button>
            </div>

        </section>
    </main>






    <!-- footer  -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>