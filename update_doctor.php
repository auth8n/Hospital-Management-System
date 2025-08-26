<?php
session_start();
include 'db_connect.php'; // Assuming this file has your DB connection setup

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Check if doctor ID is set
if (isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];
    $user_id = $_SESSION['id'];  // Get the current user's ID from session

    // Update the user's doctor ID in the database
    $stmt = $conn->prepare("UPDATE appointments SET doctor_id = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $doctor_id, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Doctor ID updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update doctor']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No doctor ID provided']);
}
?>
