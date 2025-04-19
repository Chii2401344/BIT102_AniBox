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
    <link rel="stylesheet" href="user-profile-review.css">
    <link rel="stylesheet" href="user-navbar.css">
    <script src="scripts1.js"></script>
</head>

<body>

    <?php include "navbar.php"; ?>

    <?php include "user-profile-navbar.php"; ?>

    <div class="container">
        <div class="row">
            <!-- Section Above (Button) -->
            <div class="add-review-button">
                <button class="btn btn-primary Add_Review">Add Review</button>
            </div>

            <!-- Section Below (Reviews) -->
            <div class="review-container">

                <div class="review-header">
                    <h2 class="review"><strong>✦ ⋆.˚ Recent Reviews ˚.⋆ ✦</strong></h2>
                </div>

                <div class="review-card">

                    <div class="review-anime-cover">
                        <img src="../assets/img/cover-kimi-no-na-wa.jpg" alt="Your Name">
                    </div>

                    <div class="review-card-header">

                        <div class="review-card-profile">
                            <img src="../assets/img/pfp3.jpg" alt="profile" class="user-icon" width="50px" height="50px">
                            <h4 class="review-card-username" id="profileUsername">User1_Fein</h4>
                        </div>

                        <div class="review-card-body">
                            <p class="review-card-score">8/10</p>
                            <p class="review-card-text"><a href="../animes/kimi-no-na-wa.html#profileUsername1">OMG so sad..</a></p>
                        </div>

                        <div class="review-card-header-text">
                            <p class="review-card-date">Mar 10, 2025</p>
                        </div>


                    </div>
                    
                </div>
                
                <div class="review-card">

                    <div class="review-anime-cover">
                        <img src="../assets/img/cover-bocchi-the-rock.jpg" alt="Bocchi the Rock">
                    </div>

                    <div class="review-card-header">

                        <div class="review-card-profile">
                            <img src="../assets/img/pfp3.jpg" alt="profile" class="user-icon" width="50px" height="50px">
                            <h4 class="review-card-username" id="profileUsername">User1_Fein</h4>
                        </div>

                        <div class="review-card-body">
                            <p class="review-card-score">6/10</p>
                            <p class="review-card-text"><a href="../animes/bocchi-the-rock.html#profileUsername2">I thought it was going to be about a rock</a></p>
                        </div>

                        <div class="review-card-header-text">
                            <p class="review-card-date">Nov 14, 2024</p>
                        </div>

                    </div>
                    
                </div>

                <div class="review-card">

                    <div class="review-anime-cover">
                        <img src="../assets/img/cover-one-piece.jpg" alt="One Piece">
                    </div>

                    <div class="review-card-header">

                        <div class="review-card-profile">
                            <img src="../assets/img/pfp3.jpg" alt="profile" class="user-icon" width="50px" height="50px">
                            <h4 class="review-card-username" id="profileUsername">User1_Fein</h4>
                        </div>

                        <div class="review-card-body">
                            <p class="review-card-score">10/10</p>
                            <p class="review-card-text"><a href="../animes/one-piece.html#profileUsername3">bro one piece or one PEAK</a></p>
                        </div>

                        <div class="review-card-header-text">
                            <p class="review-card-date">May 21, 2007</p>
                        </div>

                    </div>
                    
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