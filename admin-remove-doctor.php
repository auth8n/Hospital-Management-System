<?php
// Enable error reporting for troubleshooting (consider disabling in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);

// Ensure the user is logged in by checking for the 'id' session variable
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
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

// Get user ID from session
$id = $_SESSION['id'];

// Fetch user profile information using the correct 'id' field
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if any result is returned
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found with this ID.";
    exit();
}

$stmt->close();
$conn->close();
?>

<?php

    $initials = isset($_GET['initials']) ? htmlspecialchars($_GET['initials']) : '';
?>


<?php

    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
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
            <div class="profile-container">
                <div class="profile-nav">
                    <a href="admin-dashboard.php">
                        <div class="profile-item" >
                            Dashboard
                        </div>    
                    </a>

                    <a href="admin-profile.php">
                        <div class="profile-item" >
                            Profile
                        </div>    
                    </a>

                    <a href="admin-doctors.php">
                        <div class="profile-item">
                            Doctors
                        </div>
                    </a>

                    <a href="admin-users.php">
                        <div class="profile-item">
                            Patients
                        </div>
                    </a>

                    <a href="admin-appointments.php">
                        <div class="profile-item" >
                            Appointment Details
                        </div>
                    </a>

                    <a href="admin-add-doctor.php">
                        <div class="profile-item" >
                            Add Doctors
                        </div>
                    </a>

                    <a href="admin-remove-doctor.php" >
                        <div class="profile-item" id="active">
                            Remove Doctor
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
                        <h2>Remove Doctor</h2>
                        <form class="remove-doctor" action="" method="POST">
                            <div class="input-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" required>
                            </div>
                            <div class="input-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <button type="submit" name="remove_doctor">Remove Doctor</button>
                        </form>

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


                        <script>
                            // Optionally add confirmation before deletion
                            document.querySelector('.remove-doctor').addEventListener('submit', function (event) {
                                if (!confirm("Are you sure you want to remove this doctor?")) {
                                    event.preventDefault(); // Prevent form submission
                                }
                            });
                        </script>

                        <script>
                            document.getElementById('showPassword').addEventListener('change', function() {
                                const registerPassword = document.getElementById('password');
                                const confirmPassword = document.getElementById('confirm_password');
                                const type = this.checked ? 'text' : 'password';
                                registerPassword.type = type;
                                confirmPassword.type = type;
                            });
                        </script>

                        
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
                            <li><a href="index3.html">Home</a></li>
                            <li><a href="about-us3.html">About Us</a></li>
                            <li><a href="services3.html">Services</a></li>
                            <li><a href="contact3.html">Contact Us</a></li>
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
            function validatePasswords() {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirm_password').value;

                if (password !== confirmPassword) {
                    alert("Passwords do not match. Please try again.");
                    return false; // Prevent form submission
                }

                return true; // Allow form submission
            }
        </script>

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



        <script>
        $(document).ready(function() {
        $('form').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        
        $.ajax({
            url: 'upload_profile_image.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                try {
                    let data = JSON.parse(response);
                    
                    if (data.status == 'success') {
                        // Update the profile image src to the new image path
                        $('#profileImage').attr('src', data.imagePath);
                        alert("Image updated successfully!");
                    } else {
                        alert(data.message || "An error occurred.");
                    }
                } catch (error) {
                    alert("An unexpected error occurred.");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});

        </script>




        </script>

        <!--For the logout part-->
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

