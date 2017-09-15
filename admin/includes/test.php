<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

$id = $mysqli->query("SELECT username FROM secure_login DESC LIMIT 1") + 0;

echo $id;
?>
