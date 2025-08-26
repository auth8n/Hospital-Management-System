<?php
session_start();
include 'db_connect.php'; // Include the database connection file

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the necessary POST data is set
if (isset($_POST['sender_id']) && isset($_POST['receiver_id']) && isset($_POST['message'])) {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    // Check if the message is not empty
    if (empty($message)) {
        echo json_encode(["status" => "error", "message" => "Message cannot be empty."]);
        exit();
    }

    // Ensure the sender_id and receiver_id are valid integers
    if (!is_numeric($sender_id) || !is_numeric($receiver_id)) {
        echo json_encode(["status" => "error", "message" => "Invalid user IDs."]);
        exit();
    }

    // Prepare SQL query to insert the message into the database
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, receiver_type, message) VALUES (?, ?, 'doctor', ?)");
   
    

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Failed to prepare SQL statement."]);
        exit();
    }

    // Bind the parameters to the SQL query
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);

    // Execute the query and check for errors
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Message sent!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send message."]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Missing required parameters."]);
}

// Close the database connection
$conn->close();
?>
