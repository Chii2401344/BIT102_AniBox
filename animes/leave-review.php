<?php
require 'connect.php'; // Include the database connection file
session_start(); // Starts the login session

// Checks if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ani_id = $_POST['Ani_ID']; // Review Anime ID from form
    $rating = $_POST['Rating']; // Review Rating from form
    $content = $_POST['Content']; // Review Content from form
    $redirect = $_POST['redirect_to']; // Redirect URL from form
    $user_id = $_SESSION['user_id']; // User ID from session
    // Error message if user is not logged in
    if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to submit a review");
    }

    // Prepare the SQL query to check if the user has already submitted a review for this anime
    $check_sql = "SELECT * FROM review WHERE User_ID = ? AND Ani_ID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $user_id, $ani_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    // Check if the user has already submitted a review for this anime
    if ($result->num_rows > 0) {
        // If yes, triggers an alert and redirects the user back
        echo "<script>alert('You have already submitted a review for this anime. You can only leave one review per anime.'); 
    window.location.href = '$redirect'; </script>";
        exit();
        
    } else {
        // If no, insert the new review into the database
        // Prepare the SQL query to insert the review
        $sql = "INSERT INTO review (User_ID, Ani_ID, Rating, Content) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $user_id, $ani_id, $rating, $content);
        
        // Executes the query
        if ($stmt->execute()) {
            header("Location: " . $redirect);
            exit();
        // Error message if the review submission fails
        } else {
            echo "Error: " . $stmt->error;
        }

        // Closes the statement and connection for security
        $stmt->close();
        $conn->close();
    }
}
?>