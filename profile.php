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
            <h2 class="text-2xl font-bold mb-6">User Profile</h2>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-2xl">
                <form id="profile-form" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Avatar</label>
                        <div class="mt-2 flex items-center">
                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <button type="button" class="ml-5 bg-white dark:bg-gray-700 py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Change
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                        <input type="text" id="profile-username" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-gray-50 dark:bg-gray-700 text-gray-500 cursor-not-allowed">
                        <p class="mt-1 text-xs text-gray-500">Username cannot be changed.</p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email address</label>
                        <input type="email" id="profile-email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Preferences</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Receive email notifications</span>
                            <button type="button" class="bg-primary relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" role="switch" aria-checked="true">
                                <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const currentUser = Parse.User.current();
            if (currentUser) {
                document.getElementById('profile-username').value = currentUser.get('username');
                document.getElementById('profile-email').value = currentUser.get('email');
                document.getElementById('page-body').classList.remove('hidden');
            }

            document.getElementById('profile-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                const newEmail = document.getElementById('profile-email').value;
                if(currentUser) {
                    try {
                        currentUser.set('email', newEmail);
                        await currentUser.save();
                        showToast('Profile updated successfully!', 'success');
                    } catch (error) {
                        showToast(error.message, 'error');
                    }
                }
            });
        });
    </script>
</body>
</html>
