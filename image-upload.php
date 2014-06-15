<?php
if(!session_id()) {
    session_start();
}

$upload_dir = "/";
require_once('wordpress/wp-content/plugins/npcdirectory/ImageManipulator.php');

//var_dump($_FILES);

$name = $_FILES['profile_picture']['name'];
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
list($txt, $ext) = explode(".", $name);

if(in_array($ext,$valid_formats)) {
    $name = $_FILES['profile_picture']['name'];
    $actual_image_name = 'profile_' . time();
    //$size = $_FILES['profile_picture']['size'];

    $manipulator = new ImageManipulator($_FILES['profile_picture']['tmp_name']);

    // resizing to 200x200
    $newImage = $manipulator->resample(300, 300);        
    $manipulator->save("../../uploads/profile/" . $actual_image_name.'.'.$ext );
    
    //convert to png
    if($ext != 'png') {
        imagepng(imagecreatefromstring(file_get_contents("../../uploads/profile/" . $actual_image_name.'.'.$ext)), 
                 "../../uploads/profile/" . $actual_image_name.'.png');
    }
    
    //return the filename
    echo $actual_image_name.'.png';
}
?>