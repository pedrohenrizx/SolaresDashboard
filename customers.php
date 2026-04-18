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

            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <h2 class="text-2xl font-bold">Advanced Segmentation</h2>
                <div class="flex gap-2">
                    <select class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm px-4 py-2 focus:ring-primary focus:border-primary">
                        <option>Location</option>
                        <option>Purchase Frequency</option>
                        <option>Avg Spent</option>
                        <option>Status</option>
                    </select>
                    <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                        Apply Filter
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 lg:col-span-2">
                    <h3 class="text-lg font-semibold mb-4">Customer Distribution by Status</h3>
                    <div class="relative h-64">
                        <canvas id="segmentationChart"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Quick Insights</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 h-6 w-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 mt-0.5"><i class="fas fa-check text-xs"></i></span>
                            <span class="ml-3 text-sm">"New" segment grew by 15% this month.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 h-6 w-6 rounded-full bg-red-100 flex items-center justify-center text-red-600 mt-0.5"><i class="fas fa-exclamation text-xs"></i></span>
                            <span class="ml-3 text-sm">"Inactive" segment showing higher average previous spend. Action recommended.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Data Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Spent</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Jane Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">New York, NY</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Loyal</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">$1,250</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">John Smith</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">London, UK</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">New</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">$120</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Alice Johnson</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Sydney, AU</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">$840</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(typeof Chart !== 'undefined') {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#e5e7eb' : '#374151';

                const ctx = document.getElementById('segmentationChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Loyal', 'New', 'Recurring', 'Inactive'],
                        datasets: [{
                            data: [30, 20, 25, 25],
                            backgroundColor: ['#10b981', '#3b82f6', '#8b5cf6', '#ef4444'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'right', labels: { color: textColor } }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
