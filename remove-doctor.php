<?php
if (isset($_POST['remove_doctor'])) {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "theracare_users";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username and password match
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If a match is found, delete the doctor
        $delete_stmt = $conn->prepare("DELETE FROM doctors WHERE username = ? AND password = ?");
        $delete_stmt->bind_param("ss", $username, $password);

        if ($delete_stmt->execute()) {
            echo "<p style='color: green;'>Doctor removed successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error removing doctor: " . $delete_stmt->error . "</p>";
        }

        $delete_stmt->close();
    } else {
        echo "<p style='color: red;'>Invalid username or password.</p>";
    }

    // Close statements and connection
    $stmt->close();
    $conn->close();
}
?>
