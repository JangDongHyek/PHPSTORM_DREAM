<?php

@ini_set('memory_limit', '512M');

$file = '/home/khj/public_html/co_img/khj/'.$img_big;
@$image = imagecreatefromjpeg($file) or die('Error opening file '.$file);

$exif = exif_read_data($file);

if(!empty($exif['Orientation'])) {

    switch($exif['Orientation']) {

        case 8:

           $image = imagerotate($image,90,0);

            break;

        case 3:

            $image = imagerotate($image,180,0);

            break;

        case 6:

           $image = imagerotate($image,-90,0);

            break;

    }

}

header('Content-type: image/jpeg');

imagejpeg($image);

imagedestroy($image);

?>





