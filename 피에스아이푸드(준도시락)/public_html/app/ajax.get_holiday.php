<?php
include_once ('../common.php');
/**
 * 공휴일 정보
 */

$sql = " select * from g5_holiday ";
$rlt = sql_query($sql);

$arr = [];
$holiday0 = [];
$holiday1 = [];
$holiday2 = [];
$i = 0;
while($row = sql_fetch_array($rlt)) {
    if($row['type'] == 0) {
        array_push($holiday0, $row['month'].$row['day']);
    } else if($row['type'] == 1) {
        array_push($holiday1, $row['month'].$row['day']);
    } else {
        array_push($holiday2, $row['year'].$row['month'].$row['day']);
    }
}
array_push($arr, $holiday0);
array_push($arr, $holiday1);
array_push($arr, $holiday2);

echo json_encode($arr);
