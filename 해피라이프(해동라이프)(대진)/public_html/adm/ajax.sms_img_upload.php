<?
/*******************************************
회원문자발송 - 이미지 업로드
*******************************************/
include_once('./_common.php');
include_once(G5_LIB_PATH.'/class.resize.php');

//print_r($_POST);
//print_r($_FILES);

// 기존서버 업로드
$upload_path = G5_DATA_PATH.'/sms/';
$upload_file = $_FILES['sms_img']['tmp_name'];

// 이미지업로드 진행
if ($upload_file != "") {
	$ext = array_pop(explode('.', $_FILES['sms_img']['name']));
	$file_name = strtotime(G5_TIME_YMDHIS)."_".getRandomString(4).".{$ext}";
	$upload_path = $upload_path.$file_name;
	
	if (move_uploaded_file($upload_file, $upload_path)) {
		// 이미지 리사이즈
		$resize_img = new Image($upload_path);
		if ((int)$resize_img->image_width >= 1500 || (int)$resize_img->image_height >= 1500) {
			$resize_img -> width(1400);
			$resize_img -> save();
		}

		echo G5_DATA_URL."/sms/".$file_name;

	} else {
		echo "F";
	}
} else {
	echo "F";
}

?>