<?
// $save_dir ������ ���ε�� ������ ����� ��ġ�� �̾߱� �մϴ�.

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

// �Ʒ� �ڵ�� ���� ������ ������ �� �������
// ���ϸ��� �ٲپ� ���ε� ��Ű�� ��ƾ�Դϴ�.
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