<?php
session_start();



require '../config/connexion.php';
require '../article.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}


$database = new Database();
$db = $database->getConnection();

$post_obj = new Article($db);
$id = $_GET['id'];

$post = $post_obj->getById($id);

if (!$post) {
    header("Location: index.php");
    exit();
}

?>



<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?> - Tangier Vibes</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Manual CSS Links -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/post.css">
</head>

<body>

    <?php include '../includes/header.php'; ?>




    <!-- hero image the post  -->
    <section class="post_hero">
        <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>"
            class="post_hero_img" loading="lazy">
        <div class="post_hero_overlay"></div>

        <div class="post_hero_content">
            <span class="post_badge"><?= htmlspecialchars($post['cat_name']) ?></span>
            <h1 class="post_title"><?= htmlspecialchars($post['title']) ?> </h1>
            <div class="post_meta">
                <span class="meta_item"><i class="fa-regular fa-eye"></i> <?= number_format($post['views']) ?>
                    views</span>
                <span class="meta_item"><i class="fa-regular fa-comment"></i> 1 comment</span>
                <span class="meta_item"><i class="fa-regular fa-calendar"></i>
                    <?= date('F j, Y', strtotime($post['created_at'])) ?></span>
            </div>
        </div>
    </section>

    <main class="post_details_wrapper">
        <div class="container_inner">
            <div class="post_layout_grid">
                <!-- content and comment map  -->
                <div class="post_main_content">

                    <div class="post_article_body">
                        <p class="intro_text"><?= htmlspecialchars($post['description']) ?></p>
                        <p>
                            <?= nl2br(htmlspecialchars($post['content'])) ?>
                        </p>
                    </div>

                    <div class="post_section_location">
                        <h3 class="location_area_title"><i class="fa-solid fa-location-dot"></i> Location</h3>
                        <p class="location_address"><i class="fa-solid fa-location-arrow"
                                style="font-size: 11px; margin-right: 4px; color: #94a3b8;"></i> Achakar, Cap Spartel,
                            Tangier</p>
                        <div class="map_box">
                            <iframe class="map_static_img" src="" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                            <div class="map_controls_overlay">
                                <div class="map_zoom_btn">+</div>
                                <div class="map_zoom_btn">−</div>
                            </div>
                            <div class="map_pin_label">Plage Achakar</div>
                            <div class="map_attribution_overlay">Leaflet | © OpenStreetMap</div>
                        </div>
                    </div>

                    <div class="post_action_btns">
                        <a href="explore.php" class="btn_back_explore"><i class="fa-solid fa-arrow-left"></i>
                            Explore</a>
                        <a href="#" class="btn_more_category">More Beachs <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    <div class="post_comments_area">
                        <h3 class="comments_area_title"><i class="fa-regular fa-comments"></i> Comments <span
                                class="comment_count_badge">1</span></h3>

                        <div class="comment_list">
                            <div class="comment_card">
                                <div class="comment_user_icon">
                                    T
                                </div>
                                <div class="comment_content">
                                    <div class="comment_header">
                                        <span class="user_name">Tom B.</span>
                                        <span class="comment_time">Apr 20, 2026</span>
                                    </div>
                                    <p class="comment_text">Best surfing beach near Tangier. Powerful waves and almost
                                        no tourists. Absolutely loved it.</p>
                                </div>
                            </div>
                        </div>

                        <div class="comment_form_wrapper">
                            <h4 class="form_sub_title">Leave a Comment</h4>
                            <form action="#" class="comment_form">
                                <div class="form_row">
                                    <label for="name_input">Your Name *</label>
                                    <input type="text" id="name_input" class="input_field" required>
                                </div>
                                <div class="form_row">
                                    <label for="comment_input">Your Comment *</label>
                                    <textarea id="comment_input" class="textarea_field" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn_submit_comment"><i
                                        class="fa-regular fa-paper-plane"></i> Post Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- sidbare  -->
                <aside class="post_sidebar_column">

                    <div class="sidebar_card_info">
                        <h3 class="sidebar_card_title">About This Place</h3>
                        <ul class="place_stats_list">
                            <li>
                                <i class="fa-solid fa-layer-group"></i>
                                <div class="stat_text">
                                    <span>Category</span>
                                    <strong><?= htmlspecialchars($post['cat_name']) ?></strong>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-eye"></i>
                                <div class="stat_text">
                                    <span>Views</span>
                                    <strong><?= number_format($post['views']) ?></strong>
                                </div>
                            </li>
                            <li>
                                <i class="fa-regular fa-comment"></i>
                                <div class="stat_text">
                                    <span>Comments</span>
                                    <strong>1</strong>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-calendar-days"></i>
                                <div class="stat_text">
                                    <span>Posted</span>
                                    <strong><?= date('M j, Y', strtotime($post['created_at'])) ?></strong>
                                </div>
                            </li>
                        </ul>

                        <button class="btn_sidebar_save"><i class="fa-regular fa-heart"></i> Save to Favorites</button>

                        <div class="sidebar_social_share">
                            <span class="share_text">Share:</span>
                            <div class="social_icon_links">
                                <a href="#" class="social_link fb"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="social_link tw"><i class="fa-brands fa-x"></i></a>
                                <a href="#" class="social_link wa"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>

</body>

</html>