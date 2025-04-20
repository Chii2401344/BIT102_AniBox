<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../user-login.php");
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
    <link rel="stylesheet" href="user-profile-review.css">
    <link rel="stylesheet" href="user-navbar.css">
    <script src="scripts1.js"></script>
</head>

<body>

    <?php include "navbar.php"; ?>

    <?php include "user-profile-navbar.php"; ?>

    <div class="container">

            <!-- Section Below (Reviews) -->
            <div class="review-container" style="margin-top: 5%;">

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