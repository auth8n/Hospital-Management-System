<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
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
        <title>About Us</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <header class="header">
            <img src="images/theracare-logo.png" alt="Theracare Logo" class="logo-img">
            
            <i class='bx bx-menu' id="menu-icon"></i>

            <div class="navbar-a">
                <nav class="navbar">
                    <a href="index3.php">Home</a>
                    <a href="about-us3.php">About Us</a>
                    <a href="appointment3.php">Book</a>
                    <a href="services3.php">Services</a>
                    <a href="contact3.php">Contact Us</a>
                </nav>

                <span class="user-initials">
                

                    <a href="admin-dashboard.php"><?php echo $_SESSION['initials']; ?> <!-- Display initials here --></a>
                </span>
            </div>
            
        </header>

        <main>
            

            <!-- Appointment Page --->
            <div class="appointment-container">
                    <div class="appointment-title">
                        <h1>Make an Appointment</h1>
                    </div>
                    <form action="book_appointment.php" method="POST" class="appointment-schedule">
                        <div class="appointment-book">
                            <div class="doctor">
                                <p>Select Doctor</p>
                                <select name="doctor_id" class="doctor-select" required>
                                    <option value="">Choose a Doctor</option>
                                    <?php
                                    // Database connection
                                    $conn = new mysqli("localhost", "root", "", "theracare_users");

                                    // Check for connection errors
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // SQL query to fetch doctors
                                    $sql = "SELECT doctor_id, username FROM doctors";
                                    $result = $conn->query($sql);

                                    // Check if any doctors are found
                                    if ($result->num_rows > 0) {
                                        // Loop through the results and display each doctor as an option
                                        while ($row = $result->fetch_assoc()) {
                                            // Output each doctor as a select option
                                            echo "<option value='" . htmlspecialchars($row['doctor_id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</option>";
                                        }
                                    } else {
                                        // Display a message if no doctors are found
                                        echo "<option value=''>No doctors available</option>";
                                    }

                                    // Close the database connection
                                    $conn->close();
                                    ?>
                                </select>

                            </div>
                            <div class="date">
                                <p>Select Date</p>
                                <input type="date" name="date" class="date-picker" required>
                            </div>
                            <div class="time">
                                <p>Enter Email</p>
                                <input type="email" name="email" placeholder="Enter your email" required>
                                <p>Select Time</p>
                                <input type="time" name="time" class="time-picker" required>
                            </div>
                        </div>
                        <div class="appointment-book-btn">
                            <button type="submit" class="book-appointment-btn">Get Appointment</button>
                        </div>
                    </form>
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
                            <li><a href="index3.php">Home</a></li>
                            <li><a href="about-us3.php">About Us</a></li>
                            <li><a href="services3.php">Services</a></li>
                            <li><a href="contact3.php">Contact Us</a></li>
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