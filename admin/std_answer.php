<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

<?php
//getting 
$id_std = $_REQUEST["id_std"] + 0;

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

//**************************************//
//******** UPLOADING NA FIGURA *********//
//**************************************//

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

//****************************************//
//********** CHANGING STUDENTS ***********//
//****************************************//

//updating name_prof
if(isset($_POST["name_std"])) {
    if($_POST["name_std"] != "")
        $sql_write = "UPDATE students SET name_std='". $_POST["name_std"] ."' WHERE id_std=".$id_std;
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

//updating PHD
if(isset($_POST["phd"])){
    if($_POST["phd"] == "true"){
        $sql_write = "UPDATE students SET phd=TRUE WHERE id_std=".$id_std;
    }else{
        $sql_write = "UPDATE students SET phd=FALSE WHERE id_std=".$id_std;
    }
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}

if(isset($_POST["year_phd"])){
    $sql_write = "UPDATE students SET year_phd='". $_POST["year_phd"] ."' WHERE id_std=".$id_std;
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}

//updating master
if(isset($_POST["master"])){
    if($_POST["master"] == "true"){
        $sql_write = "UPDATE students SET master=TRUE WHERE id_std=".$id_std;
    }else{
        $sql_write = "UPDATE students SET master=FALSE WHERE id_std=".$id_std;
    }
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}

if(isset($_POST["year_master"])){
    $sql_write = "UPDATE students SET year_master='". $_POST["year_master"] ."' WHERE id_std=".$id_std;
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}

//updating grad
if(isset($_POST["grad"])){
    if($_POST["grad"] == "true"){
        $sql_write = "UPDATE students SET grad=TRUE WHERE id_std=".$id_std;
    }else{
        $sql_write = "UPDATE students SET grad=FALSE WHERE id_std=".$id_std;
    }
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}

if(isset($_POST["year_grad"])){
    $sql_write = "UPDATE students SET year_grad='". $_POST["year_grad"] ."' WHERE id_std=".$id_std;
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}

//getting active
if(isset($_POST["std_active"])){
    if($_POST["std_active"] == "true"){
        $sql_write = "UPDATE students SET active=TRUE WHERE id_std=".$id_std;
    }else{
        $sql_write = "UPDATE students SET active=FALSE WHERE id_std=".$id_std;
    }
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}else{
    $sql_write = "UPDATE students SET active=FALSE WHERE id_std=".$id_std;
    if(!$result_write = $mysqli_information->query($sql_write)){
        echo "<p>Connection Problem writing</p>";
        exit;
    }
}

//getting about_std
if(isset($_POST["about_std"])) {
    if($_POST["about_std"] != ""){
        $sql_write = "UPDATE students SET about_std='". $_POST["about_std"] ."' WHERE id_std=".$id_std;
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

echo "<h1> Upload ok! </h1>";

echo "<a href='edit_students.php'>GO BACK</a>";

//we should close the connection
$mysqli_information->close();
?>
<?php else : ?>
<?php endif; ?>