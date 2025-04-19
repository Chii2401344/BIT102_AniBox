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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/theme.css">
    <link rel="stylesheet" href="user-profile.css">
    <link rel="stylesheet" href="user-profile-about.css">
    <link rel="stylesheet" href="user-navbar.css">
    <script src="scripts1.js"></script>
</head>

<body>

    <?php include "navbar.php"; ?>

    <?php include "user-profile-navbar.php"; ?>

    <div class="about-container">
        <div class="about-header">
            <h2><strong>✦ About ✦</strong></h2>
            <div class="about-text">
                <p><?php echo $user['About']; ?></p>
            </div>
        </div>

        <div class="about-bar">
            <div class="FavoriteAnime">
                <h2><strong>✦ Favorite Anime ✦</strong></h2>
                <div class="fav-anime-card">
                    <div class="fav-anime-list">
                        <div class="fav-anime-cover">
                            <img src="../assets/img/cover-one-piece.jpg" alt="One Piece">
                        </div>
                        <div class="fav-anime-title">
                            <h4><a href="../animes/one-piece.html">One Piece</a></h4>
                        </div>
                    </div>

                    <div class="fav-anime-list">
                        <div class="fav-anime-cover">
                            <img src="../assets/img/cover-bocchi-the-rock.jpg" alt="Bocchi The Rock">
                        </div>
                        <div class="fav-anime-title">
                            <h4><a href="../animes/bocchi-the-rock.html">Bocchi The Rock</a></h4>
                        </div>
                    </div>

                    <div class="fav-anime-list">
                        <div class="fav-anime-cover">
                            <img src="../assets/img/cover-kimi-no-na-wa.jpg" alt="Your Name">
                        </div>
                        <div class="fav-anime-title">
                            <h4><a href="../animes/kimi-no-na-wa.html">Your Name</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <footer class="footer">
        <div class="container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>