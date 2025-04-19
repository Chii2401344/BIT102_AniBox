document.addEventListener("DOMContentLoaded", function () {

    // ------------------ Show Save Button When Typing ------------------
    function showSaveButton(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        if (input && button) {
            input.addEventListener("input", function () {
                button.style.display = "inline-block";
            });
        }
    }

    showSaveButton("username", "saveUserBtn");
    showSaveButton("email", "saveEmailBtn");
    showSaveButton("newPassword", "savePasswordBtn");
    showSaveButton("confirmPassword", "confirmPasswordBtn");
    showSaveButton("aboutText", "saveAboutBtn");
    showSaveButton("profilePicture", "savePfpBtn");
    showSaveButton("bannerPicture", "saveBannerBtn");

    // ------------------ Save Username & Email ------------------
    function saveData(inputId, buttonId, storageKey, displayId, alertMessage) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        const display = document.getElementById(displayId);

        if (input && button && display) {
            button.addEventListener("click", function () {
                let newValue = input.value;
                localStorage.setItem(storageKey, newValue);
                display.textContent = newValue;
                alert(alertMessage);
                button.style.display = "none"; // Hide after saving
            });
        }
    }

    saveData("username", "saveUserBtn", "username", "profileUsername", "Username saved!");
    saveData("email", "saveEmailBtn", "email", "profileEmail", "Email saved!");


    // ------------------ Account Deactivation ------------------
    document.getElementById('deactivateAccountBtn').addEventListener("click", function() {
        let deactivateAlert = confirm("Are you sure you want to deactivate your account? This action cannot be undone.");
        if (deactivateAlert) {
            window.location.href = "delete-acc.php";
        }
    });

});