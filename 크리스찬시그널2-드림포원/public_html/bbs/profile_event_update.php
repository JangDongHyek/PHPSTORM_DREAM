<?php
include_once('./_common.php');

//print_r($_REQUEST);exit;

$sql = " insert into g5_profile_event set ";
$sql .= " color = '{$_REQUEST['color']}', flower = '{$_REQUEST['flower']}', sports = '{$_REQUEST['sports']}', 
          age = '{$_REQUEST['age']}', area = '{$_REQUEST['area']}', tel = '{$_REQUEST['tel']}', wr_datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql);

alert('작성완료하였습니다.', G5_BBS_URL.'/content.php?co_id=greet06', false);
?>