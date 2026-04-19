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

            <!-- Dashboard Header Controls -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold">Real-time Overview</h2>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <select class="appearance-none bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 py-2 pl-4 pr-10 rounded shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            <option>Last 7 Days</option>
                            <option selected>Last 30 Days</option>
                            <option>This Quarter</option>
                            <option>This Year</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <button onclick="showToast('Refreshing data...', 'info')" class="p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded shadow-sm text-gray-500 hover:text-primary transition-colors focus:outline-none">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Active Customers</p>
                        <p class="text-2xl font-bold">1,248</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Conversion Rate</p>
                        <p class="text-2xl font-bold">12.4%</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-dollar-sign text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Avg. Revenue</p>
                        <p class="text-2xl font-bold">$142.50</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                        <i class="fas fa-heart text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Retention Rate</p>
                        <p class="text-2xl font-bold">84%</p>
                    </div>
                </div>
            </div>

            <!-- Charts and Timeline -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Charts Section (Span 2) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Customer Growth Chart -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 relative">
                        <div id="growth-spinner" class="absolute inset-0 bg-white/80 dark:bg-gray-800/80 flex items-center justify-center z-10 rounded-lg">
                            <i class="fas fa-spinner fa-spin text-3xl text-primary"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-4">Customer Growth</h3>
                        <div class="relative h-64">
                            <canvas id="growthChart"></canvas>
                        </div>
                    </div>

                    <!-- Retention Trend -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 relative">
                        <div id="retention-spinner" class="absolute inset-0 bg-white/80 dark:bg-gray-800/80 flex items-center justify-center z-10 rounded-lg">
                            <i class="fas fa-spinner fa-spin text-3xl text-primary"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-4">Retention Trend</h3>
                        <div class="relative h-64">
                            <canvas id="retentionChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Timeline (Span 1) -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Recent Activity</h3>
                    <div class="relative border-l border-gray-200 dark:border-gray-700 ml-3 space-y-6 mt-4">
                        <div class="relative pl-6">
                            <span class="absolute -left-1.5 top-1 h-3 w-3 rounded-full bg-green-500 ring-4 ring-white dark:ring-gray-800"></span>
                            <p class="text-sm font-medium">New Pro Subscription</p>
                            <p class="text-xs text-gray-500">TechCorp just upgraded. <span class="text-gray-400">10 min ago</span></p>
                        </div>
                        <div class="relative pl-6">
                            <span class="absolute -left-1.5 top-1 h-3 w-3 rounded-full bg-blue-500 ring-4 ring-white dark:ring-gray-800"></span>
                            <p class="text-sm font-medium">Report Exported</p>
                            <p class="text-xs text-gray-500">Admin generated Monthly Executive PDF. <span class="text-gray-400">1 hr ago</span></p>
                        </div>
                        <div class="relative pl-6">
                            <span class="absolute -left-1.5 top-1 h-3 w-3 rounded-full bg-yellow-500 ring-4 ring-white dark:ring-gray-800"></span>
                            <p class="text-sm font-medium">High Risk Alert</p>
                            <p class="text-xs text-gray-500">Global Media usage dropped. <span class="text-gray-400">3 hrs ago</span></p>
                        </div>
                        <div class="relative pl-6">
                            <span class="absolute -left-1.5 top-1 h-3 w-3 rounded-full bg-primary ring-4 ring-white dark:ring-gray-800"></span>
                            <p class="text-sm font-medium">Goal Reached</p>
                            <p class="text-xs text-gray-500">1,200 active users surpassed! <span class="text-gray-400">1 day ago</span></p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for Chart.js to be available
            if(typeof Chart !== 'undefined') {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#e5e7eb' : '#374151';
                const gridColor = isDark ? '#374151' : '#e5e7eb';

                // Chart Configuration Helper
                const commonOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { labels: { color: textColor } }
                    },
                    scales: {
                        x: { ticks: { color: textColor }, grid: { color: gridColor } },
                        y: { ticks: { color: textColor }, grid: { color: gridColor } }
                    }
                };

                // Growth Chart
                const ctxGrowth = document.getElementById('growthChart').getContext('2d');
                new Chart(ctxGrowth, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Total Customers',
                            data: [800, 950, 1020, 1100, 1180, 1248],
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: commonOptions
                });

                // Retention Chart
                const ctxRetention = document.getElementById('retentionChart').getContext('2d');
                new Chart(ctxRetention, {
                    type: 'bar',
                    data: {
                        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                        datasets: [{
                            label: 'Retention Rate %',
                            data: [82, 85, 83, 84],
                            backgroundColor: '#10b981',
                        }]
                    },
                    options: {
                        ...commonOptions,
                        scales: {
                            ...commonOptions.scales,
                            y: { ...commonOptions.scales.y, min: 0, max: 100 }
                        }
                    }
                });

                // Simulate data loading removal
                setTimeout(() => {
                    const spinners = document.querySelectorAll('.fa-spinner');
                    spinners.forEach(s => s.parentElement.classList.add('hidden'));
                }, 800);
            }
        });
    </script>
</body>
</html>
