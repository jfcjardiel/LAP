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

if(isset($_REQUEST("nome_dispositivo"))){
    echo $_REQUEST("nome_dispositivo");
}

if(isset($_REQUEST("show_dispositivo"))){
    echo $_REQUEST("show_dispositivo");
}

//em cada id_config vamos escrever o valor relativo em valor_dispositivo_atributos
while ($dispositivo = $result->fetch_assoc()){
    $dispositivo_name = $dispositivo("id_config");
    if(isset($_REQUEST($dispositivo_name))){
        echo $_REQUEST($dispositivo_name);
    }
}

//we should close the connection
$mysqli_disp->close();
?>