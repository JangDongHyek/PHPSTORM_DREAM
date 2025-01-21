<?php
include_once('./_common.php');

echo "TEST";

echo $member['mb_id'];
/*
$sql = "update new_car_wash set is_payment = 'Y' where cw_idx = '{$moid_arr[1]}' ";
sql_query($sql);

$sql = "select car_date_type from new_car_wash where cw_idx = '{$moid_arr[1]}'";
$cdt = sql_fetch($sql)["car_date_type"];


//2023-11-28
//포인트 사용처리

if($car_result['cp_id'] == "POINT"){
    $use_point = $car_result['cp_price'];
    insert_use_point($member['mb_id'], $use_point);
}
*/

//$sql = "SELECT * FROM new_car_wash where cw_idx = '163'";
//$car_result = sql_fetch($sql);
//if($car_result['cp_id'] == "POINT"){
//    $use_point = $car_result['cp_price'];
//    insert_use_point($member['mb_id'], $use_point);
//}


//print_r($car_result);
?>
