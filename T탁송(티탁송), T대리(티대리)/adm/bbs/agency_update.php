<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

$mb_id = trim($_POST['mb_id']);
$mb = get_member($mb_id);

/*
// 휴대폰번호 체크
$mb_hp = hyphen_hp_number($_POST['mb_hp']);
if($mb_hp) {
	$result = exist_mb_hp($mb_hp, $mb_id);
	if ($result)
		alert($result);
}
*/
$mb_zip1 = substr($_POST['mb_zip'], 0, 3);
$mb_zip2 = substr($_POST['mb_zip'], 3);

$sql_common = " mb_name = '{$_POST['mb_name']}',
				mb_nick = '{$_POST['mb_nick']}',
				mb_hp = '{$mb_hp}',
				mb_memo = '{$_POST['mb_memo']}',
				mb_level = '{$_POST['mb_level']}',
				mb_zip1 = '{$mb_zip1}',
				mb_zip2 = '{$mb_zip2}',
				mb_addr1 = '{$mb_addr1}',
				mb_addr2 = '{$mb_addr2}',
				mb_addr_jibeon = '{$mb_addr_jibeon}',
				mb_1 = '".preg_replace("/[^0-9]*/s", "", $_POST['mb_1'])."'
			  ";

// 탈퇴일, 차단일
if ($_POST['mb_leave_date'] != '')
	$sql_common .= " , mb_leave_date = '{$_POST['mb_leave_date']}'";
if ($_POST['mb_intercept_date'] != '')
	$sql_common .= " , mb_intercept_date = '{$_POST['mb_intercept_date']}'";

// 활성화
if ($_POST['mb_use'] != '')
	$sql_common .= " , mb_use = '{$_POST['mb_use']}'";


// 사업자등록증 파일업로드
$upload_dir = G5_DATA_PATH.'/biz/';
$upload_file = $_FILES['upload_mb_2']['tmp_name'];
$file_del_flag = ($del_mb_2 == "1")? true : false;

if ($upload_file != "") {
	$ext = array_pop(explode('.', $_FILES['upload_mb_2']['name']));
	$file_name = "biz_{$mb_id}_".strtotime(G5_TIME_YMDHIS).".{$ext}";
	$upload_path = $upload_dir.$file_name;
	
	if (move_uploaded_file($upload_file, $upload_path)) {
		$sql_common .= " , mb_2 = '{$file_name}'";

		if ($w == "u") 
			$file_del_flag = true;

	} else {
		$file_del_flag = false;
	}

} else {
	//$file_name = $old_mb_2;
}

/*
// 이전이미지삭제
if ($file_del_flag) {
	@unlink($upload_dir.$old_mb_2);
	if ($file_name == $old_mb_2) $sql_common .= " , mb_2 = ''";
}
*/

if ($w == '') {
	if ($mb['mb_id'])
		alert('이미 존재하는 회원아이디입니다.');

	$sql = "insert into {$g5['member_table']} set 
			mb_id = '{$mb_id}', 
			mb_password = '".get_encrypt_string($mb_password)."', 
			mb_datetime = '".G5_TIME_YMDHIS."', 
			mb_ip = '{$_SERVER['REMOTE_ADDR']}', 
			{$sql_common} ";

	$msg = "대리점 가입이 완료되었습니다. 관리자 승인 후 대리점 기능을 이용할 수 있습니다.";
	$title = "가입완료";
	$icon = "success";
	$return_url = G5_URL."/intro";

	if (!sql_query($sql)) {
		$msg = "대리점 가입에 실패하였습니다. 다시 시도해 주세요.";
		$title = "가입실패";
		$icon = "error";
		$return_url = G5_BBS_URL."/register_agc_form.php";
	}

	// alert($msg, $return_url);
	@include_once(G5_THEME_PATH.'/head.sub.php');
?>
<script>
swal({
	title: "<?=$title?>",
	text: "<?=$msg?>",
	icon: "<?=$icon?>",
	buttons: ["닫기", "확인"],
	dangerMode: true,
}).then(function(result) {
	if (result) {
		location.href = "<?=$return_url?>";
	}
});
</script>
<?
	@include_once(G5_THEME_PATH.'/tail.sub.php');


} else if ($w == 'u') {

	

} else {
	alert('제대로 된 값이 넘어오지 않았습니다.');
}




?>