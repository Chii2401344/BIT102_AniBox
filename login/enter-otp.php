<?php
// Include the database connection file and start the session
require 'connect.php';
session_start();

// Start the OTP verification process if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the OTP entered by the user
    $userOtp = $_POST['otp'];

    // Check if the OTP is valid and matches the one stored in the session
    if ($userOtp == $_SESSION['otp']) {
        // OTP is valid, proceed to reset the password
        echo "<script>alert('OTP verified successfully!');</script>";
        echo "<script>window.location.href='reset-password.html';</script>";
        exit();
    } else if ($userOtp != $_SESSION['otp']) {
        // OTP is invalid, show an error message
        echo "<script>alert('Invalid OTP. Please try again.');</script>";
        echo "<script>window.location.href='enter-otp.html';</script>";
        exit();
    }
}   
?>