<?php
include('../Assets/Connection/Connection.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Get the user ID and workshop ID from the session and query parameters
$user_id = $_SESSION["uid"];
$workshop_id = isset($_GET['workshop_id']) ? intval($_GET['workshop_id']) : 0;

// Debugging: Print user ID and workshop ID
echo "User ID: " . $user_id . "<br>";
echo "Workshop ID: " . $workshop_id . "<br>";

if ($user_id > 0 && $workshop_id > 0) {
    // Check if a chat room already exists for this user-workshop pair
    $sql = "SELECT room_id FROM chat_rooms WHERE user_id = ? AND workshop_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die(json_encode(["error" => "Prepare failed: " . $conn->error]));
    }
    $stmt->bind_param("ii", $user_id, $workshop_id);
    if (!$stmt->execute()) {
        die(json_encode(["error" => "Execute failed: " . $stmt->error]));
    }
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the existing room ID
        $row = $result->fetch_assoc();
        $room_id = $row['room_id'];
    } else {
        // Create a new chat room
        $sql = "INSERT INTO chat_rooms (user_id, workshop_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die(json_encode(["error" => "Prepare failed: " . $conn->error]));
        }
        $stmt->bind_param("ii", $user_id, $workshop_id);
        if ($stmt->execute()) {
            $room_id = $stmt->insert_id; // Get the newly created room ID
        } else {
            die(json_encode(["error" => "Failed to create chat room: " . $stmt->error]));
        }
    }
    $stmt->close();

    // Return the room ID as JSON
    echo json_encode(["room_id" => $room_id]);
} else {
    echo json_encode(["error" => "Invalid user or workshop ID."]);
}

$conn->close();
?>