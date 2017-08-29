<?php
include_once 'psl-config.php'; //incluindo a função php do include
$conn_login = mysql_connect(HOST, USER, PASSWORD);
if(!$conn_login){
	die("Connection failed: " . mysql_error());
}
$conn_mysql = mysql_select_db(DATABASE);
if(!$conn_mysql){
	die("Could not connect to database: " . mysql_error());
}
