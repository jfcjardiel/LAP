<?php

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
?>

<h2> OUR ARTICLES </h2>

<table class="table table-striped course_table">
        <thead>
          <tr>          
            <th>Magazines</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>

<?php

//********************************//
//***** READING ARTICLES *********//
//********************************//

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM articles WHERE art_group=TRUE AND art_magazine=TRUE ORDER BY year DESC";
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//getting the number of articles
$num_articles = $result->num_rows;
$art_year = 0;

if ($num_articles > 0) {
    //Writing the form options
    while ($config_dispositivo = $result->fetch_assoc()) {
        //it is exibitig the line.
        echo '<tr><td>';
        if($art_year != $config_dispositivo['year']){
          echo $config_dispositivo['year'];
          $art_year = $config_dispositivo['year'];
        }
        echo "</td>";
        echo '<td>['.$num_articles.']</td><td>';
        echo $config_dispositivo['reference'];
        echo  '</td></tr>';
        $num_articles = $num_articles - 1;
    }
}

?>
</table>

<table class="table table-striped course_table">
        <thead>
          <tr>          
            <th>Conferences</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>

<?php

//********************************//
//***** READING ARTICLES *********//
//********************************//

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM articles WHERE art_group=TRUE AND art_conference=TRUE ORDER BY year DESC";
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//getting the number of articles
$num_articles = $result->num_rows;
$art_year = 0;

if ($num_articles > 0) {
    //Writing the form options
    while ($config_dispositivo = $result->fetch_assoc()) {
        //it is exibitig the line.
        echo '<tr><td>';
        if($art_year != $config_dispositivo['year']){
          echo $config_dispositivo['year'];
          $art_year = $config_dispositivo['year'];
        }
        echo "</td>";
        echo '<td>['.$num_articles.']</td><td>';
        echo $config_dispositivo['reference'];
        echo  '</td></tr>';
        $num_articles = $num_articles - 1;
    }
}

?>
</table>

<table class="table table-striped course_table">
        <thead>
          <tr>          
            <th>Books</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>

<?php

//********************************//
//***** READING ARTICLES *********//
//********************************//

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM articles WHERE art_group=TRUE AND art_book=TRUE ORDER BY year DESC";
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//getting the number of articles
$num_articles = $result->num_rows;
$art_year = 0;

if ($num_articles > 0) {
    //Writing the form options
    while ($config_dispositivo = $result->fetch_assoc()) {
        //it is exibitig the line.
        echo '<tr><td>';
        if($art_year != $config_dispositivo['year']){
          echo $config_dispositivo['year'];
          $art_year = $config_dispositivo['year'];
        }
        echo "</td>";
        echo '<td>['.$num_articles.']</td><td>';
        echo $config_dispositivo['reference'];
        echo  '</td></tr>';
        $num_articles = $num_articles - 1;
    }
}

?>
</table>
?>