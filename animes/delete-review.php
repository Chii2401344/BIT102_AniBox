<?php
require 'connect.php'; // Include the database connection file

// Checks if the Review ID is passed in the URL
if (isset($_GET['Review_ID'])) {
    $rev_id = $_GET['Review_ID']; // Review ID from the URL
    $redirect = $_GET['redirect_to']; // Redirect URL from the form

    // Prepares the SQL query to delete the review
    $stmt = $conn->prepare("DELETE FROM review WHERE Rev_ID = ?");
    $stmt->bind_param("i", $rev_id); 

    // Executes the query
    if ($stmt->execute()) {
        // Redirects the user back to the anime page after successfully deleting
        header("Location: " . $redirect);
        exit();
    // Error message if the review deletion fails
    } else {
        echo "Delete Error: " . $stmt->error;
    }

// Error message if the Review ID is not provided
} else {
    echo "No review ID provided.";
}
?>
