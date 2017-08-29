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
$f = $_POST['f'] + 0;
$l1 = $_POST['l1'] + 0;
$w = $_POST['w'] + 0;
$h = $_POST['h'] + 0;
$er = $_POST['er'] + 0;
$tgd = $_POST['tagd'] + 0;
$x0 = $_POST['x0'] + 0;
$y0 = $_POST['y0'] + 0;

////Usando em caso de arquivo de texto
//fwrite($myfile, $impedancia);
//fwrite($myfile, " ");
//fwrite($myfile, $permissividade);
//fclose($myfile);

if($_POST['group1'] == 'cavidade_3_paredes'){
//escrevendo na database
mysql_query("INSERT INTO cavidade_3_paredes (id, f, L1, W, h, er, tgd, x0, y0) VALUES (NULL, '$f', '$l1', '$w', '$h', '$er', '$tgd', '$x0', '$y0')");
$output = shell_exec('wolfram -script /home/jardiel/Documents/cavidade3paredes');
echo "<pre>$output</pre>";
}
else{
echo "Nao funcionou";
}
// Isso embaixo foi um teste, desconsiderar
//$test = "oi $impedancia";
//echo $test;
?>
<img src="/home/jardiel/primeiro.jpg" alt="primeiro">
<img src="/home/jardiel/segundo.jpg" alt="segundo">

</p>
</body>
</html>
