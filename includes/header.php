<!-- Tangier Vibes Header -->
<header class="site_header">
    <nav class="header_nav">
        
        <!-- 1. Logo -->
        <a href="index.php" class="logo" id="logo_link">
            <div class="logo_icon"><i class="fa-solid fa-compass"></i></div>
            <span class="logo_text">Tangier <span class="highlight">Vibes</span></span>
        </a>

        <!-- 2. Navbar (Desktop Only) -->
        <ul class="nav_links desktop_only" id="nav_links">
            <li><a href="index.php" class="nav_link" id="nav_home">Home</a></li>
            <li><a href="#" class="nav_link" id="nav_top">Top Places</a></li>
            <li><a href="explore.php" class="nav_link" id="nav_explore">Explore</a></li>
            <li><a href="#" class="nav_link" id="nav_favorites"><i class="fa-regular fa-heart"></i> Favorites</a></li>
        </ul>

        <!-- 3. Search Bar (Desktop Only) -->
        <div class="header_search_container desktop_only">
            <form method="GET" action="explore.php" class="header_search_form">
                <i class="fa-solid fa-magnifying-glass search_icon"></i>
                <input type="text" name="search" placeholder="Search places..." class="header_search_input" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </form>
        </div>

        <!-- 4. Actions & Auth (Desktop Only) -->
        <div class="auth_actions desktop_only">
            <?php if (isset($_SESSION['username'])): ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <div class="user_profile_dropdown">
                        <div class="profile_trigger" id="profileTrigger">
                            <i class="fa-regular fa-circle-user profile_icon"></i>
                            <i class="fa-solid fa-chevron-down dropdown_arrow"></i>
                        </div>
                        <div class="dropdown_menu" id="dropdownMenu">
                            <div class="dropdown_header">
                                <span class="user_name"><?= htmlspecialchars($_SESSION['username']) ?></span>
                                <span class="user_role">Administrator</span>
                            </div>
                            <hr>
                            <a href="dashboard.php" class="dropdown_item"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                            <a href="logout.php" class="dropdown_item logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="welcome_group">
                        <span class="welcome_text">Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
                    </div>
                    <a href="logout.php" class="logout_btn">Logout</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="login.php" class="login_btn">Login</a>
                <a href="register.php" class="join_btn">Register</a>
            <?php endif; ?>
        </div>

        <!-- 5. Mobile Triggers -->
        <div class="mobile_triggers">
            <button class="mobile_icon_btn" id="mobileSearchTrigger"><i class="fa-solid fa-magnifying-glass"></i></button>
            <button class="mobile_icon_btn" id="mobileProfileTrigger"><i class="fa-regular fa-circle-user"></i></button>
            <button class="mobile_icon_btn" id="mobileMenuTrigger"><i class="fa-solid fa-bars"></i></button>
        </div>
    </nav>

    <!-- Mobile Overlays -->
    <div class="mobile_search_overlay" id="mobileSearchBar">
        <div class="search_container_inner">
            <form method="GET" action="explore.php" class="mobile_search_form">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Search..." class="mobile_input">
                <button type="button" id="closeSearch"><i class="fa-solid fa-xmark"></i></button>
            </form>
        </div>
    </div>

    <div class="mobile_nav_overlay" id="mobileNav">
        <div class="mobile_nav_content">
            <div class="mobile_nav_header">
                <span class="logo_text">Tangier <span class="highlight">Vibes</span></span>
                <button id="closeMenu"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <ul class="mobile_menu_links">
                <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="#"><i class="fa-solid fa-star"></i> Top Places</a></li>
                <li><a href="explore.php"><i class="fa-solid fa-compass"></i> Explore</a></li>
                <li><a href="#"><i class="fa-regular fa-heart"></i> Favorites</a></li>
            </ul>
        </div>
    </div>

    <div class="mobile_profile_overlay" id="mobileProfileMenu">
        <div class="mobile_profile_content">
            <div class="profile_menu_header">
                <h3>Profile</h3>
                <button id="closeProfile"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="profile_menu_body">
                <?php if (isset($_SESSION['username'])): ?>
                    <div class="user_info_card">
                        <i class="fa-regular fa-circle-user"></i>
                        <div class="info_text">
                            <span class="name"><?= htmlspecialchars($_SESSION['username']) ?></span>
                            <span class="role"><?= ($_SESSION['role'] == 'admin') ? 'Admin' : 'User' ?></span>
                        </div>
                    </div>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a href="dashboard.php" class="profile_link"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                    <?php endif; ?>
                    <a href="logout.php" class="profile_link logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                <?php else: ?>
                    <a href="login.php" class="profile_link"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    <a href="register.php" class="profile_link"><i class="fa-solid fa-user-plus"></i> Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<script>
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (document.getElementById('profileTrigger')) {
        document.getElementById('profileTrigger').onclick = (e) => { e.stopPropagation(); dropdownMenu.classList.toggle('show'); };
    }

    const setupToggle = (triggerId, menuId, closeId) => {
        const trigger = document.getElementById(triggerId);
        const menu = document.getElementById(menuId);
        const close = document.getElementById(closeId);
        if (trigger && menu) {
            trigger.onclick = () => { menu.classList.add('active'); document.body.style.overflow = 'hidden'; };
            close.onclick = () => { menu.classList.remove('active'); document.body.style.overflow = 'auto'; };
        }
    };

    setupToggle('mobileMenuTrigger', 'mobileNav', 'closeMenu');
    setupToggle('mobileSearchTrigger', 'mobileSearchBar', 'closeSearch');
    setupToggle('mobileProfileTrigger', 'mobileProfileMenu', 'closeProfile');

    window.onclick = (e) => {
        if (dropdownMenu) dropdownMenu.classList.remove('show');
        [document.getElementById('mobileNav'), document.getElementById('mobileSearchBar'), document.getElementById('mobileProfileMenu')].forEach(m => {
            if (e.target == m) { m.classList.remove('active'); document.body.style.overflow = 'auto'; }
        });
    };
</script>