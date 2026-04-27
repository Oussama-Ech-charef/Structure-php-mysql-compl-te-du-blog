// Main Site JavaScript

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Navigation Active Link Logic
    const navLinks = document.querySelectorAll('.nav_link');
    const currentPath = window.location.pathname;

    navLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        
        // Remove active class from all first
        link.classList.remove('active');

        // Check if current path ends with link href
        if (currentPath.endsWith(linkHref)) {
            link.classList.add('active');
        } 
        // Special case for Home (index.php) when path might just be the folder
        else if ((currentPath.endsWith('/') || currentPath.endsWith('pages/')) && linkHref === 'index.php') {
            link.classList.add('active');
        }
    });

    // 2. Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || targetId.length <= 1) return;
            
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});