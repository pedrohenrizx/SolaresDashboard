<!-- Sidebar -->
<aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen fixed lg:static transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out z-20 flex flex-col group" aria-label="Main Navigation">
    <div class="p-4 flex items-center justify-between border-b border-gray-700">
        <h2 class="text-xl font-bold sidebar-text truncate" aria-hidden="true">CustomerFlow</h2>
        <div class="flex items-center gap-2">
            <button id="toggle-desktop-sidebar" class="hidden lg:block text-gray-400 hover:text-white focus:outline-none" aria-label="Toggle Sidebar" title="Collapse Sidebar">
                <i class="fas fa-compress-alt"></i>
            </button>
            <button id="close-sidebar" class="lg:hidden text-gray-300 hover:text-white" aria-label="Close Sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto" id="sidebar-nav">
        <p class="text-xs uppercase text-gray-400 font-semibold mb-2 sidebar-text">Core Features</p>
        <a href="/index.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Overview" aria-label="Overview">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Overview</span>
        </a>
        <a href="/customers.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Customer Segmentation" aria-label="Segmentation">
            <i class="fas fa-users w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Segmentation</span>
        </a>
        <a href="/behavior.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Behavior Analysis" aria-label="Behavior Analysis">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Behavior</span>
        </a>
        <a href="/satisfaction.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Satisfaction Monitoring" aria-label="Satisfaction Monitoring">
            <i class="fas fa-smile w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Satisfaction</span>
        </a>

        <div class="pt-4 mt-4 border-t border-gray-700"></div>
        <p class="text-xs uppercase text-gray-400 font-semibold mb-2 sidebar-text">Advanced Features</p>

        <a href="/predictions.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Predictions & Alerts" aria-label="Predictions and Alerts">
            <i class="fas fa-brain w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Predictions & Alerts</span>
        </a>
        <a href="/reports.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Custom Reports" aria-label="Custom Reports">
            <i class="fas fa-file-alt w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Reports</span>
        </a>
        <a href="/collaboration.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Team Collaboration" aria-label="Team Collaboration">
            <i class="fas fa-users-cog w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Collaboration</span>
        </a>
        <a href="/gamification.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Team Gamification" aria-label="Gamification">
            <i class="fas fa-trophy w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Gamification</span>
        </a>

        <div class="pt-4 mt-4 border-t border-gray-700"></div>
        <a href="/support.php" class="nav-link flex items-center space-x-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded px-3 py-2 transition-colors" title="Help & Support" aria-label="Support">
            <i class="fas fa-question-circle w-5 text-center"></i>
            <span class="sidebar-text whitespace-nowrap">Help & Support</span>
        </a>
    </nav>
</aside>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Active Link Highlighting
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.remove('text-gray-300', 'hover:bg-gray-700');
            link.classList.add('bg-primary', 'text-white', 'shadow-md');
        }
    });

    // Desktop Sidebar Collapse Logic
    const toggleBtn = document.getElementById('toggle-desktop-sidebar');
    const sidebar = document.getElementById('sidebar');
    const texts = document.querySelectorAll('.sidebar-text');
    let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    function updateSidebarState() {
        if (isCollapsed) {
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-20');
            texts.forEach(t => t.classList.add('hidden'));
            toggleBtn.innerHTML = '<i class="fas fa-expand-arrows-alt"></i>';
        } else {
            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-64');
            texts.forEach(t => t.classList.remove('hidden'));
            toggleBtn.innerHTML = '<i class="fas fa-compress-alt"></i>';
        }
    }

    if (toggleBtn) {
        // Initial state
        updateSidebarState();

        toggleBtn.addEventListener('click', () => {
            isCollapsed = !isCollapsed;
            localStorage.setItem('sidebarCollapsed', isCollapsed);
            updateSidebarState();
        });
    }
});
</script>
