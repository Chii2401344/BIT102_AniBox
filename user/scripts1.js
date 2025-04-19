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
    showSaveButton("aboutText", "saveAboutBtn");
    showSaveButton("profilePicture", "savePfpBtn");
    showSaveButton("bannerPicture", "saveBannerBtn");

    document.getElementById("aboutText").addEventListener("input", function () {
        document.getElementById("saveAboutBtn").style.display = "inline-block";
    });

    saveData("username", "saveUserBtn", "username", "profileUsername", "Username saved!");
    saveData("email", "saveEmailBtn", "email", "profileEmail", "Email saved!");


    // ------------------ Account Deactivation ------------------
    /*document.getElementById('deactivateAccountBtn').addEventListener("click", function() {
        let deactivateAlert = confirm("Are you sure you want to deactivate your account? This action cannot be undone.");
        if (deactivateAlert) {
            window.location.href = "delete-acc.php";
        }
    });*/

    // ------------------ Check if passwords match ------------------
    document.getElementById("savePasswordBtn").addEventListener("click", function (e) {
        const newPassword = document.getElementById("newPassword").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const errorText = document.getElementById("passwordError");
    
        if (newPassword !== confirmPassword) {
            e.preventDefault(); // stop form from submitting
            errorText.style.display = "block";
        } else {
            errorText.style.display = "none";
            // allow form to submit or send it manually via AJAX if needed
            // document.getElementById("yourFormID").submit();
        }
    });

    document.getElementById("confirmPassword").addEventListener("input", function () {
        document.getElementById("passwordError").style.display = "none";
    });

    // ------------------ Display Success Password Update ------------------
    document.addEventListener("DOMContentLoaded", function () {
        const successAlert = document.getElementById("passwordSuccess");
    
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = "opacity 0.5s ease-out";
                successAlert.style.opacity = "0";
    
                // After the fade, remove it from DOM
                setTimeout(() => {
                    if (successAlert.parentNode) {
                        successAlert.parentNode.removeChild(successAlert);
                    }
                }, 500); // matches the transition time
            }, 3000); // show for 3 seconds
        }
    });

});