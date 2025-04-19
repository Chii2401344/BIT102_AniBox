<?php
session_start();
require 'connect.php';

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
$status = 'Planning'; // Set default status as planning

// Check if the anime is already in the user's Box
$check_sql = "SELECT * FROM watchlist WHERE User_ID = ? AND Ani_ID = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $user_id, $anime_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // If Anime is already in their Box, update watchlist status to Planning
    $update_sql = "UPDATE watchlist SET Status = ? WHERE User_ID = ? AND Ani_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sii", $status, $user_id, $anime_id);
    
    if ($update_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Anime status changed to planning!']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update your box']);
    }
    
    $update_stmt->close();
} else {
    // Create new watchlist entry
    $insert_sql = "INSERT INTO watchlist (User_ID, Ani_ID, Status) VALUES (?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iis", $user_id, $anime_id, $status);
    
    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Anime added to your box!']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to add to box']);
    }
    
    $insert_stmt->close();
}

$check_stmt->close();
$conn->close();
?> 