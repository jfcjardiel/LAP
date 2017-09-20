<?php
		//debug settings
		ini_set('display_errors',1);
		error_reporting(E_ALL);

include_once 'psl-config.php';
include_once 'db_connect.php';


//getting the last dispositivo uploaded
//$id = $mysqli->query("SELECT id_dispositivo FROM dispositivo ORDER BY id_dispositivo DESC LIMIT 1") + 0;

if ($stmt = $mysqli->prepare("SELECT id, username, password 
    FROM members")) {
    $stmt->execute();    // Execute the prepared query.
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $db_password);
    $stmt->fetch();
    echo $user_id;
    echo $username;
}

$mysqli_disp = new mysqli('localhost', 'root', 'input212', 'input');

$stmt = "INSERT INTO config_dispositivo_atributos (id_config, nome_atributo, id_dispositivo) VALUES (NULL, 'oi', 1)";
if($mysqli_disp->query($stmt) == FALSE){
	echo "<h1> Connection Problem </h1>";
}
?>
