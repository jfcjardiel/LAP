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
$sql = "SELECT * FROM dispositivo WHERE id_dispositivo=" . $id;
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

//Show the results
while ($dispositivo = $result->fetch_assoc()) {
    //it is exibitig the line.
    echo $dispositivo['nome_dispositivo'];
}1

//we should close the connection
$mysqli->close();
?>