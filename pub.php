<?php
//Public requests are just routed, no auth required

//NO html
//return an image class containing the url, echo on client


//load config
$config = file_get_contents("./config.json");
$config = json_decode($config, true);

//validate config
if (!$config) {
    http_response_code(500);
    exit('Server Configuration Error');
}

//configurations
$nodes = $config['nodes'];
$protocol = $config['protocol'];

$id = htmlspecialchars($_GET['id'] ?? '');
if (!$id || !preg_match('/^[a-zA-Z0-9_\-\.]+$/', $id)) {
    http_response_code(404);

    //only display error if debug is enabled
    if ($config['debug']) {
        exit('Invalid ID');
    } else {
        exit();
    }
}

//select node (random for now, will use geoip later)
$src = $nodes[array_rand($nodes)];

//below return redirect to the image
header("Location: ".$protocol."://".$src."/node.php?id=".$id);
?>



