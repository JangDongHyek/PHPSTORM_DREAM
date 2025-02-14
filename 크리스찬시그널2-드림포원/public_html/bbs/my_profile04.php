<?php
$sub_id = "my_profile04";
include_once('./_common.php');


$is_mypage = "my_profile04";
$g5['title'] = '기본정보';
include_once('./_head.php');

//$mb_id = "";
if(!empty($_SESSION['ss_mb_id'])) {
    $mb_id = $_SESSION['ss_mb_id'];
} else {
    $mb_id = $_GET['mb_id'];
}

// 회원 기본정보
$sql = " select * from {$g5['member_table']} where mb_id = '{$mb_id}' ";
$mb = sql_fetch($sql);

// 프로필 사진
//$count = sql_fetch(" select count(*) as count from g5_member_img where mb_no = {$mb['mb_no']} and thumb = 'Y' ")['count'];
//if($count > 0) { // 대표사진 있을 경우
//    $sql_search = " and thumb = 'Y' ";
//    $sql_search2 = " and thumb is null ";
//    $limit2 = " limit 1 ";
//    $limit3 = " limit 1,1 ";
//    $limit4 = " limit 2,1 ";
//} else { // 대표사진 없을 경우
//    $sql_search = "";
//    $sql_search2 = "";
//    $limit2 = " limit 1,1 ";
//    $limit3 = " limit 2,1 ";
//    $limit4 = " limit 3,1 ";
//}

//// 프로필 이미지1 -- 대표
$sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by idx asc";
$file_reuslt = sql_query($sql);
//if(isset($file1['img_file'])) $hide1 = 'hide';
//
//// 프로필 이미지2
//$sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} {$sql_search2} order by idx {$limit2}";
//$file2 = sql_fetch($sql);
//if(isset($file2['img_file'])) $hide2 = 'hide';
//
//// 프로필 이미지3
//$sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} {$sql_search2} order by idx {$limit3}";
//$file3 = sql_fetch($sql);
//if(isset($file3['img_file'])) $hide3 = 'hide';
//
//// 프로필 이미지4
//$sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} {$sql_search2} order by idx {$limit4}";
//$file4 = sql_fetch($sql);
//if(isset($file4['img_file'])) $hide4 = 'hide';


$num = sql_num_rows($file_reuslt);

include_once($member_skin_path.'/my_profile04.skin.php');

include_once('./_tail.php');
?>
