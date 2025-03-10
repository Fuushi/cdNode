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

//extract requested file
$id = $_GET['id'];

//select node
$src = $nodes[0];

//below return redirect to the image
header("Location: ".$protocol."://".$src."/node.php?id=".$id);
?>



