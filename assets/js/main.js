
document.addEventListener('DOMContentLoaded', () => {

    // 1. Variable Definitions (Selecting DOM elements)
    const menuBtn = document.querySelector('#menu_btn');
    const navLinks = document.querySelector('#nav_links');
    const menuIcon = document.querySelector('#menu_icon');
    const searchToggle = document.querySelector('#search_toggle_btn');
    const searchBox = document.querySelector('#search_box');
    const allLinks = document.querySelectorAll('.nav_link');
    const currentPath = window.location.pathname;

    // 2. Mobile Menu Toggle (Open and Close)
    menuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('open');

        // Toggle icon between (Bars) and (X)
        const isOpen = navLinks.classList.contains('open');
        menuIcon.classList.replace(isOpen ? 'fa-bars' : 'fa-xmark', isOpen ? 'fa-xmark' : 'fa-bars');
    });

    // 3. Search Box Toggle
    searchToggle.addEventListener('click', () => {
        searchBox.classList.toggle('open');
        // Focus input if search box is open
        if (searchBox.classList.contains('open')) {
            document.querySelector('#search_input').focus();
        }
    });

    // 4. Navbar Active Link matching the current page
    allLinks.forEach(link => {
        const linkHref = link.getAttribute('href');

        // Check if link matches the current browser URL
        if (linkHref !== "#" && currentPath.includes(linkHref)) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }

        // Special case for the Home page
        if (linkHref === "index.php" && (currentPath.endsWith('/') || currentPath === "")) {
            link.classList.add('active');
        }
    });

});