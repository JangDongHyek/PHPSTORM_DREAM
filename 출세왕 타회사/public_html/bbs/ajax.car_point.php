<?php
include_once('./_common.php');

$cw_idx = $_REQUEST['idx'];
$mem_id = $_REQUEST['mem_id'];
$pnt = $_REQUEST['pnt'];

if($pnt && $cw_idx) {
    $sql = " update new_car_wash
                            set cp_price    = cp_price + '$pnt'
             where cw_idx = '$cw_idx' and mb_id = '$mem_id'                   
            ";

    sql_query($sql);
}

?>