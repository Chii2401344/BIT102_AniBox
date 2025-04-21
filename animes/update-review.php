<?php
require 'connect.php'; // Include the database connection file
session_start(); // Starts the login session

// Error message if user is not logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to edit a review");
}

// Checks if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rev_id = $_POST["Rev_ID"]; // Review ID from the form
    $rating = $_POST["Rating"]; // Review Rating from the form
    $content = $_POST["Content"]; // Review Content from the form
    $redirect = $_POST['redirect_to']; // Redirect URL from the form

    // Prepares the SQL query to update the review
    $stmt = $conn->prepare("UPDATE review SET Rating = ?, Content = ?, Rev_Date = NOW() WHERE Rev_ID = ?");
    $stmt->bind_param("isi", $rating, $content, $rev_id);

    // Executes the query
    if ($stmt->execute()) {
        // Redirects the user back to the anime page after successfully updating
        header("Location: $redirect");
        exit();
    // Error message if the review update fails
    } else {
        echo "Error updating review: " . $stmt->error;
    }
}
?>