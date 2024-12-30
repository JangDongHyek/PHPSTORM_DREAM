<?php
include_once('./_common.php');
$sql="update g5_fsw_request set status ='$status' where idx='$idx'";
$result=sql_query($sql);
if($result){
    echo "ok";
}else{
    echo "fail";
}
?>