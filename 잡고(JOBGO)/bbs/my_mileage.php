<?php
$sub_id = "my_mileage";
include_once('./_common.php');

$g5['title'] = '재능 마일리지';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/register.php');
}

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
if($tab == 1) { // 사용 내역
    $sql_add .= ' and category like "사용%" ';
} else {
    $sql_add .= ' and  NOT category LIKE "사용%" ';
}

// 진행 상태 정보
$op = $_REQUEST['op'];
if(empty($op)) { $op = 1; }
if($op == 2) { $sql_add .= ' and category = "적립" '; }
else if($op == 3) { $sql_add .= ' and category = "구매" '; }

$count = sql_fetch(" select count(*) as count from new_mileage where mb_id = '{$mb_id}' {$sql_add} ")['count'];

$rows = 14;
$total_page  = ceil($count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if($tab == 1) { // 사용 내역
    $sql = " select mi.*, ad.ad_category, ad.ad_fee from new_mileage as mi left join new_advertisement as ad on ad.idx = mi.ad_idx where mi.mb_id = '{$mb_id}' {$sql_add} order by mi.wr_datetime desc limit {$from_record}, {$rows} ";
    $result = sql_query($sql);
}
else { // 입금 내역
    $sql = " select * from new_mileage where mb_id = '{$mb_id}' {$sql_add} order by wr_datetime desc limit {$from_record}, {$rows} ";
    $result2 = sql_query($sql);

    $status1 = sql_fetch(" select count(*) as count from new_mileage where mb_id = '{$_SESSION['ss_mb_id']}' and NOT category LIKE '사용%' ")['count'];
    $status2 = sql_fetch(" select count(*) as count from new_mileage where mb_id = '{$_SESSION['ss_mb_id']}' and category = '적립'; ")['count'];
    $status3 = sql_fetch(" select count(*) as count from new_mileage where mb_id = '{$_SESSION['ss_mb_id']}' and category = '구매'; ")['count'];
}
include_once($member_skin_path.'/my_mileage.skin.php');

include_once('./_tail.php');
?>