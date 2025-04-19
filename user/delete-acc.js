document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('deactivateAccountBtn').addEventListener("click", function() {
        console.log("Deactivate Account button clicked"); // Debugging line
        let deactivateAlert = confirm("Are you sure you want to deactivate your account? This action cannot be undone.");
        if (deactivateAlert) {
            window.location.href = "delete-acc.php";
        }
    });
});