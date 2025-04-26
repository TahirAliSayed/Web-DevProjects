<?php
include('../Assets/Connection/Connection.php');
include("Head.php");

// Ensure the user is logged in
session_start();
if (!isset($_SESSION["uid"])) {
    header("Location: Login.php");
    exit();
}

$user_id = $_SESSION["uid"];
$workshop_id = isset($_GET['workshop_id']) ? intval($_GET['workshop_id']) : 0;

// Validate workshop ID
if ($workshop_id <= 0) {
    echo "<p>No workshop selected. Please go back and select a valid workshop.</p>";
    include("Foot.php");
    exit();
}

// Fetch or create chat room
$sql = "SELECT room_id FROM chat_rooms WHERE user_id = ? AND workshop_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ii", $user_id, $workshop_id);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $room_id = $row['room_id'];
} 

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Chat box styling */
#chat-box {
    width: 400px;
    height: 500px;
    border: 1px solid #444;
    padding: 10px;
    overflow-y: scroll;
    margin: 20px auto;
    background-color: #1c1c1e; /* Dark background */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

/* Message input styling */
#message-input {
    width: 300px;
    padding: 10px;
    margin: 10px auto;
    display: block;
    border: 1px solid #555;
    background-color: #2c2c2e;
    color: #fff;
    border-radius: 5px;
    outline: none;
}

/* Send button styling */
#send-button {
    padding: 10px 20px;
    background-color: #fffc00; /* Snapchat yellow */
    color: black;
    font-weight: bold;
    border: none;
    cursor: pointer;
    display: block;
    margin: 10px auto;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}
#send-button:hover {
    background-color: #e6db00;
}

/* User's messages (right-aligned, yellow like Snapchat) */
.message.user {
    background-color: #fffc00; /* Snapchat yellow */
    color: black;
    margin-left: auto;
    text-align: right;
    max-width: 70%;
    border-radius: 10px 10px 0 10px;
    padding: 8px 12px;
}

/* Other messages (left-aligned, dark gray) */
.message.other {
    background-color: #2c2c2e; /* Dark gray */
    color: white;
    margin-right: auto;
    text-align: left;
    max-width: 70%;
    border-radius: 10px 10px 10px 0;
    padding: 8px 12px;
}

/* General message styling */
.message {
    margin-bottom: 10px;
    word-wrap: break-word;
    font-size: 14px;
}

/* Scrollbar styling */
#chat-box::-webkit-scrollbar {
    width: 5px;
}
#chat-box::-webkit-scrollbar-thumb {
    background-color: #fffc00;
    border-radius: 10px;
}
#chat-box::-webkit-scrollbar-track {
    background: #2c2c2e;
}

    </style>
</head>
<body>
    <div id="tab" align="center">
        <h2>Chat with Workshop</h2>
        <p>Chat Room ID: <?php echo $room_id; ?></p>

        <!-- Chat Box -->
        <div id="chat-box"></div>
        <input type="text" id="message-input" placeholder="Type your message..." />
        <button id="send-button">Send</button>
    </div>

    <script>
        // Constants for room ID and author (user ID)
        const room_id = <?php echo $room_id; ?>; // Room ID from the query parameter
        const author = <?php echo $_SESSION["uid"]; ?>; // User ID from session

        // Function to load messages
        function loadMessages() {
    console.log("Fetching messages for room ID:", room_id);
    $.ajax({
        url: 'GetMessage.php', // Backend script to fetch messages
        type: 'POST',
        data: { room_id: room_id },
        success: function(response) {
            console.log("Response from server:", response);
            try {
                const messages = JSON.parse(response);
                console.log("Parsed messages:", messages);
                $('#chat-box').empty(); // Clear the chat box before reloading messages
                messages.forEach(msg => {
                    // Determine if the message is from the current user
                    const isUserMessage = msg.author == author;
                    const messageClass = isUserMessage ? 'message user' : 'message other';
                    $('#chat-box').append(`<div class="${messageClass}"><strong>${msg.author}:</strong> ${msg.message}</div>`);
                });
                // Scroll to the bottom of the chat box
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            } catch (error) {
                console.error("Error parsing response:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error loading messages:", error);
        }
    });
}

        // Send message
        $('#send-button').click(function() {
            const message = $('#message-input').val();
            if (message.trim() !== "") {
                console.log("Sending message:", message);
                $.ajax({
                    url: 'SendMessage.php', // Backend script to send messages
                    type: 'POST',
                    data: { room_id: room_id, author: author, message: message },
                    success: function(response) {
                        console.log("Message sent:", response);
                        $('#message-input').val(''); // Clear the input field
                        loadMessages(); // Reload messages after sending
                    },
                    error: function(xhr, status, error) {
                        console.error("Error sending message:", error);
                    }
                });
            }
        });

        // Load messages every 2 seconds
        setInterval(loadMessages, 2000);

        // Load messages on page load
        $(document).ready(function() {
            console.log("Page loaded.");
            loadMessages();
        });
    </script>
</body>
<?php
include("Foot.php");
?>
</html>