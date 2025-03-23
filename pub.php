<?php
//Public requests are just routed, no auth required

//include
require 'auth.php';

//returns redirect to the image on the selected node

//define functions
function selectNode($addr, $nodes) {
    //get region
    $region = getIpLocation($addr);

    //search nodes for region match TODO make load balance between all nodes in region
    foreach ($nodes as $node_addr => $node_region) {
        if ($node_region == $region) {
            return $node_addr;
        }
    }

    //if no match, return random node for load balancing
    return array_rand($nodes);
}

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

//select node
if ($config['use_geoip']) {
    $src = selectNode($_SERVER['REMOTE_ADDR'], $nodes);
} else {
    $src = array_rand($nodes);
}

//below return redirect to the image
header("Location: ".$protocol."://".$src."/node.php?id=".$id);
?>



