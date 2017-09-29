<?php
//getting 
$id_dispositivo = $_REQUEST["id_dispositivo"] + 0;

//********************************************//
//******** WRITING VALUES ON DATABSE *********//
//********************************************//
$aux_write = 0;

if(isset($_REQUEST("nome_dispositivo"))) {
    echo $_REQUEST("nome_dispositivo");
}

if(isset($_REQUEST("show"))){
    echo $_REQUEST("show");
}

//em cada id_config vamos escrever o valor relativo em valor_dispositivo_atributos
$aux = 0;
while ($aux < 30){
    $dispositivo_name = "valor".$aux;
    if(isset($_REQUEST($dispositivo_name))){
        echo $_REQUEST($dispositivo_name);
    }
    $aux = $aux +1;
}

//we should close the connection
$mysqli_disp->close();
?>