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

//$stmt->close();
//$conn->close();
?>

<?php
   

    // Check if user is logged in
    if (!isset($_SESSION['id'])) {
        // If not logged in, redirect to the login page 
        header("Location: login-register.php");
        exit();
    }
    ?>

    <?php

    include 'db_connect.php';  // Include your database connection

    // Query doctors from the database
    $stmt = $conn->prepare("SELECT doctor_id, username FROM doctors");
    $stmt->execute();
    $result = $stmt->get_result();

    // Store the results in the $doctors array
    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    $stmt->close();
?>

<?php

    $initials = isset($_GET['initials']) ? htmlspecialchars($_GET['initials']) : '';
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
        <style>
            /*body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9; margin: 0; }*/
            .chat-container { width: 400px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); background-color: #fff; }
             .header1 { padding: 10px; background-color: #17232A; color: #fff; text-align: center; }
            .message-box { height: 300px; padding: 10px; overflow-y: auto; border-bottom: 1px solid #ddd; }
            .message { padding: 8px; margin: 5px 0; border-radius: 5px; }
            .message.sent { background-color: lightblue; text-align: right; }
            .message.received { background-color: #f0f0f0; }
            .input-container { display: flex; padding: 10px; }
            select, input[type="text"] { width: 100%; padding: 8px; margin-right: 5px; border: 1px solid #ddd; border-radius: 4px; }
            button { padding: 8px; background-color: #4CAF50; color: #fff; border: none; cursor: pointer; border-radius: 4px; }
        </style>
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
                        <div class="profile-item">
                            Profile
                        </div>
                    </a>
                    
                    <a href="user-appointment.php">
                        <div class="profile-item">
                            Book Appointments
                        </div>
                    </a>

                    <a href="view-appointment.php">
                        <div class="profile-item">
                            View Appointments
                        </div>
                    </a>
                    
                    <a href="user-messages.php">
                        <div class="profile-item" id="active">
                            Messages
                        </div>
                    </a>

                    <a href="help.php">
                        <div class="profile-item">
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

                    <div class="chat-container">
                        <div class="header1">Chat With Doctor</div>
                        <div class="message-box" id="messageBox">
                            <!-- Messages will be displayed here -->
                        </div>
                        <div class="input-container">
                            <select id="doctorSelect" onchange="updateDoctorId()">
                                <option value="">Select a doctor</option>
                                <?php
                                // Load doctors from the database
                                include 'db_connect.php';
                                $stmt = $conn->prepare("SELECT doctor_id, username FROM doctors");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($doctor = $result->fetch_assoc()) {
                                    echo "<option value='" . $doctor['doctor_id'] . "'>" . $doctor['username'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        
                        <div class="input-container">
                            <input type="text" id="messageInput" placeholder="Type your message...">
                            <button onclick="sendMessage()">Send</button>
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

        </script>

        <!-- for the logout-->
        <script>
            function confirmLogout() {
                // Display a confirmation dialog
                return confirm("Are you sure you want to log out?");
            }
        </script>

        <script>
            function updateDoctorID() {
                const doctorID = document.getElementById('doctor').value;
                
                // Display the selected doctor ID (for debugging or to use it in other processes)
                console.log("Selected Doctor ID: " + doctorID);

                // Optionally, you can send this doctor ID to the server using AJAX
                const formData = new FormData();
                formData.append('doctor_id', doctorID);

                // Use AJAX to send the doctorID to the server (example)
                fetch('update_doctor.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log('Doctor ID updated successfully');
                    } else {
                        console.log('Error:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        </script>

                    <script>
                        function updateDoctorID() {
                            const doctorID = document.getElementById('doctor').value;
                            
                            // Display the selected doctor ID (for debugging or to use it in other processes)
                            console.log("Selected Doctor ID: " + doctorID);

                            // Optionally, you can send this doctor ID to the server using AJAX
                            const formData = new FormData();
                            formData.append('doctor_id', doctorID);

                            // Use AJAX to send the doctorID to the server (example)
                            fetch('update_doctor.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    console.log('Doctor ID updated successfully');
                                } else {
                                    console.log('Error:', data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                        }
                    </script>
                    
                    <!--For the sending and receiving of messages-->
            
                    

                    

<script>
        
        // Set senderId from PHP session
        let senderId = <?php echo json_encode($_SESSION['id']); ?>;
        let receiverId = null; // Will be set based on selected doctor

        // Function to update receiverId when a doctor is selected
        function updateDoctorId() {
            var doctorSelect = document.getElementById('doctorSelect');
            receiverId = doctorSelect.value;
            if (receiverId) {
                fetchMessages(); // Fetch messages for the selected doctor
            }
        }

        // Function to fetch messages between the user and the selected doctor
        /*function fetchMessages() {
            if (!receiverId) return; // Ensure a doctor is selected

                fetch('getMessages.php?sender_id=' + senderId + '&receiver_id=' + receiverId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                        // Process and display the messages
                        console.log(data.messages);
                        } else {
                        console.error('Error fetching messages:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching messages:', error);
                    });

        }*/

        let receiver_type = 'doctor';
        function fetchMessages() {
            if (!receiverId) return;  // Ensure a user is selected

            fetch(`getMessages.php?sender_id=${senderId}&receiver_id=${receiverId}`)
                .then(response => response.json())
                .then(data => {
                    let messages = data.messages;
                    let messageBox = document.getElementById('messageBox');
                    messageBox.innerHTML = '';  // Clear existing messages
                    messages.forEach(msg => {
                        let message = document.createElement('div');
                        message.classList.add('message', (msg.sender_id == senderId && msg.receiver_type === 'doctor') ? 'sent' : 'received');
                        message.innerText = `${msg.timestamp} - ${msg.message}`;
                        messageBox.appendChild(message);
                    });
                    messageBox.scrollTop = messageBox.scrollHeight;  // Scroll to bottom
                })
                .catch(error => console.error('Error fetching messages:', error));
        }   

        //Modified function
        /*function fetchMessages() {
            if (!receiverId) return;  // Ensure a receiver is selected

            fetch(`getMessages.php?sender_id=${senderId}&receiver_id=${receiverId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); //log the data
                    let messages = data.messages;
                    let messageBox = document.getElementById('messageBox');
                    messageBox.innerHTML = '';  // Clear existing messages

                    messages.forEach(msg => {
                        let message = document.createElement('div');
                        
                        // Add both sender ID and type to ensure correct alignment
                        if (msg.sender_id == senderId && msg.receiver_type == receiverType) {
                            message.classList.add('message', 'sent');  // Align sent messages to the right
                        } else {
                            message.classList.add('message', 'received');  // Align received messages to the left
                        }
                        
                        message.innerText = `${msg.timestamp} - ${msg.message}`;
                        messageBox.appendChild(message);
                    });

                    messageBox.scrollTop = messageBox.scrollHeight;  // Scroll to bottom
                })
                .catch(error => console.error('Error fetching messages:', error));
        }*/



        // Function to send a new message
        function sendMessage() {
            var message = document.getElementById('messageInput').value;
            
            if (!receiverId) {
                alert("Please select a doctor first.");
                return;
            }
            if (message.trim() === "") {
                alert("Message cannot be empty.");
                return;
            }

            // Send message to the server
            fetch('sendMessage.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `sender_id=${senderId}&receiver_id=${receiverId}&message=${encodeURIComponent(message)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('messageInput').value = '';  // Clear input field
                    fetchMessages(); // Refresh messages
                } else {
                    alert("Failed to send message.");
                }
            })
            .catch(error => {
                console.error('Error sending message:' + data.error);
                alert("Error sending message." + data.error);
            });
        }

        // Initial load of doctors into dropdown (if needed)
        document.addEventListener('DOMContentLoaded', function() {
            // Optionally, load doctors dynamically if required
            updateDoctorId(); // Update doctor and fetch messages for the default selection
        });

        // Refresh messages every 3 seconds
        setInterval(fetchMessages, 3000);

        // Initial fetch to display messages on load
        fetchMessages();
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

