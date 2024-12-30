<?php
include_once("./_common.php");
$regdate=date("Y-m-d H:i:s");
$sql="insert g5_fsw_request2 set 
		bo_table='$bo_table',
        wr_subject='$wr_subject',
        content='$content',
        mb_id='$mb_id',
        mb_name='$mb_name',
        regdate='$regdate'
";

$result=sql_query($sql);
if($result){
    echo "ok";
}else{
    echo "fail";
}
?>