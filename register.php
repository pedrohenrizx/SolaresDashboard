<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">CustomerFlow Analytics</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Create your free account</p>
        </div>

        <form id="register-form" class="space-y-6">
            <div id="error-message" class="hidden bg-red-100 text-red-700 p-3 rounded text-sm"></div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                <input type="text" id="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary focus:invalid:border-red-500 focus:invalid:ring-red-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email address</label>
                <input type="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary focus:invalid:border-red-500 focus:invalid:ring-red-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" id="password" required minlength="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary focus:invalid:border-red-500 focus:invalid:ring-red-500 dark:bg-gray-700 dark:text-white">
                <p class="mt-1 text-xs text-gray-500">Must be at least 6 characters long.</p>
            </div>

            <div>
                <button type="submit" id="submit-btn" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                    <span id="btn-text">Register Free Account</span>
                    <i id="btn-spinner" class="fas fa-circle-notch fa-spin ml-2 hidden mt-1"></i>
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            Already have an account?
            <a href="/login.php" class="font-medium text-primary hover:text-blue-500">Sign in here</a>
        </p>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorDiv = document.getElementById('error-message');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');
            const submitBtn = document.getElementById('submit-btn');

            errorDiv.classList.add('hidden');
            btnText.textContent = "Registering...";
            btnSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            const user = new Parse.User();
            user.set("username", username);
            user.set("password", password);
            user.set("email", email);

            try {
                await user.signUp();
                window.location.href = '/index.php';
            } catch (error) {
                errorDiv.textContent = error.message;
                errorDiv.classList.remove('hidden');
                btnText.textContent = "Register Free Account";
                btnSpinner.classList.add('hidden');
                submitBtn.disabled = false;

                document.getElementById('username').classList.add('border-red-500');
                document.getElementById('email').classList.add('border-red-500');
                document.getElementById('password').classList.add('border-red-500');
            }
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                input.classList.remove('border-red-500');
            });
        });
    </script>
</body>
</html>
