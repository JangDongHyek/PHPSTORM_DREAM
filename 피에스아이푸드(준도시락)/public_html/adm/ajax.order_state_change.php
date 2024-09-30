<?php
include_once('./_common.php');
/**
 * 주문내역 - 주문상태변경 (ajax)
 */

$sql = " update g5_order set order_state = '{$state}' where idx = '{$idx}' ";
$result = sql_query($sql);

die($result);