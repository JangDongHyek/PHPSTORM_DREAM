<?php
include_once("./_common.php");

$w			= $_POST['w'];
$ca_id		= $_POST['ca_id'];
$ca_code	= $_POST['ca_code'];
$ca_name	= $_POST['ca_name'];
$ca_order	= $_POST['ca_order'];
$ca_file	= $_FILES['ca_file'];

$sql_common = "  ca_code	= '{$ca_code}',
                 ca_name	= '{$ca_name}',
                 ca_order	= '{$ca_order}' ";

if($w == "" || $w == "r"){
	sql_query("insert into g5_category set {$sql_common}");
	
    $ca_id = sql_insert_id();
	
}else if($w == "u"){
	sql_query(" update g5_category set {$sql_common} where ca_id = '{$ca_id}'");
}

$ca_dir = substr($ca_code, 0, 2);

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/category', G5_DIR_PERMISSION);
@mkdir(G5_DATA_PATH.'/category/'.$ca_dir, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/category/'.$ca_dir, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 삭제에 체크가 되어있다면 파일을 삭제합니다.
if (isset($_POST['ca_file_del']) && $_POST['ca_file_del']) {

	$row = sql_fetch("select ca_file from g5_category where ca_id = '{$ca_id}'");
	@unlink(G5_DATA_PATH.'/category/'.$ca_dir.'/'.$row['ca_file']);
	
	// 파일삭제 업데이트
	sql_query("update g5_category set ca_file = '', ca_filename = '' where ca_id = '{$ca_id}'");
}

$tmp_file  = $_FILES['ca_file']['tmp_name'];
$filesize  = $_FILES['ca_file']['size'];
$filename  = $_FILES['ca_file']['name'];
$filename  = get_safe_filename($filename);

// 서버에 설정된 값보다 큰파일을 업로드 한다면
if ($filename) {
	if ($_FILES['ca_file']['error'] == 1) {
		$file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
		alert($file_upload_msg, G5_ADMIN_URL."/category_list.php");
		exit;
	}
	else if ($_FILES['ca_file']['error'] != 0) {
		$file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
		alert($file_upload_msg, G5_ADMIN_URL."/category_list.php");
		exit;
	}
}

if (is_uploaded_file($tmp_file)) {
	// 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
	if ($filesize > 10485760) {
		$file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
		alert($file_upload_msg, G5_ADMIN_URL."/category_list.php");
		exit;
	}

	//=================================================================\
	// 090714
	// 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
	// 에러메세지는 출력하지 않는다.
	//-----------------------------------------------------------------
	$timg = @getimagesize($tmp_file);
	// image type
	if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
		 preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
		if ($timg['2'] < 1 || $timg['2'] > 16){
			alert("파일을 업로드할 수 없습니다.", G5_ADMIN_URL."/category_list.php");
			exit;
		}
	}
	//=================================================================

	// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
	$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

	shuffle($chars_array);
	$shuffle = implode('', $chars_array);

	$upload_file = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

	$dest_file = G5_DATA_PATH.'/category/'.$ca_dir.'/'.$upload_file;

	// 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
	$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['ca_file']['error']);

	// 올라간 파일의 퍼미션을 변경합니다.
	chmod($dest_file, G5_FILE_PERMISSION);
	
	if(!$ca_id){
		alert("파일을 업로드할 값이 없습니다.", G5_ADMIN_URL."/category_list.php");
		@unlink(G5_DATA_PATH.'/category/'.$ca_dir.'/'.$upload_file);
		exit;
	}
	$row = sql_fetch("select ca_file from g5_category where ca_id = '{$ca_id}'");
	
	if($row)
		@unlink(G5_DATA_PATH.'/category/'.$ca_dir.'/'.$row['ca_file']);

	sql_query("update g5_category set ca_file = '{$upload_file}', ca_filename = '{$filename}' where ca_id = '{$ca_id}'");
}

$qstr = "";
if($sca)
	$qstr .= "?sca=".$sca;

goto_url(G5_ADMIN_URL."/category_list.php".$qstr);
?>