<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Answer:</title>
</head>
<body>
<p>Os valores foram: <br/>
<?php
$servername = "localhost";
$username = "root";
$password = "input212";
$dbname = "input";
$conn = mysql_connect($servername, $username, $password);
if(!$conn){
        die("Connection failed: " . mysql_error());
}
//entrando na database chamada input
$mydb = mysql_select_db($dbname);
if(!$mydb){
        die('Could not connect to database: ' . mysql_error());
}

$dispositivo = $_POST['dispositivo'];
mysql_query("INSERT INTO dispositivo (id_dispositivo, nome_dispositivo, mostrar_dispositivo) VALUES (NULL, '$dispositivo', TRUE)");
$id = mysql_query("SELECT id_dispositivo FROM dispositivo ORDER BY id_dispositivo DESC LIMIT 1") + 0;

//echo $id;

for($i=0;$i<10;$i++){
	$name = 'member'.$i;
	if(isset($_POST[$name])){
		$nome_atributo = $_POST[$name];
		mysql_query("INSERT INTO config_dispositivo_atributos (id_config, nome_atributo, id_dispositivo) VALUES (NULL, '$nome_atributo', '$id')");
		//echo $_POST[$name];
	}
}
//criando o upload

$target_dir = "/var/www/html/admin/upload/";
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
?>

</p>
</body>
</html>
