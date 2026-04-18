<!-- Sidebar -->
<aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen fixed lg:static transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-20 flex flex-col">
    <div class="p-4 flex items-center justify-between border-b border-gray-700">
        <h2 class="text-xl font-bold">CustomerFlow</h2>
        <button id="close-sidebar" class="lg:hidden text-gray-300 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <p class="text-xs uppercase text-gray-400 font-semibold mb-2">Core Features (Free)</p>
        <a href="/index.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-home w-5 text-center"></i>
            <span>Overview</span>
        </a>
        <a href="/customers.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-users w-5 text-center"></i>
            <span>Segmentation</span>
        </a>
        <a href="/behavior.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span>Behavior</span>
        </a>
        <a href="/satisfaction.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-smile w-5 text-center"></i>
            <span>Satisfaction</span>
        </a>

        <div class="pt-4 mt-4 border-t border-gray-700"></div>
        <p class="text-xs uppercase text-gray-400 font-semibold mb-2 flex items-center justify-between">
            Pro Features
            <span class="bg-yellow-500 text-black text-[10px] px-1.5 py-0.5 rounded font-bold">PRO</span>
        </p>

        <a href="/predictions.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-brain w-5 text-center"></i>
            <span>Predictions & Alerts</span>
        </a>
        <a href="/reports.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-file-alt w-5 text-center"></i>
            <span>Reports</span>
        </a>
        <a href="/collaboration.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-users-cog w-5 text-center"></i>
            <span>Collaboration</span>
        </a>
        <a href="/gamification.php" class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors">
            <i class="fas fa-trophy w-5 text-center"></i>
            <span>Gamification</span>
        </a>
    </nav>

    <div class="p-4 border-t border-gray-700">
        <div id="plan-badge-container" class="mb-4">
            <!-- Populated via JS -->
        </div>
        <a href="/upgrade.php" class="block w-full text-center bg-primary hover:bg-blue-600 text-white rounded py-2 transition-colors text-sm font-semibold">
            Upgrade to Pro
        </a>
    </div>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const currentUser = Parse.User.current();
        if (currentUser) {
            const isPro = currentUser.get('isPro');
            const badgeContainer = document.getElementById('plan-badge-container');
            if (isPro) {
                badgeContainer.innerHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-star mr-1"></i> Pro Plan</span>';
            } else {
                badgeContainer.innerHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Free Plan</span>';
            }
        }
    });
</script>
