<?php
$sub_id = "contest_list";
include_once('./_common.php');

$g5['title'] = '공모전';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}

if (empty($category1)){
    $category1 = '카테고리별';
}


$sql = "select * from new_competition order by cp_idx desc ";
$result = sql_query($sql);



    include_once($member_skin_path.'/contest_list.skin.php');

include_once('./_tail.php');
?>