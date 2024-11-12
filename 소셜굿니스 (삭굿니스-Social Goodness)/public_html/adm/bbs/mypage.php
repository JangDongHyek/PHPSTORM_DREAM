<?php
$sub_id = "mypage";
include_once('./_common.php');

$g5['title'] = '마이페이지';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    alert('로그인 후 이용하여 주십시오.', $login_url );
}

// 상점 등록 여부 확인
$tes_sql = " select count(*) as count from g5_tes where te_category = 'tes' and mb_no = {$_SESSION['ss_mb_no']} ";
$tes_count = sql_fetch($tes_sql);
$tes_count = $tes_count['count'];

$w = '';
if($tes_count > 0) {
    $w = 'u';
}

// 방문한 곳(개수)
$place_sql = " select count(*) as count from g5_tes where te_category = '장소' and mb_no = {$_SESSION['ss_mb_no']} ";
$place_count = sql_fetch($place_sql);
$place_count = $place_count['count'];

// 리뷰한 곳(개수)
$review_sql = " select count(*) as count from g5_place_eval where mb_no = {$_SESSION['ss_mb_no']} and category='평가' ";
$review_count = sql_fetch($review_sql);
$review_count = $review_count['count'];

// 사진
$file_count_sql = " select count(*) as count from g5_file where fi_table='mypage' and mb_no = {$_SESSION['ss_mb_no']} ";
$file_count = sql_fetch($file_count_sql);
$file_count = $file_count['count'];

if($file_count > 0) {
    $file_sql = " select * from g5_file where fi_table='mypage' and mb_no = {$_SESSION['ss_mb_no']}";
    $file_row = sql_fetch($file_sql);
}

$mb = get_member($_SESSION['ss_mb_id']);

include_once($member_skin_path.'/mypage.skin.php');

include_once('./_tail.php');
?>