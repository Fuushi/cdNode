<?php
//Public requests are just routed, no auth required

//NO html
//return an image class containing the url, echo on client


//load config
$config = file_get_contents("./config.json");
$config = json_decode($config, true);

//configurations
$nodes = $config['nodes'];
$protocol = $config['protocol'];

$id = htmlspecialchars($_GET['id']);
if (!$id || !preg_match('/^[a-zA-Z0-9_\-\.]+$/', $id)) {
    http_response_code(400);
    exit('Invalid ID');
}

//select node TODO
$src = $nodes[0];

//below return redirect to the image
header("Location: ".$protocol."://".$src."/node.php?id=".$id);
?>



