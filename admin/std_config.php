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
$id_std = $_REQUEST["id_std"] + 0;
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

//taking all students informations
$std_row = $result->fetch_assoc();
$name_std = $std_row['name_std'];
$phd = $std_row['phd'];
$year_php = $std_row['year_phd'];
$master = $std_row['master'];
$year_master = $std_row['year_master'];
$grad = $std_row['grad'];
$year_grad = $std_row['year_grad'];
$active = $std_row['active'];
$about_std = $std_row['about_std'];

//*******************************//
//******* PUTTING IMAGE *********//
//*******************************//

//colocando a imagem
$target_dir_img = "/var/www/html/img/std/";
$target_img_server = $target_dir_img . $id_std . ".jpg";
$target_img = "../img/std/". $id_std . ".jpg";

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
            </tr>';
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