<?php
// get the q parameter from URL
$id = $_REQUEST["id"] + 0;

//*******************************//
//***** READING DATABSE *********//
//*******************************//

//Starting connection
$mysqli = new mysqli('localhost', 'root', 'input212', 'input');

//If there is any error, then show...
if ($mysqli->connect_errno) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

//If there isnt any error, then lets read the sql content
$sql = "SELECT nome_dispositivo FROM dispositivo WHERE id_dispositivo=" . $id;
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

//********************************//
//***** INICIALIZE TITLE *********//
//********************************//


//writing the title
while ($dispositivo = $result->fetch_assoc()) {
    //it is exibitig the line.
    echo "<h2 class='blog_title'> Ferramenta selecionada: " . $dispositivo['nome_dispositivo'] . '</h2>';
}

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM config_dispositivo_atributos  WHERE id_dispositivo=" . $id;
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

//*******************************//
//***** INICIALIZE FORM *********//
//*******************************//

//Writing the form
echo "<form method='post' attribute='post' id='form_dispositivo' name='form_dispositivo' onsubmit='return validateForm()'>";

//O id eh simplesmente comecado de 0 ate o tamanho da form
//O name eh o id_config porque sera acessado de outro lugar
$id_input = 0;

//Writing the form options
while ($config_dispositivo = $result->fetch_assoc()) {
    //it is exibitig the line.
    echo '<p>' . $config_dispositivo['nome_atributo'] . '<br/>';
    echo "<input type='text' id='" . $id_input . "' name='" . $config_dispositivo['id_config'] . "'></p>";
    $id_input = $id_input + 1;
}

//writting submit button
echo "<button type='submit' name='button_submit' id='button_submit' value='button_submit'>Calculate</button>";

//we should close the connection
$mysqli->close();
?>