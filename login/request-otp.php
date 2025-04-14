<?php
require "connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if the email exists in the database
    $sql = "SELECT Email FROM user WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Email found, proceed to send OTP
        $otp = rand(100000, 999999); // Generate a random 6-digit OTP

        // Store the OTP in the session for later verification
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP to the user's email (this is a placeholder, implement actual email sending)
        mail($email, "Your OTP Code", "Your OTP code is: " . $otp);

        echo "<script>alert('OTP sent to your email!');</script>";
        echo "<script>window.location.href = 'enter-otp.html';</script>";
    } else {
        // Email not found
        header("Location: request-otp.html?error=email-not-found");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>