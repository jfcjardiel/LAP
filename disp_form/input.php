<?php
$id = _GET['id'];
//Starting connection
$mysqli = new mysqli('localhost', 'root', 'input212', 'input');

//If there is any error, then show...
if ($mysqli->connect_errno) {
    // I do not know what to show yet
    echo "<h2 class="blog_title"><a>Problem in communication with the server. </a></h2>";
    exit;
}

if ($result = $mysqli->prepare("SELECT * 
        FROM config_dispositivo_atributos
        WHERE id_dispositivo = ?
        ORDER BY id_config")) {
        $result->bind_param('s', $id);  // Bind "$id" to parameter.
        $result->execute();    // Execute the prepared query.
        $result->store_result();
}

// If there is no result
if ($result->num_rows == 0) {
    // I do not know what to show yet
    echo "<h2 class="blog_title"><a>Problem in communication with the server. </a></h2>";
    exit;
}

//Writing the form
echo "<form method='post' attribute='post' id='form_dispositivo'>";

//Writing the input form
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