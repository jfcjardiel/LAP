<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Answer:</title>
    <!-- Javascript Files
    ================================================== -->

    <!-- initialize jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Preloader js file -->
    <script src="js/queryloader2.min.js" type="text/javascript"></script>
    <!-- For smooth animatin  -->
    <script src="js/wow.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="js/slick.min.js"></script>
    <!-- superslides slider -->
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.animate-enhanced.min.js"></script>
    <script src="js/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- for circle counter -->
    <script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
    <!-- Gallery slider -->
    <script type="text/javascript" language="javascript" src="js/jquery.tosrus.min.all.js"></script>

    <!-- Custom js-->
    <script src="js/custom.js"></script>
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

////CRIANDO ARQUIVO
//$myfile = fopen("/var/www/html/cavidade_3_paredes/fig/sample", "w");

//lendo os parametros
$f = $_POST['f'] + 0;
$l1 = $_POST['l1'] + 0;
$w = $_POST['w'] + 0;
$h = $_POST['h'] + 0;
$er = $_POST['er'] + 0;
$tgd = $_POST['tgd'] + 0;
$x0 = $_POST['x0'] + 0;
$y0 = $_POST['y0'] + 0;

//Utilizando o parâmetro para se conseguir o ID
$id = 0;

////Usando em caso de arquivo de texto
//fwrite($myfile, $impedancia);
//fwrite($myfile, " ");
//fwrite($myfile, $permissividade);

//fclose($myfile);

if($_POST['group1'] == 'cavidade_3_paredes'){
//escrevendo na database
mysql_query("INSERT INTO cavidade_3_paredes (id, f, L1, W, h, er, tgd, x0, y0) VALUES (NULL, '$f', '$l1', '$w', '$h', '$er', '$tgd', '$x0', '$y0')");
$id = mysql_query("SELECT id FROM cavidade_3_paredes ORDER BY id DESC LIMIT 1");
////CRIANDO ARQUIVO
$myfile = fopen("/var/www/html/cavidade_3_paredes/fig/sample", "w");
$output = shell_exec('rm /var/www/html/cavidade_3_paredes/fig/sample');
echo "<pre>$output</pre>";
}
else{
echo "Nao funcionou";
}
// Isso embaixo foi um teste, desconsiderar
//$test = "oi $impedancia";
//echo $test;
?>
<div id="loading">
	<img src="/home/jardiel/Documents/cavidade_3_paredes/primeiro.jpg" alt="primeiro">
	<img src="/home/jardiel/Documents/cavidade_3_paredes/segundo.jpg" alt="segundo">
</div>
</p>
</body>
</html>
