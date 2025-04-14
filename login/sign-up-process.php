<?php
require "connect.php";
session_start();

// Start the sign-up process if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm-password"];

    // Validate the input to prevent SQL injection
    $sql = "SELECT Username FROM user WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($row = $result->fetch_assoc()) {
        header("Location: user-sign-up.html?error=exists");
        exit();
    }

    // Check if the email already exists in the database
    $sql = "SELECT Email FROM user WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        header("Location: user-sign-up.html?error=email-exists");
        exit();
    }

    // Check if the email format is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: user-sign-up.html?error=invalid-email");
        exit();
    }

    // Hash the password before storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Set default images for profile pic and banner pic
    $profileImg = "../assets/img/default.jpg";
    $bannerImg = "../assets/img/default_banner.jpg";

    // Insert the new user into the database
    $sql = "INSERT INTO user (Username, Email, Password, Profile_Img, Banner_Img) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $email, $hashedPassword, $profileImg, $bannerImg); 

    // Check if the sql query was successful
    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Sign up successful!');</script>";
        echo "<script>window.location.href = '../user/user-home.html';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
