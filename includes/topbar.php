<!-- Topbar -->
<header class="bg-white dark:bg-gray-800 shadow-sm z-10 sticky top-0 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex flex-1 items-center">
                <button id="mobile-menu-btn" class="lg:hidden px-4 mr-2 border-r border-gray-200 dark:border-gray-700 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary" aria-label="Open Mobile Menu">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="flex flex-col justify-center px-4 lg:px-0 mr-4">
                    <span id="page-title" class="font-semibold text-xl text-gray-800 dark:text-white">Dashboard</span>
                    <nav class="hidden sm:flex text-xs text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-1" id="breadcrumb-list">
                            <li><a href="/index.php" class="hover:text-primary"><i class="fas fa-home"></i></a></li>
                            <li><span class="mx-1">/</span></li>
                            <li id="breadcrumb-current" class="font-medium text-gray-700 dark:text-gray-300">Overview</li>
                        </ol>
                    </nav>
                </div>

                <!-- Global Search Mockup -->
                <div class="hidden md:flex flex-1 max-w-md ml-8">
                    <div class="relative w-full text-gray-400 focus-within:text-gray-600 dark:focus-within:text-gray-300">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search"></i>
                        </div>
                        <input id="global-search" class="block w-full h-full pl-10 pr-3 py-2 border-transparent text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 bg-gray-100 dark:bg-gray-700 rounded-md focus:outline-none focus:bg-white dark:focus:bg-gray-600 focus:ring-0 sm:text-sm transition-colors" placeholder="Search customers, reports..." type="search">
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-4">

                <!-- Notifications Mockup -->
                <button onclick="showToast('No new notifications', 'info')" class="p-2 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary relative" aria-label="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-gray-800"></span>
                </button>

                <!-- Theme Toggle -->
                <button onclick="toggleTheme()" class="p-2 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary" aria-label="Toggle Theme">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>

                <!-- Profile link -->
                <div class="relative flex items-center space-x-3 border-l border-gray-200 dark:border-gray-700 pl-4">
                    <a href="/profile.php" class="text-sm text-right hidden sm:block hover:text-primary transition-colors cursor-pointer">
                        <p id="topbar-username" class="font-medium text-gray-700 dark:text-gray-300">User</p>
                    </a>
                    <button onclick="logout()" class="text-sm font-medium text-red-600 hover:text-red-500 dark:text-red-400 dark:hover:text-red-300" aria-label="Logout">
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

        // Dynamically set page title and breadcrumb based on path
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
            '/profile.php': 'User Profile',
            '/support.php': 'Help & Support',
            '/404.php': 'Page Not Found'
        };

        if (titleMap[path]) {
            document.getElementById('page-title').textContent = titleMap[path];
            document.title = titleMap[path] + " - CustomerFlow";

            const breadcrumb = document.getElementById('breadcrumb-current');
            if(breadcrumb) {
                breadcrumb.textContent = titleMap[path];
            }
        }
    });
</script>
