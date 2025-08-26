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
                        <div class="profile-item" id="active">
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

                    <a href="admin-remove-doctor.php">
                        <div class="profile-item" >
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
                        <h1>Welcome <?php echo htmlspecialchars($user['username']); ?></h1>
                        <h2>Happy to see you!</h2>
                        <!--<p><strong>Name:</strong> </p>-->
                        

                        <div class="profile-dash">
                            <div class="book-appointments">
                                <img src="doctors.jpeg" alt="Book Image">
                                <p>Doctors' List</p>
                                <a href="admin-doctors.php">Doctors' List</a>
                            </div>
                            <div class="view-appointments">
                                <img src="users.jpeg" alt="View Image">
                                <p>Patients' List</p>
                                <a href="admin-users.php">Patients' List</a>
                            </div>
                            <div class="book-appointments">
                                <img src="book.jpg" alt="Book Image">
                                <p>Appointments</p>
                                <a href="admin-appointments.php">Appointments</a>
                            </div>
                            <div class="view-appointments">
                                <img src="view.jpg" alt="View Image">
                                <p>Manage Doctors</p>
                                <a href="admin-add-doctor.php">Manage Doctors</a>
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

        <!--For the profile img-->
        <script>
        $(document).ready(function() {
            $('#imageForm').on('submit', function(e) {
                e.preventDefault();  // Prevent default form submission

                var formData = new FormData(this);  // Create FormData object with the form data

                $.ajax({
                    url: 'upload_profile_image.php',  // The PHP script to handle the image upload
                    type: 'POST',
                    data: formData,  // Sending the form data
                    processData: false,  // Don't process the data
                    contentType: false,  // Don't set content type
                    success: function(response) {
                        // Parse the JSON response from PHP
                        var data = JSON.parse(response);
                        
                        if (data.status === 'success') {
                            // Update the image source to show the uploaded image
                            $('#profile-image').attr('src', data.imagePath);
                            alert('Image uploaded successfully!');
                        } else {
                            // Handle errors (e.g., invalid file type)
                            alert('Error: ' + data.message);
                        }
                    },
                    error: function() {
                        // Handle any AJAX errors
                        alert('An error occurred while uploading the image.');
                    }
                });
            });
        });



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

