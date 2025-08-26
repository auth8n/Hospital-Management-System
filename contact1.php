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
            

        <div class="container">
            <!--<span class="big-circle"></span>-->
            <div class="form">
              <div class="contact-info">
                <h3 class="title">Get in touch</h3>
                <p class="text">
                  We'd love to hear from you! For questions, assistance, or feedback, please reach out using the contact form below or give us a call.
                Your satisfaction is our priority!</p>

                <div class="info">
                  <div class="information">
                    <img src="content/img/location.png" class="icon" alt="" />
                    <p>Anywhere Location</p>
                  </div>
                  <div class="information">
                    <a href="mailto:recipient@example.com"><img src="content/img/email.png" class="icon" alt="" /></a>
                    <p>theracare@gmail.com</p>
                  </div>
                  <div class="information">
                    <a href="tel:+254746065075"><img src="content/img/telephone.png" class="icon" alt="" /></a>
                    <p>0721 212 121</p>
                  </div>
                </div>

                <div class="social-media">
                  <p>Connect with us :</p>
                  <div class="social-icons">
                    <a href="#">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                      <i class="fab fa-instagram"></i>
                    </a>
                    <!--<a href="#">
                      <i class="fab fa-linkedin-in"></i>
                    </a>-->
                  </div>
                  <span class="triangle"></span>
                </div>
              </div>

              <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form action="contactphp.php" method="POST" autocomplete="off" name="contact-us" id="contact">
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
          document.getElementById('contact').addEventListener('submit', function (event) {
            const name = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const message = document.getElementById('message').value.trim();

            if (!name || !email || !phone || !message) {
                alert('Please fill in all the fields.');
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Additional validation for email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                event.preventDefault();
            }
          });

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