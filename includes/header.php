<!-- header -->

<header class="site_header">
    <nav class="header_nav">

        <a href="index.php" class="logo" id="logo_link">
            <i class="fa-solid fa-compass navbar_logo-icon"></i>
            <span class="logo_first">Tangier</span>
            <span class="logo_second">Vibes</span>
        </a>

        <div class="mobile_top_bar" id="mobile_top_bar">
            <button class="menu_btn" id="menu_btn" aria-label="menu opem">
                <i class="fa-solid fa-bars" id="menu_icon"></i>
            </button>

            <button class="search_toggle_btn" id="search_toggle_btn" aria-label="search open">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>

        <ul class="nav_links" id="nav_links">
            <li><a href="index.php" class="nav_link" id="nav_home">Home</a></li>
            <li><a href="top_places.php" class="nav_link" id="nav_top">Top Places</a></li>
            <li><a href="explore.php" class="nav_link" id="nav_explore">Explore</a></li>
            <li>
                <a href="favorites.php" class="nav_link" id="nav_favorites">
                    <i class="fa-regular fa-heart"></i> Favorites
                </a>
            </li>

            <?php if (isset($_SESSION['username'])): ?>
                <li class="mobile_auth">
                    <a href="logout.php" class="nav_link" style="color: #ef4444;">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            <?php else: ?>
                <li class="mobile_auth">
                    <a href="login.php" class="nav_link" id="nav_login">
                        <i class="fa-regular fa-user"></i> Login
                    </a>
                </li>
                <li class="mobile_auth">
                    <a href="register.php" class="nav_link nav_register" id="nav_register">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <form method="GET" action="explore.php" class="search_box" id="search_box">
            <i class="fa-solid fa-magnifying-glass search_icon"></i>
            <input type="text" class="search_input" name="search" id="search_input" placeholder="Search places..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        </form>

        <div class="auth_btns" id="auth_btns">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="welcome_msg">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="login_btn" style="color: #ef4444; margin-left: 10px;">Logout</a>
            <?php else: ?>
                <a href="login.php" class="login_btn" id="login_btn">Login</a>
                <a href="register.php" class="join_btn" id="join_btn">Register</a>
            <?php endif; ?>
        </div>

    </nav>
</header>