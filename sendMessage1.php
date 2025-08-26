<?php
header("Content-Type: application/json");
session_start();

// Ensure the doctor is logged in
if (!isset($_SESSION['doctor_id'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit();
}

include 'db_connect.php';

// Validate required POST data
if (!isset($_POST['senderId']) || !isset($_POST['receiverId']) || !isset($_POST['message'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit();
}

// Get data from POST request
$sender_id = $_POST['senderId'];
$receiver_id = $_POST['receiverId'];
$message = trim($_POST['message']);

// Validate input (ensure IDs are integers and message is not empty)
if (!is_numeric($sender_id) || !is_numeric($receiver_id) || empty($message)) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit();
}

// Check if the receiver_id exists in the users table
$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE id = ?");
$stmt->bind_param("i", $receiver_id);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count == 0) {
    echo json_encode(["status" => "error", "message" => "Receiver (user) does not exist"]);
    exit();
}

try {
    // Insert the message into the messages table
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, receiver_type, message) VALUES (?, ?, 'user', ?)");
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);


    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Message sent"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send message"]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
