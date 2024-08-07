<?php
include_once('./_common.php');

// 리퍼러 체크
referer_check();

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if($w == 'u')
    $mb_id = isset($_SESSION['ss_mb_id']) ? trim($_SESSION['ss_mb_id']) : '';
else if($w == '')
    $mb_id = trim($_POST['mb_id']);
else
    alert('잘못된 접근입니다', G5_URL);

if(!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');

$mb_nick        = trim($_POST['mb_nick']);
$mb_profile     = isset($_POST['mb_profile'])       ? trim($_POST['mb_profile'])     : "";

if (!trim($_SESSION['ss_mb_id']))
	alert('로그인 되어 있지 않습니다.');

if (trim($_POST['mb_id']) != $mb_id)
	alert("로그인된 정보와 수정하려는 정보가 틀리므로 수정할 수 없습니다.\\n만약 올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.");

$sql = " update {$g5['member_table']}
			set mb_nick = '{$mb_nick}'
		  where mb_id = '$mb_id' ";
sql_query($sql);

// 회원 아이콘
$mb_dir = G5_DATA_PATH.'/member/'.substr($mb_id,0,2);
$mb_url = G5_DATA_URL.'/member/'.substr($mb_id,0,2);

// 아이콘 삭제
if (isset($_POST['del_mb_icon'])) {
	$temp = explode(".", $member['mb_profile']);
	$temp_name = array_pop($temp);

    @unlink($mb_dir.'/'.$mb_id.'.'.$temp_name);
	sql_query(" update {$g5['member_table']} set mb_profile = '' where mb_id = '{$mb_id}' ");
}

$msg = "";

// 아이콘 업로드
$mb_icon = '';
if (isset($_FILES['mb_icon']) && is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
    if (preg_match("/(\.gif)|(\.jpg)|(\.jpeg)|(\.png)$/i", $_FILES['mb_icon']['name'])) {

        // 아이콘 용량이 설정값보다 이하만 업로드 가능
        if ($_FILES['mb_icon']['size'] <= $config['cf_member_icon_size']) {
			//기존 파일 삭제
			$temp = explode(".", $member['mb_profile']);
			$temp_name = array_pop($temp);

			@unlink($mb_dir.'/'.$mb_id.'.'.$temp_name);

			$temp = explode(".", $_FILES['mb_icon']['name']);
			$temp_name = array_pop($temp);

            @mkdir($mb_dir, G5_DIR_PERMISSION);
            @chmod($mb_dir, G5_DIR_PERMISSION);
            $dest_path = $mb_dir.'/'.$mb_id.'.'.$temp_name;
			$dest_url = $mb_url.'/'.$mb_id.'.'.$temp_name;

            move_uploaded_file($_FILES['mb_icon']['tmp_name'], $dest_path);
            chmod($dest_path, G5_FILE_PERMISSION);
			
			sql_query(" update {$g5['member_table']} set mb_profile = '{$dest_url}' where mb_id = '{$mb_id}' ");

        } else {
            $msg .= '회원아이콘을 '.number_format($config['cf_member_icon_size']).'바이트 이하로 업로드 해주십시오.';
        }

    } else {
        $msg .= $_FILES['mb_icon']['name'].'은(는) gif, jpg, jpeg, png 파일이 아닙니다.';
    }
}

if($msg){
	alert($msg);
	exit;
}

goto_url(G5_BBS_URL."/member_confirm.php?url=".G5_BBS_URL."/register_form.php");
?>
