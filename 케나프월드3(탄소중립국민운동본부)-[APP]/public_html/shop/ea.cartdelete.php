<?php
include_once('./_common.php');

// print_r2($_POST); exit;

// 보관기간이 지난 상품 삭제
cart_item_clean();
// cart id 설정
set_cart_id($sw_direct);

if($sw_direct)
    $tmp_cart_id = get_session('ss_cart_direct');
else
    $tmp_cart_id = get_session('ss_cart_id');

$sql = " delete from {$g5['g5_shop_cart_table']} where it_id = '$it_id' and od_id = '$tmp_cart_id' ";
sql_query($sql);

goto_url(G5_SHOP_URL."/cart.php");
?>