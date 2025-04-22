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
        <title>About Us</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <header class="header">
            <img src="images/theracare-logo.png" alt="Theracare Logo" class="logo-img">
            
            <i class='bx bx-menu' id="menu-icon"></i>

            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="about-us.php">About Us</a>
                <a href="login-register.php">Sign up/Log in</a>
                <a href="services.php">Services</a>
                <a href="contact.php">Contact Us</a>
                
            </nav>
            
        </header>

        <main>
            <!--About Us Section--->

            <div class="about-container">
                <div class="about-title">
                    <h1>About Us</h1>
                    <p><a href="index.php">Home  /</a> <a href="about-us.php">  About Us</a></p>
                </div>
                <div class="about-more">
                    <div class="about-more-img">
                        <img src="medicine.jpeg" alt="Medicine Photo">
                    </div>
                    <div class="about-more-text">
                        <h4>About Us</h4>
                        <h2>Delivering Excellence in Care</h2>
                        <p>At TheraCare, our mission is to provide compassionate, effective, and personalized care that empowers each individual on their journey to wellness and recovery. With a commitment to excellence, we blend proven therapeutic techniques, advanced technology, and a holistic approach to address both physical and emotional health. Our dedicated team strives to support each patient’s unique needs, ensuring that every step forward is guided by expertise, empathy, and unwavering support.</p>

                        <a href="contact.php">
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

                    <a href="contact.php">
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
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="services.php">Services</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
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