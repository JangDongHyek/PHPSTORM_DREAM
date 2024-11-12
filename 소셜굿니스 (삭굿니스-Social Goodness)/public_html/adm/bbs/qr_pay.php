<?php
$sub_id = "qr_pay";
include_once('./_common.php');

$g5['title'] = 'BTM 결제';
include_once('./_head.php');

$mb_no = $_SESSION['ss_mb_no'];
$te_no = $_GET['te_no'];

// 사용자 BTM
$sql = " select * from g5_member where mb_no = {$_SESSION['ss_mb_no']} ";
$mb = sql_fetch($sql);

// 임의로 te_no 6 설정, 작업 완료 후 GET 값으로 변경
$te_no = 6;
$sql = " select * from g5_tes where te_no = {$te_no} ";
$te = sql_fetch($sql);

// 이미지 (첫번째 이미지 하나만)
$sql = " select * from g5_file where fi_table = 'g5_tes' and tb_no = 6 order by fi_no limit 1 ";
$fi = sql_fetch($sql);

$register_action_url = G5_BBS_URL.'/qr_pay.php';
include_once($member_skin_path.'/qr_pay.skin.php');

include_once('./_tail.sub.php');
?>
