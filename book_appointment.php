<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";     // Replace with your MySQL password
$dbname = "theracare_users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>
            alert('You need to register and log in to book an appointment.');
            window.location.href = 'login-register.php';
        </script>";
    exit();
}

$user_id = $_SESSION['id']; // Get the user_id from the session

// Check if form data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $date = $_POST['date'];
    $time = $_POST['time'];
    $email = $_POST['email']; // Patient email
    $doctor_id = $_POST['doctor_id']; // Doctor selected from the dropdown

    // Check if a doctor was selected
    if (empty($doctor_id)) {
        echo "<script>alert('Please select a doctor.'); window.location.href='user-appointment.php';</script>";
        exit;
    }

    // Prepare and bind the query to insert the appointment with the doctor
    $stmt = $conn->prepare("INSERT INTO appointments (appointment_date, appointment_time, patient_email, user_id, doctor_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $date, $time, $email, $user_id, $doctor_id);  // Bind user_id and doctor_id

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully!'); window.location.href='user-appointment.php';</script>";
    } else {
        echo "<script>alert('Error booking appointment. Please try again.'); window.location.href='user-appointment.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
