<?php
require '../animes/connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view your reviews.");
}

$user_id = $_SESSION['user_id'];

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
    <link rel="stylesheet" href="user-profile-review.css">
    <link rel="stylesheet" href="user-navbar.css">
    <script src="scripts1.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="user-home.html">AniBox</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="user-home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-home.html#browse">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-profile-mybox.html">My Box</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-profile-about.html">Profile</a>
                    </li>
                </ul>
                <hr class="d-lg-none my-2 text-dark-50">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="user-settings.html" class="d-none d-lg-block me-3">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                        <a class="nav-link d-block d-lg-none" href="user-settings.html">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="logoutDesktop" class="d-none d-lg-block me-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <a href="#" id="logoutMobile" class="nav-link d-block d-lg-none">Logout</a>
                    </li>
                </ul>

                <!-- Profile Picture -->
                <a href="user-profile-about.html" class="card-container d-none d-lg-block">
                    <img src="../assets/img/pfp3.jpg" alt="profile" class="user-icon">
                </a>

            </div>
        </div>
    </nav>

    <div class="profile">
        <div class="pfp">
            <img src="../assets/img/pfp3.jpg" alt="profile">
        </div>
        <div class="profile_info">
            <h2 class="username" id="profileUsername">User1_Fein</h2>
            <h4 class="email" id="profileEmail">User_fein1@yohohoho.com</h4>
        </div>
    </div>

    <div class="lower_profile">
        <div class="lower_profile_nav">
            <a class="lower_profile_nav_link" href="user-profile-about.html">
                <h5>About</h5>
            </a>
            <a class="lower_profile_nav_link" href="user-profile-mybox.html">
                <h5>My Box</h5>
            </a>
            <a class="lower_profile_nav_link" href="user-profile-review.html">
                <h5>Reviews</h5>
            </a>
        </div>
    </div>

    <div class="container">

            <!-- Section Below (Reviews) -->
            <div class="review-container">

                <div class="review-header">
                    <h2 class="review"><strong>✦ ⋆.˚ Recent Reviews ˚.⋆ ✦</strong></h2>
                </div>

                
                <?php
                // Get all reviews by this user
                $sql = "SELECT r.*, a.Title, a.Cover_Img, u.Username, u.Profile_Img 
                        FROM review r 
                        JOIN anime a ON r.Ani_ID = a.Ani_ID 
                        JOIN user u ON r.User_ID = u.User_ID
                        WHERE r.User_ID = ? 
                        ORDER BY r.Rev_Date DESC";


                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo '<div class="review-card">';
                
                    // Anime cover
                    echo '<div class="review-anime-cover">';
                    echo '<a href="../animes/anime.php?id=' . $row['Ani_ID'] . '">';
                    echo '<img src="../' . htmlspecialchars($row['Cover_Img']) . '" alt="' . htmlspecialchars($row['Title']) . '">';
                    echo '</a>';
                    echo '</div>';

                    // Header: user profile + username
                    echo '<div class="review-card-header">';
                    echo '<div class="review-card-profile">';
                    echo '<img src="' . htmlspecialchars($row['Profile_Img']) . '" alt="profile" class="user-icon" width="50px" height="50px">';
                    echo '<h4 class="review-card-username" id="profileUsername">' . htmlspecialchars($row['Username']) . '</h4>';
                    echo '</div>';

                    // Body: rating and review
                    echo '<div class="review-card-body">';
                    echo '<p class="review-card-score">' . htmlspecialchars($row['Rating']) . '/10</p>';
                    echo '<p class="review-card-text">' . htmlspecialchars($row['Content']) . '</p>';
                    echo '</div>';

                    // Date
                    echo '<div class="review-card-header-text">';
                    echo '<p class="review-card-date">' . htmlspecialchars($row['Rev_Date']) . '</p>';
                    echo '</div>';

                    echo '</div>'; // Close review-card-header
                    echo '</a>';
                    echo '</div>'; // Close review-card
                }

                ?>

            </div>


    </div>
    </div>
    </div>


    <footer class="footer">
        <div class="container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>