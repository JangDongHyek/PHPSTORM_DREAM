<?
// $save_dir 변수는 업로드된 파일이 저장될 위치를 이야기 합니다.

$save_dir = $uploaddir;

$save_dir = str_replace("//", "/", $save_dir);
$save_dir = str_replace("\\\\", "/", $save_dir);

$filename_array = explode(".", $upfile_name);

$filename = $filename_array[sizeof($filename_array)-2];
$ext = $filename_array[sizeof($filename_array)-1];


if( sizeof($filename_array) != 2 ){
	exit;
}

if(eregi($ext,"html") || 
   eregi($ext,"htm") ||
   eregi($ext,"php") ||
   eregi($ext,"php3") ||      
   eregi($ext,"phtml") ||
   eregi($ext,"inc") ||
   eregi($ext,"pl") ||
   eregi($ext,"cgi") ||
   eregi($ext,"txt") ||
   eregi($ext,"asp")){
	exit;
}

// 아래 코드는 같은 파일이 웹서버 상에 있을경우
// 파일명을 바꾸어 업로드 시키는 루틴입니다.
if( is_uploaded_file($HTTP_POST_FILES["upfile"][tmp_name]) ){ 
	$target = $save_dir . $HTTP_POST_FILES["upfile"][name];

	if( file_exists($target) ){
		$bExists = 1;
		$count = 0;

		While($bExists == 1){
			if( file_exists($target) ){
				$count = $count + 1;
				$target = $save_dir . $filename . "(" . $count . ")" . "." .$ext;
				$changefilename = $filename . "(" . $count . ")" . "." . $ext;
			}else{
				$bExists = 0;
			}
		}
		move_uploaded_file($HTTP_POST_FILES["upfile"][tmp_name],$target);
		echo("$changefilename");
	}else{
		move_uploaded_file($HTTP_POST_FILES["upfile"][tmp_name],$target);
		echo("$upfile_name");
	}
}
?>