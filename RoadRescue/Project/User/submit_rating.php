<?php
include("../Assets/Connection/Connection.php");
session_start(); // Start session to get user ID

if(isset($_POST['submit_rating'])) {
    $request_id = $_POST['request_id'];
    $workshop_id = $_POST['workshop_id'];
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    // Check if request_id exists in tbl_request
    $checkQuery = "SELECT * FROM tbl_request WHERE request_id = '$request_id'";
    $checkResult = $conn->query($checkQuery);

    if($checkResult->num_rows > 0) {
        // Insert rating into tbl_ratings
        $insertQuery = "INSERT INTO tbl_ratings (request_id, workshop_id, user_id, rating, review) 
                        VALUES ('$request_id', '$workshop_id', '$user_id', '$rating', '$review')";
        
        if($conn->query($insertQuery)) {
            echo "<script>alert('Rating submitted successfully!'); window.location.href='ViewRequest.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Invalid request ID!'); window.history.back();</script>";
    }
}
?>
