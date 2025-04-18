<?php
require 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ani_id = $_POST['Ani_ID']; // ✅ Anime ID from form
    $rating = $_POST['Rating'];
    $content = $_POST['Content']; 
    $redirect = $_POST['redirect_to'];
    $user_id = $_SESSION['user_id'];
    if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to submit a review");
    }
    
    $check_sql = "SELECT * FROM review WHERE User_ID = ? AND Ani_ID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $user_id, $ani_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    // Alert the user and redirect back
    echo "<script>alert('You have already submitted a review for this anime. You can only leave one review.'); 
    window.location.href = '$redirect';
    </script>";
    exit();
} else {
    // ✅ Insert new review
    $sql = "INSERT INTO review (User_ID, Ani_ID, Rating, Content) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $user_id, $ani_id, $rating, $content);

    if ($stmt->execute()) {
        header("Location: " . $redirect);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
}
?>
