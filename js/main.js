// Theme management
function toggleTheme() {
    const isDark = document.documentElement.classList.contains('dark');
    if (isDark) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
}

// Initialize theme
document.addEventListener("DOMContentLoaded", () => {
    // Check local storage for theme preference
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // Toggle sidebar on mobile
    const menuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('close-sidebar');

    if (menuBtn && sidebar) {
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }

    if (closeBtn && sidebar) {
        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    }
});

// Helper for showing Pro functionality
function checkProAccess(actionDescription = 'access this feature') {
    const currentUser = Parse.User.current();
    if (!currentUser) return false;

    if (!currentUser.get('isPro')) {
        const wantsToUpgrade = confirm(`You need a Pro account to ${actionDescription}. Would you like to upgrade now?`);
        if (wantsToUpgrade) {
            window.location.href = '/upgrade.php';
        }
        return false;
    }
    return true;
}
