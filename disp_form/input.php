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
    $nome_dispositivo = $dispositivo['nome_dispositivo'];
    echo "<h2 class='blog_title'> Selected Tool: " . $dispositivo['nome_dispositivo'] . '</h2>';
}

//*******************************//
//******* PUTTING IMAGE *********//
//*******************************//

//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir_img = "disp_form/img/";
$target_img = $target_dir_img . $nome_dispositivo . $id . ".jpg";

if(file_exists($target_img)){
    echo '<img alt="img" src="'.$target_img.'">';
}

//*******************************//
//***** INICIALIZE FORM *********//
//*******************************//

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

//Writing the form
echo "<form method='post' attribute='post' id='form_dispositivo' name='form_dispositivo'>"; //onsubmit='return validateForm()'>";


//adding e-mail input form
echo "<p class='blog_summary'>E-mail (If the simulation take too much time, we are going to send an email with the results)<br><input class='blog_summary' type='text' id='email' name='email'></p>";

//O id eh simplesmente comecado de 0 ate o tamanho da form
//O name eh o id_config porque sera acessado de outro lugar
$id_input = 0;

//making a table.
echo '<table class="table table-striped course_table"><thead><tr><th>Variable Name</th><th>Variable Input</th></tr></thead><tbody>';

//Writing the form options
while ($config_dispositivo = $result->fetch_assoc()) {
    //it is exibitig the line.
    echo '<tr>';
    echo '<td>' . $config_dispositivo['nome_atributo'] . '</td>';
    echo "<td><input type='text' id='" . $id_input . "' name='" . $config_dispositivo['id_config'] . "'></td>";
    echo '</tr>';
    $id_input = $id_input + 1;
}

echo '</tbody></table>';

//writting submit button
//we are going to send the id of the form via the function validateFom.
echo "<button type='button' name='button_submit' id='button_submit' value='button_submit' onclick='validateForm(" . $id .")'>Calculate</button>";

//we should close the connection
$mysqli->close();
?>