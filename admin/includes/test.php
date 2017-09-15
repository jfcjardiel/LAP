<?php

include_once 'psl-config.php';
include_once 'db_connect.php';


//getting the last dispositivo uploaded
//$id = $mysqli->query("SELECT id_dispositivo FROM dispositivo ORDER BY id_dispositivo DESC LIMIT 1") + 0;

$id = $mysqli->query("SELECT id FROM members") + 0;

echo $id;

?>
