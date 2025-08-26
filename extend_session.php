<?php
session_start();

// Update the last activity time to the current time
$_SESSION['last_activity'] = time();

// Return a success message
echo json_encode(["status" => "success"]);
?>
