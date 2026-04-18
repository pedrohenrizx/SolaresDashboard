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

        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto flex items-center justify-center">

            <div class="max-w-lg w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center" id="upgrade-container">
                <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">Upgrade to Pro</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8">Unlock predictions, reports, collaboration, and gamification features.</p>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-8 border border-gray-200 dark:border-gray-600 text-left">
                    <ul class="space-y-3">
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-3"></i> <span>Advanced Predictions & Alerts</span></li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-3"></i> <span>Custom PDF & Excel Reports</span></li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-3"></i> <span>Team Collaboration Tools</span></li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-3"></i> <span>Team Gamification & Leaderboards</span></li>
                    </ul>
                </div>

                <div class="text-4xl font-bold text-gray-900 dark:text-white mb-6">$29<span class="text-lg text-gray-500 font-normal">/month</span></div>

                <button id="upgrade-btn" class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-colors text-lg flex justify-center items-center">
                    <span id="btn-text">Confirm Payment & Upgrade</span>
                    <i id="btn-spinner" class="fas fa-circle-notch fa-spin ml-2 hidden"></i>
                </button>
            </div>

            <div id="success-message" class="hidden max-w-lg w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center">
                <div class="text-green-500 mb-4">
                    <i class="fas fa-check-circle text-6xl"></i>
                </div>
                <h2 class="text-2xl font-bold mb-2">Payment Confirmed!</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Your account has been upgraded to the Pro plan. You now have access to all features.</p>
                <a href="/index.php" class="bg-primary hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition-colors">Go to Dashboard</a>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const currentUser = Parse.User.current();
            if (currentUser && currentUser.get('isPro')) {
                document.getElementById('upgrade-container').innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-star text-yellow-500 text-6xl mb-4"></i>
                        <h2 class="text-2xl font-bold mb-2">You are already a Pro user!</h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Enjoy your premium features.</p>
                        <a href="/index.php" class="bg-primary hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition-colors">Return to Dashboard</a>
                    </div>
                `;
                return;
            }

            document.getElementById('upgrade-btn').addEventListener('click', async () => {
                if (!currentUser) {
                    alert("Please log in first.");
                    window.location.href = '/login.php';
                    return;
                }

                const btnText = document.getElementById('btn-text');
                const btnSpinner = document.getElementById('btn-spinner');

                btnText.textContent = "Processing...";
                btnSpinner.classList.remove('hidden');
                document.getElementById('upgrade-btn').disabled = true;

                // Simulate payment processing delay
                setTimeout(async () => {
                    try {
                        currentUser.set("isPro", true);
                        await currentUser.save();

                        document.getElementById('upgrade-container').classList.add('hidden');
                        document.getElementById('success-message').classList.remove('hidden');

                        // Update sidebar badge if it exists
                        const badgeContainer = document.getElementById('plan-badge-container');
                        if(badgeContainer) {
                            badgeContainer.innerHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-star mr-1"></i> Pro Plan</span>';
                        }
                    } catch (error) {
                        alert("Error upgrading: " + error.message);
                        btnText.textContent = "Confirm Payment & Upgrade";
                        btnSpinner.classList.add('hidden');
                        document.getElementById('upgrade-btn').disabled = false;
                    }
                }, 1500);
            });
        });
    </script>
</body>
</html>
