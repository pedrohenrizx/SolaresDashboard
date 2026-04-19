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
                    <button onclick="showToast('Exporting CSV...', 'info')" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex items-center shadow-sm">
                        <i class="fas fa-file-csv mr-2"></i> Export
                    </button>
                    <select class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm px-4 py-2 focus:ring-primary focus:border-primary">
                        <option>Location</option>
                        <option>Purchase Frequency</option>
                        <option>Avg Spent</option>
                        <option>Status</option>
                    </select>
                    <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors shadow-sm">
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
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" onclick="document.getElementById('customer-modal').classList.remove('hidden')">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">Alice Johnson</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Sydney, AU</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">$840</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Mockup -->
                <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6 flex items-center justify-between">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">24</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
                                <a href="#" class="bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
                                <a href="#" class="bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 3 </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State Mockup (Hidden by default) -->
            <div id="empty-state" class="hidden mt-8 text-center bg-white dark:bg-gray-800 rounded-lg shadow p-12">
                <i class="fas fa-search text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">No customers found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters or search criteria.</p>
                <div class="mt-6">
                    <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-600 focus:outline-none">
                        <i class="fas fa-times mr-2"></i> Clear Filters
                    </button>
                </div>
            </div>

        </main>
    </div>

    <!-- Customer Detail Modal -->
    <div id="customer-modal" class="hidden fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('customer-modal').classList.add('hidden')"></div>
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-white dark:bg-gray-800 shadow-xl">
                        <div class="bg-primary px-4 py-6 sm:px-6 text-white flex items-center justify-between">
                            <h2 class="text-lg font-medium" id="slide-over-title">Customer Profile</h2>
                            <button type="button" class="rounded-md text-white hover:text-gray-200 focus:outline-none" onclick="document.getElementById('customer-modal').classList.add('hidden')">
                                <span class="sr-only">Close panel</span>
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <div class="relative flex-1 px-4 py-6 sm:px-6">
                            <div class="text-center mb-6">
                                <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-3 flex items-center justify-center text-2xl font-bold text-gray-500">AJ</div>
                                <h3 class="text-xl font-bold">Alice Johnson</h3>
                                <p class="text-sm text-gray-500">Inactive Customer • Sydney, AU</p>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Spent</p>
                                    <p class="mt-1 text-lg font-semibold">$840.00</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Last Purchase</p>
                                    <p class="mt-1 text-sm">October 12, 2023</p>
                                </div>
                                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <button onclick="showToast('Re-engagement email sent', 'success')" class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                        <i class="fas fa-paper-plane mr-2"></i> Send Re-engagement Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
