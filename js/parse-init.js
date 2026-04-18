// Parse initialization
Parse.initialize("zSKTEKdGR43xJ1WxLWWe7Tp6dJzgjlUIJAbLw4xh", "My5wVKGPTXmP7o1YT91gugEoeS2Nz9UIPxg8A0b2");
Parse.serverURL = 'https://parseapi.back4app.com/';

// Check if user is logged in
document.addEventListener("DOMContentLoaded", () => {
    const currentUser = Parse.User.current();
    const publicPages = ['/login.php', '/register.php'];
    const currentPath = window.location.pathname;

    if (!currentUser && !publicPages.includes(currentPath)) {
        window.location.href = '/login.php';
    } else if (currentUser && publicPages.includes(currentPath)) {
        window.location.href = '/index.php';
    }
});

// Logout function
async function logout() {
    try {
        await Parse.User.logOut();
        window.location.href = '/login.php';
    } catch (error) {
        console.error('Error logging out', error);
        alert('Error logging out: ' + error.message);
    }
}
