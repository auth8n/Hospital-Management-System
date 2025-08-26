<?php
session_start();
include 'db_connect.php';

$senderId = $_GET['sender_id'];
$receiverId = $_GET['receiver_id'];

// Fetch messages between the two users
$stmt = $conn->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)");
$stmt->bind_param("iiii", $senderId, $receiverId, $receiverId, $senderId);
if ($stmt->execute()) {
    $result = $stmt->get_result();
} else {
    error_log("Error executing query: " . $stmt->error);
}


$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Send back the messages in JSON format
echo json_encode(['messages' => $messages]);
?>
