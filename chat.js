




    // Function to send a new message
    /*function sendMessage() {
        let messageInput = document.getElementById('messageInput');
        let message = messageInput.value.trim();
        if (!message || !receiverId) return;

        fetch('sendMessage.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `sender_id=${senderId}&receiver_id=${receiverId}&message=${encodeURIComponent(message)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                fetchMessages();  // Refresh chat
                messageInput.value = '';  // Clear input field
            }
        })
        .catch(error => console.error('Error sending message:', error));
    }

    // Event listener for doctor selection change
    document.getElementById('doctorSelect').addEventListener('change', function() {
        receiverId = this.value;  // Update receiver ID to selected doctor
        fetchMessages();  // Load messages for the newly selected doctor
    });

    // Set up sending message on button click
    document.getElementById('sendButton').addEventListener('click', sendMessage);

    // Fetch messages every 5 seconds to update the chat view
    setInterval(fetchMessages, 5000);

    // Load doctors into the dropdown when page loads
    loadDoctors();*/


    /*function sendMessage() {
        var message = document.getElementById('messageInput').value;
        var receiverId = document.getElementById('doctorSelect').value;  // Get selected doctor ID
        var senderId = <?php echo $_SESSION['id']; ?>;  // Logged-in user ID
    
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
                alert("Message sent!");
                document.getElementById('messageInput').value = '';  // Clear input field
                fetchMessages();  // Refresh messages
            } else {
                alert("Failed to send message.");
            }
        })
        .catch(error => {
            console.error('Error sending message:', error);
            alert("Error sending message.");
        });
    }*/

        
        
    

