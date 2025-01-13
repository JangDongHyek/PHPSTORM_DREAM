<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

?>

<div id="bo_l">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<form method="post" name="SendPayForm_name" id="SendPayForm_id" action="<?php echo G5_BBS_URL ?>/ptmall_order_complete.php">
	<input type="hidden" name="od_idx" id="od_idx" value="<?php echo $od_idx ?>">
	<input type="hidden" name="orderPage" value="mall2">
	
	<div style="font-weight:bold; font-size:16px;">주문상품</div>
	<table class="me_tbl">
	<thead>
	<tr>
		<th class="list_tbl_th x150">사진</th>
		<th class="list_tbl_th">주문상품</th>
		<th class="list_tbl_th x140">판매가격</th>
        <th class="list_tbl_th x140">판매마일리지</th>
		<th class="list_tbl_th x100">배송비</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$od_sql = " select * from g5_ptmall_order where od_idx='{$od_idx}' ";
	$od_row = sql_fetch($od_sql);

	$cart_sum = 0;
    $cart_sum2 = 0;
	$cart_fee_sum = 0;
	$hap = 0;
    $hap2 = 0;

	$goodname = '';

	$ct_sql = " select * from g5_ptmall_cart where od_idx='{$od_idx}' ";
	$ct_qry = sql_query($ct_sql);
	$ct_num = sql_num_rows($ct_qry);
	if($ct_num > 0){
		for($i=0; $i<$ct_num; $i++){
			$ct_row = sql_fetch_array($ct_qry);

			if($i == 0) $goodname .= $ct_row['it_name'];

			$tr_bg = '';
			if($i%2 == 0) $tr_bg = 'tr_bg';

			$cart_sum += $ct_row['it_tot_price'];
            $cart_sum2 += $ct_row['it_tot_price2'];
			$cart_fee_sum += $ct_row['it_fee'];
	?>
	<tr>
		<td class="list_tbl_td2 talign_c <?php echo $tr_bg ?>">
			<?php if($ct_row['it_img'] != ''){ ?><img src="<?php echo $ct_row['it_img'] ?>" border="0" width="110"><?php } ?>
		</td>
		<td class="list_tbl_td2 <?php echo $tr_bg ?>">
			<div class="opt_name_text"><?php echo $ct_row['it_name'] ?></div>

			<?php
			if($ct_row['opt_cnt'] > 0){
				$opt_sql = " select * from g5_ptmall_cart_opt where ct_idx='{$ct_row['ct_idx']}' and mb_id='{$member['mb_id']}' order by opt_sort asc ";
				$opt_qry = sql_query($opt_sql);
				$opt_num = sql_num_rows($opt_qry);
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
					<td></td>
				</tr>
				</tbody>
				</table>
			</div>
			<?php
				}
			}

			$hap = $cart_sum + $cart_fee_sum;
            $hap2 = $cart_sum2;
			?>
		</td>
		<td class="list_tbl_td2 talign_r <?php echo $tr_bg ?>"><span class="opt_tot_price_text"><?php echo number_format($ct_row['it_tot_price']) ?>원</span></td>
        <td class="list_tbl_td2 talign_r <?php echo $tr_bg ?>"><span class="opt_tot_price_text2"><?php echo number_format($ct_row['it_tot_price2']) ?>P</span></td>
		<td class="list_tbl_td2 talign_r <?php echo $tr_bg ?>"><span class="fee_text"><?php echo number_format($ct_row['it_fee']) ?>원</span></td>
	</tr>
	<?php
		}
		if($i > 1){
			$goodname .= " 외".($i-1).'개';
		}
	}
	?>
	</tbody>
	</table>

	<table class="me_tbl" style="margin:0; border:1px solid #dcdcdc; border-top:0; background:#fff;">
	<tbody>
	<tr>
		<td style="margin:0; padding:10px;">
			<!--
			<div>
				<input type="button" id="del_btn" value="선택삭제">
			</div>
			-->
		</td>
		<td style="margin:0; padding:10px; text-align:right;">
			<span style="font-weight:bold; color:#333;">상품구매금액 : <span id="cart_sum"><?php echo number_format($cart_sum) ?></span>원</span>
			<span style="padding:0px 15px; font-weight:bold; color:#333;"> + </span>

            <span style="font-weight:bold; color:#333;"><span id="cart_sum2"><?=number_format($cart_sum2)?></span>P</span>
            <span style="padding:0px 15px; font-weight:bold; color:#333;"> + </span>

			<span style="font-weight:bold; color:#333;">배송비 : <span id="cart_fee_sum"><?php echo number_format($cart_fee_sum) ?></span>원</span>
			<span style="padding:0px 20px; font-weight:bold; color:#fa003b; font-size:22px;">= 총결제금액 <span id="hap"><?php echo number_format($hap) ?></span> 원 + <span id="hap2"><?php echo number_format($hap2) ?></span> P</span>
		</td>
	</tr>
	</tbody>
	</table>


	<div class="title_info">주문자 정보</div>
	<table class="me_tbl2">
	<tbody>
	<tr>
		<th class="info_th">이름</th>
		<td class="info_td"><?php echo $od_row['mb_name'] ?></td>
	</tr>
	<tr>
		<th class="info_th">휴대폰번호</th>
		<td class="info_td"><?php echo $od_row['mb_hp'] ?></td>
	</tr>
	</tbody>
	</table>


	<div class="title_info">배송 정보</div>
	<table class="me_tbl2">
	<tbody>
	<tr>
		<th class="info_th">받는분</th>
		<td class="info_td" colspan="3">
			<input type="text" name="od_name" id="od_name" class="input_text x170" value="">
            <!--
			<select id="deli_change">
				<option value="">배송정보선택</option>
				<?php
				$deliver_sql = " select * from g5_write_deliver where mb_id='{$member['mb_id']}' order by wr_id desc limit 0,10 ";
				$deliver_qry = sql_query($deliver_sql);
				$deliver_num = sql_num_rows($deliver_qry);
				if($deliver_num > 0){
					for($d=0; $d<$deliver_num; $d++){
						$deli_row = sql_fetch_array($deliver_qry);

						$tel_arr = explode('-',$deli_row['wr_1']);
						$hp_arr = explode('-',$deli_row['wr_2']);

						$deli_datas = '';
						$deli_datas .= $deli_row['wr_subject'];
						$deli_datas .= '||';
						$deli_datas .= $deli_row['wr_7'];
						$deli_datas .= '||';
						$deli_datas .= $tel_arr[0];
						$deli_datas .= '||';
						$deli_datas .= $tel_arr[1];
						$deli_datas .= '||';
						$deli_datas .= $tel_arr[2];
						$deli_datas .= '||';
						$deli_datas .= $hp_arr[0];
						$deli_datas .= '||';
						$deli_datas .= $hp_arr[1];
						$deli_datas .= '||';
						$deli_datas .= $hp_arr[2];
						$deli_datas .= '||';
						$deli_datas .= $deli_row['wr_3'];
						$deli_datas .= '||';
						$deli_datas .= $deli_row['wr_4'];
						$deli_datas .= '||';
						$deli_datas .= $deli_row['wr_5'];
				?>
				<option value="<?php echo $deli_datas ?>">
					<?php echo $deli_row['wr_subject'] ?>
				</option>
				<?php
					}
				}
				?>
			</select>
			-->
		</td>
	</tr>
	<tr>
		<th class="info_th">전화번호</th>
		<td class="info_td x330">
			<input type="number" name="od_tel1" id="od_tel1" class="input_text x50" value="" maxlength="3" oninput="maxLengthCheck(this)"> -
			<input type="number" name="od_tel2" id="od_tel2" class="input_text x50" value="" maxlength="4" oninput="maxLengthCheck(this)"> -
			<input type="number" name="od_tel3" id="od_tel3" class="input_text x50" value="" maxlength="4" oninput="maxLengthCheck(this)">
		</td>
		<th class="info_th">휴대폰번호</th>
		<td class="info_td">
			<input type="number" name="od_hp1" id="od_hp1" class="input_text x50" value="" maxlength="3" oninput="maxLengthCheck(this)"> -
			<input type="number" name="od_hp2" id="od_hp2" class="input_text x50" value="" maxlength="4" oninput="maxLengthCheck(this)"> -
			<input type="number" name="od_hp3" id="od_hp3" class="input_text x50" value="" maxlength="4" oninput="maxLengthCheck(this)" >
		</td>
	</tr>
	<tr>
		<th class="info_th">배송 주소</th>
		<td class="info_td" colspan="3">
            <input type="text" name="od_zip" id="od_zip" class="input_text" size="5" maxlength="6" value="<?=$member['mb_zip1']?>" readonly onclick="$('#win_zip_btn').click()">
            <button type="button" class="btn_frmline" id="win_zip_btn"
                <?php if(!$member['mb_zip1'] && !$member['mb_addr1']){ ?>
                    onclick="win_zip('SendPayForm_name', 'od_zip', 'od_addr1', 'od_addr2', 'od_addr3', 'mb_addr_jibeon');"
                <?php } ?>
            >주소 검색</button><br>
            <input type="text" name="od_addr1" id="od_addr1" class="input_text" size="60" value="<?=$member['mb_addr1'].'22'?>" readonly onclick="$('#win_zip_btn').click()"><br>
            <input type="text" name="od_addr2" id="od_addr2" class="input_text" size="60" value="<?=$member['mb_addr2']?>"><br>
            <input type="text" name="od_addr3" id="od_addr3" class="input_text" size="60" value="<?=$member['mb_addr3']?>">
            <input type="hidden" name="mb_addr_jibeon" value="">
		</td>
	</tr>
	<tr>
		<th class="info_th">주문요청 메모</th>
		<td class="info_td" colspan="3">
			<textarea name="od_memo" id="od_memo" class="input_text" style="width:100%; height:150px;"></textarea>
		</td>
	</tr>
	</tbody>
	</table>

	<input type="hidden" name="cart_sum" id="cart_sum_v" value="<?php echo $cart_sum ?>">
    <input type="hidden" name="cart_sum2" id="cart_sum_v2" value="<?php echo $cart_sum2 ?>">
	<input type="hidden" name="cart_fee_sum" id="cart_fee_sum_v" value="<?php echo $cart_fee_sum ?>">
	<input type="hidden" name="hap" id="hap_v" value="<?php echo $hap ?>">
    <input type="hidden" name="hap2" id="hap_v2" value="<?php echo $hap2 ?>">
	<input type="hidden" name="goodname" value="<?=$goodname?>">

	<div class="title_info">결제 정보</div>
	<table class="me_tbl2">
	<tbody>
	<tr>
		<th class="info_th">상품합계<br>금액</th>
		<td class="info_td">
			<?php echo number_format($cart_sum).' 원' ?>
		</td>
	</tr>
    <tr>
        <th class="info_th">상품합계<br>마일리지</th>
        <td class="info_td">
            <?php echo number_format($cart_sum2).' P' ?>
        </td>
    </tr>
	<tr>
		<th class="info_th">배송비</th>
		<td class="info_td">
			<?php echo number_format($cart_fee_sum).' 원' ?>
		</td>
	</tr>
	<tr>
		<th class="info_th">총 결제비용</th>
		<td class="info_td">
			<span style="font-weight:bold; color:#fa003b;"><?php echo number_format($hap).' 원' ?> / <?php echo number_format($hap2).' P' ?></span>
		</td>
	</tr>
	<tr>
		<th class="info_th">보유 마일리지</th>
		<td class="info_td">
			<strong><?=number_format(MEMBER_POINT)?>점</strong>
			<? if($hap2 > MEMBER_POINT) { ?>
			<div>결제 마일리지가 부족합니다.</div>
			<? } ?>
		</td>
	</tr>
	</tbody>
	</table>

	<div style="margin:40px 0; text-align:center;">
        <? if($hap2 >= MEMBER_POINT) { ?>
            <a>결제 마일리지가 부족합니다.</a>
        <? }else{ ?>
            <a id="buy">결제하기</a>
        <?php } ?>
        <!--
        <a id="buy_free">주문하기</a>
        -->
	</div>
	
	</form>
</div>


<script>
    function maxLengthCheck(object){ if (object.value.length > object.maxLength){ object.value = object.value.slice(0, object.maxLength); }}
$(function(){
	$("#deli_change").on('change', function(){
		var f = document.SendPayForm_name;
		var deli_arr = $(this).val().split('||');

		f.od_name.value = deli_arr[1];
		f.od_tel1.value = deli_arr[2];
		f.od_tel2.value = deli_arr[3];
		f.od_tel3.value = deli_arr[4];
		f.od_hp1.value = deli_arr[5];
		f.od_hp2.value = deli_arr[6];
		f.od_hp3.value = deli_arr[7];
		f.od_zip.value = deli_arr[8];
		f.od_addr1.value = deli_arr[9];
		f.od_addr2.value = deli_arr[10];
	});

	$("#buy").on('click',function(){
		if(frmInputChk()){
			if(confirm("<?=number_format($hap2)?>P를 사용하여 결제하시겠습니까?") == true) {
				document.SendPayForm_name.submit();
			} else {
				return false;
			}
		}
	});

	$("#buy_free").on('click',function(){
		if(frmInputChk()){
			document.SendPayForm_name.submit();
		}
	});
});

function frmInputChk(){
	var f = document.SendPayForm_name;

	if(f.od_name.value == ''){
		alert('받는분 이름을 입력해주세요');
		f.od_name.focus();
		return false;
	}

	if(f.od_tel1.value == ''){
		alert('전화번호를 입력해주세요');
		f.od_tel1.focus();
		return false;
	}

	if(f.od_tel2.value == ''){
		alert('전화번호를 입력해주세요');
		f.od_tel2.focus();
		return false;
	}

	if(f.od_tel3.value == ''){
		alert('전화번호를 입력해주세요');
		f.od_tel3.focus();
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
		alert('주소를 검색하여 입력해주세요');
		f.od_zip.focus();
		return false;
	}

	if(f.od_addr1.value == ''){
		alert('주소를 검색하여 입력해주세요');
		f.od_addr1.focus();
		return false;
	}

	return true;
}
</script>