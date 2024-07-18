<?
include_once("../common.php");

if(!$is_member){
    $print['code'] = "-1";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}
parse_str($_POST['data'], $order_data);
$bo_table = trim($_POST['bo_table']);
$wr_id = trim($_POST['wr_id']);
$item_count = trim($_POST['item_count']);
$write_id = sql_real_escape_string(get_text(trim($_POST['write_id'])));

$print = array();
if(empty($bo_table)){
    $print['code'] = "-12";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

if(empty($wr_id)){
    $print['code'] = "-13";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

if(empty($item_count)){
    $print['code'] = "-14";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

if(!is_numeric($item_count) || $item_count < 0){
    $print['code'] = "-15";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

$db_table = "g5_write_".$bo_table;
$sql = "select * from `$db_table` where `wr_id` = '$wr_id'";
$row = sql_fetch($sql);

if(empty($row)){
    $print['code'] = "-16";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

if($bo_table == "edu" || $bo_table == "certify" || $bo_table == "academy"){
    if(empty($row['wr_5'])){
        $print['code'] = "-17";
        $print['msg'] = "잘못된 접근입니다.";
        die(json_encode($print));
    }
} else {
    if(empty($row['wr_10'])){
        $print['code'] = "-17";
        $print['msg'] = "잘못된 접근입니다.";
        die(json_encode($print));
    }
}


$buy_no = get_uniqid();
$item_title = sql_real_escape_string($row['wr_subject']);

$item_cost = 0;
$ship_cost = 0;
$add_cost = 0;

if($bo_table == "edu" || $bo_table == "certify" || $bo_table == "academy") {
    $item_cost = $row['wr_5'];
} else {
    $item_cost = $row['wr_10'];
    $ship_cost = $row['wr_9'];
    $add_cost = $row['wr_8'];
    $od_name = $order_data['mb_name'];
    $od_hp = $order_data['mb_hp'];
    $od_zip = $order_data['mb_zip'];
    $od_addr1 = $order_data['mb_addr1'];
    $od_addr2 = $order_data['mb_addr2'];
    $od_addr3 = $order_data['mb_addr3'];
    $od_addr4 = $order_data['mb_addr4'];
}
$sum_cost = $item_count * $item_cost + $ship_cost + $add_cost;
$sql = "insert into `g5_order_list` set 
                        `mb_id` = '{$member['mb_id']}',
                        `buy_no` = '{$buy_no}',
                        `od_name` = '{$od_name}',
                        `od_hp` = '{$od_hp}',
                        `od_zip` = '{$od_zip}',
                        `od_addr1` = '{$od_addr1}',
                        `od_addr2` = '{$od_addr2}',
                        `od_addr3` = '{$od_addr3}',
                        `od_addr4` = '{$od_addr4}',
                        `bo_table` = '{$bo_table}',
                        `wr_id` = '{$wr_id}',
                        `write_id` = '{$write_id}',
                        `item_title` = '{$item_title}',
                        `item_cost` = '{$item_cost}',
                        `ship_cost` = '{$ship_cost}',
                        `add_cost` = '{$add_cost}',
                        `item_count` = '{$item_count}',
                        `sum_cost` = '{$sum_cost}',
                        `state` = '0'";
sql_query($sql);


$print['code'] = "200";
$print['cost'] = $sum_cost;
$print['buy_no'] = $buy_no;
echo json_encode($print);
?>