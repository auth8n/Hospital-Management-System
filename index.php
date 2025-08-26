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
                <a href="about-us.php">About Us</a>
                <a href="login-register.php">Sign up/Log in</a>
                <a href="services.php">Services</a>
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
                            <div class="get-appointmentbtn"><a href="appointment.php">Get Appointment</a></div>
                            <div class="contact-usbtn"><a href="contact.php">Contact Us</a></div>
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
                            <div class="get-appointmentbtn"><a href="appointment.php">Get Appointment</a></div>
                            <div class="contact-usbtn"><a href="contact.php">Contact Us</a></div>
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
                            <div class="get-appointmentbtn"><a href="appointment.php">Get Appointment</a></div>
                            <div class="contact-usbtn"><a href="contact.php">Contact Us</a></div>
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
    
    
            <!--Who we are section-->
            <div class="who-we-are">
                <div class="w-container-row">
                    <div class="shape2">
                        <img src="images/five.jpg" alt="Curve Shape" class="shape2-img">             
                    </div>
                    <div class="who-text">
                        <h1 class="title">Who we are:</h1>
                        <p class="paragraph">We are a dedicated team committed to providing exceptional care and support to individuals on their path 
                            to recovery. With a focus on personalized treatment plans and compassionate service, we strive to empower our patients with
                             the tools and guidance they need to achieve their health goals.
                        </p>
                        <p class="paragraph">With us, you are able to benefit from:</p>
                        <div class="list-benefit">
                            <ul class="list-benefit1">
                                <li class="benefit-item">Physical Therapy and Rehab</li>
                                <li class="benefit-item">Mental health counseling</li>
                                <li class="benefit-item">Substance abuse recovery</li>
                            </ul>
                            <ul class="list-benefit2">
                                <li class="benefit-item">Holistic wellness and therapies</li>
                                <li class="benefit-item">Nutritional counseling</li>
                                <li class="benefit-item">Educational life skills training</li>
                            </ul>
                        </div>
                        
                        <a class="who_button1" href="about-us.php"><div class="who-button">Read More</div></a>
                    </div>
                </div>
            </div>
    
            <!--Do section-->
            <div class="do">
                <div class="do-row">
                    <div class="do-item">
                        <i class='bx bxs-ambulance' style='color:#ffffff'></i>
                        <h2 class="do-text">Utmost Care</h2>
                        <p class="do-paragraph"></p>
                    </div>
                    <div class="do-item">
                        <i class='bx bxs-shield-plus' style='color:#ffffff'></i>
                        <h2 class="do-text">Mental Growth</h2>
                        <p class="do-paragraph"></p>
                    </div>
                    <div class="do-item">
                        <i class='bx bx-cart-add' style='color:#ffffff'></i>
                        <h2 class="do-text">Medical Prescriptions</h2>
                        <p class="do-paragraph"></p>
                    </div>
                </div>
            </div>
    
            <!--Our Services-->
            <div class="services">
                <div class="services-title"><h1>Our Services...</h1></div>
                <div class="services-content">
                    <div class="services-item">
                        <div class="service-photo">
                            <img src="images/mental.png" alt="Mental Photo" class="brain">
                        </div>
                        <div class="services-text">
                            <h2>Mental Health Counseling</h2>
                            <p>Our mental health counseling services provide a safe and supportive space where individuals can 
                                explore their thoughts and emotions. We focus on empowering you with the tools needed to manage 
                                stress, anxiety, and emotional challenges, helping you achieve mental wellness and balance in your life.h</p>
                            <a href="services.php"><div class="services-btn">Read More</div></a>
                        </div>
                    </div>
                    <div class="services-item">
                        <div class="services-text">
                            <h2>Drugs and Prescriptions</h2>
                            <p>We offer expert guidance on medications and prescriptions, ensuring that you receive the right treatment 
                                tailored to your needs. Our team works closely with you to manage your prescriptions safely, providing 
                                support throughout your recovery journey and promoting your overall health and well-being.</p>
                            <a href="services.php"><div class="services-btn">Read More</div></a>
                        </div>
                        <div class="service-photo">
                            <img src="images/pills.png" alt="Pills" class="pills">
                        </div>
                    </div>
                    <div class="services-item">
                        <div class="service-photo">
                            <img src="images/hands.png" alt="Hands" class="hands">
                        </div>
                        <div class="services-text">
                            <h2>Post Rehab Guidance</h2>
                            <p>Our post-rehab guidance is designed to help you transition smoothly from rehabilitation to everyday life. 
                                We provide continuous support, personalized strategies, and resources that empower you to maintain your progress, 
                                build resilience, and thrive independently beyond rehab.</p>
                            <a href="services.php"><div class="services-btn">Read More</div></a>
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


