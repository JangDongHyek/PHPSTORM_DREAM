<?php
include_once("./_common.php");
/**
 * 자료실 하위 카테고리
 */

$rlt = sql_query(" select * from g5_reference_room_category where main = '{$category}' ");
$options = "";
for($i=0; $row=sql_fetch_array($rlt); $i++) {
    if(!empty($row['sub'])) $options .= "<option value='".$row['sub']."'>".$row['sub']."</option>";
}
echo $options;
