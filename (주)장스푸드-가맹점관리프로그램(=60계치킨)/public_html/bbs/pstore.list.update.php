<?php
include_once('./_common.php');

$mb_id = $_GET['mb_id'];
$po_point = $_GET['po_point'];
$po_content = $_GET['po_content'];
$po_etc = $_GET['po_etc'];
$expire = preg_replace('/[^0-9]/', '', $_GET['po_expire_term']);
$mb = get_member($mb_id);

$po_type = "발급";
if($_GET[point_st]=="-"){
	$po_point="-".$po_point;
	$po_type = "차감";
}
$qstr="page=$page&ss[sc]=$ss[sc]";

if (!$mb['mb_id'])
    alert('존재하는 회원아이디가 아닙니다.');

if (($po_point < 0) && ($po_point * (-1) > $mb['mb_point']))
    alert('마일리지를 차감하는 경우 현재 포인트보다 작으면 안됩니다.', './pstore.list.php?'.$qstr);

insert_point2($mb_id, $po_point, $po_content, '@passive', $mb_id, $member['mb_id'].'-'.uniqid(''), $expire, $po_type, $po_etc);


goto_url('./pstore.list.php?'.$qstr);
?>
