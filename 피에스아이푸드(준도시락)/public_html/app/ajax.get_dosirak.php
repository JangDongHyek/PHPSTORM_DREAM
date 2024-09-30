<?php
include_once("../common.php");
/**
 * 도시락 선택
 */
$rlt = sql_query(" select * from g5_dosirak where do_category = '{$main}' ");
$option = "";
while($row = sql_fetch_array($rlt)) {
?>
<option value="<?=$row['idx']?>"><?=$row['do_name']?></option>
<?php
}
?>
