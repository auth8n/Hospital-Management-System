<?php
// Enable error reporting for troubleshooting (consider disabling in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);

// Ensure the user is logged in by checking for the 'id' session variable
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login-register.php");
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "theracare_users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID and username from session
$id = $_SESSION['doctor_id'];
$session_username = $_SESSION['username'];

// First, check if the user is a doctor by querying the doctors table
$stmt = $conn->prepare("SELECT doctor_id, username FROM doctors WHERE username = ?");
$stmt->bind_param("s", $session_username);
$stmt->execute();
$stmt->bind_result($doctor_id, $doctor_username);
$stmt->fetch();

// If the username exists in the doctors table, treat the session as a doctor
if ($doctor_id && $doctor_username === $session_username) {
    // If the user is a doctor, fetch their profile information
    $stmt->close();
    $stmt = $conn->prepare("SELECT username, email FROM doctors WHERE doctor_id = ?");
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        $username = $doctor['username'];
        $email = $doctor['email'];
    } else {
        echo "No doctor found with this ID.";
        exit();
    }
} else {
    // If the username is not found in doctors table, check in users table
    $stmt->close();
    $stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['username'];
        $email = $user['email'];
    } else {
        echo "No user found with this ID.";
        exit();
    }
}

$stmt->close();
$conn->close();
?>


<?php

    // Check if the user is logged in
    if (!isset($_SESSION['doctor_id'])) {
        header("Location: login-register.php");
        exit();
    }

    // Get the user's initials from the session
    $initials = isset($_SESSION['initials']) ? htmlspecialchars($_SESSION['initials']) : '';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <header class="header">
            <img src="images/theracare-logo.png" alt="Theracare Logo" class="logo-img">
            
            <i class='bx bx-menu' id="menu-icon"></i>

            <div class="navbar-a">
                <nav class="navbar">
                    <a href="index2.php">Home</a>
                    <a href="about-us2.php">About Us</a>
                    <a href="appointment2.php">Book</a>
                    <a href="services2.php">Services</a>
                    <a href="contact2.html">Contact Us</a>
                    
                </nav>

                <span class="user-initials">
                    <a href="doctor-dashboard.php"><?php echo $_SESSION['initials']; ?> <!-- Display initials here --></a>
                </span>
            </div>

            
            
        </header>

        <main>
            <div class="profile-container">
                <div class="profile-nav">
                    <a href="doctor-dashboard.php">
                        <div class="profile-item" id="active">
                            Dashboard
                        </div>    
                    </a>

                    <a href="doctor-profile.php">
                        <div class="profile-item">
                            Profile
                        </div>
                    </a>
                    

                    <a href="doctor-appointments.php">
                        <div class="profile-item">
                            View Appointments
                        </div>
                    </a>

                    <a href="doctor-messages.php">
                        <div class="profile-item">
                            Messages
                        </div>
                    </a>

                    
                    <a href="logout.php" onclick="return confirmLogout();">
                        <div class="profile-item">
                            Log Out
                        </div>
                    </a>
                    
                </div>
                <div class="profile-details">
                    
                    <div class="profile-section">
                        <h1>Welcome <?php echo htmlspecialchars($doctor['username']); ?></h1>
                        <h2>Happy to see you!</h2>
                        <!--<p><strong>Name:</strong> </p>-->
                        
                        <div class="profile-d1">
                            <div class="profile-dash">
                                <div class="view-appointments">
                                    <img src="view.jpg" alt="View Image">
                                    <p>My Appointments</p>
                                    <a href="doctor-appointments.php">View My Appointments</a>
                                </div>
                            </div>

                            <div class="profile-dash">
                                <div class="view-appointments">
                                    <img src="view.jpg" alt="View Image">
                                    <p>My Messages</p>
                                    <a href="doctor-messages.php">View My Messages</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>



                
            </div>

            

            <!-- Footer Section -->
            <footer class="footer">
                <div class="footer-container">
                    <!-- About Us Section -->
                    <div class="footer-about">
                        <h2>About Us</h2>
                        <p>TheraCare is dedicated to supporting mental health and well-being. We provide tailored guidance and resources for post-rehab and therapeutic needs to help you thrive.</p>
                    </div>

                    <!-- Quick Links Section -->
                    <div class="footer-links">
                        <h2>Quick Links</h2>
                        <ul>
                            <li><a href="index2.php">Home</a></li>
                            <li><a href="about-us2.php">About Us</a></li>
                            <li><a href="services2.php">Services</a></li>
                            <li><a href="contact2.php">Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Open Hours Section -->
                    <div class="footer-hours">
                        <h2>Open Hours</h2>
                        <p>We are open at the following times:</p>
                        <ul>
                            <li>Monday - Friday: 8am - 8pm</li>
                            <li>Saturday: 9am - 6pm</li>
                            <li>Sunday: Closed</li>
                        </ul>
                    </div>

                    <!-- Contact Information -->
                    <div class="footer-contact">
                        <h2>Contact Us</h2>
                        <ul>
                            <li>+123 456 7890</li>
                            <li>contact@theracare.com</li>
                            <li>123 Wellness Way, Cityville</li>
                        </ul>
                    </div>
                </div>

                <div class="footer-bottom">
                    <p>&copy; 2024 TheraCare | All Rights Reserved</p>
                </div>
            </footer>         

        </main>

        
        
        <div class="nav-bg"></div>
        <script src="navbar.js"></script>
        <script src="slider.js"></script>

        <script>
            function showSessionTimeoutWarning() {
                const warningTimeout = setTimeout(() => {
                    const userResponse = confirm("Your session is about to expire. Would you like to extend it for another 40 minutes?");
        
                    if (userResponse) {
                        extendSession();
                    } else {
                        window.location.href = "login-register.php"; // Change to your logout URL
                    }
                }, 1000); // Change timeout as needed
            }

            function extendSession() {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "extend_session.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
                xhr.onload = function () {
                    if (xhr.status === 200) {
                    alert("Your session has been extended for another 40 minutes.");
                    }
                };
    
                xhr.send();
            }
        </script>

        <script>
            let timeoutDuration = 2400 * 1000; // 40 minutes in milliseconds
            let inactivityTime;

            function resetTimer() {
                clearTimeout(inactivityTime);
                inactivityTime = setTimeout(redirectToIndex, timeoutDuration);
            }

            function redirectToIndex() {
                window.location.href = "index.php"; // Redirect to index.php
            }

            // Event listeners to reset timer on user activity
            window.onload = resetTimer;
            window.onmousemove = resetTimer;
            window.onkeypress = resetTimer;
        </script>

        <!--For the profile img-->
        

        
        <!-- for the logout-->
        <script>
            function confirmLogout() {
                // Display a confirmation dialog
                return confirm("Are you sure you want to log out?");
            }
        </script>



    </body>
</html>

<!--For the popup to extend session -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$timeout_duration = 2400; // 40 minutes in seconds

if (isset($_SESSION['last_activity'])) {
    $duration = time() - $_SESSION['last_activity'];
    
    // If the duration exceeds the timeout, log out
    if ($duration > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: login-register.php"); // Redirect to login page
        exit();
    } else if ($duration > 2100) { // Show warning after 35 minutes
        echo '<script type="text/javascript">showSessionTimeoutWarning();</script>';
    }
}

// Update the last activity time
$_SESSION['last_activity'] = time();
?>

