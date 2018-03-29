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


//**********************************************************//
//******** PREPARANDO O DOCUMENTO PARA A A LEITURA *********//
//**********************************************************//

if($_FILES['upfile']["error"] == 0){

    //criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
    $target_dir = "/var/www/html/disp_form/programs/";
    $target_file = $target_dir . $id_dispositivo;

    //echo "nome do arquivo: ", $target_file , "\n";
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

    //Conseguinto todas as linhas do cabecalho
    $sql = "SELECT COUNT(*) FROM config_dispositivo_atributos WHERE id_dispositivo=" . $id_dispositivo;
    if (!$result = $mysqli_disp->query($sql)) {
        // I do not know what to show yet
        echo "<p>Connection Problem </p>";
        exit;
    }
    // If there is no result
    if ($result->num_rows === 0) {
        // I do not know what to show yet
        echo "<p>Connection Problem </p>";
        exit;
    }

    //Abrindo o arquivo
    $nome_row = $result->fetch_assoc();
    $num_head = 6 + 2*$nome_row['COUNT(*)']; //esse eh sempre o numero de lihas do cabecalho
    $file = fopen($target_file, "r");

    //o cabecalho sera esse
    $file_head = '';

    $aux = 0;
    while($aux < $num_head){
        $file_head = $file_head . fgets($file) . "\n";
        $aux = $aux + 1;
    }

    //fechando o arquivo
    fclose($file);

    //This is going to test if picture is set. If it is, then it will generae a picture. If not, it will do nothing
    $file_foot = "\n" .'If[ValueQ[picture],Export[StringJoin["/var/www/html/disp_form/results/",user,"'. $id_dispositivo .'",".jpg"], picture],picture=False];' . "\n";

    //CLOSING WHILE
    $file_foot .= '{{variavelLoopEscolhidaPorJardiel' . $id_dispositivo . '}} = SQLExecute[conn, "SELECT COUNT(*) FROM valor_dispositivo_atributos WHERE jaleu=FALSE AND id_dispositivo='. $id_dispositivo .'"]];' . "\n";
    $file_foot .= 'CloseSQLConnection[conn];';

    //**********************************//
    //********** UPLOAD FILE ***********//
    //**********************************//

    $errors = array();
    $file_name = $_FILES['upfile']['name'];
    $file_size = $_FILES['upfile']['size'];
    $file_tmp = $_FILES['upfile']['tmp_name'];
    $file_type = $_FILES['upfile']['type'];
    $file_extension = strtolower(end(explode('.',$file_name)));
    $moved = move_uploaded_file($file_tmp,$target_file);
    echo $file_tmp;
    echo $target_file;
    if(!$moved){
        echo "<p> There was an error, file(filename) not uploaded";
        exit;
    }
    echo "File Uploaded \n";
    //com os dados em maos, basta colocar o arquivo e salvar
    $file_data = $file_head . file_get_contents($target_file) . $file_foot;
    file_put_contents($target_file, $file_data);

}

//**************************************//
//******** UPLOADING NA FIGURA *********//
//**************************************//

//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir_img = "/var/www/html/disp_form/img/";
$target_img = $target_dir_img . $id_dispositivo . ".jpg";

$errors = array();

if($_FILES['upimg']["error"] == 0){
    $img_name = $_FILES['upimg']['name'];
    $img_size = $_FILES['upimg']['size'];
    $img_tmp = $_FILES['upimg']['tmp_name'];
    $img_type = $_FILES['upimg']['type'];
    $img_extension = strtolower(end(explode('.',$file_name)));
    $moved = move_uploaded_file($img_tmp,$target_img);
    if(!$moved){
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