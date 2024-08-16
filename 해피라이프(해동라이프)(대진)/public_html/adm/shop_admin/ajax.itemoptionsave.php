<?php
include_once('./_common.php');

$item = sql_fetch("select it_option_subject from g5_shop_item where it_id = '{$it_id}'");
echo $item['it_option_subject'];
?>