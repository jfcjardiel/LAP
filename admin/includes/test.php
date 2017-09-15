<?php
define("HOST", "localhost"); //o host que queremos conectar na database
define("USER","sec_user"); //o nome do user
define("PASSWORD", "secuserinput212"); // a senha do usuário!
define("DATABASE", "secure_login"); //o nome da database que vamos querer acessar

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE","member");

define("SECURE", FALSE); //for development only

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

$id = $mysqli->query("SELECT username FROM members");

echo $id;
?>
