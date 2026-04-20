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
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Shared Notes -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 lg:col-span-2 flex flex-col h-[600px]">
                    <h3 class="text-lg font-semibold mb-4">Shared Insights & Notes</h3>

                    <div id="messages-container" class="flex-1 space-y-4 mb-4 overflow-y-auto pr-2">
                        <div class="flex justify-center p-4">
                            <i class="fas fa-circle-notch fa-spin text-2xl text-primary"></i>
                        </div>
                    </div>

                    <form id="chat-form" class="mt-auto flex border-t border-gray-200 dark:border-gray-700 pt-4">
                        <input type="text" id="chat-input" required placeholder="Share an insight..." class="flex-1 rounded-l-md border-gray-300 dark:border-gray-600 focus:ring-primary focus:border-primary dark:bg-gray-700 px-4 py-2 text-sm border-r-0">
                        <button type="submit" id="chat-btn" class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-r-md transition-colors text-sm font-medium flex items-center">
                            <span>Post</span>
                            <i id="chat-spinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                        </button>
                    </form>
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
            document.getElementById('page-body').classList.remove('hidden');

            const currentUser = Parse.User.current();
            const messageContainer = document.getElementById('messages-container');

            function formatTime(date) {
                return date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) + ' - ' + date.toLocaleDateString();
            }

            async function loadMessages() {
                try {
                    const TeamMessage = Parse.Object.extend("TeamMessage");
                    const query = new Parse.Query(TeamMessage);
                    query.descending("createdAt");
                    query.limit(50);
                    const results = await query.find();

                    messageContainer.innerHTML = '';

                    if(results.length === 0) {
                        messageContainer.innerHTML = '<p class="text-center text-gray-500 mt-4">No insights shared yet. Be the first!</p>';
                    }

                    function escapeHTML(str) {
                        return new Option(str).innerHTML;
                    }

                    // Reverse to show oldest at top, newest at bottom
                    results.reverse().forEach(msg => {
                        const username = msg.get("username") || "Team Member";
                        const text = msg.get("text") || "";

                        const safeUsername = escapeHTML(username);
                        const safeText = escapeHTML(text);

                        const isMine = msg.get("username") === (currentUser ? currentUser.get("username") : "Unknown");
                        const div = document.createElement("div");

                        div.className = isMine
                            ? "bg-blue-50 dark:bg-blue-900/20 p-3 rounded border-l-4 border-blue-500 ml-8"
                            : "bg-gray-50 dark:bg-gray-700 p-3 rounded border-l-4 border-gray-400 mr-8";

                        div.innerHTML = `
                            <p class="text-sm font-medium">${safeUsername} <span class="text-gray-500 text-xs font-normal ml-2">${formatTime(msg.createdAt)}</span></p>
                            <p class="text-sm mt-1">${safeText}</p>
                        `;
                        messageContainer.appendChild(div);
                    });

                    // Scroll to bottom
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                } catch(error) {
                    messageContainer.innerHTML = `<p class="text-center text-red-500 mt-4">Error loading messages: ${error.message}</p>`;
                }
            }

            // Initial load
            loadMessages();

            // Submit logic
            document.getElementById('chat-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                if(!currentUser) {
                    showToast("Please log in to post.", "error");
                    return;
                }

                const input = document.getElementById('chat-input');
                const btn = document.getElementById('chat-btn');
                const spinner = document.getElementById('chat-spinner');

                const text = input.value.trim();
                if(!text) return;

                btn.disabled = true;
                spinner.classList.remove('hidden');

                try {
                    const TeamMessage = Parse.Object.extend("TeamMessage");
                    const message = new TeamMessage();
                    message.set("text", text);
                    message.set("username", currentUser.get("username"));

                    await message.save();
                    input.value = '';
                    await loadMessages();
                } catch(error) {
                    showToast("Error posting: " + error.message, "error");
                } finally {
                    btn.disabled = false;
                    spinner.classList.add('hidden');
                }
            });

            // Auto-refresh every 10 seconds
            setInterval(loadMessages, 10000);
        });
    </script>
</body>
</html>
