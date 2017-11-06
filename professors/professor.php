<?php

//getting professor
if(isset($_REQUEST["id_prof"])){
  $id_prof = $_REQUEST["id_prof"];
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
$sql = "SELECT * FROM professors WHERE id_prof=" . $id_prof;
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
$prof_row = $result->fetch_assoc();
$name_prof = $prof_row['name_prof'];
$show_prof = $prof_row['show_professor'];
$email_prof = $prof_row['email'];
$about_prof = $prof_row['about_prof'];

?>

<html>

<head>
  <meta charset="utf-8">
  <title><?php echo $name_prof; ?></title>
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
<p align="center"><font SIZE="4" COLOR="#003366" FACE="Arial,Helvetica,sans-serif"><b><u><?php echo $name_prof; ?></u></b></font>
<p align="center">
<table border="0" width="77%">
  <tr>
    <td width="23%">
    <p align="center"><img border="0" src=<?php echo "'"; echo "../img/professor/".$id_prof.".jpg"; echo "'"; ?> width="170" height="193"></td>
    <td width="77%">
      <p align="justify">&nbsp;</p>
      <p align="justify">
        <span class="style15" style="font-family: &quot;Times New Roman&quot;"><?php echo $name_prof; ?></span>
          <span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:PT-BR;mso-fareast-language:PT-BR;mso-bidi-language:AR-SA"> <?php echo $about_prof; ?></span></p>
      <p align="center"><font SIZE="3" COLOR="#003366" face="Arial"><b>Curriculum Vitae</b></font>
  </tr>

</table>
<p align="justify"><font face="Arial"><br>
<font SIZE="3" COLOR="#003366"><b>Publicações
na área</b></font></font>:</p>
<table width="841" height="0" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="0" valign="top">&nbsp;</td>
    <td height="0" valign="top" class="style14">&nbsp;</td>
    <td height="0" align="center" valign="top" class="style10">&nbsp;</td>
    <td height="0" valign="top" class="style17">&nbsp;</td>
  </tr>
<?php

//********************************//
//***** READING ARTICLES *********//
//********************************//

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM articles WHERE id_prof=" . $id_prof . " ORDER BY year DESC";
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//getting the number of articles
$num_articles = $result->num_rows;
$art_year = 0;

if ($num_articles > 0) {
    //Writing the form options
    while ($config_dispositivo = $result->fetch_assoc()) {
        //it is exibitig the line.
        echo "<tr>
              <td height='0' valign='top'>&nbsp;</td>
              <td height='0' valign='top' class='style14'>";
        if($art_year != $config_dispositivo['year']){
          echo $config_dispositivo['year'];
          $art_year = $config_dispositivo['year'];
        }else{
          echo "&nbsp;";
        }
        echo '</td><td height="0" align="center" valign="top" class="style10">['.$num_articles.']</td><td height="0" valign="top" class="style17">';
        echo $config_dispositivo['reference'];
        echo  '</textarea></td></tr>';
        $num_articles = $num_articles - 1;
    }
}

?>
</table>
<p align="justify">&nbsp;</p>
<p align="justify">&nbsp;</p>
<p align="justify">&nbsp;</p>
</body>

</html>
