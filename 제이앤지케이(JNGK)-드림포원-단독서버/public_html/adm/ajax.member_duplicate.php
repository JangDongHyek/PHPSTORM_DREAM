<?php
include_once("./_common.php");

// 한달 이내에 등록 이력 있는 지 확인 (이름, 등록일자로 확인)
$sql_date = " and date_format(mb_reg_date, '%Y-%m-%d') <= date_format(now(), '%Y-%m-%d') and date_format(mb_reg_date, '%Y-%m-%d') >= date_format(date_add(now(), interval -1 month), '%Y-%m-%d') ";
$count = sql_fetch(" select count(*) as count from g5_member where mb_name = '{$_POST['mb_name']}' and center_code = '{$_POST['center_code']}' and pro_mb_no = '{$_POST['pro_mb_no']}' and use_yn = 'Y' {$sql_date}; ")['count'];

die($count);
?>