<?php
include("../Assets/Connection/Connection.php");

$workshop_id = $_GET['workshop_id'] ?? 'all';

$query = "
    SELECT 
        SUM(CASE WHEN r.request_status = 1 THEN 1 ELSE 0 END) AS accepted,
        SUM(CASE WHEN r.request_status = 2 THEN 1 ELSE 0 END) AS rejected,
        SUM(CASE WHEN r.request_status = 3 THEN 1 ELSE 0 END) AS in_progress, -- Add this line
        SUM(CASE WHEN r.request_status = 6 THEN 1 ELSE 0 END) AS completed
    FROM tbl_request r
    INNER JOIN tbl_workshop w ON r.workshop_id = w.workshop_id
    " . ($workshop_id !== 'all' ? " WHERE r.workshop_id = $workshop_id" : "");
$result = $conn->query($query);
$row = $result->fetch_assoc();

echo json_encode([
    'accepted' => $row['accepted'],
    'rejected' => $row['rejected'],
    'in_progress' => $row['in_progress'], // Add this line
    'completed' => $row['completed']
]);
?>