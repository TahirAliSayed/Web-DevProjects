<?php
include('../Assets/Connection/Connection.php');
include("Head.php");

// Ensure the workshop is logged in
session_start();
if (!isset($_SESSION["wid"])) {
    header("Location: Login.php");
    exit();
}

$workshop_id = $_SESSION["wid"];
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Validate user ID
if ($user_id <= 0) {
    echo "<p>No user selected. Please go back and select a valid user.</p>";
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
} else {
    // Create new chat room
    $sql = "INSERT INTO chat_rooms (user_id, workshop_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ii", $user_id, $workshop_id);
    if ($stmt->execute()) {
        $room_id = $stmt->insert_id;
    } else {
        die("Failed to create chat room: " . $stmt->error);
    }
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
    border: 1px solid #444; /* Dark border */
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

/* Workshop messages (right-aligned, yellow like Snapchat) */
.message.workshop {
    background-color: #fffc00; /* Snapchat yellow */
    color: black;
    margin-left: auto;
    text-align: right;
    max-width: 70%;
    border-radius: 10px 10px 0 10px;
    padding: 8px 12px;
}

/* User messages (left-aligned, dark gray) */
.message.user {
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
        <h2>Chat with User</h2>
        <p>Chat Room ID: <?php echo $room_id; ?></p>
        <div id="chat-box"></div>
        <input type="text" id="message-input" placeholder="Type your message..." />
        <button id="send-button">Send</button>
    </div>

    <script>
        const room_id = <?php echo $room_id; ?>;
        const author = <?php echo $_SESSION["wid"]; ?>;

        function loadMessages() {
            $.ajax({
                url: 'GetMessage.php',
                type: 'POST',
                data: { room_id: room_id },
                success: function(response) {
                    try {
                        const messages = JSON.parse(response);
                        $('#chat-box').empty();
                        messages.forEach(msg => {
                            const isWorkshopMessage = msg.author == author;
                            const messageClass = isWorkshopMessage ? 'message workshop' : 'message user';
                            $('#chat-box').append(`<div class="${messageClass}"><strong>${msg.author}:</strong> ${msg.message}</div>`);
                        });
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

        $('#send-button').click(function() {
            const message = $('#message-input').val();
            if (message.trim() !== "") {
                $.ajax({
                    url: 'SendMessage.php',
                    type: 'POST',
                    data: { room_id: room_id, author: author, message: message },
                    success: function(response) {
                        $('#message-input').val('');
                        loadMessages();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error sending message:", error);
                    }
                });
            }
        });

        setInterval(loadMessages, 2000);
        $(document).ready(function() { loadMessages(); });
    </script>
</body>
<?php
include("Foot.php");
?>
</html>
