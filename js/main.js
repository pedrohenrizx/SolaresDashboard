// Theme management
function toggleTheme() {
    const isDark = document.documentElement.classList.contains('dark');
    if (isDark) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        showToast('Switched to Light Mode', 'success');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        showToast('Switched to Dark Mode', 'success');
    }
}

// Toast Notification System
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');

    // Define colors based on type
    const colors = {
        success: 'bg-green-100 text-green-800 border-green-500',
        error: 'bg-red-100 text-red-800 border-red-500',
        info: 'bg-blue-100 text-blue-800 border-blue-500'
    };

    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        info: 'fa-info-circle'
    };

    toast.className = `flex items-center p-4 border-l-4 rounded shadow-md toast-enter ${colors[type] || colors.info} dark:bg-gray-800 dark:text-white`;
    toast.innerHTML = `
        <i class="fas ${icons[type] || icons.info} text-xl mr-3"></i>
        <div class="text-sm font-medium">${message}</div>
    `;

    container.appendChild(toast);

    // Remove toast after 3 seconds
    setTimeout(() => {
        toast.classList.remove('toast-enter');
        toast.classList.add('toast-exit');
        setTimeout(() => toast.remove(), 300); // Wait for exit animation
    }, 3000);
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
