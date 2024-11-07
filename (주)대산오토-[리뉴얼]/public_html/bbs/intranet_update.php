<?php
include_once('./_common.php');
$sql="update g5_write_{$bo_table} set wr_2='$wr_2' where wr_id='$wr_id'";
sql_query($sql);
goto_url(G5_BBS_URL."/board.php?bo_table=$bo_table&page=$page&sca=$sca&sop=$sop&sfl=$sfl&stx=$stx");
?>