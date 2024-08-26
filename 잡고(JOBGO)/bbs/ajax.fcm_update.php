<?php
include_once('./_common.php');

if (isset($member['mb_id'])) {
    //푸시알람을 위한 토큰 생성
    $sql="select * from g5_fcm where mb_id = '".$member['mb_id']."' " ;
    $result=sql_query($sql);
    if(sql_num_rows($result) > 0){
        $sql="update g5_fcm set token='".$_REQUEST['token']."' where mb_id = '".$member['mb_id']." ' ";
    }else{
        $sql="insert g5_fcm set mb_id='".$member["mb_id"]."',token='".$_REQUEST['token']." '";
    }
    $result=sql_query($sql);
}
?>