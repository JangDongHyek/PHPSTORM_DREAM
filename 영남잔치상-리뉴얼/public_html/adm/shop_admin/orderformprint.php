<?php
$sub_menu = '400400';
include_once('./_common.php');
$files = glob(G5_ADMIN_PATH.'/css/admin_extend_*');
if (is_array($files)) {
    foreach ((array) $files as $k=>$css_file) {
        
        $fileinfo = pathinfo($css_file);
        $ext = $fileinfo['extension'];
        
        if( $ext !== 'css' ) continue;
        
        $css_file = str_replace(G5_ADMIN_PATH, G5_ADMIN_URL, $css_file);
        add_stylesheet('<link rel="stylesheet" href="'.$css_file.'">', $k);
    }
}
include_once(G5_PATH.'/head.sub.php');
// 완료된 주문에 포인트를 적립한다.
?>
<link rel="stylesheet" href="../css/admin.css"/>

<?

//------------------------------------------------------------------------------
// 주문서 정보
//------------------------------------------------------------------------------
$sql = " select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
$od = sql_fetch($sql);
if (!$od['od_id']) {
    alert("해당 주문번호로 주문서가 존재하지 않습니다.");
}

$od['mb_id'] = $od['mb_id'] ? $od['mb_id'] : "비회원";
//------------------------------------------------------------------------------


$html_receipt_chk = '<input type="checkbox" id="od_receipt_chk" value="'.$od['od_misu'].'" onclick="chk_receipt_price()">
<label for="od_receipt_chk">결제금액 입력</label><br>';

$qstr1 = "od_status=".urlencode($od_status)."&amp;od_settle_case=".urlencode($od_settle_case)."&amp;od_misu=$od_misu&amp;od_cancel_price=$od_cancel_price&amp;od_refund_price=$od_refund_price&amp;od_receipt_point=$od_receipt_point&amp;od_coupon=$od_coupon&amp;fr_date=$fr_date&amp;to_date=$to_date&amp;sel_field=$sel_field&amp;search=$search&amp;save_search=$search";
if($default['de_escrow_use'])
    $qstr1 .= "&amp;od_escrow=$od_escrow";
$qstr = "$qstr1&amp;sort1=$sort1&amp;sort2=$sort2&amp;page=$page";

// 상품목록
$sql = " select it_id,
                it_name,
                cp_price,
                ct_notax,
                ct_send_cost,
                it_sc_type
           from {$g5['g5_shop_cart_table']}
          where od_id = '{$od['od_id']}'
          group by it_id
          order by ct_id ";
$result = sql_query($sql);

// 주소 참고항목 필드추가
if(!isset($od['od_addr3'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_order_table']}`
                    ADD `od_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `od_addr2`,
                    ADD `od_b_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `od_b_addr2` ", true);
}

// 배송목록에 참고항목 필드추가
if(!sql_query(" select ad_addr3 from {$g5['g5_shop_order_address_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_order_address_table']}`
                    ADD `ad_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `ad_addr2` ", true);
}

// 결제 PG 필드 추가
if(!sql_query(" select od_pg from {$g5['g5_shop_order_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_order_table']}`
                    ADD `od_pg` varchar(255) NOT NULL DEFAULT '' AFTER `od_mobile`,
                    ADD `od_casseqno` varchar(255) NOT NULL DEFAULT '' AFTER `od_escrow` ", true);

    // 주문 결제 PG kcp로 설정
    sql_query(" update {$g5['g5_shop_order_table']} set od_pg = 'kcp' ");
}

// LG 현금영수증 JS
if($od['od_pg'] == 'lg') {
    if($default['de_card_test']) {
    echo '<script language="JavaScript" src="http://pgweb.uplus.co.kr:7085/WEB_SERVER/js/receipt_link.js"></script>'.PHP_EOL;
    } else {
        echo '<script language="JavaScript" src="http://pgweb.uplus.co.kr/WEB_SERVER/js/receipt_link.js"></script>'.PHP_EOL;
    }
}
// 주문금액 = 상품구입금액 + 배송비 + 추가배송비
    $amount['order'] = $od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2'];

    // 입금액 = 결제금액 + 포인트
    $amount['receipt'] = $od['od_receipt_price'] + $od['od_receipt_point'];

    // 쿠폰금액
    $amount['coupon'] = $od['od_cart_coupon'] + $od['od_coupon'] + $od['od_send_coupon'];

    // 취소금액
    $amount['cancel'] = $od['od_cancel_price'];

    // 미수금 = 주문금액 - 취소금액 - 입금금액 - 쿠폰금액
    //$amount['미수'] = $amount['order'] - $amount['receipt'] - $amount['coupon'];

    // 결제방법
    $s_receipt_way = $od['od_settle_case'];

    if($od['od_settle_case'] == '간편결제') {
        switch($od['od_pg']) {
            case 'lg':
                $s_receipt_way = 'PAYNOW';
                break;
            case 'inicis':
                $s_receipt_way = 'KPAY';
                break;
            case 'kcp':
                $s_receipt_way = 'PAYCO';
                break;
            default:
                $s_receipt_way = $row['od_settle_case'];
                break;
        }
    }

    if ($od['od_receipt_point'] > 0)
        $s_receipt_way .= "+포인트";

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<style>
body{overflow-x:hidden}
section h3{ font-size:1.17em; margin:15px 0}
</style>
<style type="text/css" media="print">
    .noprint{ display:none; }
</style>
<section id="anc_sodr_list" style="padding: 2px">
    

    <form name="frmorderform" method="post" action="./orderformcartupdate.php" onsubmit="return form_submit(this);">
    <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
    <input type="hidden" name="mb_id" value="<?php echo $od['mb_id']; ?>">
    <input type="hidden" name="od_email" value="<?php echo $od['od_email']; ?>">
    <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
    <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
    <input type="hidden" name="sel_field" value="<?php echo $sel_field; ?>">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="hidden" name="page" value="<?php echo $page;?>">
    <input type="hidden" name="pg_cancel" value="0">
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption>주문 상품 목록</caption>
        <thead>
        <tr>
            <th scope="col">상품명</th>
			<th scope="col">옵션항목</th>
            <!-- <th scope="col">옵션항목</th> -->
            <th scope="col">상태</th>
            <th scope="col">수량</th>
            <th scope="col">판매가</th>
			<th scope="col">합계</th>
			<th scope="col">배송비</th>
            <!-- <th scope="col">소계</th>
            <th scope="col">쿠폰</th>
            <th scope="col">포인트</th>
            
            <th scope="col">포인트반영</th>
            <th scope="col">재고반영</th> -->
        </tr>
        </thead>
        <tbody>
        <?php
        $chk_cnt = 0;
		$pointTotal=0;
        for($i=0; $row=sql_fetch_array($result); $i++) {
            // 상품이미지
            $image = get_it_image($row['it_id'], 50, 50);

            // 상품의 옵션정보
            $sql = " select ct_id, it_id, ct_price, ct_point, ct_qty, ct_option, ct_status, cp_price, ct_stock_use, ct_point_use, ct_send_cost, io_type, io_price,io_id
                        from {$g5['g5_shop_cart_table']}
                        where od_id = '{$od['od_id']}'
                          and it_id = '{$row['it_id']}'
                        order by io_type asc, ct_id asc ";
            $res = sql_query($sql);
            $rowspan = sql_num_rows($res);

            // 합계금액 계산
            $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                            SUM(ct_qty) as qty
                        from {$g5['g5_shop_cart_table']}
                        where it_id = '{$row['it_id']}'
                          and od_id = '{$od['od_id']}' ";
            $sum = sql_fetch($sql);

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
                $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od['od_id']);

                if($sendcost == 0)
                    $ct_send_cost = '무료';
            }

            for($k=0; $opt=sql_fetch_array($res); $k++) {
                if($opt['io_type'])
                    $opt_price = $opt['io_price'];
                else
                    $opt_price = $opt['ct_price'] + $opt['io_price'];
								
                // 소계
                $ct_price['stotal'] = $opt_price * $opt['ct_qty'];
                $ct_point['stotal'] = $opt['ct_point'] * $opt['ct_qty'];
				$pointTotal+=$opt['ct_point'] * $opt['ct_qty'];
            ?>
            <tr>
                <?php 
				if($k==0){?>
                <td rowspan="<?php echo $rowspan?>" class="td_left">

                    <?php //echo $image; ?> <?php echo stripslashes($row['it_name']); ?>
					
					
                </td>
				<?php }?>
				<td>
					<?php 
						if($opt['ct_option']){
							echo $opt['ct_option']!=$row['it_name']?"(".get_text($opt['ct_option'])."-".number_format($opt['io_price'])."원)":""; 
						}
					?>
				</td>
               
                
                
                <td class="td_mngsmall"><?php echo $opt['ct_status']; ?></td>
                <td class="td_num">
                    <label for="ct_qty_<?php echo $chk_cnt; ?>" class="sound_only"><?php echo get_text($opt['ct_option']); ?> 수량</label><?php echo $opt['ct_qty']; ?>
                </td>
                <td class="td_num_right "><?php echo number_format($opt_price); ?></td>
				<td class="td_num_right "><?php echo number_format($opt_price*$opt['ct_qty']); ?></td>
				<td class="td_sendcost_by"><?php echo $ct_send_cost; ?></td>
                <!-- <td class="td_num_right"><?php echo number_format($ct_price['stotal']); ?></td>
                <td class="td_num_right"><?php echo number_format($opt['cp_price']); ?></td>
                <td class=" td_num_right"><?php echo number_format($ct_point['stotal']); ?></td>
                
                <td class="td_mngsmall"><?php echo get_yn($opt['ct_point_use']); ?></td>
                <td class="td_mngsmall"><?php echo get_yn($opt['ct_stock_use']); ?></td> -->
            </tr>
            <?php
                $chk_cnt++;
            }
            ?>
        <?php
        }
        ?>
			<tr>
				<td colspan="8" align="right" style="text-align:right">
					총금액 : <?php echo number_format($amount['order']) ?>원 /
					실결제금액 : <?php echo number_format($od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2'] - $od['od_receipt_point']); ?>원<br/>
					포인트결제 : <?php echo display_point($od['od_receipt_point']); ?> /
					포인트적립 : <?php echo display_point($pointTotal); ?>
					
				</td>
			</tr>
        </tbody>
        </table>
    </div>

   
    </form>

    <?php if ($od['od_mod_history']) { ?>
    <section id="sodr_qty_log">
        <h3>주문 수량변경 및 주문 전체취소 처리 내역</h3>
        <div>
            <?php echo conv_content($od['od_mod_history'], 0); ?>
        </div>
    </section>
    <?php } ?>
</section>

<?php if($od['od_test']&&$od['od_settle_case']!="무통장") {

?>
<!--<div class="od_test_caution">주의) 이 주문은 테스트용으로 실제 결제가 이루어지지 않았으므로 절대 배송하시면 안됩니다.</div>-->
<?php } ?>








        <section id="anc_sodr_taker" >
			<h3 style="background: #fff; display: block; padding: 15px 0 15px 10px; margin: 0 !important;">주문하신 분</h3>
			<div class="tbl_frm01">
                <table>
                <caption>주문하신 분 정보</caption>
                <colgroup>
                    <col style="width:17%" />
                    <col style="width:*" />
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="od_b_name"><span class="sound_only">주문하신 분 </span>이름/휴대폰번호</label></th>
                    <td><?php echo get_text($od['od_name']); ?> 
						<?php if($od[mb_id]){?>(<?php echo $od['mb_id']?>)<?php }?> / 
						<?php echo $od['od_hp']!=""?get_text($od['od_hp']):get_text($od['od_tel']); ?>
					</td>
					
                </tr>
                <tr>
                   
                </tr>
				<tr>
                    <th scope="row"><label for="od_b_tel"><span class="sound_only">주문날짜</label>주문날짜</th>
                    <td><?=date("Y-m-d", strtotime($od['od_time']))?></td>
                </tr>
				
				</tbody>
				</table>
			</div>
            <h3 style="background: #fff; display: block; padding: 15px 0 15px 10px; margin: 0 !important;">받으시는 분</h3>

            <div class="tbl_frm01">
                <table>
                <caption>받으시는 분 정보</caption>
                <colgroup>
                    <col style="width:17%" />
                    <col style="width:33%" />
                    <col style="width:17%" />
                    <col style="width:33%" />
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="od_b_name"><span class="sound_only">받으시는 분 </span>이름</label></th>
                    <td colspan="3"><?php echo get_text($od['od_b_name']); ?></td>
					
                </tr>
                <tr>
                   
                </tr>
                <tr>
					 <th scope="row"><label for="od_b_tel"><span class="sound_only">받으시는 분 </span>전화번호</label></th>
                    <td><?php echo get_text($od['od_b_tel']); ?></td>
                    <th scope="row"><label for="od_b_hp"><span class="sound_only">받으시는 분 </span>핸드폰</label></th>
                    <td><?php echo get_text($od['od_b_hp']); ?></td>
					
                </tr>
                <tr>
                    <th scope="row"><span class="sound_only">받으시는 분 </span>주소</th>
                    <td colspan="3">
                        <label for="od_b_zip" class="sound_only">우편번호</label><?php echo $od['od_b_zip1'].$od['od_b_zip2']; ?><br>
                        <?php echo get_text($od['od_b_addr1']); ?>
                        <label for="od_b_addr1"></label>
                        <?php echo get_text($od['od_b_addr2']); ?>
                        <label for="od_b_addr2"></label>
                        <?php echo get_text($od['od_b_addr3']); ?>
                       
                    </td>
                </tr>

                
                <tr>
                    <th scope="row"><label for="od_hope_date">받는날짜</label></th>
                    <td>
                        <?php echo $od[od_delivery_date]?>
                    </td>
					<th scope="row"><label for="od_hope_date">구매경로</label></th>
                    <td>
                        <?php echo $od[od_path]?>
                    </td>
                </tr>
				<tr>
					
				</tr>
				<tr>
					<th scope="row"><label for="od_hope_date">수령장소</label></th>
                    <td colspan="3">
                        <?php echo $od[od_b_receive]?>
                    </td>
				</tr>	

                <tr>
                    <th scope="row">전달 메세지</th>
                    <td colspan="3"><?php if ($od['od_memo']) echo get_text($od['od_memo'], 1);else echo "없음";?></td>
                </tr>
				</tbody>
				</table>
				 <h3 style="background: #fff; display: block; padding: 15px 0 15px 10px; margin: 0 !important;">결제정보</h3>
				<table>
                <caption>결제정보</caption>
                <colgroup>
                    <col style="width:17%" />
                    <col style="width:33%" />
                    <col style="width:17%" />
                    <col style="width:33%" />
                </colgroup>
                <tbody>
				<tr>
					<th scope="row"><label for="od_hope_date">결제수단</label></th>
                    <td>
						<?php
							$bank=explode(" ",$od[od_bank_account])[0];
						
						?>
                        <?php echo $od[od_settle_case]?>
						<?php echo $od[od_settle_case]=="신용카드"?"<br/>(".$od[od_bank_account].")":"";?>
						<?php echo $od[od_settle_case]=="무통장"?"<br/>".$bank."<br/>".$od[od_deposit_name]:"";?>
                    </td>
					<!-- <th scope="row"><label for="od_hope_date">결제금액</label></th>
					                    <td>
						총금액 : <?php echo number_format($amount['order']) ?>원<br/>
						포인트결제 : <?php echo display_point($od['od_receipt_point']); ?><br/>
						포인트적립 : <?php echo display_point($pointTotal); ?><br/>
						실결제금액 : <?php echo number_format($od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2'] - $od['od_receipt_point']); ?>원
					                    </td> -->
				</tr>
				
                </tbody>
                </table>
            </div>
        </section>

    </div>

    <div class="btn_confirm01 btn_confirm noprint" style="text-align:center; margin:15px 0">
        <input type="button" value="인쇄하기" class="btn_submit btn " onclick="window.print()">
    </div>

    </form>
</section>
