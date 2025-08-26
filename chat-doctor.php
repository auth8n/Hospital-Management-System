<?php
session_start();
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Chat</title>
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
        <div class="header">Doctor Chat</div>
        <div class="message-box" id="messageBox">
            <!-- Messages will be displayed here -->
        </div>
        <div class="input-container">
            <select id="userSelect" onchange="updateUserID()">
                <option value="">Select a user</option>
                <?php
                // Fetch users who have sent messages to this doctor
                $stmt = $conn->prepare("SELECT DISTINCT users.id, users.username FROM users 
                                        INNER JOIN messages ON messages.sender_id = users.id 
                                        WHERE messages.receiver_id = ?");
                $stmt->bind_param("i", $_SESSION['doctor_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($user = $result->fetch_assoc()) {
                    echo "<option value='" . $user['id'] . "'>" . htmlspecialchars($user['username']) . "</option>";
                }
                $stmt->close();
                ?>
            </select>
        </div>
        <div class="input-container">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        // Set doctor as senderId
        let senderId = <?php echo json_encode($_SESSION['doctor_id']); ?>;
        let receiverId = null;  // Initially set to null

        // Function to update receiverId when a user is selected
        function updateUserID() {
            var userSelect = document.getElementById('userSelect');
            receiverId = userSelect.value;
            if (receiverId) {
                fetchMessages(); // Fetch messages for the selected user
            }
        }

        // Function to fetch messages
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
                        message.classList.add('message', msg.sender_id == senderId ? 'sent' : 'received');
                        message.innerText = `${msg.timestamp} - ${msg.message}`;
                        messageBox.appendChild(message);
                    });
                    messageBox.scrollTop = messageBox.scrollHeight;  // Scroll to bottom
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

        // Function to send a message
        function sendMessage() {
            var message = document.getElementById('messageInput').value;

            if (!receiverId) {
                alert("Please select a user first.");
                return;
            }
            if (message.trim() === "") {
                alert("Message cannot be empty.");
                return;
            }

            // Send message to the server
            fetch('sendMessage1.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `senderId=${senderId}&receiverId=${receiverId}&message=${encodeURIComponent(message)}`
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('messageInput').value = '';  // Clear input field
                    fetchMessages(); // Refresh messages
                } else {
                    console.error("Error:" + data.message);
                    alert("Error sending message: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                alert("Network error or issue with sendMessage1.php.");
            });
        }


    </script>
</body>
</html>
