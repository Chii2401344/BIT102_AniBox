
    // ------------------ Logout Buttons ------------------
    function setupLogoutHandler(id) {
        const logoutButton = document.getElementById(id);
        if (logoutButton) {
            logoutButton.addEventListener("click", function (event) {
                event.preventDefault();
                console.log("Logout button clicked.");
                let logoutAlert = confirm("Are you sure you want to logout?");
                if (logoutAlert) {
                    window.location.href = "user-logout.php";
                }
            });
        }
    }
    setupLogoutHandler("logoutDesktop");
    setupLogoutHandler("logoutMobile");