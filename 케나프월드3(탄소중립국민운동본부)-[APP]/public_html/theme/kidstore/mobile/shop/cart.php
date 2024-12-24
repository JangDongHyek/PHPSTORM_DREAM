<?php
include_once('./_common.php');

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

<div id="sod_bsk">
		
    <form name="frmcartlist" id="sod_bsk_list" method="post" action="<?php echo $cart_action_url; ?>">

    <?php if($cart_count) { ?>
    <div id="sod_chk">
        <input type="checkbox" name="ct_all" value="1" id="ct_all">
        <label for="ct_all"></label>
        전체상품 선택
        <!--<label for="ct_all" class="sound_only">상품 전체</label>
        <input type="checkbox" name="ct_all" value="1" id="ct_all" checked>-->
        
		<div class="sod_sel_del">
        <button type="button" onclick="return form_check('seldelete');">선택삭제</button>
        <?php /*?><button type="button" onclick="return form_check('alldelete');" class="btn01">비우기</button><?php */?>
        </div><!--.sod_sel_del-->    
     </div><!--#sod_chk-->
    
        
    
    
    
    <?php } ?>

    <ul class="sod_list_new">
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
            $image_width = 60;
            $image_height = 60;
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

        <?php /*?><li class="sod_li">
            
            <div class="li_chk">
                <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품선택</label>
                <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" >
            </div>
            <div class="li_name">
                <?php echo $it_name; ?>
                <span class="total_img"><?php echo $image; ?></span>
                <div class="li_mod"  style="padding-left:<?php echo $image_width + 20; ?>px;"><?php echo $mod_options; ?></div>
            </div>
            
            <div class="li_prqty_new">
                <div class="li_chk">
                    <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품선택</label>
                    <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked>
                </div>
                <div><?php echo $it_name; ?></div>
                <div><?php echo number_format($row['ct_price']); ?></div>
            	<div>
                	<div><?php echo number_format($sum['qty']); ?></div>
                    <div><i class="fal fa-trash-alt"></i></div>
                </div>
            </div><!--.li_prqty_new-->
            
            <div class="li_prqty">
                <span class="prqty_price li_prqty_sp"><span>판매가 </span><?php echo number_format($row['ct_price']); ?></span>
                <span class="prqty_qty li_prqty_sp"><span>수량 </span><?php echo number_format($sum['qty']); ?></span>
                <span class="prqty_sc li_prqty_sp"><span>배송비 </span><?php echo $ct_send_cost; ?></span>
            </div>
            <div class="li_total">
                <span class="total_price total_span"><span>합계 </span><strong><?php echo number_format($sell_price); ?></strong></span>
                <span class="total_point total_span"><span>적립포인트 </span><strong><?php echo number_format($sum['point']); ?></strong></span>
            </div>
        </li><?php */?>
        
        <li class="sod_li">
						<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $row['it_id']; ?>">
            <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($row['it_name']); ?>">
            <div class="li_chk">
                <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" class="ct_chk" value="1" id="ct_chk_<?php echo $i; ?>" onclick="changePrice('<?=$i?>')">
                <label for="ct_chk_<?php echo $i; ?>"></label>
                <!--<label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품선택</label>
                <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked>-->
            </div>
            <span class="total_img"><?php echo $image; ?></span>
            <div class="sod_li_box">
                <div class="sod_li_title"><?php echo $it_name; ?></div>
                <div class="sod_li_price"><?php echo number_format($row['ct_price']); ?></div>
								<div class="sod-li-price" id="sod-li-price<?=$i?>" style="display:none"><?=$row[ct_price]*$sum['qty']?></div>
            </div><!--.sod_li_box-->
            <div class="sod_li_amount">
                <div class="sod_num"><?php echo number_format($sum['qty']); ?></div>
                <div class="sod_del" onclick="cartDelete('<?=$row[it_id]?>')"><i class="fal fa-trash-alt"></i></div>
            </div><!--.sod_li_amount-->
        </li><!--.sod_li-->
        
        
        
        
        
        

        <?php
            $tot_point      += $point;
            $tot_sell_price += $sell_price;
        } // for 끝

        if ($i == 0) {
            echo '<li class="empty_list">장바구니에 담긴 상품이 없습니다.</li>';
        } else {
            // 배송비 계산
            $send_cost = get_sendcost($s_cart_id, 0);
        }
        ?>
    </ul>

    <?php
    $tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비
    if ($tot_price > 0 || $send_cost > 0) {
    ?>
    
    <div id="sod_bsk_tot_wrap">
    	<h1>결제 예정금액</h1>
        <dl id="sod_bsk_tot">
        
            <?php if ($send_cost > 0) { // 배송비가 0 보다 크다면 (있다면) ?>
            <dt class="sod_bsk_dvr">배송비</dt>
            <dd class="sod_bsk_dvr"><strong><?php echo number_format($send_cost); ?> 원</strong></dd>
            <?php } ?>
    
            <?php if ($tot_price > 0) { ?>
            <dt class="sod_bsk_cnt">총 결제 예정금액</dt>
            <dd class="sod_bsk_cnt"><strong style="color:#009975;" id="tot_price"><?php //echo number_format($tot_price); ?>0 원</strong></dd>
            <div class="sod_bsk_stxt"><i class="fal fa-map-marker-exclamation"></i> 주문하실 상품과 금액이 맞는지 잘 확인해주세요.</div>
            <!--<dt>포인트</dt>
            <dd><strong><?php echo number_format($tot_point); ?> 점</strong></dd>-->
            <?php } ?>
        </dl>
    </div><!--#sod_bak_tot_wrap-->
    <?php } ?>

    <div id="sod_bsk_act" class="btn_confirm">
        <?php if ($i == 0) { ?>
        <a href="<?php echo G5_SHOP_URL; ?>/" class="btn01_one">쇼핑 계속하기</a>
        <?php } else { ?>
        <input type="hidden" name="url" value="<?php echo G5_SHOP_URL; ?>/orderform.php">
        <input type="hidden" name="act" value="">
        <input type="hidden" name="records" value="<?php echo $i; ?>">
        <a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $continue_ca_id; ?>" class="btn01">쇼핑 계속하기</a>
        <button type="button" onclick="return form_check('buy');" class="btn_submit">주문하기</button>
        <?php } ?>
    </div>

    </form>

</div>

<script>
var totalPrice=0;
//상품 선택시 가격보여주기
function changePrice(no){
	
	var price=parseInt($("#sod-li-price"+no).html());
	if($("#ct_chk_"+no).prop("checked")){
		totalPrice+=price;
	}else{
		totalPrice-=price;
	}
	$("#tot_price").html(number_format(totalPrice)+" 원");
}
//상품 개별 삭제
function cartDelete(it_id){
	if(confirm("장바구니에 담겨진 상품을 삭제하시겠습니까?")){
		location.href="<?=G5_SHOP_URL?>/ea.cartdelete.php?it_id="+it_id;
	}
}
$(function() {
    var close_btn_idx;
		//전체 선택시
		$("#ct_all").click(function(){
			if($(this).prop("checked")){
				$("#tot_price").html("<?=number_format($tot_price);?> 원");
				$(".ct_chk").prop("checked",true);
			}else{
				$("#tot_price").html("0 원");
				$(".ct_chk").prop("checked",false);

			}
		});
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