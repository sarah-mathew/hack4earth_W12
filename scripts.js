// Add interactivity (e.g., form validation, dynamic content)
document.addEventListener("DOMContentLoaded", function () {
    // Example: Add a confirmation dialog before logout
    const logoutLink = document.querySelector('a[href="logout.php"]');
    if (logoutLink) {
        logoutLink.addEventListener("click", function (e) {
            if (!confirm("Are you sure you want to logout?")) {
                e.preventDefault();
            }
        });
    }

    // Example: Validate contact form
    const contactForm = document.querySelector('form[action="submit_contact.php"]');
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const message = document.getElementById("message").value;

            if (!name || !email || !message) {
                alert("Please fill out all fields.");
                e.preventDefault();
            }
        });
    }
});
