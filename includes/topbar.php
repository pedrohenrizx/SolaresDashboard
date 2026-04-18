<!-- Topbar -->
<header class="bg-white dark:bg-gray-800 shadow-sm z-10 sticky top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <button id="mobile-menu-btn" class="lg:hidden px-4 border-r border-gray-200 dark:border-gray-700 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex-shrink-0 flex items-center px-4 lg:px-0">
                    <span id="page-title" class="font-semibold text-xl text-gray-800 dark:text-white">Dashboard</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Theme Toggle -->
                <button onclick="toggleTheme()" class="p-2 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>

                <!-- Profile dropdown -->
                <div class="relative flex items-center space-x-3">
                    <div class="text-sm text-right hidden sm:block">
                        <p id="topbar-username" class="font-medium text-gray-700 dark:text-gray-300">User</p>
                    </div>
                    <button onclick="logout()" class="text-sm font-medium text-red-600 hover:text-red-500 dark:text-red-400 dark:hover:text-red-300">
                        <i class="fas fa-sign-out-alt"></i> <span class="hidden sm:inline">Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const currentUser = Parse.User.current();
        if (currentUser) {
            document.getElementById('topbar-username').textContent = currentUser.get('username');
        }

        // Dynamically set page title based on path
        const path = window.location.pathname;
        const titleMap = {
            '/index.php': 'Overview',
            '/customers.php': 'Customer Segmentation',
            '/behavior.php': 'Behavior Analysis',
            '/satisfaction.php': 'Satisfaction',
            '/predictions.php': 'Predictions & Alerts',
            '/reports.php': 'Reports',
            '/collaboration.php': 'Team Collaboration',
            '/gamification.php': 'Gamification',
            '/upgrade.php': 'Upgrade to Pro'
        };

        if (titleMap[path]) {
            document.getElementById('page-title').textContent = titleMap[path];
            document.title = titleMap[path] + " - CustomerFlow";
        }
    });
</script>
