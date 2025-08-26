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
        <title>Contact</title>
        <link rel="stylesheet" href="style.css">
        <!--<link rel="stylesheet" href="contact.css">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
                <a href="contact.php" class="active1">Contact Us</a>
                
            </nav>
            
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
                        <input type="text" name="name" class="input" id="username" required placeholder="Username"/>
                      </div>
                      <div class="input-container">
                        <input type="email" name="email" class="input" id="email" required placeholder="Email"/>
                      </div>
                      <div class="input-container">
                        <input type="tel" name="phone" class="input" id="phone" required placeholder="Phone"/>
                      </div>                      
                      <div class="input-container textarea">
                        <textarea name="message" class="input" id="message" required placeholder="Message"></textarea>
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
    </body>
</html>