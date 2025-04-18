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

    $redirect = $_GET['redirect_to'] ?? 'anime.php';

    if ($stmt->execute()) {
        header("Location: " . $redirect);
        exit();
    } else {
        echo "Error updating review: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniBox</title>
    <link rel="icon" type="image/x-icon" href="../assets/ABLOGO.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/theme.css">
    <link rel="stylesheet" href="update.css">
    <link rel="stylesheet" href="new.css">
</head>
<body>

    <div class="update-review">
        <h1 class="text-center">Update Review</h1>

    
        <div class="back-button">
            <a class="btn btn-link" href="<?php echo htmlspecialchars($_GET['redirect_to'] ?? 'anime-list.php'); ?>">Back to Anime</a>
        </div>

        <div class="update-form">
            <form method="POST">
                <input type="hidden" name="Rev_ID" value="<?= $review['Rev_ID'] ?>">
    
                <br>
                <label for="rating">Rating:</label>
                <input type="number" name="Rating" id="rating" min="1" max="10" value="<?= $review['Rating'] ?>" required><br>
    
                <br>
                <label for="content">Review:</label>
                <input type="text" name="Content" id="content" value="<?= htmlspecialchars($review['Content']) ?>" required><br>
    
                <br>
                <button class="btn btn-success" type="submit">Update</button>
            </form>
        </div>
    </div>

</body>
</html>


