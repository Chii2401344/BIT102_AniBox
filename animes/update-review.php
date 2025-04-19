<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to edit a review");
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!isset($_GET['Rev_ID'])) {
        die("No review selected.");
    }

    $rev_id = $_GET['Rev_ID'];

    $stmt = $conn->prepare("SELECT * FROM review WHERE Rev_ID = ?");
    $stmt->bind_param("i", $rev_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $review = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rev_id = $_POST["Rev_ID"];
    $rating = $_POST["Rating"];
    $content = $_POST["Content"];

    $stmt = $conn->prepare("UPDATE review SET Rating = ?, Content = ?, Rev_Date = NOW() WHERE Rev_ID = ?");
    $stmt->bind_param("isi", $rating, $content, $rev_id);

    $redirect = $_POST['redirect_to'] ?? 'anime-list.php';

    if ($stmt->execute()) {
        header("Location: $redirect");
        exit();
    } else {
        echo "Error updating review: " . $stmt->error;
    }
}

?>