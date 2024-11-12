<?php
$sub_menu = '400400';
include_once('./_common.php');
auth_check($auth[$sub_menu], "r");
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = {$od_id}.xls" );   
header( "Content-Description: PHP4 Generated Data" ); 
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">"); 

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
	<table width="100%" border="0" cellpadding="4" cellspacing="1">
        <caption>
        <strong>주문 상품 목록</strong>
        <br />
        </caption>
        <thead>
		<tr>
			<th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">이름</th>
			<th colspan="2"><?=$od['od_name']?></th>
			<th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">결제방식</th>
			<th colspan="2"><?=$od['od_settle_case']?></th>
		</tr>
		<tr>
			<th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center">주소</th>
			<th colspan="2">
				<?php echo $od['od_b_zip1'].$od['od_b_zip2']; ?>
				<?php echo get_text($od['od_addr1']); ?>
				<?php echo get_text($od['od_addr2']); ?>
				<?php echo get_text($od['od_addr3']); ?>
				<?php echo get_text($od['od_addr_jibeon']); ?>

			</th>
			<th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">결제내용</th>
			<th colspan="2"><?=$od['od_bank_account']?></th>
		</tr>
		<tr>
			<th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center">배송지</th>
			<th colspan="2">
				<?php echo $od['od_b_zip1'].$od['od_b_zip2']; ?>
				<?php echo get_text($od['od_b_addr1']); ?>
				<?php echo get_text($od['od_b_addr2']); ?>
				<?php echo get_text($od['od_b_addr3']); ?>
				<?php echo get_text($od['od_b_addr_jibeon']); ?>

			</th>
			<th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center">연락처</th>
			<th colspan="2">TEL.<?=$od['od_tel']?> / HP.<?=$od['od_hp']?></th>
		</tr>
        <tr>
            <th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">상품명</th>
            <th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">수량</th>
            <th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">판매가</th>
            <th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">소계</th>
            <th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">배송비</th>
			<th style="background-color:#6f809a;color:#fff;font-weight:bold;text-align:center" width="200">주문날짜</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for($i=0; $row=sql_fetch_array($result); $i++) {
			
            // 상품이미지
            $image = get_it_image($row['it_id'], 50, 50);

            // 상품의 옵션정보
            $sql = " select ct_id, it_id, ct_price, ct_qty, ct_option, ct_status, cp_price, ct_send_cost, io_type, io_price
                        from {$g5['g5_shop_cart_table']}
                        where od_id = '$od_id'
                          and it_id = '{$row['it_id']}'
                        order by io_type asc, ct_id asc ";
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
                $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                           SUM(ct_qty) as qty
                           from {$g5['g5_shop_cart_table']}
                          where it_id = '{$row['it_id']}'
                         and od_id = '$od_id' ";
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
                    $opt_price = $opt['ct_price'] + $opt['io_price'];

                // 소계
                $ct_price['stotal'] = $opt_price * $opt['ct_qty'];
                $ct_point['stotal'] = $opt['ct_point'] * $opt['ct_qty'];
            ?>
            <tr>
                <?php if($k == 0) { ?>
                <td rowspan="<?php echo $rowspan; ?>" align="center" class="td_itname">
					<?php echo stripslashes($row['it_name']); ?>
					(<?php echo $opt['ct_option']; ?>)                </td>
                <?php } ?>
               
                <td align="center" class="td_cntsmall"><?php echo $opt['ct_qty']; ?></td>
                <td align="center" class="td_num"><?php echo number_format($opt_price); ?></td>
                <td align="center" class="td_num"><?php echo number_format($ct_price['stotal']); ?></td>
                <td align="center" class="td_sendcost_by"><?php echo $ct_send_cost; ?></td>
				<td align="center" class="td_num"><?php echo substr($od['od_time'],0,10); ?></td>
            </tr>
            <?php
            }
            ?>
        <?php
        }
        ?>
        </tbody>
</table>