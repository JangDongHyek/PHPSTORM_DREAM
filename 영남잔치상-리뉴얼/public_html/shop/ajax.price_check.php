<?php
include_once('./_common.php');

$is_mobile_order = is_mobile();

$sw_direct = get_session("ss_direct");

if ($sw_direct) {
    $tmp_cart_id = get_session('ss_cart_direct');
}
else {
    $tmp_cart_id = get_session('ss_cart_id');
}

if (get_cart_count($tmp_cart_id) == 0)
    alert('장바구니가 비어 있습니다.', G5_SHOP_URL.'/cart.php');

$s_cart_id = $tmp_cart_id;

$is_visit = false; //방문수령인지 아닌지 파악하기 배송비에 필요
$tot_point = 0;
$tot_sell_price = 0;

$goods = $goods_it_id = "";
$goods_count = -1;

// $s_cart_id 로 현재 장바구니 자료 쿼리
$sql = "select a.ct_id,
               a.it_id,
               a.it_name,
               a.ct_price,
               a.ct_point,
               a.ct_qty,
               a.ct_status,
               a.ct_send_cost,
               a.it_sc_type,
               b.ca_id,
               b.ca_id2,
               b.ca_id3,
               b.it_notax,
               b.ca_id
        from {$g5['g5_shop_cart_table']} a
        left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
        where a.od_id = '$s_cart_id'
        and a.ct_select = '1' ";
$sql .= "group by a.it_id ";
$sql .= "order by a.ct_id ";
$result = sql_query($sql);

$good_info = '';
$it_send_cost = 0;
$it_cp_count = 0;

$comm_tax_mny = 0; // 과세금액
$comm_vat_mny = 0; // 부가세
$comm_free_mny = 0; // 면세금액
$tot_tax_mny = 0;

$ca_ids = [];
$firstCaId = "";
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if(strval(array_search(substr($row['ca_id'],0,2), $firstCaIds)) != ""){
        array_push($ca_ids, $row['ca_id']);
        $firstCaId = substr($row['ca_id'],0,2);
    }
    // 합계금액 계산
    /*
    $sql = "select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                   SUM(ct_point * ct_qty) as point,
                   SUM(ct_qty) as qty
            from {$g5['g5_shop_cart_table']}
            where it_id = '{$row['it_id']}'
            and od_id = '$s_cart_id' ";
    $sum = sql_fetch($sql);
    */
    //240422 상품가격 item에 it_price로 가져옴 wc
    $sql = " select SUM(IF(a.io_type = 1, (a.io_price * a.ct_qty), ((b.it_price + a.io_price) * a.ct_qty))) as price,
                            SUM(a.ct_point * a.ct_qty) as point,
                            SUM(a.ct_qty) as qty
                        from {$g5['g5_shop_cart_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
                        where a.it_id = '{$row['it_id']}'
                          and a.od_id = '$s_cart_id' ";
    $sum = sql_fetch($sql);

    if (!$goods) {
        $goods = preg_replace("/\'|\"|\||\,|\&|\;/", "", $row['it_name']);
        $goods_it_id = $row['it_id'];
    }
    $goods_count++;

    $image = get_it_image($row['it_id'], 80, 80);

    $it_name = '<b>' . stripslashes($row['it_name']) . '</b>';
    $it_options = print_item_options($row['it_id'], $s_cart_id);
    if(0 < strpos($it_options,"방문수령")){
        $is_visit = true;
    }
    if($it_options) {
        $it_name .= '<div class="sod_opt">'.$it_options.'</div>';
    }

    if($default['de_tax_flag_use']) {
        if($row['it_notax']) {
            $comm_free_mny += $sum['price'];
        } else {
            $tot_tax_mny += $sum['price'];
        }
    }

    $point = $sum['point'];
    $sell_price = $sum['price'];

    $tot_point += $point;
    $tot_sell_price += $sell_price;
}

if ($i == 0) {
    echo "장바구니가 비어 있습니다.";
} else {
    $send_cost = get_sendcost($s_cart_id);
}

if($default['de_tax_flag_use']) {
    $comm_tax_mny = round(($tot_tax_mny + $send_cost) / 1.1);
    $comm_vat_mny = ($tot_tax_mny + $send_cost) - $comm_tax_mny;
}

$chk_total_price = $chk_price + $chk_cost + $chk_cost2 - $chk_coupon - $chk_point;

if($tot_sell_price != $chk_price){
    echo "합계가 틀립니다.";
}

if($is_member){
    if($member['mb_point'] - $chk_point < 0){
        echo "사용 가능한 포인트가 부족합니다.";
    }
}