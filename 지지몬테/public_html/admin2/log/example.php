<?
$path="./";
include "nalog_viewer.php";
if(!nalog_admin_check4()){nalog_go("http://navyism.com");}
if(!@include "nalog_language.php"){nalog_go("install.php");}
if(!@include"language/$language/language.php"){nalog_go("install.php");}
echo $lang[head];
?>
<?
if(function_exists("imagecreate")){
$image = @ImageCreate (50, 50); // ����� 300x300�� �̹��� ����
$color_black = @ImageColorAllocate ($image, 0x00, 0x00, 0x00); // �������� ����
$color_white = @ImageColorAllocate ($image, 0xFF, 0xFF, 0xFF); // ����� ����
@ImageArc ($image, 25, 25, 45, 45, 0, 360, $color_white); // �� �׸���
@ImageFill ($image, 25,25,$color_white);
@ImageJpeg ($image,"test_gd.jpg"); // �̹��� ���
@ImageDestroy ($image); // �޸𸮿��� �̹��� ����
$test_gd="test_gd.jpg";
}
else{
$test_gd="nalog_image/test_gd.jpg";
}
?>
<br><br>
<?include"language/$language/example.php";?>
<br><br>
</body>
</html>