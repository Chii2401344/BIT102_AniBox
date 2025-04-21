<?php
require 'connect.php'; // Include database connection file
include 'anime-navbar.php'; // Include the navbar

// Getting ID from the URL and validating it
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ani_id = (int) $_GET['id'];
    // Error message if ID is invalid
} else {
    echo "Invalid or missing anime ID!";
    exit;
}

// Fetches anime details from database
$sql = "SELECT * FROM anime WHERE Ani_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ani_id);
$stmt->execute();
$result = $stmt->get_result();

// Checks if the anime exists
if ($result->num_rows > 0) {
    $anime = $result->fetch_assoc();
    // Error message if no anime with the given ID is found
} else {
    echo "Anime not found!";
    exit;
}

// Variables for the anime details
$genre = $anime['Genre'];
$banner_img = $anime['Banner_Img'];
$redirect_url = $_SERVER['REQUEST_URI'];

// Determines tag colour for genres
$color = match (strtolower($genre)) {
    'comedy' => 'orange',
    'romance' => 'lightpink',
    'action' => 'red',
    default => 'gray'
};

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
</head>

<body>
    <!-- Container for Anime Details and Add to Box Button Section -->
    <div class="container1">
        <!-- Container for Main Anime Display -->
        <div class=anime-container>
            <?php
            // Fetches anime details from database
            $sql = "SELECT * FROM anime WHERE Ani_ID = ?"; // Retrieve all columns for the given Ani_ID
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ani_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Checks if there are any results 
            if ($result && $result->num_rows > 0) {
                $anime = $result->fetch_assoc();

                // Display of anime details
                echo '<div class="anime-cover">';
                echo '<img src="../' . htmlspecialchars($anime["Cover_Img"]) . '" alt="Bocchi the Rock">';
                echo '</div>';

                echo '<div class="anime-details">';
                echo '<p class="title"><strong>' . htmlspecialchars($anime['Title']) . '</strong></p>';
                echo '<span class="genre" style="color: ' . $color . '; border: 1px solid ' . $color . ';">' . htmlspecialchars($anime["Genre"]) . '</span>';
                echo '<p class="detail1"><strong>Episodes:</strong> ' . ($anime['Episodes']) . '</p>';
                echo '<p class="detail2"><strong>Status:</strong> ' . htmlspecialchars($anime["Status"]) . ' </p>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Add to Box Button -->
        <div class="add-button">
            <button class="btn btn-primary" id="addToBoxBtn" data-anime-id="<?php echo $ani_id; ?>"><strong>+ Add to
                    Box</strong></button>
        </div>
        <br>
    </div>

    <!-- Container for Anime Info, Synopsis, Recommendations and Reviews Sections -->
    <div class="container2">

        <!-- Divider between Anime Details and rest of the page -->
        <hr>

        <?php
        // Fecthes anime details from database
        $sql = "SELECT * FROM anime WHERE Ani_ID = ?"; // Retrieve all columns for the given Ani_ID
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ani_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Checks if there are any results
        if ($result && $result->num_rows > 0) {
            $anime = $result->fetch_assoc();

            // Container for Anime Info Section
            echo '<div class="anime-info-container">';

            // Display of Anime Average Rating Score
            echo '<div class="score">';
            echo '<p>Rating</p>';
            echo '<p></p>';
            echo '<h3>' . ($anime['AvgRating']) . '</h3>';
            echo '</div>';

            // Display of Anime Popularity
            echo '<div class="popularity">';
            echo '<p>Popularity</p>';
            echo '<p></p>';
            echo '<h3>' . ($anime['Popularity']) . '</h3>';
            echo '</div>';

            // Display of Anime Release Date
            echo '<div class="date">';
            echo '<p>Release Date</p>';
            echo '<p></p>';
            echo '<h3>' . ($anime['Release_Date']) . '</h3>';
            echo '</div>';

            // Display of Anime Production Studio
            echo '<div class="studio">';
            echo '<p>Studio</p>';
            echo '<p></p>';
            echo '<h3>' . ($anime['Studio']) . '</h3>';
            echo '</div>';

            // Closes container for Anime Info Section
            echo '</div>';

            // Display of Anime Synopsis
            echo '<div class="anime-synopsis">';
            echo '<h2><strong>✦ Synopsis ୭ ˚. ᵎᵎ</strong></h2>';
            echo '<p>' . htmlspecialchars($anime['Description']) . '</p>';
            echo '</div>';
        }
        ?>

    </div>

    <!-- Container for Recommendations and Reviews -->
    <div class="lower-half-container">

        <!-- Container for Recommendations Section -->
        <div class="recommendation-container">
            <h2><strong>✦ More Like This ₊˚⊹⋆</strong></h2>
            <br>

            <!-- Container for All Recommendations -->
            <div class="recommendation">
                <?php
                // Fetches recommendations based on genre
                $sql_recommend = "SELECT * FROM anime # Retrieves data from anime table
                                    WHERE Ani_ID != ? AND Genre = ? # Excludes current anime and filters by same genre
                                    ORDER BY Popularity DESC # Display most popular first
                                    LIMIT 3"; // Limits display to 3 animes
                $stmt_recommend = $conn->prepare($sql_recommend);
                $stmt_recommend->bind_param("is", $ani_id, $genre); // Correct order
                $stmt_recommend->execute();
                $result_recommend = $stmt_recommend->get_result();

                // Iterates through each recommendation
                while ($rec = $result_recommend->fetch_assoc()) {
                    // Container for Individual Recommendations
                    echo '<div class="individual-recommendation">';
                    echo '<a href="anime.php?id=' .$rec['Ani_ID']. '">';
                    echo '<img src="../' .htmlspecialchars($rec["Cover_Img"]). '" alt="' .htmlspecialchars($rec["Title"]). '">';
                    echo '<div class="recommendation-details">';
                    echo '<h4 class="recommendation-title"><strong>' .htmlspecialchars($rec['Title']). '</strong></h4>';
                    echo '<p class="recommendation-synopsis">' .htmlspecialchars($rec['Description']). '</p>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';

                    // Divider between each recommendation
                    echo '<br>';
                    echo '<hr>';
                    echo '<br>';
                }
                ?>

            </div>
        </div>

        <!-- Container for Anime Reviews Section -->
        <div class="anime-review-container">
            <h2><strong>✦ Reviews ✶⋆.˚</strong></h2>

            <!-- Container for All Reviews (including Review Form) -->
            <div class="review-container">

                <!-- Review Form that submits data to leave-review.php -->
                <form action="leave-review.php" method="POST">
                    <input type="hidden" name="Ani_ID" value="<?php echo $ani_id; ?>"> <!-- Passes Anime ID to the form-->
                    <input type="hidden" name="Rev_ID" value="<?= $review['Rev_ID'] ?>"> <!-- Passes Review ID to the form-->
                    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"> <!-- Passes the current URL to the form-->
                    
                    <!-- Container for Review Form -->
                    <div class="review-form">

                        <!-- Rating Form (dropdown input) -->
                        <div class="rating-form">
                            <label for="rating">Rating:</label><br>
                            <select class="form-select" id="rating" name="Rating" required> <!-- Ensures that a rating is selected -->
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
                            <label>Review:</label><br>
                            <input type="text" id="content" name="Content" placeholder="Write a review..." required> <!-- Ensures that a comment was written -->
                        </div>

                        <!-- Submit Review Button -->
                        <div class="submisson-button">
                            <br>
                            <button type="submit" class="submit-button">Submit</button>
                        </div>
                        <br>
                        
                </form>
            
            </div>

            <!-- Divider between Review Form and Reviews -->
            <hr>

            <!-- Container for All Reviews -->
            <div class="review-comments">

                <?php
                $sql = "SELECT r.*, u.Username, u.Profile_Img # Retrieves review and user data
                        FROM review r
                        JOIN user u ON r.User_ID = u.User_ID # Joins review and user tables
                        WHERE r.Ani_ID = ? # Filters reviews displayed by current Anime ID
                        ORDER BY 
                        CASE WHEN r.User_ID = ? THEN 0 ELSE 1 END, # Prioritizes logged in user's review 
                        r.Rev_Date DESC"; // Sorts displayed reviews by most recently posted
                $stmt = $conn->prepare($sql);
                $user_id = $_SESSION['user_id'] ?? null; // If user is not logged in, this will be null
                $stmt->bind_param("ii", $ani_id, $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Checks if there are any reviews
                if ($result->num_rows > 0) {
                    // Iterates through each review that was fetched
                    while ($row = $result->fetch_assoc()) {

                        // Checks if the user is logged in, and if the review belongs to the logged in user
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['User_ID']) {
                            // Display of user's review card if logged in and if a review has been made by them
                            echo '<div class="review-card user-review" style="position: relative;">';
                            // Button for Edit and Delete Review Options
                            echo '<div class="dropdown" style="position: absolute; top: 1rem; right: 1.5rem;">';
                            echo '<button class="btn btn-info" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1rem;">...</button>';
                            echo '<ul class="dropdown-menu">';

                            // Edit Review Button - triggers modal and passes data to it
                            echo '<button type="button" class="dropdown-item"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateReviewModal"                      
                                    data-rev-id="' .$row['Rev_ID']. '"
                                    data-rating="' .$row['Rating']. '"
                                    data-content="' .htmlspecialchars($row['Content']). '">
                                    Edit Review
                                    </button>';

                            // Delete Review - redirects to delete-review.php
                            echo '<a class="dropdown-item" href="delete-review.php?Review_ID='.$row['Rev_ID'].'&redirect_to=' .$redirect_url. '" onclick="return confirm(\'Are you sure you want to delete your review?\')">Delete Review</a>';

                            echo '</ul>';
                            echo '</div>';

                            // Display of user's review details
                            echo '<img src="' .htmlspecialchars($row["Profile_Img"]). '" alt="profile" class="review-user-icon" width="50px" height="50px">';
                            echo '<h4 class="review-username">' .htmlspecialchars($row["Username"]). '</h4>';
                            echo '<h5>' .$row["Rating"]. '/10</h5>';
                            echo '<p style="text-align: left;">' .htmlspecialchars($row["Content"]). '</p>';
                            echo '<p class="review-date">' .date("M j, Y", strtotime($row["Rev_Date"])). '</p>';
                            echo '</div>';
                            continue; // Skip displaying this review again in the later loop
                        }

                        // Display of other users' reviews
                        echo '<div class="review-card">';
                        echo '<img src="' .htmlspecialchars($row["Profile_Img"]). '" alt="profile" class="review-user-icon" width="50px" height="50px">';
                        echo '<h4 class="review-username">' .htmlspecialchars($row["Username"]). '</h4>';
                        echo '<h5>' .$row["Rating"]. '/10</h5>';
                        echo '<p style="text-align: left;">' .htmlspecialchars($row["Content"]). '</p>';
                        echo '<p class="review-date">' .date("M j, Y", strtotime($row["Rev_Date"])). '</p>';
                        echo '</div>';
                    }

                    // Message if no reviews yet
                } else {
                    echo '<p>No reviews yet! (◞‸◟；) Be the first to leave one?</p>';
                }
                ?>

                <!-- Update Review Modal -->
                <div class="modal fade" id="updateReviewModal" tabindex="-1" aria-labelledby="updateReviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <!-- Modal Content -->
                        <div class="modal-content">
                            <!-- Sends updated review data to update-review.php -->
                            <form method="POST" action="update-review.php">
                                <!-- Stores the unique Review ID -->
                                <input type="hidden" name="Rev_ID" id="modal-rev-id">
                                <!-- Stores the current URL for redirection -->
                                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

                                <!-- Header of the Update Review Modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateReviewModalLabel"
                                        style="color:var(--earthy-brown); font-weight:bold;">Update Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <!-- Body of the Update Review Modal -->
                                <div class="modal-body">
                                    <!-- Rating Update Input Field -->
                                    <div class="mb-3">
                                        <label for="modal-rating" class="form-label" style="color:var(--earthy-brown); font-weight:bold;">Rating</label>
                                        <input type="number" class="form-control" name="Rating" id="modal-rating" min="1" max="10" required>
                                    </div>
                                    <!-- Review Update Input Field -->
                                    <div class="mb-3">
                                        <label for="modal-content" class="form-label" style="color:var(--earthy-brown); font-weight:bold;">Review</label>
                                        <input type="text" class="form-control" name="Content" id="modal-content" style="border-color:var(--light-blue);" required>
                                    </div>
                                </div>

                                <!-- Footer of the Update Review Modal -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

    <!-- Additional Styling for the Page -->
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-image:
                linear-gradient(to bottom, rgba(0, 0, 0, 0.7) 0%, white 45%),
                url('../<?php echo htmlspecialchars($banner_img); ?>');
            background-position: top;
        }

        .review-dropdown {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
        }

        .btn.btn-info {
            font-size: 1rem;
            border-radius: 5rem;
            border: none;
            background-color: var(--light-blue);
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn.btn-info:hover {
            background-color: var(--light-blue-hover);
            color: white;
            transform: translateY(-2px);
        }


        .genre {
            margin: 1.25rem;
            margin-left: 1rem;
            font-size: 1.25rem;
            border-radius: 30rem;
            padding: 0.313rem;
            width: fit-content;
        }

        .dropdown-menu {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 0.5rem;
        }

        .dropdown-item:hover {
            background-color: var(--light-blue);
            color: #000;
        }


        #modal-rating {
            border: 1px solid var(--light-blue);
            border-radius: 5px;
            width: 30%
        }

        #modal-content {
            border: 1px solid var(--light-blue);
            border-radius: 5px;
            height: 3rem;
            width: 80%
        }

        .btn.btn-success {
            border: none;
            background: linear-gradient(135deg, var(--soft-green), var(--sky-blue));
            border-color: var(--soft-green);
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, var(--soft-green-hover), var(--sky-blue-hover));
            border-color: var(--soft-green-hover);
            transform: translateY(-2px);
        }

        a {
            text-decoration: none;
        }
    </style>

    <!-- JavaScript for Modal -->
    <script>
        // Refers to the Update Review Modal
        const updateModal = document.getElementById('updateReviewModal');
        // Event listener for when the modal is shown
        updateModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal 
            const revId = button.getAttribute('data-rev-id'); // Review ID from the button
            const rating = button.getAttribute('data-rating'); // Rating from the button
            const content = button.getAttribute('data-content'); // Content from the button
            // Displays the existing values in the modal
            updateModal.querySelector('input[name="Rev_ID"]').value = revId; 
            updateModal.querySelector('input[name="Rating"]').value = rating;
            updateModal.querySelector('input[name="Content"]').value = content;
        });
    </script>

    <!-- JavaScript for Add to Box Button -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addToBoxBtn = document.getElementById('addToBoxBtn');

            addToBoxBtn.addEventListener('click', function () {
                const animeId = this.getAttribute('data-anime-id');

                fetch('add-to-watchlist.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ anime_id: animeId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert(data.error || 'Failed to add to watchlist');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding to watchlist');
                    });
            });
        });
    </script>

</body>

</html>