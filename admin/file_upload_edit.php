<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

if (login_check($mysqli) == true){
	//lendo o id que deve ser substituido
	$id = $_REQUEST["id"] + 0;

	//**************************************//
	//******** UPLOADING NA FIGURA *********//
	//**************************************//

	//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
	$target_dir_img = "/var/www/html/disp_form/img/";
	$target_img = $target_dir_img . $id . ".jpg";

	$errors = array();

	if(isset($_FILES['upimg'])){
		$img_name = $_FILES['upimg']['name'];
		$img_size = $_FILES['upimg']['size'];
		$img_tmp = $_FILES['upimg']['tmp_name'];
		$img_type = $_FILES['upimg']['type'];
		$img_extension = strtolower(end(explode('.',$file_name)));
		$moved = move_uploaded_file($img_tmp,$target_img);
		if($moved){
			echo "The image " . basename($img_name) . "has been uploaded";
		}
		else{
			echo "There was an error, image not uploaded";
		}
	}

	//***********************************//
	//********** START UPLOAD ***********//
	//***********************************//

	//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
	$target_dir = "/var/www/html/disp_form/programs/";
	$target_file = $target_dir . $id;

	if(isset($_FILES['upfile'])){
		$file_name = $_FILES['upfile']['name'];
		$file_size = $_FILES['upfile']['size'];
		$file_tmp = $_FILES['upfile']['tmp_name'];
		$file_type = $_FILES['upfile']['type'];
		$file_extension = strtolower(end(explode('.',$file_name)));
		$moved = move_uploaded_file($file_tmp,$target_file);
		if($moved){
			echo "The file " . basename($file_name) . "has been uploaded" . "\n";
		}
		else{
			echo "There was an error, file not uploaded";
		}
	}

	echo "<h1> Upload ok! </h1>";
}else{
	echo "<h1> You are not Allowed </h1>";
}
?>