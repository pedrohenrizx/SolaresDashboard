<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex hidden" id="page-body">

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <?php include 'includes/topbar.php'; ?>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                Gamification
                <span class="ml-3 bg-yellow-500 text-black text-xs px-2 py-1 rounded font-bold uppercase tracking-wider">Pro Feature</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Leaderboard -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4 text-center"><i class="fas fa-crown text-yellow-500 mr-2"></i> Team Leaderboard</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded border border-yellow-200 dark:border-yellow-700">
                            <div class="flex items-center">
                                <span class="text-xl font-bold text-yellow-600 mr-4 w-6 text-center">1</span>
                                <span class="font-medium">Sarah Jenkins (Sales)</span>
                            </div>
                            <span class="font-bold text-primary">2,450 pts</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded">
                            <div class="flex items-center">
                                <span class="text-xl font-bold text-gray-500 mr-4 w-6 text-center">2</span>
                                <span class="font-medium">Mike Ross (Support)</span>
                            </div>
                            <span class="font-bold text-primary">1,890 pts</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded">
                            <div class="flex items-center">
                                <span class="text-xl font-bold text-orange-400 mr-4 w-6 text-center">3</span>
                                <span class="font-medium">Elena Gilbert (Marketing)</span>
                            </div>
                            <span class="font-bold text-primary">1,620 pts</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Achievements -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Recent Achievements</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-green-100 text-green-600 p-2 rounded-full mr-3"><i class="fas fa-star"></i></div>
                            <div>
                                <p class="font-medium text-sm">Retention Master</p>
                                <p class="text-xs text-gray-500">Sarah retained 5 high-risk clients this week. (+500 pts)</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3"><i class="fas fa-bullseye"></i></div>
                            <div>
                                <p class="font-medium text-sm">Target Smasher</p>
                                <p class="text-xs text-gray-500">Elena exceeded the monthly MQL goal by 20%. (+300 pts)</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-purple-100 text-purple-600 p-2 rounded-full mr-3"><i class="fas fa-smile-beam"></i></div>
                            <div>
                                <p class="font-medium text-sm">Customer Favorite</p>
                                <p class="text-xs text-gray-500">Mike maintained a 4.9 CSAT score for 30 days. (+400 pts)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                if(checkProAccess('access Gamification features')) {
                    document.getElementById('page-body').classList.remove('hidden');
                }
            }, 500);
        });
    </script>
</body>
</html>
