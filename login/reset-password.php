<?php
// Include the database connection file and start the session
require "connect.php";
session_start();

// Start the password reset process if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the new password and confirm password from the form and email from session
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $email = $_SESSION["email"];

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password

    // Update the password in the database
    $sql = "UPDATE user SET Password = ? WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $email);
    $stmt->execute();
 
    // Check if the password was updated successfully
    if ($stmt->execute()) {
        echo "<script>alert('Password reset successful!');</script>";
        echo "<script>window.location.href = 'user-login.html';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>