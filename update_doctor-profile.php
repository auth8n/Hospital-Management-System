<?php
session_start();
include 'db_connect.php'; // Assuming this file has your DB connection setup

// Check if doctor is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login-register.php");
    exit();
}

// Process the form if it's submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_SESSION['id'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Verify that the passwords match
    if ($new_password !== $confirm_new_password) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    // Update the doctor information in the database
    $stmt = $conn->prepare("UPDATE doctors SET username = ?, password = ? WHERE doctor_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters and execute the update
    $stmt->bind_param("ssi", $new_username, $new_password, $doctor_id); // Assuming you store passwords in plaintext

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully. Please log in again with your new credentials.');</script>";
        session_destroy(); // Log out the doctor
        echo "<script>window.location.href = 'login-register.php';</script>";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
