<style>
.info_box {padding: 10px; display: block; width: auto; background: #FBFBFB; margin: 5px 0 0; border: 1px solid #CCC;}
.info_box li {list-style: none; padding-top: 5px;}
.info_box li:first-child {padding: 0;}
.info_box strong {margin-right: 20px;}
.info_box span {font-size: 16px; color: #ff6633;}
</style>
<?php
$od_sql = " select * from g5_ptmall_order where od_idx='{$od_idx}' ";
$od_row = sql_fetch($od_sql);

$mb_sql = " select mb_2 from g5_member where mb_id='{$od_row['mb_id']}' ";
$mb_row = sql_fetch($mb_sql);

$moid_arr = explode('60chicken4_',$od_row['moid']);

if($od_row['od_method'] != '' && $od_row['pay_status'] == '결제완료' && $is_admin){
?>
<div style="margin:0; padding:10px 0; text-align:right;" id="btnCancelWrap">
	<a style="display:inline-block; margin:0; padding:4px 8px; color:#fff; border:1px solid #cc3300; border-radius:3px; background:#ff6633; cursor:pointer;" onclick="fnCancelPoint('<?=$od_idx?>');">주문취소</a>
</div>
<script>
function fnCancelPoint(idx){
	if(confirm("결제를 취소하시겠습니까? 사용된 마일리지는 환불됩니다.") == true){

		var form = $('<form></form>');
		form.attr('action', "./cancel_point.php");
		form.attr('method', 'post');
		form.appendTo('#btnCancelWrap');

		var od_idx = $("<input type='hidden' name='od_idx' value='" + idx + "'>"),
			co_id = $("<input type='hidden' name='co_id' value='<?=$co_id?>'>"),
			page = $("<input type='hidden' name='page' value='<?=$page?>'>");
			sch_wr_id = $("<input type='hidden' name='sch_wr_id' value='<?=$sch_wr_id?>'>");
			sch_mb_2 = $("<input type='hidden' name='sch_mb_2' value='<?=$sch_mb_2?>'>");

		form.append(od_idx);
		form.append(co_id);
		form.append(page);
		form.append(sch_wr_id);
		form.append(sch_mb_2);

		form.submit();

	} else {
		return false;
	}
}
</script>
<?php
}

//url 파라미터
$qstr = "";
if($sch_wr_id != "") $qstr .= "&amp;sch_wr_id=".$sch_wr_id;
if($sch_mb_2 != "") $qstr .= "&amp;sch_mb_2=".$sch_mb_2;


$od_tel_arr = explode('-', $od_row['od_tel']);
$od_hp_arr = explode('-', $od_row['od_hp']);

$ct_sql = " select * from g5_ptmall_cart where od_idx='{$od_idx}' and it_bo_table='ptmall_item' and ct_status!='대기' order by ct_idx desc ";
$ct_qry = sql_query($ct_sql);
$ct_num = sql_num_rows($ct_qry);
if($ct_num > 0){
?>
<div>
	<?php if($od_row['moid'] != ''){ ?>주문번호 : <?php echo $moid_arr[1] ?><?php } ?>
	<?php if($mb_row['mb_2'] != ''){ echo '&nbsp;&nbsp;&nbsp;매장명 : '.$mb_row['mb_2']; } ?>
</div>
<table class="od_tbl">
<thead>
<tr>
	<th class="od_head_th x180">이미지</th>
	<th class="od_head_th">주문상품</th>
	<th class="od_head_th x160">판매가격</th>
    <th class="od_head_th x160">판매마일리지</th>
	<th class="od_head_th x110">배송비</th>
</tr>
</thead>
<tbody>
<?php
for($ct=0; $ct<$ct_num; $ct++){
	$ct_row = sql_fetch_array($ct_qry);
?>
<tr>
	<td class="od_body_td talgin_c">
		<?php if($ct_row['it_img'] != ''){ ?><img src="<?php echo $ct_row['it_img'] ?>" border="0" width="160" /><?php } ?>
	</td>
	<td class="od_body_td">
		<div class="opt_name_text"><?php echo $ct_row['it_name'] ?></div>

		<?php
		if($ct_row['opt_cnt'] > 0){
			$opt_sql = " select * from g5_ptmall_cart_opt where ct_idx='{$ct_row['ct_idx']}' order by opt_sort asc ";
			$opt_qry = sql_query($opt_sql);
			$opt_num = sql_num_rows($opt_qry);

			for($o=0; $o<$opt_num; $o++){
				$opt_row = sql_fetch_array($opt_qry);
		?>
		<div class="opt_container">
			<table>
			<tbody>
			<tr>
				<td style="width:420px;">
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
	<td class="od_body_td talgin_r"><span class="opt_tot_price_text"><?php echo number_format($ct_row['it_tot_price']) ?>원</span></td>
    <td class="od_body_td talgin_r"><span class="opt_tot_price_text"><?php echo number_format($ct_row['it_tot_price2']) ?>P</span></td>
	<td class="od_body_td talgin_r"><span class="fee_text"><?php echo number_format($ct_row['it_fee']) ?>원</span></td>
</tr>
<?php
}
?>
<?php if($member['mb_level'] > 2){ ?>
<tr>
	<td class="od_memo_td talign_r" style="font-weight:bold;">주문요청 메모</td>
	<td class="od_memo_td talign_l" colspan="3"><?php echo nl2br($od_row['od_memo']) ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php
}
?>


<?php if($member['mb_level'] > 2){ ?>
	<!-- 관리자 STR -->
	<div class="od_title">결제정보</div>
	<table class="od_tbl">
	<thead>
	<tr>
		<th class="pay_head_th" colspan="2"></th>
	</tr>
	</thead>
	<tbody>
    <tr>
        <th class="pay_body_th">상품합계 금액</th>
        <td class="pay_body_td">
            <?php
            if($od_row['od_tot_price'] > 0){
                echo number_format($od_row['od_tot_price']).'원 ' ;
            }

            if($od_row['od_tot_price2'] > 0){
                echo number_format($od_row['od_tot_price2']).'P' ;
            }
            ?>
        </td>
    </tr>
	<tr>
		<th class="pay_body_th">배송비</th>
		<td class="pay_body_td"><?php echo number_format($od_row['od_tot_fee']).'원' ?></td>
	</tr>
    <tr>
        <th class="pay_body_th">일반 주문 금액</th>
        <td class="pay_body_td"><?php echo number_format($od_row['od_hap']).'원' ?></td>
    </tr>
    <tr>
        <th class="pay_body_th">마일리지 주문 금액</th>
        <td class="pay_body_td"><?php echo number_format($od_row['od_hap2']).'P' ?></td>
    </tr>
	<tr>
		<th class="pay_body_th">사용 포인트</th>
		<td class="pay_body_td">
			<?
			$pt_sql = "SELECT po_point FROM g5_point WHERE pt_od_idx = '{$od_idx}'";
			$pt_row = sql_fetch($pt_sql);
			$use_point = $pt_row["po_point"];
			?>
			<strong><?php echo number_format(abs($use_point)).'점' ?></strong>
		</td>
	</tr>
	<tr>
		<th class="pay_body_th">결제 방식</th>
		<td class="pay_body_td">
            <?php
            if($od_row['od_hap'] > 0 && $od_row['od_hap2'] > 0){
                $od_method = '포인트&일반 주문';
            }else if($od_row['od_hap'] > 0){
                $od_method = '일반 주문';
            }else if($od_row['od_hap2'] > 0){
                $od_method = '포인트';
            }else{
                $od_method = '일반 주문';
            }

            echo $od_method;
            ?>
        </td>
	</tr>
	<tr>
		<th class="pay_body_th">결제 상태</th>
		<td class="pay_body_td"><?php echo $od_row['pay_status'] ?></td>
	</tr>
	</tbody>
	</table>

	<div style="margin:40px auto; text-align:center;">
		<?if($od_row['trade_check'] == '' && $od_row['pay_status'] != '결제취소'){ ?>
		<input type="button" id="complete_btn" value="발주완료">
		<?php } ?>
	</div>

	<form method="post" name="complete_frm" action="<?php echo G5_BBS_URL ?>/complete.php">
		<input type="hidden" name="co_id" value="<?php echo $co_id ?>">
		<input type="hidden" name="od_idx" value="<?php echo $od_idx ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
	</form>

	<script>
	$(function(){
		$("#complete_btn").on('click', function(){
			if(confirm('정말 발주완료를 하시겠습니까?')){
				document.complete_frm.submit();
			}else{
				return false;
			}
		});
	});
	</script>


	<form method="post" name="delivery_frm" action="<?php echo G5_BBS_URL ?>/delivery_update.php" onsubmit="return delivery_act(this)">
	<input type="hidden" name="co_id" value="<?php echo $co_id ?>">
	<input type="hidden" name="od_idx" value="<?php echo $od_idx ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="order_mode" value="ptmall">
		<div class="od_title">배송지 정보</div>
		<table class="od_tbl">
		<thead>
		<tr>
			<th class="pay_head_th" colspan="4"></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th class="pay_body_th">이름</th>
			<td class="pay_body_td" colspan="3">
				<input type="text" name="od_name" class="input_text x170" value="<?php echo $od_row['od_name'] ?>">
			</td>
		</tr>
		<tr>
			<th class="pay_body_th">전화번호</th>
			<td class="pay_body_td x320">
				<input type="text" name="od_tel1" class="input_text x50" value="<?php echo $od_tel_arr[0] ?>"> -
				<input type="text" name="od_tel2" class="input_text x50" value="<?php echo $od_tel_arr[1] ?>"> -
				<input type="text" name="od_tel3" class="input_text x50" value="<?php echo $od_tel_arr[2] ?>">
			</td>
			<th class="pay_body_th">휴대폰번호</th>
			<td class="pay_body_td">
				<input type="text" name="od_hp1" class="input_text x50" value="<?php echo $od_hp_arr[0] ?>"> -
				<input type="text" name="od_hp2" class="input_text x50" value="<?php echo $od_hp_arr[1] ?>"> -
				<input type="text" name="od_hp3" class="input_text x50" value="<?php echo $od_hp_arr[2] ?>">
			</td>
		</tr>
		<tr>
			<th class="pay_head_th" colspan="4"></th>
		</tr>
		<tr>
			<th class="pay_body_th" rowspan="4">주소</th>
			<td class="pay_body_td" colspan="3">
				<input type="text" name="od_zip" value="<?php echo $od_row['od_zip'] ?>" id="od_zip" class="input_text" size="5" maxlength="6">
				<button type="button" class="btn_frmline" onclick="win_zip('delivery_frm', 'od_zip', 'od_addr1', 'od_addr2', 'od_addr3', 'mb_addr_jibeon');">주소 검색</button>
			</td>
		</tr>
		<tr>
			<td class="pay_body_td" colspan="3">
				<input type="text" name="od_addr1" value="<?php echo $od_row['od_addr1'] ?>" id="od_addr1" class="input_text" size="60">
			</td>
		</tr>
		<tr>
			<td class="pay_body_td" colspan="3">
				<input type="text" name="od_addr2" value="<?php echo $od_row['od_addr2'] ?>" id="od_addr2" class="input_text" size="60">
			</td>
		</tr>
		<tr>
			<td class="pay_body_td" colspan="3">
				<input type="text" name="od_addr3" value="<?php echo $od_row['od_addr3'] ?>" id="od_addr3" class="input_text" size="60">
				<input type="hidden" name="mb_addr_jibeon" value="">
			</td>
		</tr>
		<tr>
			<th class="pay_body_th">택배사 선택</th>
			<td class="pay_body_td" colspan="3">
				<select name="od_delivery">
					<option value="">택배사 선택</option>
					<?php
					$deli_sql = " select * from g5_delivery order by de_order asc, de_idx desc ";
					$deli_qry = sql_query($deli_sql);
					$deli_num = sql_num_rows($deli_qry);
					if($deli_num > 0){
						for($deli=0; $deli<$deli_num; $deli++){
							$deli_row = sql_fetch_array($deli_qry);
					?>
					<option value="<?php echo $deli_row['de_idx'] ?>" <?php if($deli_row['de_idx'] == $od_row['od_delivery_idx']) echo 'selected'; ?>><?php echo $deli_row['de_name'] ?></option>
					<?php
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th class="pay_body_th">송장번호</th>
			<td class="pay_body_td" colspan="3">
				<input type="text" name="od_send_number" class="input_text x170" value="<?php echo $od_row['od_send_number'] ?>">
			</td>
		</tr>
		</tbody>
		</table>

		<div style="margin:40px auto; text-align:center;">
			<input type="submit" id="delivery_btn" value="배송지정보 수정">
			<input type="button" id="list_btn" value="목록으로" onclick="location.href='<?php echo G5_BBS_URL ?>/content.php?co_id=<?php echo $co_id ?>&page=<?=$page?><?=$qstr?>';">
			<!--<input type="button" id="list_btn" value="목록으로" onclick="history.back();">-->
			<?php if($member['mb_id'] == 'admin' || $member['mb_id'] == 'lets080'){ ?>
			<input type="button" id="delete_btn" value="주문삭제" onclick="delete_act()">
			<?php } ?>
		</div>
	</form>

	<script>
	function delivery_act(f){
		if(f.od_name.value == ''){
			alert('이름을 입력해주세요');
			f.od_name.focus();
			return false;
		}

		if(f.od_hp1.value == ''){
			alert('휴대폰번호를 입력해주세요');
			f.od_hp1.focus();
			return false;
		}

		if(f.od_hp2.value == ''){
			alert('휴대폰번호를 입력해주세요');
			f.od_hp2.focus();
			return false;
		}

		if(f.od_hp3.value == ''){
			alert('휴대폰번호를 입력해주세요');
			f.od_hp3.focus();
			return false;
		}

		if(f.od_zip.value == ''){
			alert('주소를 선택(입력)해주세요');
			f.od_zip.focus();
			return false;
		}

		if(f.od_addr1.value == ''){
			alert('주소를 선택(입력)해주세요');
			f.od_addr1.focus();
			return false;
		}

		return true;
	}


	function delete_act(){
		if(confirm('주문을 삭제하시겠습니까? 삭제된 주문 내역은 복구할 수 없습니다.')){
			location.href = g5_bbs_url + "/cancel_order.php?co_id=<?=$co_id?>&od_idx=<?php echo $od_idx ?>&page=<?php echo $page ?><?=str_replace('&amp;', '&', $qstr)?>";
		}
	}
	</script>
	<!-- 관리자 END -->

<?php }else{ ?>

	<!-- 점주 STR -->
	<div class="od_title">배송정보</div>
	<table class="od_tbl">
	<thead>
	<tr>
		<th class="delivery_head_th" colspan="2"></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<th class="delivery_body_th">받는분</th>
		<td class="delivery_body_td"><?php echo $od_row['od_name'] ?></td>
	</tr>
	<tr>
		<th class="delivery_body_th">전화번호</th>
		<td class="delivery_body_td"><?php echo $od_row['od_tel'] ?></td>
	</tr>
	<tr>
		<th class="delivery_body_th">휴대폰번호</th>
		<td class="delivery_body_td"><?php echo $od_row['od_hp'] ?></td>
	</tr>
	<tr>
		<th class="delivery_body_th">배송주소</th>
		<td class="delivery_body_td">
			<?
			if($od_row['od_zip'] != '') echo '['.$od_row['od_zip'].'] ';
			if($od_row['od_addr1'] != '') echo $od_row['od_addr1'].' ';
			if($od_row['od_addr2'] != '') echo $od_row['od_addr2'].' ';
			if($od_row['od_addr3'] != '') echo $od_row['od_addr3'].' ';
			?>
		</td>
	</tr>
	<tr>
		<th class="delivery_body_th">배송업체/송장번호</th>
		<td class="delivery_body_td">
			<?php if($od_row['od_delivery_url'] != ''){ ?><a href="<?php echo $od_row['od_delivery_url'] ?>" target="_blank"><?php } ?>
			<?php echo $od_row['od_delivery_name'] ?>
			<?php if($od_row['od_delivery_url'] != ''){ ?></a><?php } ?>
			<?php if($od_row['od_send_number'] != ''){ echo ' / '.$od_row['od_send_number']; } ?>
		</td>
	</tr>
	</tbody>
	</table>


	<div class="od_title">결제정보</div>
	<table class="od_tbl">
	<thead>
	<tr>
		<th class="pay_head_th" colspan="2"></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<th class="pay_body_th">상품합계 금액</th>
		<td class="pay_body_td"><?php echo number_format($od_row['od_tot_price']).'원' ?></td>
	</tr>
	<tr>
		<th class="pay_body_th">배송비</th>
		<td class="pay_body_td"><?php echo number_format($od_row['od_tot_fee']).'원' ?></td>
	</tr>
    <tr>
        <th class="pay_body_th">일반 주문 금액</th>
        <td class="pay_body_td"><?php echo number_format($od_row['od_hap']).'원' ?></td>
    </tr>
    <tr>
        <th class="pay_body_th">마일리지 주문 금액</th>
        <td class="pay_body_td"><?php echo number_format($od_row['od_hap2']).'P' ?></td>
    </tr>
	<tr>
		<th class="pay_body_th">사용 포인트</th>
		<td class="pay_body_td">
			<?
			$pt_sql = "SELECT po_point FROM g5_point WHERE pt_od_idx = '{$od_idx}'";
			$pt_row = sql_fetch($pt_sql);
			$use_point = $pt_row["po_point"];
			?>
			<strong><?php echo number_format(abs($use_point)).'점' ?></strong>
		</td>
	</tr>
	<tr>
		<th class="pay_body_th">결제방식</th>
		<td class="pay_body_td">
            <?php
            if($od_row['od_hap'] > 0 && $od_row['od_hap2'] > 0){
                $od_method = '포인트&일반 주문';
            }else if($od_row['od_hap'] > 0){
                $od_method = '일반 주문';
            }else if($od_row['od_hap2'] > 0){
                $od_method = '포인트';
            }

            echo $od_method;
            ?>
        </td>
	</tr>
	<tr>
		<th class="pay_body_th">결제 상태</th>
		<td class="pay_body_td"><?php echo $od_row['pay_status'] ?></td>
	</tr>
	</tbody>
	</table>

	<div style="margin:40px auto; text-align:center;">
		<? if($member['mb_level'] == 2){ ?>
		<a id="list_btn" href="<?php echo G5_BBS_URL ?>/content.php?co_id=<?php echo $co_id ?>&page=<? echo ($page)? $page : 1 ;?>">목록으로</a>
		<? } else { ?>
		<a id="list_btn" href="javascript:history.back();">목록으로</a>
		<? } ?>
	</div>
	<!-- 점주 END -->

<?php } ?>
	