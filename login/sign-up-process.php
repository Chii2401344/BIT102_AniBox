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
    $stmt = $conn->prepare("SELECT Password FROM user WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($row = $result->fetch_assoc()) {
        header("Location: user-sign-up.html?error=exists");
        exit();
    } 
    // Check if the email format is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: user-sign-up.html?error=invalid-email");
        exit();
    }

    // Hash the password before storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO user (Username, Password, Email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $email); 

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
