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
//getting 
$id_prof = $_REQUEST["id_prof"] + 0;

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

//***********************************//
//******** READING DATABASE *********//
//***********************************//

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM articles WHERE id_prof=" . $id_prof . " ORDER BY year DESC";
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//the number of articles is the result of the research
$num_articles = $result->num_rows+1;

//***************************************//
//******** INSERT NEW REFERENCE *********//
//***************************************//

$year_art = 'year'.$num_articles;
$ref_art = 'art'.$num_articles;

//echo $_POST[$year_art];
//echo $_POST[$ref_art];

if(isset($_POST[$year_art]) && $_POST[$year_art] != ""){
    if(isset($_POST[$ref_art]) && $_POST[$ref_art] != ""){
        $sql_write = 'INSERT INTO articles (id_art, id_prof, year, reference) VALUES (NULL,'.$id_prof.','.$_POST[$year_art].',"'.$_POST[$ref_art].'")';
        if(!$result_write = $mysqli_information->query($sql_write)){
            echo "<p>Connection Problem writing</p>";
            exit;
        }
    }
}

//*****************************************//
//********** CHANGING REFERENCE ***********//
//*****************************************//

if ($num_articles > 1) {
    $num_articles = $num_articles - 1;
    //em cada id_config vamos escrever o valor relativo em valor_dispositivo_atributos
    while ($articles = $result->fetch_assoc()){
        $year_art = 'year'.$num_articles;
        $ref_art = 'art'.$num_articles;
        if(isset($_POST[$year_art])){
            if($_POST[$year_art] != ""){
                $sql_write = 'UPDATE articles SET year='.$year_art.' WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        if(isset($_POST[$year_art])){
            if($_POST[$year_art] != ""){
                $sql_write = 'UPDATE articles SET reference="'.$ref_art.'" WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
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