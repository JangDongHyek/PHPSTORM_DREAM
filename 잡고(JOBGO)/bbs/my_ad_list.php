<?php
$sub_id = "my_ad_list";
include_once('./_common.php');

$g5['title'] = '광고 관리';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/register.php');
}

$mb = get_member($_SESSION['ss_mb_id']);

// 탭 설정
$tab = $_REQUEST['tab'];
//아무것도 안들어왔을 경우 tab 1로 설정
if (empty($tab)) { $tab = 1; }
//설정한 탭이 아닐경우 팅겨냄
if ($tab != 1 && $tab != 2 && $tab != 3&& $tab != 4) {
    alert("올바른 방식으로 접근해주세요",G5_URL);
}

$sql_add = '';
if($tab == 1) { $sql_add = ' and ad_category = "1" '; }
else if($tab == 2) { $sql_add = ' and ad_category = "2" '; }
else if($tab == 3) { $sql_add = ' and ad_category = "3" '; }
else if($tab == 4) { $sql_add = ' and ad_category = "4" '; }

$count = sql_fetch(" select count(*) as count from new_advertisement where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} ")['count'];

$rows = 14;
$total_page  = ceil($count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * from new_advertisement where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} order by wr_datetime desc ";
$result = sql_query($sql); // 메인 상단
$result2 = sql_query($sql); // 메인 하단
$result3 = sql_query($sql); // 카테고리 상단
$result4 = sql_query($sql); // 플러스
// 광고 잔여 일 계산 (진행 중인 광고만)
$end_date = substr(sql_fetch(" select ad_end_date from new_advertisement where mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} and ad_status = '진행중' ")['ad_end_date'], 0, 10);
if(empty($end_date) || date('Y-m-d') > $end_date) { // 종료예정일이 없거나 종료예정일이 지났을 경우 d_day = 0;
    $d_day = 0;
} else {
    $d_day = ( strtotime($end_date) - strtotime(date('Y-m-d')) ) / 86400; // 남은 일자 계산
}

include_once($member_skin_path.'/my_ad_list.skin.php');

include_once('./_tail.php');
?>