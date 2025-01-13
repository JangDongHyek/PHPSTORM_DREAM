<?php
include_once('./_common.php');

$sql = " update g5_content set co_content='{$co_content}', co_mobile_content='{$co_mobile_content}' where co_id='{$co_id}' ";
sql_query($sql);

alert('저장되었습니다!',G5_BBS_URL.'/content.php?co_id='.$co_id);
?>
