<?php
global $pid;
$pid = "my_income";
$sub_id = "my_income";
include_once('./_common.php');

$g5['title'] = '수익 관리';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/register.php');
}

//if ($private){
//    $_SESSION['ss_mb_id'] = "00mjjj@naver.com";
//}
$mb_id = $_SESSION['ss_mb_id'];
$mb = get_member($mb_id);



// 탭 설정
$tab = $_REQUEST['tab'];
//아무것도 안들어왔을 경우 tab 1로 설정
if (empty($tab)) { $tab = 1; }
//설정한 탭이 아닐경우 팅겨냄
if ($tab != 1 && $tab != 2 && $tab != 3) {
    alert("올바른 방식으로 접근해주세요",G5_URL);
}

$sql_add = '';
if($mb['mb_division'] == '1') { // 일반인
    if($tab == 1) {
        $sql_add .= " and ph_bo_table = '@pay_minus' ";
    } else {
        //$sql_add .= " and ph_content = '캐쉬 충전' ";
        $sql_add .= " and ph_bo_table = '@pay_plus' ";
    }

    $count = sql_fetch(" select count(*) as count from new_payment_history where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} ")['count'];

    $rows = 14;
    $total_page  = ceil($count / $rows);  // 전체 페이지 계산
    if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $sql = " select * from new_payment_history where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} order by wr_datetime desc limit {$from_record}, {$rows} ";
    $result = sql_query($sql);

    $sql = " select * from new_payment_history where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} order by wr_datetime desc limit {$from_record}, {$rows} ";

    $result2 = sql_query($sql);
}
else { // 전문인
    // 진행 상태 정보
    $op = $_REQUEST['op'];
    if (empty($op)) { $op = 1; }

    $sql_add = " and rp_proc !=4 ";
    if($op == 2) { $sql_add .= ' and rp_proc = 1 '; }
    else if($op == 3) { $sql_add .= ' and rp_proc = 2 '; }
    else if($op == 4 || $tab == 2) { $sql_add .= ' and rp_proc = 3 '; }

    $count = sql_fetch(" select count(*) as count from new_request_pay where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} ")['count'];

    $rows = 14;
    $total_page  = ceil($count / $rows);  // 전체 페이지 계산
    if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $sql = " select * from new_request_pay where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} order by wr_datetime desc limit {$from_record}, {$rows} ";
    $result = sql_query($sql);
    $result2 = sql_query($sql);
    $status1 = sql_fetch(" select count(*) as count from new_request_pay where mb_id = '{$_SESSION['ss_mb_id']}' ")['count'];
    $status2 = sql_fetch(" select count(*) as count from new_request_pay where mb_id = '{$_SESSION['ss_mb_id']}' and rp_proc = 1 ")['count'];
    $status3 = sql_fetch(" select count(*) as count from new_request_pay where mb_id = '{$_SESSION['ss_mb_id']}' and rp_proc = 2 ")['count'];
    $status4 = sql_fetch(" select count(*) as count from new_request_pay where mb_id = '{$_SESSION['ss_mb_id']}' and rp_proc = 3 ")['count'];
}

include_once($member_skin_path.'/my_income.skin.php');

include_once('./_tail.php');
?>