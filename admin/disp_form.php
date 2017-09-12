<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Answer:</title>
</head>
<body>
<?php

//***********************************//
//******** START CONNECTION *********//
//***********************************//

//Starting connection
$mysqli = new mysqli('localhost', 'root', 'input212', 'input');

//If there is any error, then show...
if ($mysqli->connect_errno) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

//**********************************//
//******** READING DATABSE *********//
//**********************************//

//We are inserting the dispositivo in the database
$dispositivo = $_POST['dispositivo'];
$sql = "INSERT INTO dispositivo (id_dispositivo, nome_dispositivo, mostrar_dispositivo) VALUES (NULL,'" . $dispositivo ."', TRUE)";
if (!$result = $mysqli->query($sql)) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

//getting the last dispositivo uploaded
$id = mysqli->query("SELECT id_dispositivo FROM dispositivo ORDER BY id_dispositivo DESC LIMIT 1") + 0;

//inserting the dispositivo atributes
for($i=0;$i<30;$i++){
	$name = 'nome'.$i;
	if(isset($_POST[$name])){
		$nome_atributo = $_POST[$name];
		mysqli->query("INSERT INTO config_dispositivo_atributos (id_config, nome_atributo, id_dispositivo) VALUES (NULL, '" . $nome_atributo . "', " . $id . ")");
		//echo $_POST[$name];
	}
}

?>

</p>
</body>
</html>
