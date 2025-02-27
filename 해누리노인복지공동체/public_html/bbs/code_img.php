<? //code_img.php
session_start();

header("Content-type: image/png");

$scode = (mt_rand(9,18) * mt_rand(10,19));

$im = @imagecreate(60, 22) or die("Cannot Initialize new GD image stream");

$bgcolor = imagecolorallocate($im, 218, 232, 254);

$bgcolor2 = imagecolorallocate($im, 0, 0, 0);

$text_color = imagecolorallocate($im, 1, 103, 150);

ImageFilledRectangle($im,0,0,60,22,$bgcolor2);

ImageFilledRectangle($im,1,1,58,20,$bgcolor);

imagestring($im, 5, 19, 5,  $scode, $text_color);

imagepng($im); imagedestroy($im); $_SESSION['scode'] = $scode;

?>