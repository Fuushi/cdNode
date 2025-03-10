<?php
//NODE serves files
$id = $_GET['id'];
$path = "./public/" . $id;

// Check if the file exists and is a valid image
if (file_exists($path)) {
    // Set the appropriate content-type header
    header("Content-Type: image/jpeg");
    header("Content-Length: " . filesize($path));

    // Output the image data directly
    readfile($path);
} else {
    // Handle file not found or invalid file type
    header("HTTP/1.0 404 Not Found");
    echo "Image not found.";
}
