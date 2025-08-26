<?php
session_start();
if (isset($_SESSION['id'])) {
    //echo "Session ID: " . $_SESSION['id']; Debugging session ID
} else {
    echo "No session found. Please log in.";
}
?>


<?php

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
                        <div class="profile-item" id="active">
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
                    <!-- Appointment Table -->
                    <div class="view-table">
                        <h2>Appointments List</h2>
                        <?php
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        session_regenerate_id(true);

                        if (!isset($_SESSION['id'])) {
                            header("Location: login-register.php");
                            exit();
                        }

                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "theracare_users";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $user_id = $_SESSION['id'];

                        $stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $user = $result->fetch_assoc();
                        } else {
                            echo "No user found with this ID.";
                            exit();
                        }

                        // Fetch appointments, including the patient's email
                        $stmt = $conn->prepare("
                        SELECT a.id, a.appointment_date, a.appointment_time, d.username AS doctor_name, u.username AS patient_name, u.email AS patient_email 
                        FROM appointments a 
                        JOIN doctors d ON a.doctor_id = d.doctor_id 
                        JOIN users u ON a.user_id = u.id
                        ");

                        $stmt->execute();
                        $appointments_result = $stmt->get_result();

                        // Check if any appointments are found
                        if ($appointments_result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Doctor's Name</th><th>Patient's Name</th><th>Patient's Email</th><th>Appointment Date</th><th>Appointment Time</th></tr>";

                        while ($row = $appointments_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['doctor_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['patient_email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['appointment_time']) . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                        } else {
                        echo "No appointments found.";
                        }


                        $stmt->close();
                        $conn->close();
                        ?>
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
                            <li><a href="about-us.php">About Us</a></li>
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

