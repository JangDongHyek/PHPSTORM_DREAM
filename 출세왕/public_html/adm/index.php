<?php
include_once('./_common.php');

$g5['title'] = '관리자메인';
include_once ('./admin.head.php');

global $menu;
//관리팀장 읽기 권한 확인 후 첫번째 메뉴로 이동
if ($member['mb_level'] != 10) {
    $sql = "select * from g5_auth where mb_id = '{$member['mb_id']}' order by au_auth asc ";
    $auth_result = sql_fetch($sql);

    goto_url($menu[$auth_result['au_menu']][0][2]);
}else{
    goto_url('member_list.php');

}

include_once ('./admin.tail.php');
?>
