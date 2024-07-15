<?php
include_once('./_common.php');
/**
 * 사용자 차단 (리스트에서 숨김 처리 - 앱 심사 통과용)
 */

$target_mb_no = get_member($target)['mb_no'];

$sql = " insert into g5_block set mb_id = '{$member['mb_id']}', target_mb_id = '{$target}', target_mb_no = '{$target_mb_no}', rel_table = '{$rel_table}', rel_idx = '{$rel_idx}', wr_datetime = '".G5_TIME_YMDHIS."' ";
$result = sql_query($sql);

if($result) {
    $msg = '사용자가 차단되었습니다.';
    if($url == 'helpme') {
        alert($msg, G5_BBS_URL.'/help_list.php', false);
    }
    else if($url == 'community') {
        alert($msg, G5_BBS_URL.'/community.php', false);
    }
    else if($url == 'reference') {
        alert($msg, G5_BBS_URL.'/shop.php', false);
    }
    else {
        alert($msg, '', false);
    }
    //die('success');
}
