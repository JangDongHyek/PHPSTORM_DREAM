<?php
include_once('./_common.php');
/**
 * 레슨(상품) 금액
 */
$lesson_price =  sql_fetch(" select * from g5_lesson where idx = '{$lesson_idx}' ")['lesson_price'];

echo $lesson_price;
exit;