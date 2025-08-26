<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page or handle accordingly
    header("Location: login.php");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat Demo</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9; margin: 0; }
        .chat-container { width: 400px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); background-color: #fff; }
        .header { padding: 10px; background-color: #4CAF50; color: #fff; text-align: center; }
        .message-box { height: 300px; padding: 10px; overflow-y: auto; border-bottom: 1px solid #ddd; }
        .message { padding: 8px; margin: 5px 0; border-radius: 5px; }
        .message.sent { background-color: #e0ffe0; text-align: right; }
        .message.received { background-color: #f0f0f0; }
        .input-container { display: flex; padding: 10px; }
        select, input[type="text"] { width: 100%; padding: 8px; margin-right: 5px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 8px; background-color: #4CAF50; color: #fff; border: none; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="header">Live Chat</div>
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
    

    <!--<script src="chat.js"></script>-->
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
        function fetchMessages() {
            if (!receiverId) return; // Ensure a doctor is selected

            fetch(`getMessages.php?sender_id=${senderId}&receiver_id=${receiverId}`)
                .then(response => response.json())
                .then(data => {
                    let messages = data.messages;
                    let messageBox = document.getElementById('messageBox');
                    messageBox.innerHTML = '';  // Clear existing messages
                    messages.forEach(msg => {
                        let message = document.createElement('div');
                        message.classList.add('message', msg.sender_id === senderId ? 'sent' : 'received');
                        message.innerText = `${msg.timestamp} - ${msg.message}`;
                        messageBox.appendChild(message);
                    });
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

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
                console.error('Error sending message:', error);
                alert("Error sending message.");
            });
        }

        // Initial load of doctors into dropdown (if needed)
        document.addEventListener('DOMContentLoaded', function() {
            // Optionally, load doctors dynamically if required
            updateDoctorId(); // Update doctor and fetch messages for the default selection
        });
    </script>


    
</body>
</html>
