<?php
include_once('./_common.php');

// 오류시 공히 Error 라고 처리하는 것은 회원정보가 있는지? 비밀번호가 틀린지? 를 알아보려는 해킹에 대비한것

$mb_no = trim($_GET['mb_no']);
$mb_nonce = trim($_GET['mb_nonce']);

// 회원아이디가 아닌 회원고유번호로 회원정보를 구한다.
$sql = " select mb_id, mb_lost_certify from {$g5['member_table']} where mb_no = '{$mb_no}' ";
$mb  = sql_fetch($sql);
if (empty($mb['mb_lost_certify']))
    die("Error");

sql_query(" update {$g5['member_table']} set mb_lost_certify = '', mb_password = '".$mb['mb_lost_certify']."' where mb_no = '{$mb_no}' ");
alert('Your password has been changed.\\n\\nPlease log in with your member ID and changed password.', G5_BBS_URL.'/login.php');

// // 인증 링크는 한번만 처리가 되게 한다.
// sql_query(" update {$g5['member_table']} set mb_lost_certify = '' where mb_no = '$mb_no' ");
//
// // 인증을 위한 난수가 제대로 넘어온 경우 임시비밀번호를 실제 비밀번호로 바꿔준다.
// if ($mb_nonce === substr($mb['mb_lost_certify'], 0, 32)) {
//     $new_password_hash = substr($mb['mb_lost_certify'], 33);
//     sql_query(" update {$g5['member_table']} set mb_password = '$new_password_hash' where mb_no = '$mb_no' ");
//     alert('Your password has been changed.\\n\\nPlease log in with your member ID and changed password.', G5_BBS_URL.'/login.php');
// }
// else {
//     die("Error");
// }
?>
