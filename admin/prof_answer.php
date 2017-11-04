<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

<?php
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


echo "<h1> Upload ok! </h1>";

echo "<a href='edit_professor.php'>GO BACK</a>";

//we should close the connection
$mysqli_information->close();
?>
<?php else : ?>
<?php endif; ?>