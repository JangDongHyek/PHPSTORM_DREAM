<?php
include_once('./_common.php');

$sql = " select * from g5_member where mb_level = 2 and mb_approval = 'Y' order by mb_no ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $sql = " insert into g5_member_point set mb_id = '{$row['mb_id']}', point_category = '적립', point = 330, acc_point = 330, point_content = '프로필 심사 승인 (330 만나 지급)', wr_datetime = '".G5_TIME_YMDHIS."' ";
    $result2 = sql_query($sql);

//    if($row['mb_no'] != 73) {
//        $file_sql = " update g5_member_img set thumb = 'Y' where mb_no = {$row['mb_no']} order by idx limit 1";
//        $result2 = sql_query($file_sql);
//    }
}

echo $result2;