<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
        echo "<script>
                window.location.href = 'login-register.php';
            </script>";
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
            
            <!--About Us Section--->

            <div class="about-container">
                <div class="about-title">
                    <h1>About Us</h1>
                    <p><a href="index3.php">Home  /</a> <a href="about-us3.php">  About Us</a></p>
                </div>
                <div class="about-more">
                    <div class="about-more-img">
                        <img src="medicine.jpeg" alt="Medicine Photo">
                    </div>
                    <div class="about-more-text">
                        <h4>About Us</h4>
                        <h2>Delivering Excellence in Care</h2>
                        <p>At TheraCare, our mission is to provide compassionate, effective, and personalized care that empowers each individual on their journey to wellness and recovery. With a commitment to excellence, we blend proven therapeutic techniques, advanced technology, and a holistic approach to address both physical and emotional health. Our dedicated team strives to support each patient’s unique needs, ensuring that every step forward is guided by expertise, empathy, and unwavering support.</p>

                        <a href="contact3.php">
                            <div class="contact-btn">
                                Contact Us
                            </div>
                        </a>
                    </div>
                </div>
                <div class="about-services">
                    <div class="about-services-text">
                        <h1>Our Services</h1>
                        <p> With a focus on holistic care, we are dedicated to fostering lasting well-being and empowering you with the tools needed for sustainable recovery.</p>

                        <div class="progress">
                            <div class="progress-details">
                                <p for="drugs">Drugs</p>
                                <p>76%</p>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar p1"></div>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-details">
                                <p for="drugs">Check In</p>
                                <p>80%</p>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar p2"></div>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-details">
                                <p for="drugs">Consultation</p>
                                <p>95%</p>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar p3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="about-services-figures">
                        <div class="first">
                            <div>
                                <h2>20+</h2>
                                <p>Years of Experience</p>
                            </div>
                            <div>
                                <h2>1000+</h2>
                                <p>Projects Done</p>
                            </div>
                        </div>
                        <div class="first">
                            <div>
                                <h2>300+</h2>
                                <p>Satisfied Client</p>
                            </div>
                            <div>
                                <h2>64</h2>
                                <p>Certified Award</p>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="about-work">
                    <h4>About Us</h4>
                    <h2>Committed to Excellence in Care</h2>

                    <a href="contact3.php">
                        <div class="contact-btn1">
                            <p>Contact Us</p>
                        </div>
                    </a>
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