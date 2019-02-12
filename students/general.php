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

//getting phd results
$sql = "SELECT * FROM students WHERE phd=TRUE ORDER BY year_phd DESC";
if (!$result_phd = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//getting master results
$sql = "SELECT * FROM students WHERE master=TRUE ORDER BY year_master DESC";
if (!$result_master = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//getting graduation results
$sql = "SELECT * FROM students WHERE grad=TRUE ORDER BY year_grad DESC";
if (!$result_grad = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem </p>";
    exit;
}

//*************************************//
//******* BUILDING THE TABLES *********//
//*************************************//

echo "<h2> OUR STUDENTS </h2>";
  
//building PHD tables
if ($result_phd->num_rows === 0) {
}else{
  echo '<table class="table table-striped course_table">
        <thead>
          <tr>          
            <th>PHD STUDENTS</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>';
  while($std_row = $result_phd->fetch_assoc()){
    //taking all students informations
    $id_std = $std_row["id_std"];
    $name_std = $std_row['name_std'];
    $year_phd = $std_row['year_phd'];
    $active = $std_row['active'];
    echo '<tr>';
    // echo '<td><a href="students/about.php?id_std='.$id_std.'">'.$name_std.'</td>';
	echo '<td><a href="student.php?id_std='.$id_std.'">'.$name_std.'</td>';
    echo '<td>'.$year_phd.'</td>';
    if($active){
      echo '<td>CURRENTLY STUDENT</td>';
    }else{
      echo '<td></td>';
    }
    echo '</tr>';
  }
  echo '</tbody></table><br>';
}

//building master tables
if ($result_master->num_rows === 0) {
}else{
  echo '<table class="table table-striped course_table">
        <thead>
          <tr>          
            <th>MASTER STUDENTS</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>';
  while($std_row = $result_master->fetch_assoc()){
    //taking all students informations
    $id_std = $std_row["id_std"];
    $name_std = $std_row['name_std'];
    $phd = $std_row['phd'];
    $year_master = $std_row['year_master'];
    $active = $std_row['active'];
    echo '<tr>';
    // echo '<td><a href="students/about.php?id_std='.$id_std.'">'.$name_std.'</td>';
	echo '<td><a href="student.php?id_std='.$id_std.'">'.$name_std.'</td>';
    echo '<td>'.$year_master.'</td>';
    if($active && !$phd){
      echo '<td>CURRENTLY STUDENT</td>';
    }else{
      echo '<td></td>';
    }
    echo '</tr>';
  }
  echo '</tbody></table><br>';
}

//building master tables
if ($result_grad->num_rows === 0) {
}else{
  echo '<table class="table table-striped course_table">
        <thead>
          <tr>          
            <th>GRADUATION STUDENTS</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>';
  while($std_row = $result_grad->fetch_assoc()){
    //taking all students informations
    $id_std = $std_row["id_std"];
    $name_std = $std_row['name_std'];
    $phd = $std_row['phd'];
    $master = $std_row['master'];
    $year_grad = $std_row['year_grad'];
    $active = $std_row['active'];
    echo '<tr>';
    // echo '<td><a href="students/about.php?id_std='.$id_std.'">'.$name_std.'</td>';
	echo '<td><a href="student.php?id_std='.$id_std.'">'.$name_std.'</td>';
    echo '<td>'.$year_grad.'</td>';
    if($active && !$phd && !$master){
      echo '<td>CURRENTLY STUDENT</td>';
    }else{
      echo '<td></td>';
    }
    echo '</tr>';
  }
  echo '</tbody></table><br>';
}

?>