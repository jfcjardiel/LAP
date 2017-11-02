<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

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
$email_prof = $prof_row['email_prof'];

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

if($show_professor == true){
    echo '<input type="radio" name="show_professor" value="yes" checked> Show Tool<br><input type="radio" name="show_professor" value="no"> Not show<br>';
}else{
    echo '<input type="radio" name="show_professor" value="yes"> Show Tool<br><input type="radio" name="show_professor" value="no" checked> Not show<br>';
}

//editing email
echo "<p> Email: </p>";
//echo $nome_dispositivo;
echo "<input type='text' name='email_prof' placeholder=' ". $email_prof ."' maxlength='30'><br>";

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
$num_articles = $result->num_rows;

//lets put a place to to add
echo "<textarea cols='60' rows='4' name='". $num_articles+1 ."' placeholder='New Reference'></textarea>";

// If there is no result
if ($num_articles > 0) {
    $id_article = $num_articles;
    //Writing the form options
    while ($config_dispositivo = $result->fetch_assoc()) {
        //it is exibitig the line.
        echo "<a>" . $id_article . "</a><textarea cols='30' rows='4' name='". $id_article ."' placeholder='New Reference'></textarea>";
        $id_article = $id_article - 1;
    }
    //writting submit button
    //we are going to send the id of the form via the function validateFom.
    echo '<button type="submit" name="change_prof" id="change_prof" value="change_prof">Change Information</br></button> </form>';
}

//we should close the connection
$mysqli_information->close();
?>
<?php else : ?>
<?php endif; ?>