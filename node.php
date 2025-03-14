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

// Determine the content type based on the file extension
$extension = pathinfo($path, PATHINFO_EXTENSION);
$contentTypes = [
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'webp' => 'image/webp'
];

$contentType = $contentTypes[$extension] ?? 'application/octet-stream';

// Check if the file exists and is a valid image
if (file_exists($path)) {
    // Set the appropriate content-type header
    header("Content-Type: " . $contentType);
    header("Content-Length: " . filesize($path));

    // Add security headers
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");

    // Output the image data directly
    readfile($path);
} else {
    // Handle file not found or invalid file type
    header("HTTP/1.0 404 Not Found");
    echo "Image not found.";
}

?>