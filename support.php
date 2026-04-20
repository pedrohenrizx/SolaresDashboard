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
            <h2 class="text-2xl font-bold mb-6">Help & Support</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- FAQs -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Frequently Asked Questions</h3>
                    <div class="space-y-4">
                        <details class="group">
                            <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                                <span>How do I export my reports?</span>
                                <span class="transition group-open:rotate-180">
                                    <i class="fas fa-chevron-down text-gray-500"></i>
                                </span>
                            </summary>
                            <p class="text-gray-600 dark:text-gray-400 mt-3 group-open:animate-fadeIn">
                                Navigate to the Reports tab, select your criteria, and use the "Export as PDF" or "Excel" buttons located at the bottom of the filter menu.
                            </p>
                        </details>
                        <details class="group">
                            <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                                <span>How often is data updated?</span>
                                <span class="transition group-open:rotate-180">
                                    <i class="fas fa-chevron-down text-gray-500"></i>
                                </span>
                            </summary>
                            <p class="text-gray-600 dark:text-gray-400 mt-3 group-open:animate-fadeIn">
                                Data on the Overview dashboard is updated in real-time. Analytical data like behavior and predictions sync every hour.
                            </p>
                        </details>
                        <details class="group">
                            <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                                <span>How do I add team members?</span>
                                <span class="transition group-open:rotate-180">
                                    <i class="fas fa-chevron-down text-gray-500"></i>
                                </span>
                            </summary>
                            <p class="text-gray-600 dark:text-gray-400 mt-3 group-open:animate-fadeIn">
                                Go to the Collaboration tab and click "Invite Member". You can assign different roles like Admin or Editor.
                            </p>
                        </details>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Contact Support</h3>
                    <form id="support-form" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                            <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md dark:bg-gray-700">
                                <option>General Inquiry</option>
                                <option>Technical Issue</option>
                                <option>Billing</option>
                                <option>Feature Request</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                            <textarea rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white" placeholder="Describe your issue in detail..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-sm flex justify-center items-center">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="font-medium mb-4">Direct Contact</h4>
                        <div class="space-y-3 text-sm">
                            <a href="mailto:pedrohenri.craftmourazx@gmail.com" class="flex items-center text-gray-600 dark:text-gray-400 hover:text-primary transition-colors">
                                <i class="fas fa-envelope mr-3 text-primary"></i> pedrohenri.craftmourazx@gmail.com
                            </a>
                            <a href="https://wa.me/5522992685896" target="_blank" class="flex items-center text-gray-600 dark:text-gray-400 hover:text-green-500 transition-colors">
                                <i class="fab fa-whatsapp mr-3 text-green-500 text-lg"></i> (22) 99268-5896
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById('page-body').classList.remove('hidden');

            document.getElementById('support-form').addEventListener('submit', (e) => {
                e.preventDefault();
                showToast('Message sent! Our team will contact you shortly.', 'success');
                e.target.reset();
            });
        });
    </script>
</body>
</html>
