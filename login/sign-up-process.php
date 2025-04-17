<?php
// Include the database connection file and start the session
require "connect.php";
session_start();

// Start the sign-up process if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username, email, password, and confirm password from the form
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

    // Check if the username already exists in the database
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

    // Check if the email already exists in the database
    if ($row = $result->fetch_assoc()) {
        header("Location: user-sign-up.html?error=email-exists");
        exit();
    }

    // Check if the email format is correct
    $domain = substr(strrchr($email, "@"), 1);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !checkdnsrr($domain, "MX")) {
        header("Location: user-sign-up.html?error=invalid-email");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user details into database
    $sql = "INSERT INTO user (Username, Email, Password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword); 

    // Check if the sql query was successful
    if ($stmt->execute()) {
        // Sign up successful, store the username in the session and redirect to user home page
        $_SESSION['username'] = $username;
        echo "<script>alert('Sign-up successful!');</script>";
        echo "<script>window.location.href = '../user/user-home.html';</script>";
        exit();
    } else {
        // Error inserting data into the database
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
