<?php
$sub_menu = '250100';
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
    $sql = " select * from {$g5['asset_table']} where po_id = '{$_POST['po_id'][$k]}' ";
    $row = sql_fetch($sql);

    if(!$row['po_id'])
        continue;

    if($row['po_asset'] < 0) {
        $mb_id = $row['mb_id'];
        $po_asset = abs($row['po_asset']);

        if($row['po_rel_table'] == '@expire')
            delete_expire_asset($mb_id, $po_asset);
        else
            delete_use_asset($mb_id, $po_asset);
    } else {
        if($row['po_use_asset'] > 0) {
            insert_use_asset($row['mb_id'], $row['po_use_asset'], $row['po_id']);
        }
    }

    // 포인트 내역삭제
    $sql = " delete from {$g5['asset_table']} where po_id = '{$_POST['po_id'][$k]}' ";
    sql_query($sql);

    // po_mb_asset에 반영
    $sql = " update {$g5['asset_table']}
                set po_mb_asset = po_mb_asset - '{$row['po_asset']}'
                where mb_id = '{$_POST['mb_id'][$k]}'
                  and po_id > '{$_POST['po_id'][$k]}' ";
    sql_query($sql);

    // 포인트 UPDATE
    $sum_asset = get_asset_sum($_POST['mb_id'][$k]);
    $sql= " update {$g5['member_table']} set mb_asset = '$sum_asset' where mb_id = '{$_POST['mb_id'][$k]}' ";
    sql_query($sql);
}

goto_url('./asset_list.php?'.$qstr);
?>