<?php
session_start();
$ani_id = "1";
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniBox</title>
    <link rel="icon" type="image/x-icon" href="../assets/ABLOGO.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/theme.css">
    <link rel="stylesheet" href="../user/user-navbar.css">
    <link rel="stylesheet" href="anime.css">
    <link rel="stylesheet" href="new.css">
</head>

<body class="bocchi-the-rock">

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="../user/user-home.html">AniBox</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-home.html#browse">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-profile-mybox.html">My Box</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-profile-about.html">Profile</a>
                    </li>
                </ul>
                <hr class="d-lg-none my-2 text-dark-50">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../user/user-settings.html" class="d-none d-lg-block me-3">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                        <a class="nav-link d-block d-lg-none" href="../user/user-settings.html">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="logoutDesktop" class="d-none d-lg-block me-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <a href="#" id="logoutMobile" class="nav-link d-block d-lg-none">Logout</a>
                    </li>
                </ul>

                <!-- Profile Picture -->
                <a href="../user/user-profile-about.html" class="card-container d-none d-lg-block">
                    <img src="../assets/img/pfp3.jpg" alt="profile" class="user-icon">
                </a>

            </div>
        </div>
    </nav>

    <!-- Container for Anime Details and Add to Box Button Section -->
    <div class="container1">
        <!-- Container for Main Anime Display -->
        <div class=anime-container>
            <?php
            $sql = "SELECT * FROM anime WHERE Ani_ID = '1'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
            $anime = $result->fetch_assoc();
            }  

            echo '<div class="anime-cover">';
            echo '<img src="../' . htmlspecialchars($anime["Cover_Img"]) . '" alt="Bocchi the Rock">';
            echo '</div>';
        
            echo '<div class="anime-details">';
            echo '<p class="title"><strong>' .htmlspecialchars($anime['Title']). '</strong></p>';
            echo '<span class="bocchi-genre">' .htmlspecialchars($anime["Genre"]). '</span>';
            echo '<p class="detail1"><strong>Episodes:</strong> ' .($anime['Episodes']). '</p>';
            echo '<p class="detail2"><strong>Status:</strong> ' .htmlspecialchars($anime["Status"]).' </p>';
            echo '</div>';
            ?>
        </div>
        <!-- Add to Box Button -->
        <div class="add-button">
            <button class="btn btn-primary"><strong>+ Add to Box</strong></button>
        </div>
        <br>
    </div>

    <!-- Container for Anime Info, Synopsis, Recommendations and Reviews Sections -->
    <div class="container2">

        <!-- Divider between Anime Details and rest of the page -->
        <hr>

        <!-- Container for Anime Info Section -->
        <div class="anime-info-container">

        <?php
            $sql = "SELECT * FROM anime WHERE Ani_ID = '1'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
            $anime = $result->fetch_assoc();
            }  

            echo '<div class="score">';
            echo '<p>Rating</p>';
            echo '<p></p>';
            echo '<h3>' .($anime['AvgRating']). '</h3>';
            echo '</div>';

            echo '<div class="popularity">';
            echo '<p>Popularity</p>';
            echo '<p></p>';
            echo '<h3>' .($anime['Popularity']). '</h3>';
            echo '</div>';

            echo '<div class="date">';
            echo '<p>Release Date</p>';
            echo '<p></p>';
            echo '<h3>' .($anime['Release_Date']). '</h3>';
            echo '</div>';

            echo '<div class="studio">';
            echo '<p>Studio</p>';
            echo '<p></p>';
            echo '<h3>' .($anime['Studio']). '</h3>';
            echo '</div>';

            echo '</div>';

            echo '<div class="anime-synopsis">';
            echo '<h2><strong>✦ Synopsis ୭ ˚. ᵎᵎ</strong></h2>';
            echo '<p>' .htmlspecialchars($anime['Description']). '</p>';
            echo '</div>';

        ?>

        </div>

        
        <!-- Anime Synopsis Section -->
        

        <!-- Container for Recommendations and Reviews -->
        <div class="lower-half-container">

            <!-- Container for Recommendations Section -->
            <div class="recommendation-container">
                <h2><strong>✦ More Like This ₊˚⊹⋆</strong></h2>
                <br>
                <!-- Container for All Recommendations -->
                <div class="recommendation">

                    <!-- Container for Individual Recommendation Section -->
                    
                    <?php
                    
                    $genre = $anime['Genre']; // genre of the current anime

                    $sql_recommend = "SELECT * FROM anime 
                    WHERE Genre = ? AND Ani_ID != ? 
                    ORDER BY Popularity DESC
                    LIMIT 3";

                    $stmt_recommend = $conn->prepare($sql_recommend);
                    $stmt_recommend->bind_param("si", $genre, $ani_id);
                    $stmt_recommend->execute();
                    $result_recommend = $stmt_recommend->get_result();

                    while ($rec = $result_recommend->fetch_assoc()) {
                    echo '<div class="individual-recommendation">';
                    echo '<img src="../' .htmlspecialchars($anime["Cover_Img"]). '" alt="' .htmlspecialchars($anime["Title"]). '">';
                    #<!-- Container for Recommendation Details and Add to Box Button -->
                    echo '<div class="recommendation-details">';
                    echo '<h4 class="recommendation-title"><strong>' .htmlspecialchars($anime['Title']). '</strong></h4>';
                    echo '<p class="recommendation-synopsis">' .htmlspecialchars($anime['Description']). '</p>';
                    echo '<button class="btn btn-light"><strong>+ Add to Box</strong></button>';
                        
                    echo '</div>';
                    echo '</div>';

                    echo '<br>';
                    echo '<hr>';
                    echo '<br>';
                    }
                    ?>

                    <br>
                    <hr>
                    <br>

                    <!-- Container for Individual Recommendation Section -->
                    <div class="individual-recommendation">
                        <img src="../assets/img/cover-girls-band-cry.jpg" alt="Girls Band Cry">
                        <!-- Container for Recommendation Details and Add to Box Button -->
                        <div class="recommendation-details">
                            <h4 class="recommendation-title"><strong>Girls Band Cry</strong></h4>
                            <p class="recommendation-synopsis">
                                A group of young women from different backgrounds form a
                                band, using music as a way to express their struggles, dreams, and emotions.
                            </p>
                            <button class="btn btn-light"><strong>+ Add to Box</strong></button>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>

                    <!-- Container for Individual Recommendation Section -->
                    <div class="individual-recommendation">
                        <img src="../assets/img/cover-laid-back-camp.jpg" alt="Laid Back Camp">
                        <!-- Container for Recommendation Details and Add to Box Button -->
                        <div class="recommendation-details">
                            <h4 class="recommendation-title"><strong>Laid Back Camp</strong></h4>
                            <p class="recommendation-synopsis">
                                A group of friends go on relaxing camping trips, enjoying
                                nature, good food, and each other's company.
                            </p>
                            <button class="btn btn-light"><strong>+ Add to Box</strong></button>
                        </div>
                    </div>

                    <br>

                </div>
            </div>

            <!-- Container for Anime Reviews Section -->
            <div class="anime-review-container">
                <h2><strong>✦ Reviews ✶⋆.˚</strong></h2>

                <!-- Container for All Reviews (including Review Form) -->
                <div class="review-container">

                    <!-- Container for Review Form -->
                    <form action="leave-review.php" method="POST">
                        <input type="hidden" name="Ani_ID" value="<?php echo $ani_id; ?>">
                        <input type="hidden" name="Rev_ID" value="<?= $review['Rev_ID'] ?>">
                        <input type="hidden" name="redirect_to" value="<?php echo basename($_SERVER['PHP_SELF']); ?>">
                        <div class="review-form">

                            <!-- Rating Form (dropdown input) -->
                            <div class="rating-form">
                                <label for="rating">Rating:</label><br>
                                <select class="form-select" id="rating" name="Rating" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>

                            <!-- Review Comment Form (text input) -->
                            <div class="review">
                                <label for ="content">Review:</label><br>
                                <input type="text" id="content" name="Content" placeholder="Write a review..." required>
                            </div>

                            <!-- Submit Review Button -->
                            <div class="submisson-button">
                                <br>
                                <button type="submit" class="submit-button">Submit</button>
                            </div>
                            <br>
                    </div>

                    <!-- Divider between Review Form and Reviews -->
                    <hr>

                    <!-- Container for All Reviews -->
                    <div class="review-comments">
                    <?php
                        
                        $sql_reviews = "SELECT r.*, u.Username, u.Profile_Img 
                        FROM review r
                        JOIN user u ON r.User_ID = u.User_ID
                        WHERE r.Ani_ID = ?
                        ORDER BY r.Rev_Date DESC";

                        $stmt_reviews = $conn->prepare($sql_reviews);
                        $stmt_reviews->bind_param("i", $ani_id); // this uses the id from the URL!
                        $stmt_reviews->execute();
                        $result_reviews = $stmt_reviews->get_result();

                        if ($result_reviews->num_rows > 0) {
                            while ($row = $result_reviews->fetch_assoc()) {
                        
                                
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['User_ID']) {
                            echo '<div class="review-card user-review" style="position: relative;">';
                            echo '<div class="dropdown" style="position: absolute; top: 1rem; right: 1.5rem;">';
                            echo '<button class="btn btn-info" data-bs-toggle="dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1rem;">...</button>';
                            echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                            echo '<a class="dropdown-item" href="update-review.php?Rev_ID=' . $row['Rev_ID'] . '&redirect_to=' . basename($_SERVER['PHP_SELF']) . '">Edit Review</a>';
                            echo '<a class="dropdown-item" href="delete-review.php?Review_ID=' . $row['Rev_ID'] . '&redirect_to=' . basename($_SERVER['PHP_SELF']) . '" onclick="return confirm(\'Are you sure you want to delete this review?\')">Delete Review</a>';

                            echo '</ul>';
                            echo '</div>';
                            echo '<img src="' . htmlspecialchars($row["Profile_Img"]) . '" alt="profile" class="review-user-icon" width="50px" height="50px">';
                            echo '<h4 class="review-username">' . htmlspecialchars($row["Username"]) . '</h4>';
                            echo '<h5>' . $row["Rating"] . '/10</h5>';
                            echo '<p>' . htmlspecialchars($row["Content"]) . '</p>';
                            echo '<p class="review-date">' . date("M j, Y", strtotime($row["Rev_Date"])) . '</p>';
                            echo '</div>';
                            continue; // Skip displaying this review again in the loop
                        }
                                echo '<div class="review-card">';
                                echo '<img src="' . htmlspecialchars($row["Profile_Img"]) . '" alt="profile" class="review-user-icon" width="50px" height="50px">';
                                echo '<h4 class="review-username">' . htmlspecialchars($row["Username"]) . '</h4>';
                                echo '<h5>' . $row["Rating"] . '/10</h5>';
                                echo '<p>' . htmlspecialchars($row["Content"]) . '</p>';
                                echo '<p class="review-date">' . date("M j, Y", strtotime($row["Rev_Date"])) . '</p>';
                                echo '</div>';   
                            }
                        } else {
                            echo '<p>No reviews yet! (◞‸◟；) Be the first to leave one?</p>';
                        }
                        $conn->close();
                    ?>
                    
                        

                    <br>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
</section>

</html>