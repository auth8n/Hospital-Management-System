<?php
    session_start();
    $initials = isset($_GET['initials']) ? htmlspecialchars($_GET['initials']) : '';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <header class="header">
            <img src="images/theracare-logo.png" alt="Theracare Logo" class="logo-img">
            
            <i class='bx bx-menu' id="menu-icon"></i>

            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="about-us.html">About Us</a>
                <a href="login-register.php">Sign up/Log in</a>
                <a href="services.html">Services</a>
                <a href="contact.php">Contact Us</a>
                
            </nav>
            
        </header>

        <main>
            <!--Slider Container-->
            <div class="slider-container">
                <div class="slider-container-row fade">
                    <div class="container-text">
                        <h1 class="title">Empowering Recovery: Your Partner in Post-Rehab Care!</h1>
                        <p class="paragraph">Transforming rehabilitation with personalized care and support, 
                            ensuring every step of your journey is met with compassion and expertise
                        </p>
                        <div class="button-area">
                            <div class="get-appointmentbtn"><a href="#">Get Appointment</a></div>
                            <div class="contact-usbtn"><a href="#">Contact Us</a></div>
                        </div>
                    </div>
                    <div class="container-gif">
                        <img src="images/Just talking.gif" alt="Just talking" class="talking-gif">
                    </div>
                </div>
    
                <div class="slider-container-row fade">
                    <div class="container-text">
                        <h1 class="title">Holistic Healing: Comprehensive Support for Mental Wellness</h1>
                        <p class="paragraph">Combining innovative treatments with empathetic care, our goal is to foster a 
                            supportive environment where mental wellness is nurtured and recovery is achievable for everyone.
                        </p>
                        <div class="button-area">
                            <div class="get-appointmentbtn">Get Appointment</div>
                            <div class="contact-usbtn">Contact Us</div>
                        </div>
                    </div>
                    <div class="container-gif">
                        <img src="images/Talk Over Tea.gif" alt="Talking Over Tea" class="talking-gif">
                    </div>
                </div>
    
                <div class="slider-container-row fade">
                    <div class="container-text">
                        <h1 class="title">Seemless Transition: Life Bridging the Gap From Rehab to Daily Life!</h1>
                        <p class="paragraph">Offering continous care and resources, we make your transition and rehabilitation
                            to everyday life smooth and stress-free, empowering you to thrive with confidence and independence.
                        </p>
                        <div class="button-area">
                            <div class="get-appointmentbtn">Get Appointment</div>
                            <div class="contact-usbtn">Contact Us</div>
                        </div>
                    </div>
                    <div class="container-gif">
                        <img src="images/From the First Flash to the Last Word – Dow Jones.gif" alt="Just talking" class="talking-gif">
                    </div>
                </div>
    
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
    
                <!-- The dots/circles -->
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
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
                <li><a href="index.html">Home</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact Us</a></li>
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
    </body>
</html>