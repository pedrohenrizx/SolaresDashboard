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
            <h2 class="text-2xl font-bold mb-6">Behavior Analysis</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Activity Heatmap Mockup -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Peak Purchasing Hours</h3>
                    <div class="relative h-64 flex items-center justify-center bg-gray-50 dark:bg-gray-700 rounded border border-dashed border-gray-300 dark:border-gray-600">
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <i class="fas fa-th text-4xl mb-2"></i>
                            <p>Activity Heatmap Visualization</p>
                            <p class="text-xs mt-2">Peak times: 18:00 - 21:00 EST</p>
                        </div>
                    </div>
                </div>

                <!-- Acquisition Channels -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Acquisition Channels</h3>
                    <div class="relative h-64">
                        <canvas id="channelsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Popular Products -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <h3 class="text-lg font-semibold mb-4">Top Products/Services</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary rounded flex items-center justify-center text-white font-bold mr-4">1</div>
                            <div>
                                <p class="font-medium">Premium Subscription</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">450 purchases this month</p>
                            </div>
                        </div>
                        <span class="text-green-500 font-semibold"><i class="fas fa-arrow-up mr-1"></i>12%</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded flex items-center justify-center text-white font-bold mr-4">2</div>
                            <div>
                                <p class="font-medium">Consulting Package</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">320 purchases this month</p>
                            </div>
                        </div>
                        <span class="text-green-500 font-semibold"><i class="fas fa-arrow-up mr-1"></i>5%</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded flex items-center justify-center text-white font-bold mr-4">3</div>
                            <div>
                                <p class="font-medium">Basic Plan</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">210 purchases this month</p>
                            </div>
                        </div>
                        <span class="text-red-500 font-semibold"><i class="fas fa-arrow-down mr-1"></i>2%</span>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(typeof Chart !== 'undefined') {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#e5e7eb' : '#374151';

                const ctx = document.getElementById('channelsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Organic Search', 'Social Media', 'Direct', 'Referral'],
                        datasets: [{
                            data: [45, 25, 20, 10],
                            backgroundColor: ['#4f46e5', '#ec4899', '#f59e0b', '#10b981'],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom', labels: { color: textColor } },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed !== null) {
                                            label += context.parsed + '% conversion rate';
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
