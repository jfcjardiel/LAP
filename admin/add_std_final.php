<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//***********************************//
//******** START CONNECTION *********//
//***********************************//

//Starting connection
$mysqli_information = new mysqli('localhost', 'root', 'input212', 'information');

//If there is any error, then show...
if ($mysqli_information->connect_errno) {
    // I do not know what to show yet
    echo "<h2 class='blog_title'>Connection Problem </h2>";
    exit;
}

//******************************************//
//********** CHANGING PROFESSORS ***********//
//******************************************//

//updating name_prof
if(isset($_POST["name_std"])) {
    if($_POST["name_std"] == ""){
            echo "<p>Problem writing</p>";
            exit;
    }else{
        $name_std = $_POST["name_std"];
    }
}else{
    echo "<p>Problem writing</p>";
    exit;
}

//updating PHD
if(isset($_POST["phd"])){
    if($_POST["phd"] == "true"){
        $phd = "TRUE";
    }else{
        $phd = "FALSE";
    }
    if($_POST["year_phd"] == ""){
        $year_phd = "NULL";
    }else{
        $year_phd = $_POST["year_phd"];
    }
}else{
    $phd = "FALSE";
}

if(isset($_POST["year_phd"])){
    if($_POST["year_phd"] == ""){
        $year_phd= "NULL";
    }
}else{
    $year_phd = "NULL";
}

//updating master
if(isset($_POST["master"])){
    if($_POST["master"] == "true"){
        $master = "TRUE";
    }else{
        $master = "FALSE";
    }
    if($_POST["year_master"] == ""){
        $year_master = "NULL";
    }else{
        $year_master = $_POST["year_master"];
    }
}else{
    $master = "FALSE";
}

if(isset($_POST["year_master"])){
    if($_POST["year_master"] == ""){
        $year_master= "NULL";
    }
}else{
    $year_master= "NULL";
}

//updating grad
if(isset($_POST["grad"])){
    if($_POST["grad"] == "true"){
        $grad = "TRUE";
    }else{
        $grad = "FALSE";
    }
    if($_POST["year_grad"] == ""){
        $year_grad= "NULL";
    }else{
        $year_grad = $_POST["year_grad"];
    }
}else{
    $grad = "FALSE";
}

if(isset($_POST["year_grad"])){
    if($_POST["year_grad"] == ""){
        $year_grad= "NULL";
    }
}else{
    $year_grad= "NULL";
}

//getting active
if(isset($_POST["std_active"])){
    if($_POST["std_active"] == "true"){
        $active = "TRUE";
    }else{
        $active = "FALSE";
    }
}
else{
    $active = "FALSE";
}

//getting about_std
if(isset($_POST["about_std"])) {
    if($_POST["about_std"] == ""){
            echo "<p>Problem writing</p>";
            exit;
    }else{
        $about_std = $_POST["about_std"];
    }
}else{
    $about_std = "";
}

echo $name_std;
echo $phd;
echo $year_phd;
echo $master;
echo $year_master;
echo $grad;
echo $year_grad;
echo $active;
echo $about_std;

/*
$sql_write = "INSERT INTO students (id_std, name_std, php, year_phd, master, year_master, grad, year_grad, active, about_std) VALUES (NULL,".$name_std.",".$phd.",".$year_phd.",".$master.",".$year_master.",".$grad.",".$year_grad.",".$active.",".$about_std.")";
if(!$result_write = $mysqli_information->query($sql_write)){
    echo "<p>Connection Problem writing</p>";
    exit;
}
*/
//**************************************//
//******** UPLOADING NA FIGURA *********//
//**************************************//

//If there isnt any error, then lets read the sql content
$sql = "SELECT id_std FROM students ORDER BY id_std DESC LIMIT 1";
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
$id_std = $std_row['id_std'];

//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir_img = "/var/www/html/img/std/";
$target_img = $target_dir_img . $id_std . ".jpg";

if($_FILES['std_img']["error"] == 0){
    $img_name = $_FILES['std_img']['name'];
    $img_size = $_FILES['std_img']['size'];
    $img_tmp = $_FILES['std_img']['tmp_name'];
    $img_type = $_FILES['std_img']['type'];
    $moved = move_uploaded_file($img_tmp,$target_img);
    if(!$moved){
        echo "<p> There was an error, image not uploaded";
        exit;
    }
}

echo "<h1> Student Registered! </h1>";

echo "<a href='edit_students.php'>GO BACK</a>";

//we should close the connection
$mysqli_information->close();
?>
<?php else : ?>
<?php endif; ?>