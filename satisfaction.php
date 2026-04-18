<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex">

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <?php include 'includes/topbar.php'; ?>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6">Satisfaction Monitoring</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-2">Net Promoter Score (NPS)</h3>
                    <div class="text-5xl font-bold text-green-500 mb-2">+42</div>
                    <p class="text-sm text-gray-500">Excellent</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-2">Average Rating</h3>
                    <div class="text-5xl font-bold text-yellow-500 mb-2">4.6</div>
                    <div class="flex justify-center text-yellow-400">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-2">Sentiment Analysis</h3>
                    <div class="text-5xl font-bold text-blue-500 mb-2">78%</div>
                    <p class="text-sm text-gray-500">Positive Feedback</p>
                </div>
            </div>

            <!-- Recent Feedback -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <h3 class="text-lg font-semibold mb-4">Recent Feedback</h3>
                <div class="space-y-4">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <div class="flex justify-between mb-1">
                            <span class="font-medium">"Great service and fast response times."</span>
                            <span class="text-sm text-gray-500">2 hours ago</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="text-green-500 mr-2"><i class="fas fa-smile"></i> Positive</span>
                            <span>• from User #892</span>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <div class="flex justify-between mb-1">
                            <span class="font-medium">"The new feature is a bit confusing to use."</span>
                            <span class="text-sm text-gray-500">5 hours ago</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="text-yellow-500 mr-2"><i class="fas fa-meh"></i> Neutral</span>
                            <span>• from User #412</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="font-medium">"I keep getting an error on checkout."</span>
                            <span class="text-sm text-gray-500">1 day ago</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="text-red-500 mr-2"><i class="fas fa-frown"></i> Negative</span>
                            <span>• from User #773</span>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
