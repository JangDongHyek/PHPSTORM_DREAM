<?php
// 창업정보 - 개설희망지역 구/군 정보 불러오기
include_once('./_common.php');

if ($_POST['si'] == "") die();

$sql = "SELECT gugun FROM g5_map WHERE si_short = '{$_POST['si']}' ORDER BY gugun ASC;";
$result = sql_query($sql);
//$result_cnt = sql_num_rows($result);
?>
<option value="">2차</option>
<? while($row = sql_fetch_array($result)) { ?>
<option value="<?=$row['gugun']?>" <?if ($row['gugun'] == $_POST['gugun']) echo "selected"; ?>><?=$row['gugun']?></option>
<? } ?>