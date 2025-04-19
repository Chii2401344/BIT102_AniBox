<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user-login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
require '../login/connect.php'; // DB connection

// Fetch user data
$sql = "SELECT * FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

//update username section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveUserBtn'])) {
    $new_username = $_POST['username'];

    $sql = "UPDATE user SET Username = ? WHERE User_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_username, $user_id);

    if ($stmt->execute()) {
        $_SESSION['username'] = $new_username; // Update session variable
        header("Location: user-settings.php?success=1");
        exit();
    } else {
        header("Location: user-settings.php?error=1");
        exit();
    }
}

//update email section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveEmailBtn'])) {
    $new_email = $_POST['email'];

    $sql = "UPDATE user SET Email = ? WHERE User_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_email, $user_id);

    if ($stmt->execute()) {
        $_SESSION['email'] = $new_email; // Update session variable
        header("Location: user-settings.php?success=1");
        exit();
    } else {
        header("Location: user-settings.php?error=1");
        exit();
    }
}

//update about section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveAboutBtn'])) {
    $new_about = $_POST['aboutText'];

    $sql = "UPDATE user SET About = ? WHERE User_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_about, $user_id);

    if ($stmt->execute()) {
        $_SESSION['About'] = $new_about; // Update session variable
        header("Location: user-settings.php?success=1");
        exit();
    } else {
        header("Location: user-settings.php?error=1");
        exit();
    }
}

//update profile picture section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['savePfpBtn'])) {
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
        $img_name = basename($_FILES['profilePicture']['name']);
        $target_dir = "../assets/img/";
        $target_file = $target_dir . time() . "_" . $img_name;

        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_file)) {
            $sql = "UPDATE user SET Profile_Img = ? WHERE User_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            if ($stmt->execute()) {
            } else {
                echo "<script>alert('Failed to update profile image.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Failed to upload image.');</script>";
        }
    }
}

//update banner picture section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveBannerBtn'])) {
    if (isset($_FILES['bannerPicture']) && $_FILES['bannerPicture']['error'] == 0) {
        $img_name = basename($_FILES['bannerPicture']['name']);
        $target_dir = "../assets/img/";
        $target_file = $target_dir . time() . "_" . $img_name;

        if (move_uploaded_file($_FILES['bannerPicture']['tmp_name'], $target_file)) {
            $sql = "UPDATE user SET Banner_Img = ? WHERE User_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            if ($stmt->execute()) {
            } else {
                echo "<script>alert('Failed to update banner image.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Failed to upload image.');</script>";
        }
    }
}

//update password section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['savePasswordBtn'])) {
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];

    if ($new_password !== $confirm_password) {
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('passwordError').style.display = 'block';
        });</script>";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET Password = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $hashed_password, $user_id);

        if ($stmt->execute()) {
            // Redirect to avoid resubmission
            header("Location: user-settings.php?password_updated=1");
            exit();
        } else {
            echo "<script>alert('Failed to update password.');</script>";
        }

        $stmt->close();
    }
}
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

    <?php if (isset($_GET['password_updated']) && $_GET['password_updated'] == 1): ?>
        <div id="passwordSuccess" class="alert alert-success text-center" style="margin: 1rem auto; width: 80%; opacity: 1;">
            Password updated successfully!
        </div>
    <?php endif; ?>

    <div class="account-settings">
        <h3>Account Settings</h3>
        <form action="" id="account-form" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <!-- username section -->
                <label for="username">New Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo ($user['Username']); ?>" required>
                <div>
                    <button type="submit" name="saveUserBtn" id="saveUserBtn" style="display: none;" class="btn btn-primary">Save Changes</button>
                </div>

                <!-- email section -->
                <label for="email" class="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['Email']; ?>" required>
                <div>
                    <button class="btn btn-primary" id="saveEmailBtn" style="display: none;" type="submit" name="saveEmailBtn">Save Changes</button>
                </div>

                <!-- password section -->
                <label for="newPassword" class="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password">

                <label for="confirmPassword" class="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password">
                <div id="passwordError" style="display: none; color: red; margin-top: 5px;">Passwords do not match!</div>

                <div>
                    <button class="btn btn-primary" name="savePasswordBtn" id="savePasswordBtn" type="submit">Save Changes</button>
                </div>

                <!-- about section -->
                <label for="aboutText" class="aboutText">About</label>
                <textarea class="form-control" id="aboutText" name="aboutText" rows="10"><?php echo ($user['About']); ?></textarea>
                <div>
                    <button class="btn btn-primary" name="saveAboutBtn" id="saveAboutBtn" type="submit" style="display: none;">Save Changes</button>
                </div>

                <!-- profile image section -->
                <label for="profilePicture" class="profilePicture">Profile Picture</label>
                <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*">
                <div>
                    <button class="btn btn-primary" name="savePfpBtn" id="savePfpBtn" type="submit" style="display: none;">Save Changes</button>
                </div>

                <!-- banner image section -->
                <label for="bannerPicture" class="bannerPicture">Banner Picture</label>
                <input type="file" class="form-control" id="bannerPicture" name="bannerPicture" accept="image/*">
                <div>
                    <button class="btn btn-primary" name="saveBannerBtn" id="saveBannerBtn" type="submit" style="display: none;">Save Changes</button>
                </div>

                <!-- acc deactivation section -->
                <strong><label for="accountDeactivation" class="accountDeactivation">Account Deactivation</label></strong><br>
                <span id="accountDeactivation" class="deactivationDisplay">Warning! This will permanently delete all your account data.</span><br>
                <button type="button" class="deactivateAccount" id="deactivateAccountBtn">Deactivate Account</button>
                
                <!-- Update Favourite Animes -->
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