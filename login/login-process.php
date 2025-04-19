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
    $sql = "SELECT * FROM user WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($row = $result->fetch_assoc()) {
        // Verify the password if the user exists
        if (password_verify($pass, $row['Password'])) {
            // Login successful, store the user details in the session
            $_SESSION['user_id'] = $row['User_ID'];
            $_SESSION['username'] = $user;
            $_SESSION['email'] = $row['Email'];
            $_SESSION['Password'] = $row['Password'];
            $_SESSION['About'] = $row['About'];
            $_SESSION['Profile_Img'] = $row['Profile_Img'];
            $_SESSION['Banner_Img'] = $row['Banner_Img'];
            
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