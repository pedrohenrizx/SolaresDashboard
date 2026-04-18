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
                Predictions & Alerts
                <span class="ml-3 bg-yellow-500 text-black text-xs px-2 py-1 rounded font-bold uppercase tracking-wider">Pro Feature</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Churn Risk -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-red-500">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-semibold">High Churn Risk Accounts</h3>
                        <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex justify-between items-center p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded">
                            <div>
                                <p class="font-medium">TechCorp Inc.</p>
                                <p class="text-xs text-gray-500">Usage down 40% this week</p>
                            </div>
                            <button class="text-sm bg-gray-200 dark:bg-gray-600 px-3 py-1 rounded hover:bg-gray-300 dark:hover:bg-gray-500">Action</button>
                        </li>
                        <li class="flex justify-between items-center p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded">
                            <div>
                                <p class="font-medium">Global Media LLC</p>
                                <p class="text-xs text-gray-500">Payment failed twice</p>
                            </div>
                            <button class="text-sm bg-gray-200 dark:bg-gray-600 px-3 py-1 rounded hover:bg-gray-300 dark:hover:bg-gray-500">Action</button>
                        </li>
                    </ul>
                </div>

                <!-- Revenue Prediction -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-semibold">Revenue Forecast (Next 30 Days)</h3>
                        <i class="fas fa-chart-line text-green-500 text-xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-gray-800 dark:text-white mb-2">~$24,500</div>
                    <p class="text-sm text-green-600 font-medium"><i class="fas fa-arrow-up"></i> 8.5% increase projected</p>
                    <p class="text-xs text-gray-500 mt-4">Based on current acquisition rates and historical seasonal data.</p>
                </div>
            </div>

            <!-- Automated Alerts Log -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <h3 class="text-lg font-semibold mb-4">System Alerts</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap w-10">
                                    <span class="text-yellow-500"><i class="fas fa-bell"></i></span>
                                </td>
                                <td class="px-4 py-3 text-sm">Unusual spike in cart abandonment detected (14:00 - 15:00).</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 text-right">2 hrs ago</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap w-10">
                                    <span class="text-green-500"><i class="fas fa-check-circle"></i></span>
                                </td>
                                <td class="px-4 py-3 text-sm">Weekly retention goal (+5%) achieved.</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 text-right">1 day ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Check Pro Status before showing content
            setTimeout(() => {
                if(checkProAccess('access Predictions & Alerts')) {
                    document.getElementById('page-body').classList.remove('hidden');
                }
            }, 500); // small delay to ensure Parse user is loaded
        });
    </script>
</body>
</html>
