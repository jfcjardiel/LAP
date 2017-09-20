<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Answer:</title>
	</head>
<body>
	<?php
	include_once 'includes/register.inc.php';
	include_once 'includes/functions.php';

	sec_session_start();

	//only who is logged can do it!
	if (login_check($mysqli) == true){
		//debug settings
		ini_set('display_errors',1);
		error_reporting(E_ALL);

		//***********************************//
		//******** START CONNECTION *********//
		//***********************************//

		//Starting connection
		$mysqli_disp = new mysqli('localhost', 'root', 'input212', 'input');

		//If there is any error, then show...
		if ($mysqli_disp->connect_errno) {
		    // I do not know what to show yet
		    echo "<h1>Connection Problem </h1>";
		    exit;
		}

		//**********************************//
		//******** WRITING DATABSE *********//
		//**********************************//

		//We are inserting the dispositivo in the database
		$dispositivo = $_POST['dispositivo'];
		$sql = "INSERT INTO dispositivo (id_dispositivo, nome_dispositivo, mostrar_dispositivo) VALUES (NULL,'" . $dispositivo ."', TRUE)";
		if (!$result = $mysqli_disp->query($sql)) {
		    // I do not know what to show yet
		    echo "<h1>Connection Problem </h1>";
		    exit;
		}


		//getting the last dispositivo uploaded
		$id_result = $mysqli_disp->query("SELECT id_dispositivo FROM dispositivo ORDER BY id_dispositivo DESC LIMIT 1");
		if($id_result->num_rows > 0){
			$id_row = $id_result->fetch_assoc();
			$id = $id_row["id_dispositivo"];			
		}
		else{
			echo "<h1> Connection Problem </h1>";
			exit;
		}

		//inserting the dispositivo atributes
		for($i=0;$i<30;$i++){
			$name = 'nome'.$i;
			if(isset($_POST[$name])){
				$nome_atributo = $_POST[$name];
				$stmt = "INSERT INTO config_dispositivo_atributos (id_config, nome_atributo, id_dispositivo) VALUES (NULL, '" . $nome_atributo . "', " . $id . ")";
				if($mysqli_disp->query($stmt) == FALSE){
					echo "<h1> Connection Problem </h1>";
					exit;
				}
				echo $_POST[$name];
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
		$file_head = 'Needs["DatabaseLink`"];' . "\n";
		$file_head .= 'conn = OpenSQLConnection[JDBC["MySQL(Connector/J)", "localhost:3306/input"], Username -> "root", Password -> "input212"];' . "\n";

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
					$id_config_result = $mysqli_disp->query($stmt);
					if($id_config_result->num_rows == 1){
						$id_config_row = $id_config_result->fetch_assoc();
						$id_config = $id_config_row["id_config"];
					}
					else{
						echo "ERROR: CONTACT SUPPORT";
						exit;
					}
					//com o id em maos, vamos colocar no arquivo como ele deve pegar o valor
					$nome_variavel = $_POST[$variavel];
					$file_connection .= '{{'.$nome_variavel.'}}=SQLExecute[conn, "SELECT valor FROM valor_dispositivo_atributos WHERE id_config='.$id_config.' AND jaleu=FALSE ORDER BY id_valor DESC LIMIT 1"];'  . "\n";
					//dando update no valor lido
					$file_connection .= 'SQLExecute[conn, "UPDATE valor_dispositivo_atributos SET jaleu=TRUE WHERE id_config='.$id_config.' ORDER BY id_valor DESC LIMIT 1"];' . "\n";
				}
			}
		}

		//com os dados em maos, basta colocar o arquivo e salvar
		$file_data = $file_head . $file_connection . file_get_contents($target_file);
		file_put_contents($target_file, $file_data);

		//**************************************//
		//******** UPLOADING NA FIGURA *********//
		//**************************************//


		//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
		$target_dir_img = "/var/www/html/disp_form/img/";
		$target_img = $target_dir . $dispositivo . ".jpg";

		//echo "nome do arquivo: ", $target_file , "\n";
		$uploadOk = FALSE;
		$imgType = pathinfo($target_img,PATHINFO_EXTENSION);

		$errors = array();
		$img_name = $_FILES['upimg']['name'];
		$img_size = $_FILES['upimg']['size'];
		$img_tmp = $_FILES['upimg']['tmp_name'];
		$img_type = $_FILES['upimg']['type'];
		$img_extension = strtolower(end(explode('.',$file_name)));

		if(file_exists($target_img)){
			echo "Warning: arquivo com o mesmo nome da pasta foi sobrescrito";
			$uploadOk = TRUE;
		}

		if($_FILES["upimg"]["size"] > 1000000000){
			echo "Error, file is larger than 10MB" . $_FILES["upfile"]["size"];
			$uploadOk = TRUE;
		}

		//echo $uploadOk;

		if($uploadOk){
			echo "Error your file was not uploaded. Caiu no primeiro IF";
			exit;
		}
		else{
			$moved = move_uploaded_file($img_tmp,$target_img);
			if($moved){
				echo "the image " . basename($img_name) . "has been uploaded";
			}
			else{
				echo "There was an error, image not uploaded";
			}
		}
	}
	else{
		echo "<h1>You are not allowed</h1>";
	}
	?>
	</body>
</html>
