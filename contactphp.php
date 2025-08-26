<?php
// Database configuration
$host = 'localhost';
$dbname = 'theracare_users';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        // Insert data into the contact table
        $sql = "INSERT INTO contact (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            echo "<script>alert('Thank you for contacting us! We will get back to you shortly.');</script>";
            echo "<script>window.location.href = 'contact.php';</script>"; // Redirect using JavaScript
            exit();
        } else {
            echo "<script>alert('Failed to submit your request. Please try again later.');</script>";
        }
        
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>
