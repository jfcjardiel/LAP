<?php

$mysqli = new mysqli('localhost', 'sec_user', 'secuserinput212', 'secure_login');

//If there is any error, then show...
if ($mysqli->connect_errno) {
    // I do not know what to show yet
    echo "Connection Problem";
    exit;
}

$id = $mysqli->query("SELECT username FROM members");

echo $id;

?>
