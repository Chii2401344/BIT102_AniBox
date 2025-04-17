<?php
// Include the database connection file and start the session
require '../login/connect.php';
session_start();

$username = $_SESSION['username']; // Get the username from the session

// Run DELETE query to delete an account from the database
$sql = "DELETE FROM user WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

// Check if the account was deleted successfully
if ($stmt->execute()) {
    // Logout the user and redirect to the login page
    session_destroy();
    echo "<script>alert('Account deleted successfully. You will be redirected to home page.');</script>";
    echo "<script>window.location.href = '../index.html';</script>";
    exit();
} else {
    // Error deleting account
    echo "<script>alert('Failed to delete account.');</script>";
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>