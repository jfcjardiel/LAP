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

// get the q parameter from URL
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

//******************************************//
//********** CHANGING PROFESSORS ***********//
//******************************************//

//updating name_prof
if(isset($_POST["name_prof"])) {
    if($_POST["name_prof"] != ""){
        $sql_write = "UPDATE professors SET name_prof='". $_POST["name_prof"] ."' WHERE id_prof=".$id_prof;
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

//updating show_professor
if(isset($_POST["show_professor"])){
    if($_POST["show_professor"] == "yes"){
        $sql_write = "UPDATE professors SET show_professor=TRUE WHERE id_prof=".$id_prof;
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
    if($_REQUEST["show_professor"] == "no"){
        $sql_write = "UPDATE professors SET show_professor=FALSE WHERE id_prof=".$id_prof;
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

//updating email_prof
if(isset($_POST["email_prof"])) {
    if($_POST["email_prof"] != ""){
        $sql_write = "UPDATE professors SET email='". $_POST["email_prof"] ."' WHERE id_prof=".$id_prof;
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

//updating about_prof
if(isset($_POST["about_prof"])) {
    if($_POST["about_prof"] != ""){
        $sql_write = "UPDATE professors SET about_prof='". $_POST["about_prof"] ."' WHERE id_prof=".$id_prof;
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

echo "<h1> Upload ok! </h1>";

echo "<a href='edit_professor.php'>GO BACK</a>";

//we should close the connection
$mysqli_information->close();
?>
<?php else : ?>
<?php endif; ?>