<?php
include_once('./_common.php');

$del_comment = trim($_POST['del_comment']);
$mb_id    = trim($_POST['mb_id']);

//기존탈퇴기능 이렇게되어있었음
$sql2 = " update {$g5['member_table']} set mb_8 = 1  where mb_id = '{$mb_id}' ";
$result2 = sql_query($sql2);

//문구작성해주는거 여러번도 가능하고 최신한개만 씀
$sql = "INSERT INTO g5_member_del (mb_id, del_comment )
               value ('$mb_id','$del_comment')
";
$result = sql_query($sql);

echo $result;

?>