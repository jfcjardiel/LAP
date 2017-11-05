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
$year_phd = $std_row['year_phd'];
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
echo '<form method="post" attribute="post" action="std_answer.php?id_std=' . $id_std . '" enctype="multipart/form-data" id="mod_disp" name="mod_disp">';

//editing name
echo "<p> Student Name: </p>";
//echo $nome_dispositivo;
echo "<input type='text' name='name_std' placeholder=' ". $name_std ."' maxlength='30'><br>";

echo "<p>Students Degree in LAP:</p>";
//phd
if($phd == true){
    echo '<input type="checkbox" name="phd" value="true" checked> Phd Student';
    echo '<input type="text" name="year_phd" placeholder="'.$year_phd.'"><br>';
}else{
    echo '<input type="checkbox" name="phd" value="true"> Phd Student';
    echo '<input type="text" name="year_phd" placeholder="Degree Year"><br>';
}

//master
if($master == true){
    echo '<input type="checkbox" name="master" value="true" checked> Master Student';
    echo '<input type="text" name="year_master" placeholder="'.$year_master.'"><br>';
}else{
    echo '<input type="checkbox" name="master" value="true"> Master Student';
    echo '<input type="text" name="year_master" placeholder="Degree Year"><br>';
}

//graduation
if($grad == true){
    echo '<input type="checkbox" name="grad" value="true" checked> Undergraduate Student';
    echo '<input type="text" name="year_master" placeholder="'.$year_grad.'"><br>';
}else{
    echo '<input type="checkbox" name="grad" value="true"> Undergraduate Student';
    echo '<input type="text" name="year_grad" placeholder="Degree Year"><br>';
}

//about student section
echo "<p>About the student: </p>";
echo '<textarea cols="60" rows="10" placeholder="' . $about_std . '" name="about_std"></textarea><br>';

echo '<p>Here is the IMAGE you are going to upload (JUST JPG):</p><input type = "file" name="std_img" id = "std_img"><br><br>';

echo '<button type="submit" name="change_std" id="change_std" value="change_std">Change Information</br></button> </form>';

//we should close the connection
$mysqli_information->close();
?>
</body>
</html>
<?php else : ?>
<?php endif; ?>