<?php
//debug settings
ini_set('display_errors',1);
error_reporting(E_ALL);

$aux_time = 0;
$image_result_server = "/var/www/html/disp_form/results/jfcjardiel1.jpg";
while(!file_exists($image_result_server) && ($aux_time < 30)){
    sleep(1);
    echo file_exists($image_result_server);
    $aux_time = $aux_time + 1;
}

$image_result = "disp_form/results/". $email_result[0] . $id_dispositivo . ".jpg";
if($aux_time < 30){
    echo '<img alt="img" src="'.$image_result.'">';
}else{
    echo "<h2 class='blog_title'>Not working </h2>";
}
?>
