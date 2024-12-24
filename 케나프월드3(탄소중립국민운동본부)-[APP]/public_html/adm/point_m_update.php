<?php
$sub_menu = "200200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = $_POST['mb_id'];
$po_point = $_POST['po_point'];
$po_content = $_POST['po_content'];
$expire = preg_replace('/[^0-9]/', '', $_POST['po_expire_term']);

$mb = get_member($mb_id);

if (!$mb['mb_id'])
    alert('존재하는 회원아이디가 아닙니다.', './point_m_list.php?'.$qstr);

if (($po_point < 0) && ($po_point * (-1) > $mb['mb_point']))
    alert('포인트를 깎는 경우 현재 포인트보다 작으면 안됩니다.', './point_mist_l.php?'.$qstr);

$po_rel_table = "@passive";
if($mb_register)
	$po_rel_table = "@bonus";

insert_point_m($mb_id, $po_point, $po_content, $po_rel_table, $mb_id, $member['mb_id'].'-'.uniqid(''), $expire);
if($mb_register && $mb['mb_recommend']){
	insert_point_m($mb['mb_recommend'], ($po_point * 0.1), $mb['mb_name']."님의 추천인 보너스 지급", $po_rel_table, $mb['mb_recommend'], $member['mb_id'].'-'.uniqid(''), $expire);
}

goto_url('./point_m_list.php?'.$qstr);
?>
