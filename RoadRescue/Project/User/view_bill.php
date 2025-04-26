<?php
include("../Assets/Connection/Connection.php");

if(isset($_GET['bill'])) {
    $billFile = $_GET['bill'];
    $billPath = "../Assets/File/Bill/".$billFile;
    
    // Verify file exists and is an image
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExt = pathinfo($billFile, PATHINFO_EXTENSION);
    
    if(file_exists($billPath) && in_array(strtolower($fileExt), $imageExtensions)) {
        // Set proper content type header
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        ];
        
        header('Content-Type: '.$mimeTypes[strtolower($fileExt)]);
        header('Content-Length: '.filesize($billPath));
        readfile($billPath);
        exit();
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Bill not found or invalid file type";
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "No bill specified";
}
?>