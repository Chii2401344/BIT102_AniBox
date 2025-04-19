document.addEventListener("DOMContentLoaded", function () {

    // ------------------ Load Saved Username & Email ------------------
    const usernameInput = document.getElementById("username");
    const profileUsername = document.getElementById("profileUsername");
    const emailInput = document.getElementById("email");
    const profileEmail = document.getElementById("profileEmail");

    if (localStorage.getItem("username")) {
        let savedUsername = localStorage.getItem("username");
        if (usernameInput) usernameInput.value = savedUsername; // Settings input
        if (profileUsername) profileUsername.textContent = savedUsername; // Profile display
    }

    if (localStorage.getItem("email")) {
        let savedEmail = localStorage.getItem("email");
        if (emailInput) emailInput.value = savedEmail; // Settings input
        if (profileEmail) profileEmail.textContent = savedEmail; // Profile display
    }

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

    // ------------------ Toggle Password Visibility ------------------
    const togglePasswordBtn = document.getElementById("togglePassword");
    const passwordSpan = document.getElementById("currentPassword");

    if (togglePasswordBtn && passwordSpan) {
        let actualPassword = "Zoro1234"; // Replace with actual stored password
        passwordSpan.dataset.visible = "false";
        passwordSpan.textContent = "*".repeat(actualPassword.length);

        togglePasswordBtn.addEventListener("click", function () {
            let eyeIcon = this.querySelector("i");

            if (passwordSpan.dataset.visible === "false") {
                passwordSpan.textContent = actualPassword; // Show actual password
                passwordSpan.dataset.visible = "true";
                eyeIcon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                passwordSpan.textContent = "*".repeat(actualPassword.length); // Hide password
                passwordSpan.dataset.visible = "false";
                eyeIcon.classList.replace("bi-eye-slash", "bi-eye");
            }
        });
    }

    // ------------------ Display Update User Icon  ------------------
    const profilePicture = document.getElementById('profilePicture');
    const iconPreview = document.getElementById('iconPreview');

    profilePicture.addEventListener('change', () => {
        const file = profilePicture.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = () => {
                iconPreview.src = reader.result;
                iconPreview.style.display = 'block';
                saveBtn.style.display = 'inline-block';
            };

            reader.readAsDataURL(file);
        }
    });

    // ------------------ Display Update User banner ------------------
    const bannerPicture = document.getElementById('bannerPicture');
    const bannerPreview = document.getElementById('bannerPreview');

    bannerPicture.addEventListener('change', () => {
        const file = bannerPicture.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = () => {
                bannerPreview.src = reader.result;
                bannerPreview.style.display = 'block';
                saveBtn.style.display = 'inline-block';
            };

            reader.readAsDataURL(file);
        }
    });

    // ------------------ Account Deactivation ------------------
    document.getElementById('deactivateAccountBtn').addEventListener("click", function() {
        let deactivateAlert = confirm("Are you sure you want to deactivate your account? This action cannot be undone.");
        if (deactivateAlert) {
            window.location.href = "delete-acc.php";
        }
    });

});