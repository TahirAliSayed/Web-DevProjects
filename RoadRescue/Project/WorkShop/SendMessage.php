<?php
include('../Assets/Connection/Connection.php');

$room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : 0;
$author = isset($_POST['author']) ? intval($_POST['author']) : 0;
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if ($room_id <= 0 || $author <= 0 || empty($message)) {
    die(json_encode(["error" => "Invalid input."]));
}

$sql = "INSERT INTO messages (room_id, author, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die(json_encode(["error" => "Prepare failed: " . $conn->error]));
}
$stmt->bind_param("iis", $room_id, $author, $message);
if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Failed to send message: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>