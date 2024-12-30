<?php
include_once("./_common.php");
$regdate=date("Y-m-d H:i:s");
$sql="insert g5_request set 
        wr_id='$wr_id',
        wr_subject='$wr_subject',
        content='$content',
        mb_id='$mb_id',
        mb_name='$mb_name',
        regdate='$regdate'
";

$result=sql_query($sql);

if($result){
    
    /* 관리자 알림톡 전송 */
    $params = array(
        'wr_name' => $mb_name,
        'wr_subject' => $wr_subject
    );
    
    sendAlimTalk(0, $params, ADMIN_TEL);
    
    echo "ok";        
}else{
    echo "fail";
}
?>