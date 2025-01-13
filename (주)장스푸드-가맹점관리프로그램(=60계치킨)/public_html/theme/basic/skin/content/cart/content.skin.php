<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);

$list_sql = " select * from g5_cart where mb_id='{$member['mb_id']}' and ct_status='대기' and ct_direct='n' order by ct_idx asc ";
$list_qry = sql_query($list_sql);
$list_num = sql_num_rows($list_qry);
?>

<script>
function comma(num){
    var len, point, str;  
    num = num + "";  
    point = num.length % 3 ;
    len = num.length;  
    str = num.substring(0, point);  

    while (point < len) {  
        if (str != "") str += ",";  
        str += num.substring(point, point + 3);  
        point += 3;  
    }  
    return str;
}
</script>

<div id="category_container">
	<h2 id="category_title"><?php echo $g5['title']; ?></h2>

	<div style="font-weight:bold; color:#333;">※ 총 <span style="color:#ff0000;"><?php echo $list_num ?></span>건의 상품이 장바구니에 담겨있습니다.</div>

	<form method="post" name="od_frm" action="<?php echo G5_BBS_URL ?>/cart_update.php">
	<input type="hidden" name="mode" id="mode" value="">
	<input type="hidden" name="buy_mode" id="buy_mode" value="">
		<table class="list_tbl">
		<thead>
		<tr>
			<th class="list_th x60"><input type="checkbox" id="all_check" value="y"></th>
			<th class="list_th x150">사진</th>
			<th class="list_th">주문상품</th>
			<th class="list_th x140">판매가격</th>
			<th class="list_th x100">배송비</th>
		</tr>
		</thead>
		<tbody>
		<?php
		if($list_num > 0){
			for($l=0; $l<$list_num; $l++){
				$list_row = sql_fetch_array($list_qry);

				$item_sql = " select count(*) as cnt from g5_write_item where wr_id='{$list_row['it_id']}' ";
				$item_row = sql_fetch($item_sql);

				$td_bg = '';
				if($l%2 == 0) $td_bg = 'td_bg';
		?>
		<tr>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<input type="hidden" name="ct_idx[]" value="<?php echo $list_row['ct_idx'] ?>">
				<input type="checkbox" name="ct_chk[]" class="ct_chk" value="<?php echo $list_row['ct_idx'] ?>">
				
				<input type="hidden" class="it_fee" value="<?php echo $list_row['it_fee'] ?>">
				<input type="hidden" class="it_tot_price" value="<?php echo $list_row['it_tot_price'] ?>">
			</td>
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php if($list_row['it_img'] != ''){ ?><img src="<?php echo $list_row['it_img'] ?>" border="0" width="110" /><?php } ?></td>
			<td class="list_td <?php echo $td_bg ?>">
				<div class="opt_name_text"><?php echo $list_row['it_name'] ?></div>

				<?php
				if($list_row['opt_cnt'] > 0){
					$opt_sql = " select * from g5_cart_opt where ct_idx='{$list_row['ct_idx']}' and mb_id='{$member['mb_id']}' order by opt_sort asc ";
					$opt_qry = sql_query($opt_sql);
					$opt_num = sql_num_rows($opt_qry);

					if($item_row['cnt'] == 0){
						$opt_del_sql = " delete from g5_cart_opt where ct_idx='{$list_row['ct_idx']}' and mb_id='{$member['mb_id']}' ";
						sql_query($opt_del_sql);
					}

					for($o=0; $o<$opt_num; $o++){
						$opt_row = sql_fetch_array($opt_qry);
				?>
				<div class="opt_container">
					<table>
					<tbody>
					<tr>
						<td style="width:390px;">
						<?php
						if($opt_row['opt1_value'] != ''){
							$opt1_value_arr = explode('|',$opt_row['opt1_value']);
							echo '<div>';
							if($opt1_value_arr[3] != '') echo $opt1_value_arr[3].' : ';
							if($opt1_value_arr[1] != '') echo $opt1_value_arr[1];
							echo '</div>';
						}
						
						if($opt_row['opt2_value'] != ''){
							$opt2_value_arr = explode('|',$opt_row['opt2_value']);
							echo '<div>';
							if($opt2_value_arr[3] != '') echo $opt2_value_arr[3].' : ';
							if($opt2_value_arr[1] != '') echo $opt2_value_arr[1];
							echo '</div>';
						}

						if($opt_row['opt3_value'] != ''){
							$opt3_value_arr = explode('|',$opt_row['opt3_value']);
							echo '<div>';
							if($opt3_value_arr[3] != '') echo $opt3_value_arr[3].' : ';
							if($opt3_value_arr[1] != '') echo $opt3_value_arr[1];
							echo '</div>';
						}
						?>
						</td>
						<td><span class="quantity_text"><?php echo $opt_row['opt_quantity'] ?>개</span></td>
					</tr>
					</tbody>
					</table>
				</div>
				<?php
					}
				}
				?>
			</td>
			<td class="list_td talgin_r <?php echo $td_bg ?>"><span class="opt_tot_price_text"><?php echo number_format($list_row['it_tot_price']) ?>원</span></td>
			<td class="list_td talgin_r <?php echo $td_bg ?>"><span class="fee_text"><?php echo number_format($list_row['it_fee']) ?>원</span></td>
		</tr>
		<?php
				if($item_row['cnt'] == 0){
					$cart_del_sql = " delete from g5_cart where ct_idx='{$list_row['ct_idx']}' ";
					sql_query($cart_del_sql);
				}
			}
		}
		?>
		</tbody>
		</table>

		<table class="list_tbl" style="margin:0; border:1px solid #dcdcdc; border-top:0; background:#fff;">
		<tbody>
		<tr>
			<td style="margin:0; padding:10px;">
				<div>
					<input type="button" id="del_btn" value="선택삭제">
				</div>
			</td>
			<td style="margin:0; padding:10px; text-align:right;">
				<span style="font-weight:bold; color:#333;">상품구매금액 : <span id="cart_sum">0</span>원</span>
				<span style="padding:0px 15px; font-weight:bold; color:#333;"> + </span>
				<span style="font-weight:bold; color:#333;">배송비 : <span id="cart_fee_sum">0</span>원</span>
				<span style="padding:0px 20px; font-weight:bold; color:#fa003b; font-size:22px;">= 총결제금액 <span id="hap">0</span> 원</span>
			</td>
		</tr>
		</tbody>
		</table>

		<div style="margin:40px auto; text-align:center;">
			<a id="buy1">선택상품 구매</a>
			<a id="buy2">전체상품 구매</a>
		</div>

	</form>
</div>

<?php
if($item_row['cnt'] != '' && $item_row['cnt'] == 0){
?>
<script>
window.location.reload();
</script>
<?php
}
?>

<script>
$(function(){
	$("#all_check").on('click', function(){
		if($(this).is(':checked') == true){
			$(".ct_chk").prop('checked', true);
			check_sum();
		}else{
			$(".ct_chk").prop('checked', false);
			check_sum();
		}
	});


	$(".ct_chk").on('click', function(){
		check_sum();
	});


	$("#del_btn").on('click', function(){
		if($(".ct_chk").is(":checked") == false){
			alert('삭제할 상품을 선택(체크)해주세요');
			return false;
		}

		if(confirm("정말 삭제하시겠습니까?")){
			$("#mode").val('del');
			document.od_frm.submit();
		}
	});

	
	$("#buy1").on('click', function(){
		if($(".ct_chk").is(':checked') == false){
			alert('구매하실 상품을 선택해주세요');
			return false;
		}

		$("#buy_mode").val('select');
		document.od_frm.action = "<?php echo G5_BBS_URL ?>/cart_in.php";
		document.od_frm.submit();
	});

	$("#buy2").on('click', function(){
		$("#buy_mode").val('all');
		$(".ct_chk").prop('checked', true);

		document.od_frm.action = "<?php echo G5_BBS_URL ?>/cart_in.php";
		document.od_frm.submit();
	});
});



function check_sum(){
	var _idx;
	var cart_sum = 0;
	var cart_fee_sum = 0;
	
	if($(".ct_chk").length > 0){
		for(var i=0; i<$(".ct_chk").length; i++){
			_idx = $(".ct_chk").index($(".ct_chk").eq(i));
			if($(".ct_chk").eq(_idx).is(':checked') == true){
				cart_sum += Number($(".it_tot_price").eq(_idx).val());
				cart_fee_sum += Number($(".it_fee").eq(_idx).val());
			}
		}
	}

	var hap = cart_sum + cart_fee_sum;

	$("#cart_sum").html(comma(cart_sum));
	$("#cart_fee_sum").html(comma(cart_fee_sum));
	$("#hap").html(comma(hap));
}
</script>

