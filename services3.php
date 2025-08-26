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
        <title>Services</title>
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

            <!--Services Page-->
            <div class="sservices">
                <div class="sservices-title">
                    <p><a href="index3.php">Home  /</a> <a href="services3.php">  Our Services</a></p>
                    <h1>Our Services</h1>
                </div>
                <div class="sservices-list">
                    <div class="item-list">
                        <div class="item" onclick="openPopup('popup1')">
                            <div class="sservices-list-item">
                                <img src="personal.jpg" alt="Personalized Recovery">
                                <h1>Personalized Recovery</h1>
                                <p>Individualized recovery plans based on each patient's unique needs</p>
                                <div class="sservices-btn" onclick="openModal('modal1')">
                                    <p>Read More</p>
                                </div>
                            </div>
                        </div>
                        <div class="item" onclick="openPopup('popup2')">
                            <div class="sservices-list-item">
                                <img src="mental.jpg" alt="">
                                <h1>Mental Counselling</h1>
                                <p>One-on-one counselling sessions with licensed therapists for well-being</p>
                                <div class="sservices-btn">
                                    <p>Read More</p>
                                </div>
                            </div>
                        </div>
                        <div class="item" onclick="openPopup('popup3')">
                            <div class="sservices-list-item">
                                <img src="follow.jpg" alt="">
                                <h1>Medical Check-Ups</h1>
                                <p>Regular medical consultations with doctors specializing in post-rehab care</p>
                                <div class="sservices-btn">
                                    <p>Read More</p>
                                </div>
                            </div>
                        </div>
                        <div class="item" onclick="openPopup('popup4')">
                            <div class="sservices-list-item">
                                <img src="support1.jpg" alt="">
                                <h1>Support Groups</h1>
                                <p>Group therapy and support sessions where we share experiences and insight</p>
                                <div class="sservices-btn">
                                    <p>Read More</p>
                                </div>
                            </div>
                        </div>
                        <div class="item" onclick="openPopup('popup5')">
                            <div class="sservices-list-item" >
                                <img src="meditation1.jpg" alt="">
                                <h1>Wellness Programs</h1>
                                <p>Programs like yoga, meditation, and nutrition counselling to promote wellness</p>
                                <div class="sservices-btn">
                                    <p>Read More</p>
                                </div>
                            </div>
                        </div>
                        <div class="item" onclick="openPopup('popup6')">
                            <div class="sservices-list-item">
                                <img src="call.jpg" alt="">
                                <h1>Relapse Prevention</h1>
                                <p>24/7 hotline to reach out in times of crisis or when experiencing relapre triggers</p>
                                <div class="sservices-btn">
                                    <p>Read More</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popup Modal -->
                    <div id="popup1" class="popup">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup('popup1')">&times;</span>
                            <img src="personal.jpg" alt="Personalized Recovery">
                            <h1>Personalized Recovery</h1>
                            <p>Our personalized recovery plans are tailored to each patient's unique needs, providing individualized care that ensures a comprehensive and effective recovery journey.</p>
                            <a href="appointment3.php" class="btn-book">Book Now</a>
                        </div>
                    </div>

                    <div id="popup2" class="popup">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup('popup2')">&times;</span>
                                <img src="mental.jpg" alt="">
                                <h1>Mental Counselling</h1>
                                <p>Participate in one-on-one counselling sessions with licensed therapists who provide personalized support to promote mental health, emotional resilience, and personal growth in a safe and understanding environment.</p>
                                <a href="appointment3.php" class="btn-book">Book Now</a>
                        </div>
                    </div>

                    <div id="popup3" class="popup">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup('popup3')">&times;</span>
                                <img src="follow.jpg" alt="">
                                <h1>Medical Check-Ups</h1>
                                <p>Attend regular medical consultations with doctors who specialize in post-rehabilitation care, focusing on personalized assessments, progress tracking, and tailored treatment plans to support long-term recovery and overall well-being.</p>
                                <a href="appointment3.php" class="btn-book">Book Now</a>
                        </div>
                    </div>
                    <div id="popup4" class="popup">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup('popup4')">&times;</span>
                                <img src="support1.jpg" alt="">
                                <h1>Support Groups</h1>
                                <p>Participate in group therapy and support sessions that foster shared experiences, mutual understanding, and valuable insights, helping individuals navigate their recovery journey together in a supportive community.</p>
                                <a href="appointment3.php" class="btn-book">Book Now</a>
                        </div>
                    </div>
                    <div id="popup5" class="popup">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup('popup5')">&times;</span>
                                <img src="meditation1.jpg" alt="">
                                <h1>Wellness Programs</h1>
                                <p>Engage in wellness programs like yoga, meditation, and nutrition counseling designed to improve physical health, enhance mental clarity, and foster overall well-being through holistic approaches.</p>
                                <a href="appointment3.php" class="btn-book">Book Now</a>
                        </div>
                    </div>
                    <div id="popup6" class="popup">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup('popup6')">&times;</span>
                                <img src="call.jpg" alt="">
                                <h1>Relapse Prevention</h1>
                                <p>Access a 24/7 hotline for immediate support during times of crisis or when facing relapse triggers, ensuring help is always available to guide you through challenging moments.</p>
                                <a href="appointment3.php" class="btn-book">Book Now</a>
                        </div>
                    </div>

                </div>

                <div class="sservices-process">
                    <div class="sservices-process-text">
                        <p>How it works</p>
                        <h1>Our Process Workflow</h1>
                        <div class="sservices-process-list">
                            <div class="number">
                               <p>01</p> 
                            </div>
                            <div class="details">
                                <h3>Initial Consultation</h3>
                                <p>Begin with a one-on-one consultation to discuss your needs, goals, and the services we offer, ensuring that you receive personalized care tailored to your journey.</p>
                            </div>
                        </div>
                        <div class="sservices-process-list">
                            <div class="number">
                               <p>02</p> 
                            </div>
                            <div class="details">
                                <h3>Customized Plan Development</h3>
                                <p>Based on the consultation, our team develops a unique, comprehensive plan, combining therapeutic services, resources, and scheduling to fit your lifestyle and recovery goals.</p>
                            </div>
                        </div>
                        <div class="sservices-process-list">
                            <div class="number">
                               <p>03</p> 
                            </div>
                            <div class="details">
                                <h3>Onboarding and Orientation</h3>
                                <p>We walk you through our system, tools, and support options to ensure you feel comfortable and fully equipped to make the most of our services.</p>
                            </div>
                        </div>
                    </div>
                    <div class="sservices-process-img">
                        <img src="steps.gif" alt="">
                        <div class="sservices-process-list">
                            <div class="number">
                               <p>04</p> 
                            </div>
                            <div class="details">
                                <h3>Ongoing Support</h3>
                                <p>Receive continuous support through regular sessions, resources, and access to our team, ensuring progress and addressing challenges as they arise.</p>
                            </div>
                        </div>
                        <div class="sservices-process-list">
                            <div class="number">
                               <p>05</p> 
                            </div>
                            <div class="details">
                                <h3>Follow-up and Adjustment</h3>
                                <p>Follow-ups to assess your progress, make adjustments, and ensure your path to recovery is as smooth and effective as possible.<</p>
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
        <script>
            function openPopup(popupId) {
                document.getElementById(popupId).style.display = "flex"; // Show the popup
                document.body.style.overflow = "hidden"; // Disable scrolling on background
            }

            function closePopup(popupId) {
                document.getElementById(popupId).style.display = "none"; // Hide the popup
                document.body.style.overflow = "auto"; // Restore scrolling
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