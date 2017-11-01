<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

<?php
//getting 
$id_dispositivo = $_REQUEST["id_dispositivo"] + 0;
//echo $id_dispositivo;

//***********************************//
//******** START CONNECTION *********//
//***********************************//

//Starting connection
$mysqli_disp = new mysqli('localhost', 'root', 'input212', 'input');

//If there is any error, then show...
if ($mysqli_disp->connect_errno) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

//**********************************//
//******** READING DATABSE *********//
//**********************************//

//We are getting all the attributes of the dispositivo
$sql = "SELECT id_config FROM config_dispositivo_atributos WHERE id_dispositivo=" . $id_dispositivo;
if (!$result = $mysqli_disp->query($sql)) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

// If there is no result
if ($result->num_rows === 0) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

//********************************************//
//******** CHANGING CONFIG ATRIBUTOS *********//
//********************************************//
$aux_write = 0;

//em cada id_config vamos escrever o valor relativo em valor_dispositivo_atributos
while ($dispositivo = $result->fetch_assoc()){
    $config_name = "valor".$aux_write;
    if(isset($_REQUEST[$config_name])){
        if($_REQUEST[$config_name] != ""){
            $sql_write = "UPDATE config_dispositivo_atributos SET nome_atributo='". $_REQUEST[$config_name] ."' WHERE id_config=".$dispositivo["id_config"];
            if(!$result_write = $mysqli_disp->query($sql_write)){
                echo "<p>Connection Problem writing</p>";
                exit;
            }
        }
        $aux_write = $aux_write + 1;
    }
}

//********************************************//
//********** CHANGING DISPOSITIVOS ***********//
//********************************************//

if(isset($_REQUEST["nome_dispositivo"])) {
    if($_REQUEST["nome_dispositivo"] != ""){
        $sql_write = "UPDATE dispositivo SET nome_dispositivo='". $_REQUEST["nome_dispositivo"] ."' WHERE id_dispositivo=".$id_dispositivo;
        if(!$result_write = $mysqli_disp->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

if(isset($_REQUEST["show"])){
    if($_REQUEST["show"] == "yes"){
        $sql_write = "UPDATE dispositivo SET mostrar_dispositivo=TRUE WHERE id_dispositivo=".$id_dispositivo;
        if(!$result_write = $mysqli_disp->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
    if($_REQUEST["show"] == "no"){
        $sql_write = "UPDATE dispositivo SET mostrar_dispositivo=FALSE WHERE id_dispositivo=".$id_dispositivo;
        if(!$result_write = $mysqli_disp->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

//**************************************//
//******** UPLOADING NA FIGURA *********//
//**************************************//

//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir_img = "/var/www/html/disp_form/img/";
$target_img = $target_dir_img . $id_dispositivo . ".jpg";

$errors = array();

if(isset($_FILES['upimg'])){
    $img_name = $_FILES['upimg']['name'];
    $img_size = $_FILES['upimg']['size'];
    $img_tmp = $_FILES['upimg']['tmp_name'];
    $img_type = $_FILES['upimg']['type'];
    $img_extension = strtolower(end(explode('.',$file_name)));
    $moved = move_uploaded_file($img_tmp,$target_img);
    if($moved){
    }else{
        echo "<p> There was an error, image not uploaded";
        exit;
    }
}

echo "<h1> Upload ok! </h1>";

echo "<a href='edit_tools.php'>GO BACK</a>";

//we should close the connection
$mysqli_disp->close();
?>
<?php else : ?>
    <h1> You are not Allowed </h1>
<?php endif; ?>