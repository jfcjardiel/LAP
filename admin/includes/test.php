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
//getting the last dispositivo uploaded
$id_result = $mysqli_disp->query("SELECT id FROM members ORDER BY id DESC LIMIT 1");
if($id_result->num_rows > 0){
	$id_row = $id_result->fetch_assoc();
	$id = $id_row["id"];
	echo "ACHOU!";
	echo $id;
}
else{
	echo "<h1> Connection Problem </h1>";
	exit;
}

?>
