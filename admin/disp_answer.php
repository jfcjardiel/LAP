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
//******** WRITING VALUES ON DATABSE *********//
//********************************************//
$aux_write = 0;

if(isset($_REQUEST["nome_dispositivo"])) {
    echo "nome dispositivo";
    echo $_REQUEST["nome_dispositivo"];
}

if(isset($_REQUEST["show"])){
    echo $_REQUEST["show"];
}

//em cada id_config vamos escrever o valor relativo em valor_dispositivo_atributos
$aux = 0;
while ($aux < 30){
    $dispositivo_name = "valor".$aux;
    if(isset($_REQUEST[$dispositivo_name])){
        echo $aux;
    }
    $aux = $aux +1;
}

//we should close the connection
$mysqli_disp->close();
?>