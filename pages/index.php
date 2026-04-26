<?php
session_start();

require '../config/connexion.php';
require '../article.php';

$database = new Database();
$db = $database->getConnection();

$post_obj = new Article($db);
$posts = $post_obj->all();
?>


<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tangier Vibes - Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/home.css">
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <!-- hero section  -->
    <section class="hero_section" id="hero_section">

        <img src="../images/image1.jpg" alt="Tangier - backgrond image hero" class="hero_bg_img" loading="lazy">

        <div class="hero_overlay"></div>

        <div class="hero_content">

            <p class="hero_label">WELCOME TO YOUR GATEWAY TO AFRICA</p>

            <h1 class="hero_title">
                Experience the Magic<br>
                of <span class="hero_highlight">Tangier</span>
            </h1>

            <p class="hero_desc">
                Discover hidden beaches, legendary cafes, exquisite<br>
                restaurants, and historic landmarks in the Pearl of the North.
            </p>

            <div class="hero_btns">
                <a href="explore.php" class="hero_btn_primary" id="btn_explore">
                    Start Exploring
                </a>

                <a href="#" class="hero_btn_outline" id="btn_top">
                    Top Picks <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>

    </section>

    <!-- last 5 post -->
    <section class="latest_section" id="latest_section">

        <div class="section_header">
            <h2 class="section_title">Latest Places</h2>
            <p class="section_subtitle">The newest additions to TangierVibes</p>
        </div>

        <div class="places_list">
            <?php foreach ($posts as $i => $post): ?>
                <a href="post_details.php?id=<?= $post['id'] ?>" class="place_card">
                    <span class="place_rank rank_top"><?= $i + 1 ?></span>
                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>"
                        class="place_img" loading="lazy">
                    <div class="place_info">
                        <span class="place_category"><?= htmlspecialchars($post['cat_name']) ?></span>
                        <p class="place_name"><?= htmlspecialchars($post['title']) ?></p>
                        <p class="place_views">
                            <i class="fa-regular fa-eye"></i> <?= number_format($post['views']) ?> views
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>



        </div>

        <div class="section_footer">
            <a href="explore.php" class="view_all_link" id="view_all_btn">
                View All Places <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </section>


    <!-- footer  -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>