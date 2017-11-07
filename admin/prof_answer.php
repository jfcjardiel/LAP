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

$group = 'art_group'.$num_articles;
$art_group = "FALSE";
if(isset($_POST[$group])){
    $art_group = "TRUE";
}

$art_option='art_option'.$num_articles;
$art_magazine = "FALSE";
$art_conference = "FALSE";
$art_book = "FALSE";

if(isset($_POST[$art_option])){
    if($_POST[$art_option] == "1"){
        $art_magazine = "TRUE";
    }else if($_POST[$art_option] == "2"){
        $art_conference = "TRUE";
    }else if($_POST[$art_option] == "3"){
        $art_book = "TRUE";
    }
}

//echo $_POST[$year_art];
//echo $_POST[$ref_art];

if(isset($_POST[$year_art]) && $_POST[$year_art] != ""){
    if(isset($_POST[$ref_art]) && $_POST[$ref_art] != ""){
        $sql_write = 'INSERT INTO articles (id_art, id_prof, year, reference, art_group, art_magazine, art_conference, art_book) VALUES (NULL,'.$id_prof.','.$_POST[$year_art].',"'.$_POST[$ref_art].'",'.$art_group.','.$art_magazine.','.$art_conference.','.$art_book.')';
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

        $group = 'art_group'.$num_articles;
        if(isset($_POST[$group])){
            $sql_write = 'UPDATE articles SET art_group=TRUE WHERE id_art='.$articles['id_art'];
            if(!$result_write = $mysqli_information->query($sql_write)){
                echo "<p>Connection Problem writing</p>";
                exit;
            }
        }else{
            $sql_write = 'UPDATE articles SET art_group=FALSE WHERE id_art='.$articles['id_art'];
            if(!$result_write = $mysqli_information->query($sql_write)){
                echo "<p>Connection Problem writing</p>";
                exit;
            }
        }

        $art_option='art_option'.$num_articles;
        if(isset($_POST[$art_option])){
            if($_POST[$art_option] == '1'){
                $sql_write = 'UPDATE articles SET art_magazine=TRUE, art_conference=FALSE, art_book=FALSE WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }else if($_POST[$art_option] == '2'){
                $sql_write = 'UPDATE articles SET art_magazine=FALSE, art_conference=TRUE, art_book=FALSE WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }else if($_POST[$art_option] == '3'){
                $sql_write = 'UPDATE articles SET art_magazine=FALSE, art_conference=TRUE, art_book=FALSE WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        if(isset($_POST[$year_art])){
            if($_POST[$year_art] != ""){
                $sql_write = 'UPDATE articles SET year='.$_POST[$year_art].' WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        if(isset($_POST[$ref_art])){
            if($_POST[$ref_art] != ""){
                $sql_write = 'UPDATE articles SET reference="'.$_POST[$ref_art].'" WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        if(isset($_POST[$art_group])){
            if($_POST[$art_group] != ""){
                $sql_write = 'UPDATE articles SET art_group="'.$_POST[$art_group].'" WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        if(isset($_POST[$art_magazine])){
            if($_POST[$art_magazine] != ""){
                $sql_write = 'UPDATE articles SET art_magazine="'.$_POST[$art_magazine].'" WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        if(isset($_POST[$art_conference])){
            if($_POST[$art_conference] != ""){
                $sql_write = 'UPDATE articles SET art_conference="'.$_POST[$art_conference].'" WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        if(isset($_POST[$art_book])){
            if($_POST[$art_book] != ""){
                $sql_write = 'UPDATE articles SET art_book="'.$_POST[$art_book].'" WHERE id_art='.$articles['id_art'];
                if(!$result_write = $mysqli_information->query($sql_write)){
                    echo "<p>Connection Problem writing</p>";
                    exit;
                }
            }
        }
        $num_articles = $num_articles - 1;
    }
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