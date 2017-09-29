<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

<?php
// get the q parameter from URL
$id = $_REQUEST["id"] + 0;
//echo $id;

//*******************************//
//***** READING DATABSE *********//
//*******************************//

//Starting connection
$mysqli_disp = new mysqli('localhost', 'root', 'input212', 'input');

//If there is any error, then show...
if ($mysqli_disp->connect_errno) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//If there isnt any error, then lets read the sql content
$sql = "SELECT nome_dispositivo FROM dispositivo WHERE id_dispositivo=" . $id;
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

//pegando o nome do dispositivo
$nome_row = $result->fetch_assoc();
$nome_dispositivo = $nome_row['nome_dispositivo'];

//*******************************//
//******* PUTTING IMAGE *********//
//*******************************//

//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir_img = "/var/www/html/disp_form/img/";
$target_img_server = $target_dir_img . $id . ".jpg";
$target_img = "../disp_form/img/". $id . ".jpg";

if(file_exists($target_img_server)){
    echo '<img alt="img" src="'.$target_img.'">';
}

//*******************************//
//***** INICIALIZE FORM *********//
//*******************************//

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM config_dispositivo_atributos  WHERE id_dispositivo=" . $id;
if (!$result = $mysqli_disp->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

// If there is no result
if ($result->num_rows === 0) {
    // I do not know what to show yet
    echo "<p>Connection Problem <p>";
    exit;
}

//Writing the form
echo "<form method='post' attribute='post' id='mod_disp' name='mod_disp'>"; //onsubmit='return validateForm()'>";


//editing name
echo "<p> Tools Name: </p>";
//echo $nome_dispositivo;
echo "<input type='text' id='disp_name' name='nome_dispositivo' placeholder=' ". $nome_dispositivo ."'><br>";

echo '<input type="checkbox" name="show_dispositivo" value="yes" id="show_dispositivo"> Show Tool<br>';

echo "<h3>Tool Configuration </h3>";

$id_input = 0;
//Writing the form options
while ($config_dispositivo = $result->fetch_assoc()) {
    //it is exibitig the line.
    echo "<input type='text' id='" . $id_input . "' name='" . $config_dispositivo['id_config'] . "' placeholder='". $config_dispositivo['nome_atributo'] ."'><br>";
    $id_input = $id_input + 1;
}

//writting submit button
//we are going to send the id of the form via the function validateFom.
echo "<button type='button' name='button_submit' id='button_submit' value='button_submit' onclick='sendForm(" . $id .")'>Change</button>";

//we should close the connection
$mysqli_disp->close();
?>
<?php else : ?>
<?php endif; ?>