<?php
//origin endpoint that nodes will request metadata from
// get_list endpoint returns an itemized list of all items in the origin
// the node can compare its own files to this array and request missing
// items from origin via pub.php

//validate source
//...

//do not accept path for get_list
$path = "./public/";
$files = scandir($path);

//dump files into a json array
$data = json_encode($files);

//remove invalid files
//... TODO 

//return json data
echo $data;
?>