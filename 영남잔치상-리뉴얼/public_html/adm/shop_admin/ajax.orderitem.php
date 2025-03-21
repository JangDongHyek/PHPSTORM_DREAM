<?php
$sub_menu = '400400';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$od_id = $_POST['od_id'];

$sql = " select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
$od = sql_fetch($sql);

if(!$od['od_id'])
    die('<div>주문정보가 존재하지 않습니다.</div>');

// 상품목록
$sql = " select it_id,
                it_name,
                cp_price,
                ct_notax,
                ct_send_cost,
                it_sc_type
           from {$g5['g5_shop_cart_table']}
          where od_id = '$od_id'
          group by it_id
          order by ct_id ";
$result = sql_query($sql);
?>

<section id="cart_list">
	<div style="float:left">
    <h2 class="h2_frm">주문상품 목록</h2>
	</div>
	<div style="float:right">
		<a href="./excel.orderitem.php?od_id=<?=$od_id?>">엑셀다운로드</a>
	</div>

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption>주문 상품 목록</caption>
        <thead>
        <tr>
            <th scope="col">상품명</th>
            <th scope="col">옵션항목</th>
            <th scope="col">상태</th>
            <th scope="col">수량</th>
            <th scope="col">판매가</th>
            <th scope="col">소계</th>
            <th scope="col">쿠폰</th>
            <th scope="col">포인트</th>
            <th scope="col">배송비</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for($i=0; $row=sql_fetch_array($result); $i++) {
            // 상품이미지
            $image = get_it_image($row['it_id'], 50, 50);

            // 상품의 옵션정보
            /*
            $sql = " select ct_id, it_id, ct_price, ct_point, ct_qty, ct_option, ct_status, cp_price, ct_stock_use, ct_point_use, ct_send_cost, io_type, io_price,io_id
                        from {$g5['g5_shop_cart_table']}
                        where od_id = '$od_id'
                          and it_id = '{$row['it_id']}'
                        order by io_type asc, ct_id asc ";
            $res = sql_query($sql);*/

            $sql = " select a.ct_id, a.it_id, a.ct_price, a.ct_point, a.ct_qty, a.ct_option, a.ct_status, a.cp_price, a.ct_stock_use, a.ct_point_use, a.ct_send_cost, a.io_type, a.io_price,a.io_id ,b.it_price
                        from {$g5['g5_shop_cart_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
                        where a.od_id = '$od_id' 
                          and a.it_id = '{$row['it_id']}'
                        order by a.io_type asc, a.ct_id asc ";
            $res = sql_query($sql);

            $rowspan = sql_num_rows($res);

            // 배송비
            switch($row['ct_send_cost'])
            {
                case 1:
                    $ct_send_cost = '착불';
                    break;
                case 2:
                    $ct_send_cost = '무료';
                    break;
                default:
                    $ct_send_cost = '선불';
                    break;
            }

            // 조건부무료
            if($row['it_sc_type'] == 2) {
                
                // 합계금액 계산
                /*
                $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                           SUM(ct_qty) as qty
                           from {$g5['g5_shop_cart_table']}
                          where it_id = '{$row['it_id']}'
                         and od_id = '$od_id' ";
                $sum = sql_fetch($sql);
                */

                //240422 상품가격 item에 it_price로 가져옴 wc
                $sql = " select SUM(IF(a.io_type = 1, (a.io_price * a.ct_qty), ((b.it_price + a.io_price) * a.ct_qty))) as price,
                            SUM(a.ct_qty) as qty,
                            b.it_price as it_price
                        from {$g5['g5_shop_cart_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
                        where a.it_id = '{$row['it_id']}'
                          and a.od_id = '$od_id' 
		
						  ";
                $sum = sql_fetch($sql);

                $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od_id);

                if($sendcost == 0)
                    $ct_send_cost = '무료';

                $save_it_id = $row['it_id'];
            }

            for($k=0; $opt=sql_fetch_array($res); $k++) {
                if($opt['io_type'])
                    $opt_price = $opt['io_price'];
                else
                    $opt_price = $opt['it_price'] + $opt['io_price'];

                // 소계
                $ct_price['stotal'] = $opt_price * $opt['ct_qty'];
                $ct_point['stotal'] = $opt['ct_point'] * $opt['ct_qty'];
            ?>
            <tr>
                <?php if($k == 0) { ?>
                <td class="td_itname" rowspan="<?php echo $rowspan; ?>">
                    <a href="./itemform.php?w=u&amp;it_id=<?php echo $row['it_id']; ?>"><?php echo $image; ?> <?php echo stripslashes($row['it_name']); ?></a>
                    <?php if($od['od_tax_flag'] && $row['ct_notax']) echo '[비과세상품]'; ?>
                </td>
                <?php } ?>
                <td class="td_itopt_tl">
                    <?php echo $opt['ct_option']; ?>
                </td>
                <td class="td_mngsmall"><?php echo $opt['ct_status']; ?></td>
                <td class="td_cntsmall"><?php echo $opt['ct_qty']; ?></td>
                <td class="td_num"><?php echo number_format($opt_price); ?></td>
                <td class="td_num"><?php echo number_format($ct_price['stotal']); ?></td>
                <td class="td_num"><?php echo number_format($opt['cp_price']); ?></td>
                <td class="td_num"><?php echo number_format($ct_point['stotal']); ?></td>
                <td class="td_sendcost_by"><?php echo $ct_send_cost; ?></td>
            </tr>
            <?php
            }
            ?>
        <?php
        }
        ?>
        </tbody>
        </table>
    </div>
</section>