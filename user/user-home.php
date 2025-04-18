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
$sql = "SELECT * FROM user WHERE user_id = '$user_id'"; // SQL query to fetch user data
$result = $conn->query($sql); // Execute the query
$user = $result->fetch_assoc(); // Fetch the user data

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
    <link rel="stylesheet" href="user-home.css">
    <link rel="stylesheet" href="user-navbar.css">
    <link rel="stylesheet" href="browse-anime.css">
</head>

<body>

    <!-- Include User's Navigation Bar  -->
    <?php include "navbar.php"; ?>

    <main>
        <!-- Slideshow Section -->
        <div class="slideshow-container">
            <img class="slide active" src="../assets/img/poster-onepiece.jpg">
            <img class="slide" src="../assets/img/poster-bocchi.webp">
            <img class="slide" src="../assets/img/poster-yourname.webp">

            <!-- Overlay + Text -->
            <div class="overlay">
                <div class="text-box">
                    <h1 class="text-box-h1" id="slide-title">Title 1</h1>
                    <p class="text-box-p" id="slide-description">Description for Image 1.</p>
                </div>
            </div>

            <!-- Slideshow Buttons -->
            <div class="button-container">
                <button class="nav-button" onclick="plusDivs(-1)">&#10094;</button>
                <button class="nav-button" onclick="plusDivs(1)">&#10095;</button>
            </div>
        </div>

        <!-- Section Seperator to seperate the slideshow with the rest of the page -->
        <div class="section-seperator"></div>

        
        <!-- Include Browse Section -->
        <?php include "user-browse.php"; ?>

    </main>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts for the slideshow -->
    <script>
        var myIndex = 0;
        var images = document.getElementsByClassName("slide");
        var titles = ["One Piece", "Bocchi The Rock", "Your Name"];
        var descriptions = [
            "A young pirate, Luffy, sets sail with his crew to find the legendary One Piece treasure and become the Pirate King, facing powerful enemies and uncovering world-shaking secrets..",
            "Hitori \"Bocchi\" Gotoh, a socially anxious girl who loves guitar, joins a band to make friends and overcome her shyness, leading to hilarious and heartfelt moments.",
            "Two strangers, Taki and Mitsuha, mysteriously swap bodies across time, forming a deep connection and racing to change fate before disaster strikes."
        ];
        var interval = 4000;

        function showDivs(n) {
            for (let i = 0; i < images.length; i++) {
                images[i].classList.remove("active");
            }
            if (n >= images.length) { myIndex = 0; }
            if (n < 0) { myIndex = images.length - 1; }
            images[myIndex].classList.add("active");

            // Update text
            document.getElementById("slide-title").textContent = titles[myIndex];
            document.getElementById("slide-description").textContent = descriptions[myIndex];
        }

        function plusDivs(n) {
            myIndex += n;
            showDivs(myIndex);
        }

        function autoSlide() {
            myIndex++;
            showDivs(myIndex);
            setTimeout(autoSlide, interval);
        }

        images[0].classList.add("active");

        autoSlide();
    </script>

</body>

</html>