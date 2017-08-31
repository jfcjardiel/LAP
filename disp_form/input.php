<?php
// get the q parameter from URL
$id = $_REQUEST["id"] + 0;
//Starting connection
$mysqli = new mysqli('localhost', 'root', 'input212', 'input');

//If there is any error, then show...
if ($mysqli->connect_errno) {
    // I do not know what to show yet
    echo "Connection Problem";
    exit;
}

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM config_dispositivo_atributos  WHERE id_dispositivo=" . $id;
if (!$result = $mysqli->query($sql)) {
    // I do not know what to show yet
    echo "Connection Problem";
    exit;
}

// If there is no result
if ($result->num_rows === 0) {
    // I do not know what to show yet
    echo "Connection Problem";
    exit;
}

//Writing the form
echo "<form method='post' attribute='post' id='form_dispositivo'>";

//Writing the form options
while ($config_dispositivo = $result->fetch_assoc()) {
    //it is exibitig the line.
    echo '<p>' . $config_dispositivo['nome_atributo'] . '<br/>';
    echo "<input type='text' id='" . $config_dispositivo['id_config'] . "' name='" . $config_dispositivo['id_config'] . "'></p>";
}

//writting submit button
echo "<button type='submit' name='button_submit' id='button_submit' value='button_submit'>Calculate</button>";

//we should close the connection
$mysqli->close();
?>