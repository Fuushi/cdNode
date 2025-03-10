<?php
//Public requests are just routed, no auth required

//NO html
//return an image class containing the url, echo on client

//constants
$nodes = [
    "172.16.1.91:3000", //origin server
    //other nodes go here
];

//extract requested file
$id = $_GET['id'];

//select node
$src = $nodes[0];

//below return html class for the requested image
?>


<img src="http://<?php echo $src ?>/node.php?id=<?php echo $id ?>" alt="">