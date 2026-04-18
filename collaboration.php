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
                Team Collaboration
                <span class="ml-3 bg-yellow-500 text-black text-xs px-2 py-1 rounded font-bold uppercase tracking-wider">Pro Feature</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Shared Notes -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 lg:col-span-2">
                    <h3 class="text-lg font-semibold mb-4">Shared Insights & Notes</h3>
                    <div class="space-y-4 mb-4">
                        <div class="bg-blue-50 dark:bg-gray-700 p-3 rounded border-l-4 border-blue-500">
                            <p class="text-sm font-medium">Marketing Team <span class="text-gray-500 text-xs font-normal ml-2">Today, 10:30 AM</span></p>
                            <p class="text-sm mt-1">We noticed a drop in conversion from the new Facebook ad campaign. Pausing it for now to analyze further.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded border-l-4 border-gray-400">
                            <p class="text-sm font-medium">Sales Team <span class="text-gray-500 text-xs font-normal ml-2">Yesterday</span></p>
                            <p class="text-sm mt-1">Enterprise segment looks promising. Let's focus our outreach there next week.</p>
                        </div>
                    </div>
                    <div class="mt-4 flex">
                        <input type="text" placeholder="Share an insight..." class="flex-1 rounded-l-md border-gray-300 dark:border-gray-600 focus:ring-primary focus:border-primary dark:bg-gray-700 px-4 py-2 text-sm border-r-0">
                        <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-r-md transition-colors text-sm font-medium">
                            Post
                        </button>
                    </div>
                </div>

                <!-- Team Members -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Team Access</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold mr-3">AD</div>
                                <span class="text-sm font-medium">Admin User</span>
                            </div>
                            <span class="text-xs bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">Owner</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-xs font-bold mr-3">MK</div>
                                <span class="text-sm font-medium">Marketing Team</span>
                            </div>
                            <span class="text-xs bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">Editor</span>
                        </li>
                    </ul>
                    <button class="mt-6 w-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 py-2 rounded text-sm font-medium transition-colors border border-gray-300 dark:border-gray-600">
                        <i class="fas fa-plus mr-1"></i> Invite Member
                    </button>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                if(checkProAccess('access Team Collaboration')) {
                    document.getElementById('page-body').classList.remove('hidden');
                }
            }, 500);
        });
    </script>
</body>
</html>
