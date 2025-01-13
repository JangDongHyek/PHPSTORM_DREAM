<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

$SignatureUtil = new INIStdPayUtil();

//############################################
// 1.전문 필드 값 설정(***가맹점 개발수정***)
//############################################
// 여기에 설정된 값은 Form 필드에 동일한 값으로 설정
// 우리회사 아이피 일때는 테스트 모드
if($_SERVER['REMOTE_ADDR']=="121.144.134.22"){
	$mid 			= "INIpayTest";  								// 가맹점 ID(가맹점 수정후 고정)
	$signKey 		= "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"; 			// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지
// 다른 아이피는 실버전으로
}else{
	$mid 			= "60chicken4";  								// 가맹점 ID(가맹점 수정후 고정)
	//인증
	$signKey 		= "cml2aGZnL1dNY28rcHE5WlZuMG9hZz09"; 			// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지
}

$timestamp 		= $SignatureUtil->getTimestamp();   			// util에 의해서 자동생성
$orderNumber 	= $mid . "_" . $timestamp; 						// 가맹점 주문번호(가맹점에서 직접 설정)

//
//###################################
// 2. 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)
//###################################
$mKey 			= hash("sha256", $signKey);
//$mKey			= "3a9503069192f207491d4b19bd743fc249a761ed94246c8c42fed06c3cd15a33";

/* 기타 */
$siteDomain = G5_BBS_URL."/INIStdPaySample"; //가맹점 도메인 입력

// 페이지 URL에서 고정된 부분을 적는다. 
// Ex) returnURL이 http://localhost:8082/demo/INIpayStdSample/INIStdPayReturn.jsp 라면
//                 http://localhost:8082/demo/INIpayStdSample 까지만 기입한다.
?>

<!--<script language="javascript" type="text/javascript" src="https://stgstdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>-->
<script language="javascript" type="text/javascript" src="https://stdpay.inicis.com/stdjs/INIStdPay.js"
charset="UTF-8"></script>

<script>
window.onload = function(){
	INIStdPay.allowpopup();
}

function paybtn() {
	INIStdPay.pay('SendPayForm_id');
}
</script>

<div id="bo_l">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<form method="post" name="SendPayForm_name" id="SendPayForm_id">
	<input type="hidden" name="od_idx" id="od_idx" value="<?php echo $od_idx ?>">
	<input type="hidden" name="orderPage" value="mall2">

	<!-- 주문상품 -->
	<div style="font-weight:bold; font-size:16px;">주문상품</div>
	<table class="me_tbl">
	<thead>
	<tr>
		<th class="list_tbl_th x150">사진</th>
		<th class="list_tbl_th">주문상품</th>
		<th class="list_tbl_th x140">판매가격</th>
		<th class="list_tbl_th x100">배송비</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$od_sql = " select * from g5_point_order where od_idx='{$od_idx}' ";
	$od_row = sql_fetch($od_sql);

	$cart_sum = 0;
	$cart_fee_sum = 0;
	$hap = 0;

	$goodname = '';

	$ct_sql = " select * from g5_point_cart where od_idx='{$od_idx}' ";
	$ct_qry = sql_query($ct_sql);
	$ct_num = sql_num_rows($ct_qry);
	if($ct_num > 0){
		for($i=0; $i<$ct_num; $i++){
			$ct_row = sql_fetch_array($ct_qry);

			if($i == 0) $goodname .= $ct_row['it_name'];

			$tr_bg = '';
			if($i%2 == 0) $tr_bg = 'tr_bg';

			$cart_sum += $ct_row['it_tot_price'];
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
				$opt_sql = " select * from g5_point_cart_opt where ct_idx='{$ct_row['ct_idx']}' and mb_id='{$member['mb_id']}' order by opt_sort asc ";
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
			?>
		</td>
		<td class="list_tbl_td2 talign_r <?php echo $tr_bg ?>"><span class="opt_tot_price_text"><?php echo number_format($ct_row['it_tot_price']) ?>원</span></td>
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
			<span style="font-weight:bold; color:#333;">배송비 : <span id="cart_fee_sum"><?php echo number_format($cart_fee_sum) ?></span>원</span>
			<span style="padding:0px 20px; font-weight:bold; color:#fa003b; font-size:22px;">= 총결제금액 <span id="hap"><?php echo number_format($hap) ?></span> 원</span>
		</td>
	</tr>
	</tbody>
	</table>
	<!-- // 주문상품 -->

	<!-- 주문자정보 -->
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
	<!-- // 주문자정보 -->

	<!-- 배송정보 -->
	<div class="title_info">배송 정보</div>
	<table class="me_tbl2">
	<tbody>
	<tr>
		<th class="info_th">받는분</th>
		<td class="info_td" colspan="3">
			<input type="text" name="od_name" id="od_name" class="input_text x170" value="">
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
		</td>
	</tr>
	<tr>
		<th class="info_th">전화번호</th>
		<td class="info_td x330">
			<input type="text" name="od_tel1" id="od_tel1" class="input_text x50" value=""> -
			<input type="text" name="od_tel2" id="od_tel2" class="input_text x50" value=""> -
			<input type="text" name="od_tel3" id="od_tel3" class="input_text x50" value="">
		</td>
		<th class="info_th">휴대폰번호</th>
		<td class="info_td">
			<input type="text" name="od_hp1" id="od_hp1" class="input_text x50" value=""> -
			<input type="text" name="od_hp2" id="od_hp2" class="input_text x50" value=""> -
			<input type="text" name="od_hp3" id="od_hp3" class="input_text x50" value="">
		</td>
	</tr>
	<tr>
		<th class="info_th">배송 주소</th>
		<td class="info_td" colspan="3">
            <input type="text" name="od_zip" value="" id="od_zip" class="input_text" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('SendPayForm_name', 'od_zip', 'od_addr1', 'od_addr2', 'od_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="od_addr1" value="" id="od_addr1" class="input_text" size="60"><br>
            <input type="text" name="od_addr2" value="" id="od_addr2" class="input_text" size="60"><br>
            <input type="text" name="od_addr3" value="" id="od_addr3" class="input_text" size="60">
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
	<!-- // 배송정보 -->

	<input type="hidden" name="cart_sum" id="cart_sum_v" value="<?php echo $cart_sum ?>">
	<input type="hidden" name="cart_fee_sum" id="cart_fee_sum_v" value="<?php echo $cart_fee_sum ?>">
	<input type="hidden" name="hap" id="hap_v" value="<?php echo $hap ?>">

	<!-- 결제정보 -->
	<div class="title_info">결제 정보</div>
	<table class="me_tbl2">
	<tbody>
	<tr>
		<th class="info_th">상품합계 금액</th>
		<td class="info_td">
			<?php echo number_format($cart_sum).' 원' ?>
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
			<span style="font-weight:bold; color:#fa003b;"><?php echo number_format($hap).' 원' ?></span>
		</td>
	</tr>
	<?php if($hap > 0){ ?>
	<tr>
		<th class="info_th">결제방법 선택</th>
		<td class="info_td">
			<input type="radio" name="od_method" id="od_method1" class="od_method" value="card"><label for="od_method1">신용카드</label>
			<input type="radio" name="od_method" id="od_method2" class="od_method" value="online"><label for="od_method2">온라인계좌이체</label>
			<input type="radio" name="od_method" id="od_method4" class="od_method" value="VBank"><label for="od_method4">가상계좌(무통장입금)</label>
		</td>
	</tr>
	<?php }else{?>
	<input type="hidden" name="od_method" id="od_method3" class="od_method" value="free">
	<?php } ?>

	</tbody>
	</table>
	<!-- // 결제정보 -->

	<div style="margin:40px 0; text-align:center;">
		<?php if($hap > 0){ ?>
		<a id="buy">결제하기</a>
		<?php }else{ ?>
		<a id="buy_free">주문하기</a>
		<?php } ?>
	</div>


	<!-- KG이니시스 연동 STR -->
	<?php
	$params = "oid=" . $orderNumber . "&price=" . $hap . "&timestamp=" . $timestamp;
	$sign = hash("sha256", $params);
	?>
	<input type="hidden" name="version" value="1.0" />
	<input type="hidden" name="mid" value="<?php echo $mid ?>" />
	<input type="hidden" name="oid" value="<?php echo $orderNumber ?>" />
	<input type="hidden" name="goodname" value="<?php echo $goodname ?>" />
	<input type="hidden" name="price" value="<?php echo $hap ?>" />
	<input type="hidden" name="currency" value="WON" />
	<input type="hidden" name="buyername" value="<?php echo $od_row['mb_name'] ?>" />
	<input type="hidden" name="buyertel" value="<?php echo $od_row['mb_hp'] ?>" />
	<input type="hidden" name="timestamp" value="<?php echo $timestamp ?>" />
	<input type="hidden" name="signature" value="<?php echo $sign ?>" />
	<input type="hidden" name="returnUrl" value="<?php echo $siteDomain ?>/INIStdPayReturn_point.php" />
	<input type="hidden" name="mKey" value="<?php echo $mKey ?>" />
	<input type="hidden" name="acceptmethod" id="acceptmethod" value="" >
	<input type="hidden" name="gopaymethod" id="gopaymethod" value="" />
	<input type="hidden" name="offerPeriod" value="" />
	<input type="hidden" name="languageView" value="ko" />
	<input type="hidden" name="charset" value="UTF-8" />
	<input type="hidden" name="payViewType" value="" />
	<input type="hidden" name="merchantData" id="merchantData" value="" />
	<input type="hidden" name="closeUrl" value="<?php echo $siteDomain ?>/close.php" >
	<input type="hidden" name="popupUrl" value="<?php echo $siteDomain ?>/popup.php" >
	<!-- KG이니시스 연동 END -->

	</form>
</div>


<script>
var vbankDate = 'vbank(<?=date("Ymd", strtotime("+6 days", strtotime(date("Y-m-d"))));?>)';

$(function(){
	// 배송정보선택
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

	// 결제방법 선택
	// 1. 신용카드
	$("#od_method1").on('click', function(){
		if($(this).is(':checked') == true){
			$("#gopaymethod").val('Card');
			$("[name=acceptmethod]").val("");
		}
	});
	// 2. 온라인계좌이체
	$("#od_method2").on('click', function(){
		if($(this).is(':checked') == true){
			$("#gopaymethod").val('DirectBank');
			$("[name=acceptmethod]").val("");
		}
	});
	// 3. 무료
	$("#od_method3").on('click', function(){
		if($(this).is(':checked') == true){
			$("#gopaymethod").val('');
			$("[name=acceptmethod]").val("");
		}
	});
	// 4. 가상계좌
	$("#od_method4").on('click', function(){
		if($(this).is(':checked') == true){
			$("#gopaymethod").val('VBank');
			$("[name=acceptmethod]").val(vbankDate + ":va_receipt");
		}
	});

	// 결제하기
	$("#buy").on('click',function(){
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

		<?php if($hap > 0){ ?>
		if($(".od_method").is(':checked') == false){
			alert('결제방법을 선택해주세요');
			$(".od_method").eq(0).focus();
			return false;
		}
		<?php } ?>

		// merchantData 입력
		var datas = "",
			od_tel = "",
			od_hp = "";

		if($("#od_idx").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_idx=" + $("#od_idx").val();
		}

		if($("#od_name").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_name=" + encodeURI($("#od_name").val());
		}

		if($("#od_tel1").val() != ''){
			od_tel += $("#od_tel1").val()+"-";
		}

		if($("#od_tel2").val() != ''){
			od_tel += $("#od_tel2").val()+"-";
		}

		if($("#od_tel3").val() != ''){
			od_tel += $("#od_tel3").val();
		}

		if(od_tel != ''){
			if(datas != '') datas += "&";
			datas += "od_tel=" + od_tel;
		}

		if($("#od_hp1").val() != ''){
			od_hp += $("#od_hp1").val()+"-";
		}

		if($("#od_hp2").val() != ''){
			od_hp += $("#od_hp2").val()+"-";
		}

		if($("#od_hp3").val() != ''){
			od_hp += $("#od_hp3").val();
		}

		if(od_hp != ''){
			if(datas != '') datas += "&";
			datas += "od_hp=" + od_hp;
		}

		if($("#od_zip").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_zip=" + $("#od_zip").val();
		}

		if($("#od_addr1").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_addr1=" + encodeURI($("#od_addr1").val());
		}

		if($("#od_addr2").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_addr2=" + encodeURI($("#od_addr2").val());
		}

		if($("#od_addr3").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_addr3=" + encodeURI($("#od_addr3").val());
		}

		if($("#od_memo").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_memo=" + encodeURI($("#od_memo").val());
		}

		if($("#od_method1").is(':checked') == true){
			if(datas != '') datas += "&";
			datas += "od_method=" + $("#od_method1").val();
		}

		if($("#od_method2").is(':checked') == true){
			if(datas != '') datas += "&";
			datas += "od_method=" + $("#od_method2").val();
		}

		if($("#od_method4").is(':checked') == true){
			if(datas != '') datas += "&";
			datas += "od_method=" + $("#od_method4").val();
		}

		if($("#cart_sum_v").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_tot_price=" + $("#cart_sum_v").val();
		}

		if($("#cart_fee_sum_v").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_tot_fee=" + $("#cart_fee_sum_v").val();
		}

		if($("#hap_v").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_hap=" + $("#hap_v").val();
		}

		$("#merchantData").val(datas);

        paybtn();
	});


	// 결제하기 (무료)
	$("#buy_free").on('click',function(){
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

		// merchantData 입력
		var datas = "",
			od_tel = "",
			od_hp = "";

		if($("#od_idx").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_idx=" + $("#od_idx").val();
		}

		if($("#od_name").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_name=" + encodeURI($("#od_name").val());
		}

		if($("#od_tel1").val() != ''){
			od_tel += $("#od_tel1").val()+"-";
		}

		if($("#od_tel2").val() != ''){
			od_tel += $("#od_tel2").val()+"-";
		}

		if($("#od_tel3").val() != ''){
			od_tel += $("#od_tel3").val();
		}

		if(od_tel != ''){
			if(datas != '') datas += "&";
			datas += "od_tel=" + od_tel;
		}

		if($("#od_hp1").val() != ''){
			od_hp += $("#od_hp1").val()+"-";
		}

		if($("#od_hp2").val() != ''){
			od_hp += $("#od_hp2").val()+"-";
		}

		if($("#od_hp3").val() != ''){
			od_hp += $("#od_hp3").val();
		}

		if(od_hp != ''){
			if(datas != '') datas += "&";
			datas += "od_hp=" + od_hp;
		}

		if($("#od_zip").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_zip=" + $("#od_zip").val();
		}

		if($("#od_addr1").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_addr1=" + encodeURI($("#od_addr1").val());
		}

		if($("#od_addr2").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_addr2=" + encodeURI($("#od_addr2").val());
		}

		if($("#od_addr3").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_addr3=" + encodeURI($("#od_addr3").val());
		}

		if($("#od_memo").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_memo=" + encodeURI($("#od_memo").val());
		}

		if($("#od_method1").is(':checked') == true){
			if(datas != '') datas += "&";
			datas += "od_method=" + $("#od_method1").val();
		}

		if($("#od_method2").is(':checked') == true){
			if(datas != '') datas += "&";
			datas += "od_method=" + $("#od_method2").val();
		}

		if($("#od_method4").is(':checked') == true){
			if(datas != '') datas += "&";
			datas += "od_method=" + $("#od_method4").val();
		}

		if($("#cart_sum_v").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_tot_price=" + $("#cart_sum_v").val();
		}

		if($("#cart_fee_sum_v").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_tot_fee=" + $("#cart_fee_sum_v").val();
		}

		if($("#hap_v").val() != ''){
			if(datas != '') datas += "&";
			datas += "od_hap=" + $("#hap_v").val();
		}

		$("#merchantData").val(datas);

        f.action = "<?php echo G5_BBS_URL ?>/point_order_complete.php";
		f.submit();
	});
});

</script>