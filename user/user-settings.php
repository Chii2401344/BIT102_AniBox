<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../user-login.html");
    exit();
}

// Get the User_ID from session
$user_id = $_SESSION['user_id'];

require '../login/connect.php'; // Include the database connection file

// Fetch user data
$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniBox</title>
    <link rel="icon" type="image/x-icon" href="../assets/ABLOGO.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/theme.css">
    <link rel="stylesheet" href="user-settings.css">
    <link rel="stylesheet" href="user-profile.css">
    <link rel="stylesheet" href="user-navbar.css">
    <link rel="stylesheet" href="user-profile.css">
    <script src="scripts1.js"></script>
</head>

<body>

    <?php include "navbar.php"; ?>

    <?php include "user-profile-navbar.php"; ?>

    <div class="account-settings">
        <h3>Account Settings</h3>
        <form action="" id="account-form">

            <div class="form-group">
                <label for="username" class="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter new username"
                    value=<?php echo $user['Username']; ?>>
                <div><button class="btn btn-primary" id="saveUserBtn" style="display: none;" type="button">Save
                        Changes</button></div>

                <label for="email" class="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter new email"
                    value=<?php echo $user['Email']; ?>>
                <div><button class="btn btn-primary" id="saveEmailBtn" style="display: none;" type="button">Save
                        Changes</button></div>

                <label for="newPassword" class="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password" value="">
                <div><button class="btn btn-primary" id="savePasswordBtn" style="display: none;" type="button">Save
                        Changes</button></div>

                <label for="confirmPassword" class="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Enter confirmed password"
                    value="">
                <div><button class="btn btn-primary" id="confirmPasswordBtn" style="display: none;" type="button">Save
                        Changes</button></div>

                <label for="aboutText" class="aboutText">About</label>
                <textarea class="form-control" id="aboutText" rows="10"
                    contenteditable="true"><?php echo $user['About']; ?></textarea>
                <div><button class="btn btn-primary" id="saveAboutBtn" style="display: none;" type="button">Save
                        Changes</button></div>

                <label for="profilePicture" class="profilePicture">Profile Picture</label>
                <input type="file" class="form-control" id="profilePicture" accept="image/*">
                <img id="iconPreview" src="" alt="Image Preview" style="max-width: 10rem; display: none; margin-top: 20px; border-radius: 7px; border: 2px solid var(--earthy-brown); overflow: hidden;">
                <div><button class="btn btn-primary" id="savePfpBtn" style="display: none;" type="button">Save
                        Changes</button></div>

                <label for="bannerPicture" class="bannerPicture">Banner Picture</label>
                <input type="file" class="form-control" id="bannerPicture" accept="image/*">
                <img id="bannerPreview" src="" alt="Image Preview" style="max-width: 35rem; display: none; margin-top: 20px; border-radius: 7px; border: 2px solid var(--earthy-brown); overflow: hidden;">
                <div><button class="btn btn-primary" id="saveBannerBtn" style="display: none;" type="button">Save
                        Changes</button></div>

                <strong><label for="accountDeactivation" class="accountDeactivation">Account Deactivation</label></strong><br>
                <span id="accountDeactivation" class="deactivationDisplay">Warning! This will permanently delete all your account data.</span><br>
                <button type="button" class="deactivateAccount" id="deactivateAccountBtn">Deactivate Account</button>
                


            </div>
        </form>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>