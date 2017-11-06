<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

<html>

<head>
<style type="text/css">
<!--
.style10 {font-size: 12px}
.style12 {color: #804000}
.style13 {color: #8C4600}
.style14 {  color: #8C4600;
    font-size: 12px;
    font-weight: bold;
}
.style15 {font-size: 14px}
-->
</style>
</head>

<body bgcolor="#FFFFFF">
<?php
// get the q parameter from URL
$id_prof = $_REQUEST["id_prof"] + 0;
//echo $id;

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

//*******************************//
//******* PUTTING IMAGE *********//
//*******************************//

//colocando a imagem
$target_dir_img = "/var/www/html/img/professor/";
$target_img_server = $target_dir_img . $id_prof . ".jpg";
$target_img = "../img/professor/". $id_prof . ".jpg";

if(file_exists($target_img_server)){
    echo '<img alt="img" src="'.$target_img.'">';
}

//*******************************//
//***** INICIALIZE FORM *********//
//*******************************//

//Writing the form
echo '<form method="post" attribute="post" action="prof_answer.php?id_prof=' . $id_prof . '" enctype="multipart/form-data" id="mod_disp" name="mod_disp">';

//editing name
echo "<p> Professor Name: </p>";
//echo $nome_dispositivo;
echo "<input type='text' name='name_prof' placeholder=' ". $name_prof ."' maxlength='30'><br>";

if($show_prof == true){
    echo '<input type="radio" name="show_professor" value="yes" checked> Professor Active <br><input type="radio" name="show_professor" value="no"> Former Professor <br>';
}else{
    echo '<input type="radio" name="show_professor" value="yes"> Professor Active <br><input type="radio" name="show_professor" value="no" checked> Former Professor <br>';
}

//editing email
echo "<p> Email: </p>";
//echo $nome_dispositivo;
echo "<input type='text' name='email_prof' placeholder=' ". $email_prof ."' maxlength='30'><br>";

echo "<p>About the professor: </p>";
echo '<textarea cols="60" rows="10" placeholder="' . $about_prof . '" name="about_prof"></textarea>';

echo "<h3>Articles: </h3>";

//Reading database!

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM articles WHERE id_prof=" . $id_prof . " ORDER BY year DESC";
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//the number of articles is the result of the research
$num_articles = $result->num_rows + 1;

//lets put a place to to add

echo '<table width="846" border="0" cellpadding="0" cellspacing="0">';

echo '<tr>
    <td height="0" valign="top">&nbsp;</td>
    <td height="0" valign="top" class="style14"><input type="text" id="disp_name" name="year'. $num_articles .'" placeholder="year" maxlength="20"><br></td>
    <td height="0" align="center" valign="top" class="style10">['.$num_articles.']</td>
    <td height="0" valign="top" class="style15"><textarea cols="60" rows="4" placeholder="New Reference" name="art' . $num_articles .'"></textarea></td>
    <td height="0" valign="top" class="style15">
        <select name="art_option' . $num_articles .'">
          <option value="1">Revista</option>
          <option value="2">Conferencia</option>
          <option value="3">Livro</option>
        </select></td>
    <td height="0" valign="top" class="style15"><input type="checkbox" name="art_group' . $num_articles .'" value="True"></td>
    </tr>';

// If there is no result
if ($num_articles > 1) {
    $num_articles = $num_articles - 1;
    //Writing the form options
    while ($config_dispositivo = $result->fetch_assoc()) {
        //it is exibitig the line.
        echo '<tr>
            <td height="0" valign="top">&nbsp;</td>
            <td height="0" valign="top" class="style14"><input type="text" id="disp_name" name="year'. $num_articles .'" placeholder="'. $config_dispositivo['year'] .'"maxlength="20"><br></td>
            <td height="0" align="center" valign="top" class="style10">['.$num_articles.']</td>
            <td height="0" valign="top" class="style15"><textarea cols="60" rows="4" placeholder="' . $config_dispositivo['reference'] . '" name="art' . $num_articles .'"></textarea></td>
            <td height="0" valign="top" class="style15">
                <select name="art_option' . $num_articles .'">
            <option value="1" ';
        if($config_dispositivo['art_magazine']){
            echo 'selected';
        }
        echo '>Revista</option><option value="2" ';
        if($config_dispositivo['art_conference']){
            echo 'selected';
        }        
        echo '>Conferencia</option><option value="3" ';
        if($config_dispositivo['art_book']){
            echo 'selected';
        }
        echo '>Livro</option></select></td><td height="0" valign="top" class="style15"><input type="checkbox" name="art_group' . $num_articles .'" value="True" '
        if($config_dispositivo['art_group']){
            echo 'checked';
        }
        echo '></td></tr>';
        $num_articles = $num_articles - 1;
    }
    //writting submit button
    //we are going to send the id of the form via the function validateFom.
}

echo "</table>";
echo '<button type="submit" name="change_prof" id="change_prof" value="change_prof">Change Information</br></button> </form>';


//we should close the connection
$mysqli_information->close();
?>
</body>
</html>
<?php else : ?>
<?php endif; ?>