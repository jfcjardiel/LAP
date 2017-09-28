<?php
//getting 
$id_dispositivo = $_REQUEST["id_dispositivo"] + 0;
//echo $id_dispositivo;

//get email
$email = $_REQUEST["email"];

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
    $sql_write = "INSERT INTO valor_dispositivo_atributos (id_valor, id_config, id_dispositivo, jaleu, valor, email) VALUES (NULL, " . $id_config . " , " . $id_dispositivo . ", FALSE ," . $valor_dispositivo . " , '" . $email . "')";
    if(!$result_write = $mysqli->query($sql_write)){
        echo "<h2 class='blog_title'>Connection Problem writing</h2>";
        exit;
    }
    $aux_write = $aux_write + 1;
}

//getting the id_valor 

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

//Criando o arquivo na pasta watch para o watchdog perceber a criacao e executar o mathematica
$dispositivo = $result->fetch_assoc();

//THIS PART IS WHEN WE TRY TO EXECUTE SHELL_EXEC
//$order = "wolfram -script ./programs/" . $dispositivo["nome_dispositivo"] . $id_dispositivo;
//$output = exec($order);
//echo $output;

//deleting if there is the same
//$shell_command_delete = "rm -f " . $image_result_server;
//exec($shell_command_delete);

//creating the file flag to watch execute mathematica
$file_flag = "/var/www/html/disp_form/watch/" . $id_dispositivo;
$handle = fopen($file_flag, 'w') or die('Cannot open file:  '.$file_flag);
fwrite($handle, "Jardiel");
fclose($handle);


//********************************************//
//************* ExIBITING RESULT *************//
//********************************************//

//Vai mover a imagem gerada e fazer uma imagem unica, ja que o time eh esperado que gere algo unico
$email_result = explode("@", $email, 2);
$image_result_mathematica_server = "/var/www/html/disp_form/results/". $email_result[0] . $id_dispositivo . ".jpg" ;

$id_image = time();
$image_result_server = "/var/www/html/disp_form/results/" . $id_image . ".jpg" ;
$image_result = "disp_form/results/". $id_image . ".jpg" ;

//echo $image_result_server;
//vamos ficar procurando a imagem ate 90s
$aux_time = 0; //we are going to expect a certain amount of time
while(!file_exists($image_result_mathematica_server) && ($aux_time < 30)){
    sleep(3);
    $aux_time = $aux_time + 1;
}

//caso o tempo de 90segundos tenha ultrapassado...
if($aux_time < 30){
    $shell_command = "mv -f " . $image_result_mathematica_server . " " . $image_result_server;
    shell_exec($shell_command);
    echo "<br>";
    //vamos verificar quantos pixels existem... se for muito grande, vamos encaixar no servidor
    //if(getimagesize($image_result_server)[0] > 700){
    //    echo '<img alt="Picture not displayed" class="img-responsive" style="width:100%;height:auto;" src="'.$image_result.'">';
    //}else{
        //se nao for grande, nao vamos encaixar no servidor
        echo '<img alt="Picture not displayed" class="img-responsive" src="'.$image_result.'">';
    //}
}else{
    echo "<h2 class='blog_title'>Not working </h2>";
}

//Estou fazendo isso porque eu nao consigo eliminar o arquivo
//$shell_command = "rm -f " . $file_flag;
//shell_exec($shell_command);

//we should close the connection
$mysqli->close();
?>