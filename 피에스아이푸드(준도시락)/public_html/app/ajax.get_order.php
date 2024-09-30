<?php
include_once ('../common.php');
/**
 * 정기배달 도시락 주문내역 (new)
 * 주문 정보
 */

$sql = " select * from g5_order where mb_id = '{$member['mb_id']}' and delivery_date like '{$date}%' and read_yn is not null order by delivery_date ";
$rlt = sql_query($sql);

$arr = [];
while($row = sql_fetch_array($rlt)) {
    $row['wr_datetime'] = substr($row['wr_datetime'], 0, 10);
    array_push($arr, $row);
}

echo json_encode($arr);exit;
