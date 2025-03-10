<?php 
//load config
$config = file_get_contents("./config.json");
$config = json_decode($config, true);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Test</p>
    <img src="http://<?php echo $config['local_addr']?>/pub.php?id=00000001.jpeg" alt="Image">

</body>
</html>