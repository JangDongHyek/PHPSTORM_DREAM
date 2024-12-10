<?php
$sub_menu = ($_POST['mode'] == "agency")? "150100" : "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

auth_check($auth[$sub_menu], 'w');

//check_admin_token();

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
				mb_recommend = '{$mb_recommend}',
				mb_1 = '".preg_replace("/[^0-9]*/s", "", $_POST['mb_1'])."',
				mb_3 = '{$mb_3}',
				mb_4 = '{$mb_4}',
				is_ccm = '{$is_ccm}'
			  ";

// 은행정보추가
// 1) 은행명
if ($_POST['mb_6'] != '')
	$sql_common .= " , mb_6 = '{$_POST['mb_6']}'";
// 2) 계좌번호
if ($_POST['mb_7'] != '')
	$sql_common .= " , mb_7 = '{$_POST['mb_7']}'";
// 3) 예금주
if ($_POST['mb_8'] != '')
	$sql_common .= " , mb_8 = '{$_POST['mb_8']}'";
// 4) 통장사본 => 면허증사본
if ($_POST['mb_9'] != '')
	$sql_common .= " , mb_9 = '{$_POST['mb_9']}'";
// 5) 생년월일 또는 사업자번호
if ($_POST['mb_10'] != '')
	$sql_common .= " , mb_10 = '{$_POST['mb_10']}'";
// 6) 출금승인
if ($_POST['mb_user_acc'] != '')
	$sql_common .= " , mb_user_acc = '{$_POST['mb_user_acc']}'";

// 탈퇴일, 차단일
if ($_POST['mb_leave_date'] != '')
	$sql_common .= " , mb_leave_date = '{$_POST['mb_leave_date']}'";
if ($_POST['mb_intercept_date'] != '')
	$sql_common .= " , mb_intercept_date = '{$_POST['mb_intercept_date']}'";

// 승인여부 (대리점만)
if ($_POST['mb_use'] != '')
	$sql_common .= " , mb_use = '{$_POST['mb_use']}'";

// 승인여부 (회원만)
if ($_POST['mb_user_auth'] != '')
	$sql_common .= " , mb_user_auth = '{$_POST['mb_user_auth']}'";

// 대리점 대표번호
if ($_POST['mb_11'] != '' || $_POST['mb_level'] == "9")
	$sql_common .= " , mb_11 = '{$_POST['mb_11']}'";

// 대리점, 회원 구분
if ($_POST['mode'] == "agency") {	// 1) 대리점이면
	$result_url = './agency_list.php';

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
		$file_name = $old_mb_2;
	}

	// 이전이미지삭제
	if ($file_del_flag) {
		@unlink($upload_dir.$old_mb_2);
		if ($file_name == $old_mb_2) $sql_common .= " , mb_2 = ''";
	}

} else {	// 2)회원이면
	$result_url = './member_list.php';

	// 대리점no 추가
	$sql_common .= ", agency_no = '{$agency_no}'";
}

// 기사 콜유형 추가
$driv_type = ((int)$_POST['driv_type'] > 0) ? $_POST['driv_type'] : 0;
$sql_common .= ", driv_type = '{$driv_type}'";


// 포인트자동차감 설정 (post로 넘어온 데이터 존재하면)
if (!is_null($_POST['at_point_mdate'])) {
    // 변수초기화
    $at_point_type = $_POST['at_point_type']; // 차감방식(월) - 0:없음, 1:차감
    $at_point = preg_replace("/[^0-9]*/s", "", $_POST['at_point']); // 차감포인트
    $at_point_sdate = ""; // 일차감_시작일
    $at_point_edate = ""; // 일차감_종료일
    $at_point_mdate = ""; // 월차감_최초선택일

    // 220408 추가
    $at_point2_type = $_POST['at_point2_type']; // 차감방식(일) - 0:없음, 1:차감
    $at_point2 = preg_replace("/[^0-9]*/s", "", $_POST['at_point2']); // 차감포인트

    if ($at_point_type == "1") {
        // 월차감을 지정한 최초일자
        $at_point_mdate = ($_POST['at_point_mdate'] != "")? $_POST['at_point_mdate'] : G5_TIME_YMD;
    }

    if ($at_point2_type == "1") {
        // 일차감
        $at_point_sdate = $_POST['at_point_sdate'];
        $at_point_edate = $_POST['at_point_edate'];
    }


    $sql_common .= ", at_point_type = '{$at_point_type}'
                    , at_point = '{$at_point}'
                    , at_point2_type = '{$at_point2_type}'
                    , at_point2 = '{$at_point2}'
                    , at_point_sdate = '{$at_point_sdate}'
                    , at_point_edate = '{$at_point_edate}'
                    , at_point_mdate = '{$at_point_mdate}'
                    ";
}


if ($w == '') {
	if ($mb['mb_id'])
		alert('이미 존재하는 회원아이디입니다.');

	$sql = "insert into {$g5['member_table']} set 
			mb_id = '{$mb_id}', 
			mb_password = '".get_encrypt_string($mb_password)."', 
			mb_datetime = '".G5_TIME_YMDHIS."', 
			mb_ip = '{$_SERVER['REMOTE_ADDR']}', 
			{$sql_common} ";
	$rst = sql_query($sql);

	// 회원이면 로그인용 아이디 추가
	if ($rst && $_POST['mode'] == "member") {
		$id_arr = explode("-", $mb_id);
		$number = ltrim($id_arr[1], '0');

		$sql = "INSERT INTO g5_member_login_id SET
				login_id = '{$mb_id}',
				mb_hp = '{$mb_hp}',
				agency_no = '{$agency_no}',
				number = '{$number}',
				regdate = '".G5_TIME_YMDHIS."'
				";
		sql_query($sql);
	}

} else if ($w == 'u') {

	if (!$mb['mb_id'])
		alert('존재하지 않는 회원자료입니다.');

	if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
		alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

	if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
		alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');
	
	if ($mb_password)
		$sql_common .= " , mb_password = '".get_encrypt_string($mb_password)."' ";
	

	$sql = "update {$g5['member_table']}
			set {$sql_common}
			where mb_id = '{$mb_id}' ";
	sql_query($sql);

} else {
	alert('제대로 된 값이 넘어오지 않았습니다.');
}


if ($qstr != "") $result_url .= "?".$qstr;
goto_url($result_url);

?>