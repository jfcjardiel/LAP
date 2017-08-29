<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Answer:</title>
</head>
<body>
<p>A razao eh:
<?php
//Usando DATABASE
//inicializando a database
$servername = "localhost";
$username = "root";
$password = "input212";
$dbname = "input";
//criando conexao com a database
$conn = mysql_connect($servername, $username, $password);
//checando a conexao com a database
if(!$conn){
	die("Connection failed: " . mysql_error());
}
//entrando na database chamada input
$mydb = mysql_select_db($dbname);
if(!$mydb){
	die('Could not connect to database: ' . mysql_error());
}

////USANDO APENAS ARQUIVO
//$myfile = fopen("/var/www/html/html_tudo/test", "w");

//lendo os parametros
$impedancia = $_POST['impedancia'] + 0;
$permissividade = $_POST['permissividade'] + 0;

////Usando em caso de arquivo de texto
//fwrite($myfile, $impedancia);
//fwrite($myfile, " ");
//fwrite($myfile, $permissividade);
//fclose($myfile);

if($_POST['group1'] == 'microfita'){
//escrevendo na database
mysql_query("INSERT INTO microfita (id, impedancia, permissividade) VALUES (NULL, '$impedancia', '$permissividade')");
$output = shell_exec('wolfram -script /home/jardiel/Documents/microfita');
echo "<pre>$output</pre>";
}
else{
echo "Nao funcionou";
}
// Isso embaixo foi um teste, desconsiderar
//$test = "oi $impedancia";
//echo $test;
?>
</p>
</body>
</html>
