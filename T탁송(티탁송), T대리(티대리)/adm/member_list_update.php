<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

$url = './member_list.php?'.$qstr;

if ($_POST['act_button'] == "선택수정") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
        } else {
            if($_POST['mb_certify'][$k])
                $mb_adult = $_POST['mb_adult'][$k];
            else
                $mb_adult = 0;

            $sql = " update {$g5['member_table']}
                        set mb_level = '{$_POST['mb_level'][$k]}',
                            mb_intercept_date = '{$_POST['mb_intercept_date'][$k]}',
                            mb_mailling = '{$_POST['mb_mailling'][$k]}',
                            mb_sms = '{$_POST['mb_sms'][$k]}',
                            mb_open = '{$_POST['mb_open'][$k]}',
                            mb_certify = '{$_POST['mb_certify'][$k]}',
                            mb_adult = '{$mb_adult}'
                        where mb_id = '{$_POST['mb_id'][$k]}' ";
            sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "회원탈퇴") { //"선택삭제"

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
        } else if (is_admin($mb['mb_id']) == 'super') {
            $msg .= $mb['mb_id'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
        } else {
            // 회원자료 삭제
            member_delete($mb['mb_id']);

			// 로그인용 아이디 탈퇴처리
			$sql = "UPDATE g5_member_login_id SET is_leave = 'Y'
					WHERE login_id = '{$mb['mb_id']}'
					";
			sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "상태변경" || $_POST['act_button'] == "회원상태변경") {	// 대리점, 회원 승인여부 변경
	// 변경처리
	for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
        } else {
			// 대리점 상태변경
            if($_POST['mb_use'][$k]) {
				$sql = "update {$g5['member_table']}
						set mb_use = '{$_POST['mb_use'][$k]}'
						where mb_id = '{$_POST['mb_id'][$k]}' ";
				sql_query($sql);

			// 회원 상태변경
			} else if ($_POST['mb_user_auth'][$k] && $_POST['act_button'] == "회원상태변경") {
				$sql = "update {$g5['member_table']}
						set mb_user_auth = '{$_POST['mb_user_auth'][$k]}'
						";
				if ($_POST['mb_user_acc'][$k]) $sql .= ", mb_user_acc = '{$_POST['mb_user_acc'][$k]}' ";
				$sql .= "where mb_id = '{$_POST['mb_id'][$k]}' ";
				sql_query($sql);
			}
        }
    }

	$url = ($_POST['act_button'] == "상태변경")? './agency_list.php?'.$qstr : './member_list.php?'.$qstr;
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

goto_url($url);
?>
