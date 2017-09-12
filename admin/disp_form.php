<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Answer:</title>
</head>
<body>
<?php

//debug settings
ini_set('display_errors',1);
error_reporting(E_ALL);

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
$id = $mysqli->query("SELECT id_dispositivo FROM dispositivo ORDER BY id_dispositivo DESC LIMIT 1") + 0;

//echo $id;

//inserting the dispositivo atributes
for($i=0;$i<30;$i++){
	$name = 'nome'.$i;
	if(isset($_POST[$name])){
		$nome_atributo = $_POST[$name];
		$mysqli->query("INSERT INTO config_dispositivo_atributos (id_config, nome_atributo, id_dispositivo) VALUES (NULL, '" . $nome_atributo . "', " . $id . ")");
		//echo $_POST[$name];
	}
}

//***********************************//
//********** START UPLOAD ***********//
//***********************************//

//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir = "/var/www/html/disp_form/";
$target_file = $target_dir . $dispositivo;

//echo "nome do arquivo: ", $target_file , "\n";
$uploadOk = FALSE;
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
	$uploadOk = TRUE;
}

//echo $uploadOk;

if($uploadOk){
	echo "Error your file was not uploaded. Caiu no primeiro IF";
	exit;
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

//putting the header into the file
$file_head = 'Needs["DatabaseLink`"];';
$file_head .= 'conn = OpenSQLConnection[JDBC["MySQL(Connector/J)", "localhost:3306/input"], Username -> "root", Password -> "input212"];';

//inserting into the file, the correct variables
$file_connection = '';
for($i=0;$i<30;$i++){
	$name = 'nome'.$i;
	$variavel = 'variavel'.$i;
	if(isset($_POST[$name])){
		if(isset($_POST[$variavel])){
			//pegar o id_config do nome do dispositivo
			$nome_atributo = $_POST[$name];
			$stmt = "SELECT id_config FROM config_dispositivo_atributos WHERE nome_atributo='".$nome_atributo."' AND id_dispositivo=".$id;
			$id_config = $mysqli->query($stmt) + 0;
			//com o id em maos, vamos colocar no arquivo como ele deve pegar o valor
			$nome_variavel = $_POST[$variavel];
			$file_connection .= '{{'.$nome_variavel.'}}=SQLExecute[conn, "SELECT valor FROM valor_dispositivo_atributos WHERE id_config='.$id_config.' AND jaleu=FALSE ORDER BY id_valor DESC LIMIT 1"];';
			//dando update no valor lido
			$file_connection .= 'SQLExecute[conn, "UPDATE valor_dispositivo_atributos SET jaleu=TRUE WHERE id_config='.$id_config.' ORDER BY id_valor DESC LIMIT 1"];';
		}
	}
}

//com os dados em maos, basta colocar o arquivo e salvar
$file_data = $file_head . $file_connection . file_get_contents($target_file);
file_put_contents($target_file, $file_data);

echo "verifique";

?>

</p>
</body>
</html>
