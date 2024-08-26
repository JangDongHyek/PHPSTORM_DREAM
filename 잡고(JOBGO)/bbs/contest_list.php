<?php
$sub_id = "contest_list";
include_once('./_common.php');

$g5['title'] = '공모전';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}
$category1 = $_REQUEST['category1'];
$category2 = $_REQUEST['category2'];
if (empty($category1)){
    $category1 = '카테고리별';
}

//1차메뉴
$competition_ctg = common_code('competition_ctg','code_ctg','json');
//선택한 1차메뉴 idx 불러오기
$common_code = common_code($category1,'code_name','json');

//2차메뉴
$competition_ctg2 = common_code($common_code[0]['idx'],'code_p_idx','json');
//선택한 2차메뉴 idx 불러오기
$common_code2 = common_code($category2,'code_name','json','and code_p_idx = '.$common_code[0]['idx']);

if (empty($category2)){
    //없으면 2차 카테고리 중에 첫번 째
    $common_code2[0]['idx'] = $competition_ctg2[0]['idx'];
}

$sql = "select * from new_competition where cp_category1 = {$common_code[0]['idx']} and cp_category2 = {$common_code2[0]['idx']} order by cp_idx desc ";
$result = sql_query($sql);



    include_once($member_skin_path.'/contest_list.skin.php');

include_once('./_tail.php');
?>