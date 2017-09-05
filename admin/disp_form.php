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
$sql = "INSERT INTO dispositivo (id_dispositivo, nome_dispositivo, mostrar_dispositivo) VALUES (NULL," . $dispositivo .", TRUE)";
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
		mysqli->query("INSERT INTO config_dispositivo_atributos (id_config, nome_atributo, id_dispositivo) VALUES (NULL, " . $nome_atributo . ", " . $id ")");
		//echo $_POST[$name];
	}
}

//***********************************//
//********** START UPLOAD ***********//
//***********************************//

//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir = "/var/www/html/disp_form";
$target_file = $target_dir . $dispositivo;

//echo "nome do arquivo: ", $target_file , "\n";
$uploadOk = TRUE;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

$errors = array();
$file_name = $_FILES['upfile']['name'];
$file_size = $_FILES['upfile']['size'];
$file_tmp = $_FILES['upfile']['tmp_name'];
$file_type = $_FILES['upfile']['type'];
$file_extension = strtolower(end(explode('.',$file_name)));

if(file_exists($target_file)){
	echo "Warning: arquivo com o mesmo nome da pasta foi sobrescrito";
	$uploadOk = TRUE;
}

if($_FILES["upfile"]["size"] > 1000000000){
	echo "Error, file is larger than 10MB" . $_FILES["upfile"]["size"];
	$uploadOk = FALSE;
}

//echo $uploadOk;

if($uploadOK){
	echo "Error your file was not uploaded. Caiu no primeiro IF";
}
else{
	$moved = move_uploaded_file($file_tmp,$target_file);
	if($moved){
		echo "the file " . basename($file_name) . "has been uploaded";
	}
	else{
		echo "There was an error, file not uploaded";
	}
}

//**********************************************************//
//******** PREPARANDO O DOCUMENTO PARA A A LEITURA *********//
//**********************************************************//



?>

</p>
</body>
</html>
