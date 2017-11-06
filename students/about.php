<?php

//getting professor
if(isset($_REQUEST["id_std"])){
  $id_std = $_REQUEST["id_std"];
}else{
  echo "<h1> Connection Problem </h1>";
  exit;
}

//*******************************//
//***** READING DATABSE *********//
//*******************************//

//Starting connection
$mysqli_information = new mysqli('localhost', 'root', 'input212', 'information');

//If there is any error, then show...
if ($mysqli_information->connect_errno) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM students WHERE id_std=" . $id_std;
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

// If there is no result (don't apply in this case)
if ($result->num_rows === 0) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//pegando o nome do professor
$std_row = $result->fetch_assoc();
$name_std = $std_row['name_std'];
$about_std = $prof_row['about_std'];

?>

<html>

<head>
  <meta charset="utf-8">
  <title><?php echo $name_std; ?></title>
  <style type="text/css">
    <!--
    .style15 {
    	font-size: 12.0pt;
    	font-weight: bold;
    	font-style: italic;
    }
    .style10 {font-size: 12px}
    .style12 {color: #804000}
    .style13 {color: #8C4600}
    .style14 {color: #8C4600;
    	font-size: 12px;
    	font-weight: bold;
    }
    .style17 {font-size: 14px}
    -->
  </style>
</head>

<body bgcolor="#FFFFFF">

<p align="center">
<p align="center"><font SIZE="4" COLOR="#003366" FACE="Arial,Helvetica,sans-serif"><b><u><?php echo $name_std; ?></u></b></font>
<p align="center">
<table border="0" width="77%">
  <tr>
    <td width="23%">
    <p align="center"><img border="0" src=<?php echo "'"; echo "../img/std/".$id_std.".jpg"; echo "'"; ?> width="170" height="193"></td>
    <td width="77%">
      <p align="justify">&nbsp;</p>
      <p align="justify">
        <span class="style15" style="font-family: &quot;Times New Roman&quot;"><?php echo $name_std; ?></span>
          <span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:PT-BR;mso-fareast-language:PT-BR;mso-bidi-language:AR-SA"> <?php echo $about_std; ?></span></p>
  </tr>
</table>

<p align="justify"><font face="Arial"><br><font SIZE="3" COLOR="#003366"><b>Publicações</b></font></font>:</p>

<table width="844" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="0" valign="top" class="style14">&nbsp;</td>
    <td height="0" align="center" valign="top" class="style17">&nbsp;</td>
    <td height="0" valign="top">&nbsp;</td>
  </tr>
<?php

?>
</table>
<p align="justify">&nbsp;</p>
<p align="justify">&nbsp;</p>
<p align="justify">&nbsp;</p>
</body>

</html>
