<?php
require 'connect.php';

if (isset($_GET['Review_ID'])) {
    $rev_id = $_GET['Review_ID'];

    $stmt = $conn->prepare("DELETE FROM review WHERE Rev_ID = ?");
    $stmt->bind_param("i", $rev_id);

    $redirect = $_GET['redirect_to'] ?? 'anime.php';

    if ($stmt->execute()) {
        header("Location: " . $redirect);
        exit();
    } else {
        echo "Delete Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No review ID provided.";
}
?>
