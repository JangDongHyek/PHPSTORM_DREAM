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
$image = @ImageCreate (50, 50); // 사이즈가 300x300인 이미지 생성
$color_black = @ImageColorAllocate ($image, 0x00, 0x00, 0x00); // 검정색을 설정
$color_white = @ImageColorAllocate ($image, 0xFF, 0xFF, 0xFF); // 흰색을 설정
@ImageArc ($image, 25, 25, 45, 45, 0, 360, $color_white); // 원 그리기
@ImageFill ($image, 25,25,$color_white);
@ImageJpeg ($image,"test_gd.jpg"); // 이미지 출력
@ImageDestroy ($image); // 메모리에서 이미지 제거
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