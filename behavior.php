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
                    <h3 class="text-lg font-semibold mb-4">Customer Categories</h3>
                    <div class="relative h-64">
                        <canvas id="channelsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Popular Products -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <h3 class="text-lg font-semibold mb-4">Top Categories (Dynamic)</h3>
                <div class="space-y-4" id="category-list">
                    <div class="flex justify-center p-4">
                        <i class="fas fa-circle-notch fa-spin text-2xl text-primary"></i>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            if(typeof Chart !== 'undefined') {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#e5e7eb' : '#374151';

                let retailCount = 0;
                let enterpriseCount = 0;
                let wholesaleCount = 0;

                try {
                    const Customer = Parse.Object.extend("Customer");
                    const query = new Parse.Query(Customer);
                    const results = await query.find();

                    results.forEach(c => {
                        const cat = c.get('category');
                        if (cat === 'Retail') retailCount++;
                        if (cat === 'Enterprise') enterpriseCount++;
                        if (cat === 'Wholesale') wholesaleCount++;
                    });

                    // Populate Top Categories List
                    const listContainer = document.getElementById('category-list');
                    listContainer.innerHTML = '';

                    const categories = [
                        { name: 'Retail', count: retailCount, color: 'bg-primary' },
                        { name: 'Enterprise', count: enterpriseCount, color: 'bg-blue-500' },
                        { name: 'Wholesale', count: wholesaleCount, color: 'bg-purple-500' }
                    ].sort((a, b) => b.count - a.count);

                    function escapeHTML(str) {
                        return new Option(str).innerHTML;
                    }

                    categories.forEach((cat, index) => {
                        const safeName = escapeHTML(cat.name);
                        listContainer.innerHTML += `
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 ${cat.color} rounded flex items-center justify-center text-white font-bold mr-4">${index + 1}</div>
                                    <div>
                                        <p class="font-medium">${safeName}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">${cat.count} customers</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                } catch (error) {
                    showToast("Error loading behavior data: " + error.message, "error");
                }

                const ctx = document.getElementById('channelsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Retail', 'Enterprise', 'Wholesale'],
                        datasets: [{
                            data: [retailCount, enterpriseCount, wholesaleCount],
                            backgroundColor: ['#4f46e5', '#3b82f6', '#a855f7'],
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
