<?php
include_once('./_common.php');

$idx = $_REQUEST['idx'];

if ($is_admin != 'super' ) alert('최고관리자만 접근 가능합니다.');


$sql = "select count(*) cnt from new_payment where Moid like '%-{$idx}-%' ";
$cnt = sql_fetch($sql)['cnt'];

//if ($cnt > 0){
//    alert("거래내역이 있는 재능은 삭제할 수 없습니다.");
//    die();
//}

$sql = "select * from new_talent where ta_idx = '{$idx}' ";
$row = sql_fetch($sql);

if ($row['ta_idx'] != "" ) {
    $sql = "delete from {$g5['talent_table']} where ta_idx = '{$row['ta_idx']}' ";
    sql_query($sql);

    $sql = " select bf_idx,bf_file,bo_table from {$g5['board_file_table']} where (bo_table = 'talent' or bo_table = 'sub_talent' or bo_table = 'thum_talent') and wr_id = '{$row['ta_idx']}' ";
    $img_sql = sql_query($sql);
    for ($a = 0; $img_row = sql_fetch_array($img_sql); $a++) {
        @unlink(G5_DATA_PATH . '/file/' . $img_row['bo_table'] . '/' . $img_row['bf_file']);
        $sql = "delete from {$g5['board_file_table']} where bf_idx = '" . $img_row['bf_idx'] . "' ";
        sql_query($sql);
    }

    $sql = "delete from {$g5['category_service_table']} where ta_idx = '{$row['ta_idx']}' ";
    sql_query($sql);

    $sql = "delete from {$g5['pay_talent_table']} where ta_idx = '{$row['ta_idx']}' ";
    sql_query($sql);

    $sql = "delete from new_talent_qna where ta_idx = '{$row['ta_idx']}' ";
    sql_query($sql);

    $sql = "delete from new_like where li_table = 'talent' and ta_idx = '{$row['ta_idx']}' ";
    sql_query($sql);

    alert("삭제가 완료되었습니다.");

}else{
    alert("존재하지 않는 게시물입니다.",G5_ADMIN_URL."/talent_list.php");
}

