<?php
// Include the database connection file and start the session
require "connect.php";
session_start();

// Start the login process if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Validate the input to prevent SQL injection
    $sql = "SELECT User_ID, Password FROM user WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($row = $result->fetch_assoc()) {
        // Verify the password if the user exists
        if (password_verify($pass, $row['Password'])) {
            // Login successful
            $_SESSION['user_id'] = $row['User_ID'];
            $_SESSION['username'] = $user;
            
            header("Location: ../user/user-home.php");
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