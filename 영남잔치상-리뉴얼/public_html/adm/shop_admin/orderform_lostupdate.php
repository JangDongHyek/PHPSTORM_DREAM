<?php
$sub_menu = '400400';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

//23.11.07 id비교해서 최근껄로 주문번호 바꿔주는 로직임 wc
$od_id = $_REQUEST['od_id'];
$od_ip = $_REQUEST['od_ip'];

$sql = " select * from {$g5['g5_shop_cart_table']} where ct_ip  = '$od_ip' ORDER BY ct_id DESC LIMIT 1 ";
$ct = sql_fetch($sql);

$qstr = "sort1=$sort1&amp;sort2=$sort2&amp;sel_field=$sel_field&amp;search=$search&amp;page=$page";
$url = "./orderform.php?od_id=$od_id&amp;$qstr";

if($ct['od_id']){
    $sql = " update {$g5['g5_shop_order_table']}
                                set od_id = '{$ct['od_id']}'
                                where od_id = '$od_id' ORDER BY od_time DESC LIMIT 1
                                ";
    $result = sql_query($sql);

    if($result){
        $url = "./orderform.php?od_id={$ct['od_id']}&amp;$qstr";
        alert('최근상품 불러오기 성공',$url);
    }else{
        alert('업데이트 실패 잠시 후 다시시도해주세요.',$url);
    }

    //select * from g5_shop_cart where ct_ip = '14.43.98.145' ORDER BY ct_id DESC LIMIT 1
}else{
    alert('알수없는 오류, 잠시 후 다시시도해주세요.',$url);
}