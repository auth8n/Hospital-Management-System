
<?php

    $initials = isset($_GET['initials']) ? htmlspecialchars($_GET['initials']) : '';
?>



<!-- Continue with the rest of your page content -->

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
                    <a href="index1.php">Home</a>
                    <a href="about-us1.php">About Us</a>
                    <a href="appointment1.php">Book</a>
                    <a href="services1.php">Services</a>
                    <a href="contact1.php">Contact Us</a>
                    
                </nav>

                <span class="user-initials">
                    <a href="profile.php"><?php echo $_SESSION['initials']; ?> <!-- Display initials here --></a>
                </span>
            </div>

            
            
        </header>

        <main>
            <div class="profile-container">
                <div class="profile-nav">
                    <a href="profile.php">
                        <div class="profile-item" >
                            Dashboard
                        </div>    
                    </a>

                    <a href="user-profile.php">
                        <div class="profile-item" >
                            Profile
                        </div>    
                    </a>

                    <a href="user-appointment.php">
                        <div class="profile-item">
                            Book Appointments
                        </div>
                    </a>

                    <a href="view-appointment.php">
                        <div class="profile-item" >
                            View Appointments
                        </div>
                    </a>

                    <a href="user-messages.php">
                        <div class="profile-item">
                            Messages
                        </div>
                    </a>

                    <a href="help.php">
                        <div class="profile-item" id="active">
                        Help & Support
                        </div>
                    </a>
                    
                    <a href="logout.php" onclick="return confirmLogout();">
                        <div class="profile-item">
                            Log Out
                        </div>
                    </a>

                    
                </div>

                <div class="profile-details">

                    <div class="help">

                        <!--<h1>Help and Support</h1>-->

                        <!-- FAQ Section -->
                        <section class="faq">
                            <h2>Frequently Asked Questions</h2>
                            <ul>
                                <li><strong>How can I book an appointment?</strong>
                                    <p>Simply visit the booking page and select a doctor, date, and time to schedule your appointment.</p>
                                </li>
                                <li><strong>What should I do if I need to reschedule?</strong>
                                    <p>You can reschedule your appointment directly from your profile page under 'My Appointments'.</p>
                                </li>
                                <li><strong>How do I contact my therapist or doctor?</strong>
                                    <p>You can send a message through the platform’s messaging system or book an additional consultation.</p>
                                </li>
                            </ul>
                        </section>

                        


                        <!-- Support Resources Section -->
                        <section class="support-resources">
                            <h2>Support Resources</h2>
                            <ul>
                                <li><a href="#">How to book an appointment</a></li>
                                <li><a href="#">Step-by-step guides</a></li>
                                <li><a href="#">Troubleshooting tips</a></li>
                            </ul>
                        </section>

                        <!-- Emergency Contact Section -->
                        <section class="emergency-contact">
                            <h2>Emergency Contact</h2>
                            <p>If you need immediate assistance, please call our helpline at <strong>(555) 123-4567</strong>.</p>
                        </section>

                        <!-- Feedback Section -->
                        <section class="feedback">
                            <h2>Give Us Your Feedback</h2>
                            <p>Your feedback is valuable to us! <br><a href="services1.php#process">Submit Feedback</a></p>
                        </section>
                    </div>

                    <!-- Contact Form Section -->
                    <div class="contact-form">
                        <span class="circle one"></span>
                        <span class="circle two"></span>

                        <form action="" method="POST" autocomplete="off" name="contact-us" id="contact">
                            <h3 class="title">Contact us</h3>
                            <div class="input-container">
                                <input type="text" name="name" class="input" id="username" placeholder="Username"/>
                            </div>
                            <div class="input-container">
                                <input type="email" name="email" class="input" id="email" placeholder="Email"/>
                            </div>
                            <div class="input-container">
                                <input type="tel" name="phone" class="input" id="phone" required placeholder="Phone"/>
                            </div>
                            <div class="input-container textarea">
                                <textarea name="message" class="input" id="message" placeholder="Message"></textarea>
                            </div>
                            <input type="submit" value="Send" class="btn" />
                        </form>
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
                                        echo "<script>window.location.href = 'help.php';</script>"; // Redirect using JavaScript
                                        exit();
                                    } else {
                                        echo "<script>alert('Failed to submit your request. Please try again later.');</script>";
                                    }
                                    
                                }
                            } catch (PDOException $e) {
                                die("Database connection failed: " . $e->getMessage());
                            }

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
                            <li><a href="index1.php">Home</a></li>
                            <li><a href="about-us1.php">About Us</a></li>
                            <li><a href="services1.php">Services</a></li>
                            <li><a href="contact1.php">Contact Us</a></li>
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

