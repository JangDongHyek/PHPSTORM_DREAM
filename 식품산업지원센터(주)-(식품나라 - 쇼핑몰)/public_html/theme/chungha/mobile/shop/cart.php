<?php
include_once('./_common.php');
include_once(G5_SHOP_PATH.'/settle_naverpay.inc.php');

$g5['title'] = 'CART';
include_once(G5_MSHOP_PATH.'/_head.php');

// $s_cart_id 로 현재 장바구니 자료 쿼리
$sql = " select a.ct_id,
                a.it_id,
                a.it_name,
                a.ct_price,
                a.ct_point,
                a.ct_qty,
                a.ct_status,
                a.ct_send_cost,
                a.it_sc_type,
                b.ca_id
           from {$g5['g5_shop_cart_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
          where a.od_id = '$s_cart_id' ";
$sql .= " group by a.it_id ";
$sql .= " order by a.ct_id ";
$result = sql_query($sql);

$cart_count = sql_num_rows($result);
?>

<script src="<?php echo G5_JS_URL; ?>/shop.js"></script>

<div id="sod_bsk" class="od_prd_list">

    <form name="frmcartlist" id="sod_bsk_list" method="post" action="<?php echo $cart_action_url; ?>">


	<div class="tbl_head03 tbl_wrap">
		<table>
			<thead>
				<tr>
					<th scope="col" class="chk_box">
                    <?php if($cart_count) { ?>
						<div id="sod_chk">
							<label for="ct_all" class="sound_only">상품 전체</label>
							<input type="checkbox" name="ct_all" value="1" id="ct_all" class="selec_chk" checked >
							
						</div>
						<?php } ?>
					</th>
					<th scope="col">상품명</th>
					<th scope="col" class="hidden-xs">총수량</th>
					<th scope="col" class="hidden-xs">판매가</th>
					<th scope="col" class="hidden-xs">소계</th>
				</tr>
			</thead>
			<tbody>






    
        <?php
        $tot_point = 0;
        $tot_sell_price = 0;
        $it_send_cost = 0;

        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            // 합계금액 계산
            $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                            SUM(ct_point * ct_qty) as point,
                            SUM(ct_qty) as qty
                        from {$g5['g5_shop_cart_table']}
                        where it_id = '{$row['it_id']}'
                          and od_id = '$s_cart_id' ";
            $sum = sql_fetch($sql);

            if ($i==0) { // 계속쇼핑
                $continue_ca_id = $row['ca_id'];
            }

            $a1 = '<a href="./item.php?it_id='.$row['it_id'].'"><strong>';
            $a2 = '</strong></a>';
            $image_width = 80;
            $image_height = 80;
            $image = get_it_image($row['it_id'], $image_width, $image_height);

            $it_name = $a1 . stripslashes($row['it_name']) . $a2;
            $it_options = print_item_options($row['it_id'], $s_cart_id);
            if($it_options) {
                $mod_options = '<button type="button" id="mod_opt_'.$row['it_id'].'" class="mod_btn mod_options">선택사항수정</button>';
                $it_name .= '<div class="sod_opt">'.$it_options.'</div>';
            }

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
                $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $s_cart_id);

                if($sendcost == 0)
                    $ct_send_cost = '무료';
            }

            $point      = $sum['point'];
            $sell_price = $sum['price'];
        ?>

				<tr>


					<td class="td_chk chk_box">
						<label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품선택</label>
					<input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked>
					</td> 
            
					<td class="td_prd">
						<div class="sod_img"><a href="https://evread.co.kr/shop/item.php?it_id=2020000022"><?php echo $image; ?></a></div>
						<div class="sod_name">
							<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $row['it_id']; ?>">
							<input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($row['it_name']); ?>">
							<b><?php echo $it_name; ?></b>
							
							<div class="sod_option_btn"><?php echo $mod_options; ?></div>
						</div>
						<span id="sell_price_0" class="total_prc visible-xs">17,000</span>

					</td>
					<td class="td_num hidden-xs"><?php echo number_format($sum['qty']); ?></td>
					<td class="td_numbig hidden-xs"><?php echo number_format($row['ct_price']); ?></td>
					<td class="td_numbig hidden-xs"><span id="sell_price_0" class="total_prc"><?php echo number_format($sell_price); ?></span></td>

</tr>
        <?php
            $tot_point      += $point;
            $tot_sell_price += $sell_price;
        } // for 끝

        if ($i == 0) {
            echo '<tr><td colspan="5" class="empty_list">장바구니에 담긴 상품이 없습니다.</td></tr>';
        } else {
            // 배송비 계산
            $send_cost = get_sendcost($s_cart_id, 0);
        }
        ?>
		
			</tbody>
		</table>
	</div>
	<!-- /tbl_head03 -->
    <?php
    $tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비
    if ($tot_price > 0 || $send_cost > 0) {
    ?>
    <dl id="sod_bsk_tot">
		<?php if($tot_sell_price > 0 ){?>
		<dt class="sod_bsk_dvr">총소계비</dt>
        <dd class="sod_bsk_dvr"><strong><?php echo number_format($tot_sell_price); ?> 원</strong></dd>
		<? }?>
        <?php if ($send_cost > 0) { // 배송비가 0 보다 크다면 (있다면) ?>
        <dt class="sod_bsk_dvr">배송비</dt>
        <dd class="sod_bsk_dvr"><strong><?php echo number_format($send_cost); ?> 원</strong></dd>
        <?php } ?>
		


        <?php if ($tot_price > 0) { ?>
        <dt class="sod_bsk_cnt">총계</dt>
        <dd class="sod_bsk_cnt"><strong><?php echo number_format($tot_price); ?> 원</strong></dd>
        <dt>포인트</dt>
        <dd><strong><?php echo number_format($tot_point); ?> 점</strong></dd>
        <?php } ?>
    </dl>
    <?php } ?>

    <div id="sod_bsk_act" class="btn_confirm">
        <?php if ($i == 0) { ?>
        <a href="<?php echo G5_SHOP_URL; ?>/" class="newBtn">쇼핑 계속하기</a>
        <?php } else { ?>
        <input type="hidden" name="url" value="<?php echo G5_SHOP_URL; ?>/orderform.php">
        <input type="hidden" name="act" value="">
        <input type="hidden" name="records" value="<?php echo $i; ?>">
        <a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $continue_ca_id; ?>" class="newBtn">쇼핑 계속하기</a>
        <button type="button" onclick="return form_check('buy');" class="newBtn bgT">주문하기</button>
        <div><button type="button" onclick="return form_check('seldelete');" class="newBtn smallB">선택삭제</button>
        <button type="button" onclick="return form_check('alldelete');" class="newBtn smallB">비우기</button></div>
        <?php if ($naverpay_button_js) { ?>
        <div class="cart-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
        <?php } ?>
        <?php } ?>
    </div>

    </form>

</div>

<script>
$(function() {
    var close_btn_idx;

    // 선택사항수정
    $(".mod_options").click(function() {
        var it_id = $(this).attr("id").replace("mod_opt_", "");
        var $this = $(this);
        close_btn_idx = $(".mod_options").index($(this));

        $.post(
            "./cartoption.php",
            { it_id: it_id },
            function(data) {
                $("#mod_option_frm").remove();
                $this.after("<div id=\"mod_option_frm\"></div>");
                $("#mod_option_frm").html(data);
                price_calculate();
            }
        );
    });

    // 모두선택
    $("input[name=ct_all]").click(function() {
        if($(this).is(":checked"))
            $("input[name^=ct_chk]").attr("checked", true);
        else
            $("input[name^=ct_chk]").attr("checked", false);
    });

    // 옵션수정 닫기
    $(document).on("click", "#mod_option_close", function() {
        $("#mod_option_frm").remove();
        $("#win_mask, .window").hide();
        $(".mod_options").eq(close_btn_idx).focus();
    });
    $("#win_mask").click(function () {
        $("#mod_option_frm").remove();
        $("#win_mask").hide();
        $(".mod_options").eq(close_btn_idx).focus();
    });

});

function fsubmit_check(f) {
    if($("input[name^=ct_chk]:checked").length < 1) {
        alert("구매하실 상품을 하나이상 선택해 주십시오.");
        return false;
    }

    return true;
}


function form_check(act) {
    var f = document.frmcartlist;
    var cnt = f.records.value;

    if (act == "buy")
    {
        f.act.value = act;
        f.submit();
    }
    else if (act == "alldelete")
    {
        f.act.value = act;
        f.submit();
    }
    else if (act == "seldelete")
    {
        if($("input[name^=ct_chk]:checked").size() < 1) {
            alert("삭제하실 상품을 하나이상 선택해 주십시오.");
            return false;
        }

        f.act.value = act;
        f.submit();
    }

    return true;
}
</script>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>