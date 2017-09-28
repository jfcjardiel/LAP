<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<html>
<?php if (login_check($mysqli) == true) : ?>
<head>
</head>
<body>
<?php
//Starting connection
$mysqli = new mysqli('localhost', 'root', 'input212', 'input');

//If there is any error, then show...
if ($mysqli->connect_errno) {
    // I do not know what to show yet
    echo "<option value=''>Connection Problem</option>";
    exit;
}

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM dispositivo WHERE mostrar_dispositivo=TRUE ORDER BY id_dispositivo";
if (!$result = $mysqli->query($sql)) {
    // I do not know what to show yet
    echo "<option value=''>Connection Problem</option>";
    exit;
}

// If there is no result
if ($result->num_rows === 0) {
    // I do not know what to show yet
    echo "<option value=''>Connection Problem</option>";
    exit;
}

//Show the results
while ($dispositivo = $result->fetch_assoc()) {
    //it is exibitig the line.
    echo "<option value='" . $dispositivo['id_dispositivo'] . "'>".$dispositivo['nome_dispositivo']."</option>";
}

//we should close the connection
$mysqli->close();
?>
</body>
<html>