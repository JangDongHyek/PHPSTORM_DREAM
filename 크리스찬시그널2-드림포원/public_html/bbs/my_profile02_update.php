<?php
$sub_id = "my_profile02";
include_once('./_common.php');

//print_r($_REQUEST);exit;
$mb_id = $_POST['mb_id'];
$page = $_POST['page']; // 이동할 페이지 (기본정보 or 취미/관심사)

$sql = " select mb_no from {$g5['member_table']} where mb_id = '{$mb_id}' ";
$mb_no = sql_fetch($sql)['mb_no'];

$sql_common = " interview1_text1 = '{$_POST['interview1_text1']}', 
                interview2_text1 = '{$_POST['interview2_text1']}', 
                interview2_text2 = '{$_POST['interview2_text2']}', 
                interview3_text1 = '{$_POST['interview3_text1']}', 
                interview3_text2 = '{$_POST['interview3_text2']}', 
                interview4_text1 = '{$_POST['interview4_text1']}', 
                interview4_text2 = '{$_POST['interview4_text2']}', 
                interview5_text1 = '{$_POST['interview5_text1']}', 
                interview5_text2 = '{$_POST['interview5_text2']}', 
                interview6_text1 = '{$_POST['interview6_text1']}', 
                interview7_text1 = '{$_POST['interview7_text1']}', 
                interview8_text1 = '{$_POST['interview8_text1']}', 
                interview9_text1 = '{$_POST['interview9_text1']}', 
                interview10_text1 = '{$_POST['interview10_text1']}', 
                interview11_text1 = '{$_POST['interview11_text1']}', 
                interview11_text2 = '{$_POST['interview11_text2']}',
                interview12_text1 = '{$_POST['interview12_text1']}',
                interview12_text2 = '{$_POST['interview12_text2']}',
                interview13_text1 = '{$_POST['interview13_text1']}',
                interview14_text1 = '{$_POST['interview14_text1']}'
                ";
/*for ($i = 1; $i <= 12; $i++) {
    if(!empty($_POST['interview'.$i.'_text1'])) {
        $sql_common .= " interview".$i."_text1 = '{$_POST['interview'.$i.'_text1']}', ";
    }
    if(!empty($_POST['interview'.$i.'_text2'])) {
        $sql_common .= " interview".$i."_text2 = '{$_POST['interview'.$i.'_text2']}', ";
    }
    if(!empty($_POST['interview'.$i.'_text3'])) {
        $sql_common .= " interview".$i."_text3 = '{$_POST['interview'.$i.'_text3']}', ";
    }
}*/
$sql_common = substr($sql_common, 0, -2);

$sql = " select count(*) as count from g5_member_interview where mb_no = '{$mb_no}' ";
$count = sql_fetch($sql)['count'];

if($count > 0) {
    $sql = " update g5_member_interview set {$sql_common} where mb_no = '{$mb_no}' ";
    sql_query($sql);
}
else {
    $sql = " insert into g5_member_interview set mb_no = '{$mb_no}', {$sql_common} ";
    sql_query($sql);
}

// 프로필 작성 상태 완료 업데이트
$sql = " update {$g5['member_table']} set mb_profile2 = 'Y' where mb_id = '{$mb_id}' ";
sql_query($sql);

die('success');
//goto_url(G5_BBS_URL.'/'.$page.'?mb_id='.$mb_id);
?>