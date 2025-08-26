<?php
session_start();

// Include the database connection
include 'db_connect.php';  // Ensure the correct path to your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];  // Get the action (upload, edit, delete)

    if ($action == 'upload' || $action == 'edit') {
        // Handle the upload or edit image functionality
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $target_dir = "uploads/";  // Directory where the image will be stored
            $file_name = basename($_FILES['profile_image']['name']);
            $target_file = $target_dir . $file_name;
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate the file type (allow only image types)
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($image_file_type, $allowed_types)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
                exit;
            }

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                // Store the uploaded image path in session
                $_SESSION['uploaded_image'] = $target_file;

                // Update the user's profile image in the database (optional)
                if (isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];  // Get the user ID from the session

                    // Use MySQLi for the database update query
                    $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
                    $stmt->bind_param("si", $target_file, $userId);  // Bind parameters (string, integer)
                    $stmt->execute();
                    $stmt->close();
                }

                // Respond with the image path
                echo json_encode(['status' => 'success', 'imagePath' => $target_file]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
            }
        }
    }

    // Handle the delete action
    if ($action == 'delete') {
        // Handle the image deletion logic (optional)
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];  // Get the user ID from the session

            // Delete the image file from the server (if it exists)
            $stmt = $conn->prepare("SELECT profile_image FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->bind_result($imagePath);
            $stmt->fetch();
            $stmt->close();

            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);  // Delete the image file
            }

            // Update the database to remove the image path
            $stmt = $conn->prepare("UPDATE users SET profile_image = NULL WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->close();

            // Remove the image from the session
            unset($_SESSION['uploaded_image']);

            // Respond with success
            echo json_encode(['status' => 'success', 'message' => 'Image deleted successfully']);
        }
    }
}
?>
