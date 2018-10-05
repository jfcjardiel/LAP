<?php
$id = 1;
$num_fotos = 40;
//criando o upload  -> o arquivo vai ter o nome do dispositivo na pasta disp_form
$target_dir_img = "/var/www/html/gallery/gallery_people/";

while($id < $num_fotos){
    $target_img_server = $target_dir_img . $id . ".JPG";
    $target_img = "gallery/gallery_people/". $id . ".JPG";
    if(file_exists($target_img_server)){
        echo '<a href="'.$target_img.'" title="This is Title"><img class="gallery_img" src="'.$target_img.'" alt="img" /><span class="view_btn">View</span></a>';
    }
    $id = $id+1;
}
?>