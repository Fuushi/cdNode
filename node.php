<?php
//NODE serves files
$id = htmlspecialchars($_GET['id']);
if (!$id || !preg_match('/^[a-zA-Z0-9_\-\.]+$/', $id)) {
    http_response_code(400);
    exit('Invalid ID');
}

$path = "./public/" . $id;

//normalize path
$realPath = realpath($path);
if (!$realPath || strpos($realPath, realpath('./public/')) !== 0) {
    http_response_code(404);
    exit('Image not found.');
}


// Check if the file exists and is a valid image
if (file_exists($path)) {
    // Set the appropriate content-type header
    header("Content-Type: image/jpeg"); //TODO this needs to be dynamic
    header("Content-Length: " . filesize($path));

    // Output the image data directly
    readfile($path);
} else {
    // Handle file not found or invalid file type
    header("HTTP/1.0 404 Not Found");
    echo "Image not found.";
}

?>