<?php
//debug settings
ini_set('display_errors',1);
error_reporting(E_ALL);

// get the q parameter from URL
$id_dispositivo = $_REQUEST["id_dispositivo"] + 0;
//echo $id_dispositivo;

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

//We are getting all the attributes of the dispositivo
$sql = "SELECT * FROM config_dispositivo_atributos WHERE id_dispositivo=" . $id_dispositivo;
if (!$result = $mysqli->query($sql)) {
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
//******** WRITING VALUES ON DATABSE *********//
//********************************************//
$aux_write = 0;

//em cada id_config vamos escrever o valor relativo em valor_dispositivo_atributos
while ($dispositivo = $result->fetch_assoc()){
    $valor_str = "valor" . $aux_write;
    $valor_dispositivo = $_REQUEST[$valor_str]+0;
    $id_config = $dispositivo["id_config"];
    $sql_write = "INSERT INTO valor_dispositivo_atributos (id_valor, id_config, jaleu, valor, email) VALUES (NULL, " . $id_config . " , FALSE ," . $valor_dispositivo . " , 'jfcjardiel@gmail.com')";
    if(!$result_write = $mysqli->query($sql_write)){
        echo "<h2 class='blog_title'>Connection Problem writing</h2>";
        exit;
    }
    $aux_write = $aux_write + 1;
}

//********************************************//
//********** EXECUTING MATHEMATICA ***********//
//********************************************//

//We are getting the name of dispositivo from dispositivo_id
$sql = "SELECT * FROM dispositivo  WHERE id_dispositivo=" . $id_dispositivo;
if (!$result = $mysqli->query($sql)) {
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

//executing mathematica
$dispositivo = $result->fetch_assoc();

$order = "wolfram -script " . $dispositivo["nome_dispositivo"];
$output = shell_exec($order);

echo "<pre> $output </pre>";

//we should close the connection
$mysqli->close();
?>