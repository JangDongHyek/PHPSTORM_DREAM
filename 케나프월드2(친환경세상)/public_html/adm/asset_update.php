<?php
$sub_menu = "250100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = $_POST['mb_id'];
$po_asset = $_POST['po_asset'];
$po_content = $_POST['po_content'];
$expire = preg_replace('/[^0-9]/', '', $_POST['po_expire_term']);

$mb = get_member($mb_id);

if (!$mb['mb_id'])
    alert('존재하는 회원아이디가 아닙니다.', './asset_list.php?'.$qstr);

if (($po_asset < 0) && ($po_asset * (-1) > $mb['mb_asset']))
    alert('포인트를 깎는 경우 현재 포인트보다 작으면 안됩니다.', './asset_list.php?'.$qstr);

insert_asset($mb_id, $po_asset, $po_content, '@passive', $mb_id, $member['mb_id'].'-'.uniqid(''), $expire);

goto_url('./asset_list.php?'.$qstr);
?>
