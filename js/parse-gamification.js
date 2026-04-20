document.addEventListener('DOMContentLoaded', async function() {
    const container = document.getElementById('leaderboard-container');
    if (!container) return;

    try {
        const query = new Parse.Query(Parse.User);
        query.limit(10);
        // Assuming a points field exists, otherwise sort by creation date as mockup
        query.descending("createdAt");

        const users = await query.find();

        if (users.length === 0) {
            container.innerHTML = '<p class="text-center text-gray-500 py-4">No team members found.</p>';
            return;
        }

        container.innerHTML = '';

        // Mock points calculation based on index for demonstration
        const basePoints = 2500;

        function escapeHTML(str) {
            return new Option(str).innerHTML;
        }

        users.forEach((user, index) => {
            const points = basePoints - (index * 300) - Math.floor(Math.random() * 100);
            const rank = index + 1;
            const username = user.get("username") || "Anonymous";
            const safeUsername = escapeHTML(username);

            // Determine styling based on rank
            let bgClass = "bg-gray-50 dark:bg-gray-700";
            let rankClass = "text-gray-500";

            if (rank === 1) {
                bgClass = "bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700";
                rankClass = "text-yellow-600";
            } else if (rank === 2) {
                rankClass = "text-gray-400"; // Silver
            } else if (rank === 3) {
                rankClass = "text-orange-400"; // Bronze
            }

            const div = document.createElement('div');
            div.className = `flex items-center justify-between p-3 rounded ${bgClass}`;
            div.innerHTML = `
                <div class="flex items-center">
                    <span class="text-xl font-bold ${rankClass} mr-4 w-6 text-center">${rank}</span>
                    <span class="font-medium text-gray-900 dark:text-white">${safeUsername}</span>
                </div>
                <span class="font-bold text-primary">${points.toLocaleString()} pts</span>
            `;
            container.appendChild(div);
        });

    } catch (error) {
        console.error("Error loading leaderboard:", error);
        container.innerHTML = '<p class="text-center text-red-500 py-4">Failed to load leaderboard.</p>';
    }
});
