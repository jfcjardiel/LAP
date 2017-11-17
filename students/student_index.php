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
$sql = "SELECT * FROM students WHERE active=TRUE";
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    exit;
}

//*************************************//
//******* BUILDING THE TABLES *********//
//*************************************//
  
while($std_row = $result->fetch_assoc()){
    //taking all students informations
    $id_std = $std_row["id_std"];
    $name_std = $std_row['name_std'];
    $target_img_server = "/var/www/html/img/std/".$id_std.".jpg";
    $target_img = "/img/std/".$id_std.".jpg";
    echo '<div class="col-lg-3 col-md-3 col-sm-3">
            <div class="single_stsTestimonial wow fadeInUp">';
    if(file_exists($target_img_server)){
      echo '<img class="stsTesti_img" src="'.$target_img.'" alt="img">';
    }else{
      echo '<img class="stsTesti_img" src="img/nophoto.jpg" alt="img">';
    }
    echo '<div class="stsTestimonial_content">';
    echo '<h3>'. $name_std .'</h3>';
    if($std_row['phd']){
      echo '<span>Phd Student</span>';
    }else if($std_row['master']){
      echo '<span>Master Student</span>';
    }else{
      echo '<span>Undergraduate Student</span>';
    }
    echo '</div></div></div>';
}

?>