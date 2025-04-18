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

if (!isset($data['anime_id']) || !isset($data['status'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit();
}

$user_id = $_SESSION['user_id'];
$anime_id = $data['anime_id'];
$status = $data['status'];

// Validate status
$valid_statuses = ['Watching', 'Completed', 'Planning'];
if (!in_array($status, $valid_statuses)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid status']);
    exit();
}

// Update the watchlist entry
$sql = "UPDATE watchlist SET Status = ? WHERE User_ID = ? AND Ani_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $status, $user_id, $anime_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update watchlist']);
}

$stmt->close();
$conn->close();
?> 