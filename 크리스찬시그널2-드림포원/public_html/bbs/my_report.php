<?php
$sub_id = "my_report";
include_once('./_common.php');

// 로그인 확인
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php');
}

$mb_no = $member['mb_no'];

$count = sql_fetch(" select count(*) as count from g5_member_report where mb_no = '{$mb_no}' ")['count'];

$sql = " select mb.*, mr.report_category, mr.report_contents, date_format(mr.report_date, '%Y/%m/%d %H:%i') as report_date
         from g5_member_report as mr 
         left join {$g5['member_table']} as mb on mr.report_mb_no = mb.mb_no where mr.mb_no = '{$mb_no}' ";
$result = sql_query($sql);

$is_mypage = "my_report";
$g5['title'] = '내 신고함';
include_once('./_head.php');

include_once($member_skin_path.'/my_report.skin.php');

include_once('./_tail.php');
?>
