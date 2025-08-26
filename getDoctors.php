<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctors from the database
$sql = "SELECT doctor_id, username FROM doctors";
$result = $conn->query($sql);

$doctors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

/*$doctors = [];
while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}*/

$conn->close();

header('Content-Type: application/json');
echo json_encode($doctors);
?>
