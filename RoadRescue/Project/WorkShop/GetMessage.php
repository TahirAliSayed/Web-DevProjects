<?php
include('../Assets/Connection/Connection.php');

$room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : 0;

if ($room_id <= 0) {
    die(json_encode(["error" => "Invalid room ID."]));
}

$sql = "SELECT author, message FROM messages WHERE room_id = ? ORDER BY timestamp ASC";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die(json_encode(["error" => "Prepare failed: " . $conn->error]));
}
$stmt->bind_param("i", $room_id);
if (!$stmt->execute()) {
    die(json_encode(["error" => "Execute failed: " . $stmt->error]));
}
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Debugging: Print the fetched messages
error_log("Fetched messages: " . print_r($messages, true));

echo json_encode($messages);

$stmt->close();
$conn->close();
?>