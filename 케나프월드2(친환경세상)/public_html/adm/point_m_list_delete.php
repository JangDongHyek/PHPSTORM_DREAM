<?php
$sub_menu = '200200';
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'd');

check_admin_token();

$count = count($_POST['chk']);
if(!$count)
    alert($_POST['act_button'].' 하실 항목을 하나 이상 체크하세요.');

for ($i=0; $i<$count; $i++)
{
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];

    // 포인트 내역정보
    $sql = " select * from {$g5['point_table_m']} where po_id = '{$_POST['po_id'][$k]}' ";
    $row = sql_fetch($sql);

    if(!$row['po_id'])
        continue;

    if($row['po_point'] < 0) {
        $mb_id = $row['mb_id'];
        $po_point = abs($row['po_point']);

        if($row['po_rel_table'] == '@expire')
            delete_expire_point_m($mb_id, $po_point);
        else
            delete_use_point_m($mb_id, $po_point);
		exit;
    } else {
        if($row['po_use_point'] > 0) {
            insert_use_point_m($row['mb_id'], $row['po_use_point'], $row['po_id']);
        }
    }

    // 포인트 내역삭제
    $sql = " delete from {$g5['point_table_m']} where po_id = '{$_POST['po_id'][$k]}' ";
    sql_query($sql);

    // po_mb_point에 반영
    $sql = " update {$g5['point_table_m']}
                set po_mb_point = po_mb_point - '{$row['po_point']}'
                where mb_id = '{$_POST['mb_id'][$k]}'
                  and po_id > '{$_POST['po_id'][$k]}' ";
    sql_query($sql);

    // 포인트 UPDATE
    $sum_point = get_point_sum_m($_POST['mb_id'][$k]);
    $sql= " update {$g5['member_table']} set mb_point_m = '$sum_point' where mb_id = '{$_POST['mb_id'][$k]}' ";
    sql_query($sql);
}

goto_url('./point_m_list.php?'.$qstr);
?>