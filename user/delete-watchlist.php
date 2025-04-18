<?php
session_start();
require '../login/connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['anime_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing anime ID']);
    exit();
}

$user_id = $_SESSION['user_id'];
$anime_id = $data['anime_id'];

// Delete the watchlist entry
$sql = "DELETE FROM watchlist WHERE User_ID = ? AND Ani_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $anime_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to delete watchlist entry']);
}

$stmt->close();
$conn->close();
?> 