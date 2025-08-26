<?php
session_start();
include 'db_connect.php'; // Assuming this file has your DB connection setup

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login-register.php");
    exit();
}

// Process the form if it's submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Verify that the passwords match
    if ($new_password !== $confirm_new_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user information in the database
    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_username, $hashed_password, $user_id);

    if ($stmt->execute()) {
        // Success message and redirect
        echo "<script>alert('Profile updated successfully. Please log in again with your new credentials.');</script>";
        session_destroy(); // Log out the user
        echo "<script>window.location.href = 'login-register.php';</script>";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
