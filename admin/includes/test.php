<?php

$mysqli = new mysqli( "localhost", "sec_user", "secuserinput212", "secure_login");

$id = $mysqli->query("SELECT username FROM members");

echo $id;
?>
