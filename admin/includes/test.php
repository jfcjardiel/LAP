<?php

//Starting connection
$mysqli = new mysqli('localhost', 'root', 'input212', 'secure_login');

//If there is any error, then show...
if ($mysqli->connect_errno) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

//getting the last dispositivo uploaded
//$id = $mysqli->query("SELECT id_dispositivo FROM dispositivo ORDER BY id_dispositivo DESC LIMIT 1") + 0;

$id = $mysqli->query("SELECT username FROM members");

echo $id;

?>
