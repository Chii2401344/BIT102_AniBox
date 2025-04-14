<?php
require "connect.php"; // Include the database connection file
session_start(); // Start the session to store user information

// Start the login process if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Validate the input to prevent SQL injection
    $stmt = $conn->prepare("SELECT Password FROM user WHERE Username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($row = $result->fetch_assoc()) {
        // Verify the password if the user exists
        if (password_verify($pass, $row['Password'])) {
            // Login successful
            $_SESSION['username'] = $user;  // Store the username in session
            header("Location: ../user/user-home.html");
            exit();
        } else {
            // Incorrect password
            header("Location: user-login.html?error=incorrect");
            exit();
        }
    } else {
        // User not found
        header("Location: user-login.html?error=invalid");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>