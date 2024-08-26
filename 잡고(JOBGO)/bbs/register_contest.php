<?php
$sub_id = "register_contest";
include_once('./_common.php');

$g5['title'] = '공모전 등록';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}



$cp_idx = $_GET['idx'];
$cp = "";
if (isset($cp_idx)) {
    $sql = " select * from new_competition where cp_idx = {$cp_idx} ";
    $cp = sql_fetch($sql);

    if (!$cp){
        alert('존재하지 않는 공모전 입니다.', G5_URL);
    }

    if ($member['mb_id'] != $cp['mb_id']){
        alert('올바른 접근 방식이 아닙니다.', G5_URL);
    }

    $date = explode('-',$cp['cp_datetime']);


    $category1_name = common_code($cp['cp_category1'], 'code_idx', 'json');
    $category1_name = $category1_name[0]['name'];
    $category2_name = common_code($cp['cp_category2'], 'code_idx', 'json');
    $category2_name = $category2_name[0]['name'];

    $sql = "select count(bf_idx) cnt from {$g5['board_file_table']} where wr_id = '{$cp_idx}' and bo_table = 'competition_sub' ";
    $sub_img_cnt = sql_fetch($sql);
}
include_once($member_skin_path.'/register_contest.skin.php');

include_once('./_tail.php');
?>