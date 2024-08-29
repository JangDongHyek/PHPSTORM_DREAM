<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";

$shop_url = $home_dir;//쇼핑몰 url

header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$shopname = $ary[shopname];
	$shopemail  = $ary[email];
	$icash_id  = $ary[icash_id];
	$shoptel1= $ary[tel1];
}

$SQL = "select * from order_config where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
  $field1_text = $ary[field1_text];
  $field2_text = $ary[field2_text];
  $field3_text = $ary[field3_text];
  $field4_text = $ary[field4_text];
  $field5_text = $ary[field5_text];
}

//================== 주문서 내용을 불러옴 ================================================
$order_sql = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
$order_res = mysql_query($order_sql, $dbconn);
$order_tot = mysql_num_rows($order_res);
if($order_tot > 0){
	$order_row = mysql_fetch_array($order_res);
	$index_no=$order_row[index_no];
	$id = $order_row[id];
	$name = $order_row[name];
	$passport1 = $order_row[passport1];
	$passport2 = $order_row[passport2];
	$tel1 = $order_row[tel1];
	$tel2 = $order_row[tel2];
	$email = $order_row[email];
	$buyer_zip = $order_row[buyer_zip];
	$buyer_address = $order_row[buyer_address];
	$buyer_address_d = $order_row[buyer_address_d ];
	$receiver = $order_row[receiver];
	$rev_tel = $order_row[rev_tel];
	$rev_tel1 = $order_row[rev_tel1];
	$zip = $order_row[zip];
	$address = $order_row[address];
	$address_d = $order_row[address_d];
	$message = $order_row[message];
	$paymethod = $order_row[paymethod];
	$account_no = $order_row[account_no];
	$status = $order_row[status];
	$date = $order_row[date];
	$money_sender = $order_row[money_sender];
	$pay_day = $order_row[pay_day];
	$date_str = substr($date,0,4)."/".substr($date,5,2)."/".substr($date,8,2);
	$if_use_bonus = $order_row[if_use_bonus];
	$use_bonus_tot = $order_row[use_bonus_tot];
	$freight_fee = $order_row[freight_fee];
	$freight_code = $order_row[freight_code];
	$field1 = $order_row[field1];
	$field2 = $order_row[field2];
	$field3 = $order_row[field3];
	$field4 = $order_row[field4];
	$field5 = $order_row[field5];

	//====================== 결제방법 정보 ===============================================
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
		$pay_sql = "select * from $BankTable where mart_id='$mart_id' and account_no='$account_no'";
		$pay_res = mysql_query($pay_sql, $dbconn);
		$pay_row = mysql_fetch_array($pay_res);
		$account_no = $pay_row[account_no];
		$bank_name = $pay_row[bank_name];
		$bank_number = $pay_row[bank_number];
		$owner_name = $pay_row[owner_name];
	}

	if($paymethod== 'bycard' || $paymethod== 'bytelec' || $paymethod== 'byesignpay' || $paymethod== 'byprepay' || $paymethod== 'byallthegate' || $paymethod== 'bytgcorp' ||$paymethod== 'by_dacom_card' ){
		$paystr = "카드결제";
		$totpaystr = "카드결제 금액";
	}
	if($paymethod== 'byaccount'||$paymethod== 'by_telec_account'||$paymethod== 'by_allthegate_account'||$paymethod== 'by_tg_account'||$paymethod== 'by_dacom_account'){
		$paystr = "계좌이체";
		$totpaystr = "계좌이체 금액";
	}

	//====================== 온라인 입금시 계좌 정보 =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "온라인입금";
			$totpaystr = "온라인 입금 금액";
		}else{
			$account_str ="";
			$paystr = "";
			$totpaystr = "온라인 입금 금액";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "온라인입금 + 포인트결제";
			$totpaystr = "온라인 입금 금액";
		}else{
			$account_str ="";
			$paystr = "";
			$totpaystr = "온라인 입금 금액";
		}
	}

	if($paymethod== 'bypoint'){
		$paystr = "포인트결제";
		$totpaystr = "결제 금액";
	}
}

$mailcontent = "

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<title>▒ $mart_id- 믿을수있는 쇼핑몰, 쇼핑의 즐거움을 더해드립니다 ▒</title>
<style type='text/css'>
<!--
.text_18 {font-family: '돋움','굴림';font-size: 12px ;line-height: 18px;color: #333333}
.mypage_1 {font-family: '돋움','굴림';font-size: 12px ;line-height: 16px;color: #DA6157;  font-weight: bold;}
.mypage_2 {font-family: '돋움','굴림';font-size: 12px ;line-height: 16px;color: #A46738;  font-weight: bold;}
.mypage_3 {font-family: '돋움','굴림';font-size: 12px ;line-height: 16px;color: #D0783A;  font-weight: bold;}
.mypage_4 {font-family: '돋움','굴림';font-size: 12px ;line-height: 16px;color: #627C12;  font-weight: bold;}
a:link {color:#333333; text-decoration:none; }
a:visited {color:#333333; text-decoration:none; }
a:active {color:#333333; text-decoration:none;}
a:hover {color:#000000; text-decoration:none;}
.input_03 {color:333333; font-family:'돋움','굴림'; font-size: 9pt; background-color:#F7F7F7; border:1 solid #999999;
border-top-color: #9E9E9E; border-right-color: #EAEAEA; border-bottom-color: #EAEAEA;border-left-color: #9E9E9E;}
-->
</style>
</head>
<body>
<table width='650' border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='20'><img src='http://$HTTP_HOST/market/image/mail/top_l.gif' width='20' height='70'></td>
		<td align='center' background='http://$HTTP_HOST/market/image/mail/top_bg.gif'><img src='http://$HTTP_HOST/market/image/mail/top_type.gif' width='260' height='70'></td>
		<td width='20'><img src='http://$HTTP_HOST/market/image/mail/top_r.gif' width='20' height='70'></td>
	</tr>
	<tr>
		<td height='10' colspan='3'></td>
	</tr>
</table>
<table width='650' border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='20'><img src='http://$HTTP_HOST/market/image/mail/mid_l.gif' width='20' height='130'></td>
		<td align='center' background='http://$HTTP_HOST/market/image/mail/mid_bg.gif'><img src='http://$HTTP_HOST/market/image/mail/title_common.gif'></td>
		<td width='20'><img src='http://$HTTP_HOST/market/image/mail/mid_r.gif' width='20' height='130'></td>
	</tr>
	<tr>
		<td height='20' colspan='3'></td>
	</tr>
</table>
<table width='630' border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='1' bgcolor='E4E4E4'></td>
		<td>
			<table width='100%'  border='0' cellspacing='0' cellpadding='20'>
				<tr>
            		<td bgcolor='#FFFFFF' class='text_18'>
            			안녕하세요 $shopname 쇼핑몰입니다.<br>
            			고객님이 주문하신 상품이 배송지로 출발하였습니다. <br>
            			배송기간은 1~3일이내에 받아보실 수 있습니다.<br><br>
            		</td>
          		</tr>
				<tr>
					<td class='text_18'>
<!------------------------------------- 내용 시작 --------------------------------------->
                        <table width='100%' border='1' align='center' cellpadding='5' cellspacing='0' bordercolorlight='#E1E1E1' bordercolordark='white'>
                        	<tr>
                        		<td bgcolor='F1766C' height='3' colspan='2'></td>
                       		</tr>
                        	<tr>
                        		<td width='100'  bgcolor='#F7F7F7' class='text_14_s2'><img src='../image/icon_4.gif' width='15' height='9' align='absmiddle'>주문번호</td>
                        		<td><span class='price'>$order_num</span></td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='../image/icon_4.gif' width='15' height='9' align='absmiddle'>주문날짜</td>
                        		<td><span class='price'>$date_str</span></td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='../image/icon_4.gif' width='15' height='9' align='absmiddle'>주문상품</td>
                        		<td>
";
$ok_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
$ok_res = mysql_query($ok_sql, $dbconn);
$ok_tot = mysql_num_rows($ok_res);
$mon_tot = 0;
$i = 0;
while($ok_row = mysql_fetch_array($ok_res)){
	$i++;
	$item_name = $ok_row[item_name];
	$coupon_used = $ok_row[coupon_used];
	$item_no_forcash = $ok_row[item_no];
	$item_no_coupon = $ok_row[item_no];
	if($i == 0){
		$item_no_tmp = $ok_row[item_no]; //제일 나중 구매한 상품
	}
	$order_pro_no = $ok_row[order_pro_no];
	$mart_id = $ok_row[mart_id];
	$opt = $ok_row[opt];
	$opt1_5 = $ok_row[opt1_5];
	$z_price = $ok_row[z_price];
	if($index_no < 297 || $index_no > 304){
    $tax_price = $z_price * 0.1;
	}
	$z_price = $z_price + $tax_price;
	$tax_price_str=number_format($tax_price);




	$bonus = $ok_row[bonus];
	$pro_freight_code = $ok_row[pro_freight_code];
	$pro_delivery = $ok_row[pro_delivery];
	$z_price_str = number_format($z_price);
	$bonus_str = number_format($bonus);
	
	$use_bonus = $ok_row[use_bonus];
	$status = $ok_row[status];
	$quantity = $ok_row[quantity];
	$sum = $z_price*$quantity;

	$sum_str = number_format($sum);
	
	$mon_tot += $sum;

	$cart_sql1 = "select * from $ItemTable where item_no='$item_no_coupon'";
	$cart_res1 = mysql_query($cart_sql1, $dbconn);
	$cart_row1 = mysql_fetch_array($cart_res1);

	$prevno = $cart_row1[prevno];
	$cate_num = $cart_row1[category_num];
	$use_coupon = $cart_row1[use_coupon];
	$provider_id = $cart_row1[provider_id];
	$img_sml = $cart_row1[img_sml];
	$img = $cart_row1[img];
	$img_big = $cart_row1[img_big];
	$img_high = $cart_row1[img_high];
	$short_explain = $cart_row1[short_explain];
	$short_explain = han_cut($short_explain,28);
  
	$if_cash_str = '';
	$SQL_T = "select if_cash,mart_id from item where item_no='$item_no_forcash'";
	$dbresult_T = mysql_query($SQL_T, $dbconn);
	$if_cash = mysql_result($dbresult_T,0,0);
	$mart_id_tmp = mysql_result($dbresult_T,0,1);
	
	if($mart_id == $mart_id_tmp){
		if($if_cash == '1') $if_cash_str = "<img src='http://$HTTP_HOST/market/images/cash.gif' width='46' height='15' absalign='middle'>";
	}else{
		$SQL_T = "select if_cash from gnt_item where seller_id='$mart_id' and item_no='$item_no_forcash'";
		$dbresult_T = mysql_query($SQL_T, $dbconn);
		$numRows_T = mysql_num_rows($dbresult_T);
		if($numRows_T > 0)
		$if_cash = mysql_result($dbresult_T,0,0);
		if($if_cash == '1') $if_cash_str = "<img src='http://$HTTP_HOST/market/images/cash.gif' width='46' height='15' absalign='middle'>";
	}

	//============================ 상품 이미지 =======================================
	if($img_sml != "" && file_exists("$Co_img_UP$mart_id_tmp/$img_sml")){
		if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
			$img_str = "<img src='http://$HTTP_HOST/$Co_img_DOWN$mart_id_tmp/$img_sml' width='50' height='50' border='0' align='left'>";
		}
	}else{
		$img_str = "<img src='http://$HTTP_HOST/market/image/noimage_ss.gif' border='0' width='50' height='50' border='0'>";
	}

	$mailcontent .= "
								<table width='100%'  border='0' cellspacing='0' cellpadding='5'>
                        				<tr>
                        					<td width='70' valign='top'>
												<table width='60' height='60' border='0' align='center' cellpadding='0' cellspacing='0'>
                        							<tr>
                        								<td align='center' background='http://$HTTP_HOST/market/image/product/product_back.gif'>$img_str</td>
                       								</tr>
                        						</table>
											</td>
                        					<td>
												<span class='text_red'>[$item_name]</span> $if_cash_str
	";
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
		$mailcontent .= "<br>옵션:";
		$opts = explode("!", $opt);
		if(strstr($opts[0],'^'))
			$opts_1 = explode("^", $opts[0]);
		else $opts_1[0] = $opts[0];
		
		if($opts_1[0] != "")
			$mailcontent .= "$opts_1[0]";
		if($opts_1[3] != "")
			$mailcontent .= "($opts_1[3])";

		if($opt1_5 != ""){
			$opt1_5_ex = explode("@",$opt1_5);

			$mailcontent .= "($opt1_5_ex[0])($opt1_5_ex[1])";
		
		}else{
			$mailcontent .= "($opts_1[3])";
		}

		if($opts[1] != "")
			$mailcontent .= "$opts[1]&nbsp;";
		if($opts[2] != "")
			$mailcontent .= "$opts[2]";
	}
	$mailcontent .= "

                            					<br><span class='text_14_s2'>$short_explain</span>
											</td>
											<td width='90'>단가 : $z_price_str 원<BR>(부가세:$tax_price_str 원포함)</td>
                        					<td width='40'>$quantity 개</td>
											<td width='90'>합계 : $sum_str 원</td>
                       					</tr>
										<tr>
											<td align='center' colspan='5'><b>[송장번호 : $pro_freight_code] | [택배회사 : $pro_delivery ]</b></td>
										</tr>
                        			</table>
	";
}   
$mon_tot_freight = $mon_tot + $freight_fee;
$mon_tot_freight_str = number_format($mon_tot_freight);
$freight_fee_str = number_format($freight_fee);
$mailcontent .= "
								</td>
                       		</tr>
                        	 <tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>배송료</td>
                        		<td><span class='price'>$freight_fee_str 원</span></td>
                       		</tr> 
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>결제금액</td>
                        		<td><span class='price'>$mon_tot_freight_str 원</span></td>
                       		</tr>
";
if($if_use_bonus == 1){
	$use_bonus_tot_str = number_format($use_bonus_tot);
	//실제 결제해야될 금액 
	$money_to_pay = $mon_tot_freight - $use_bonus_tot;
	$money_to_pay_str = number_format($money_to_pay);

	$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>포인트 사용</td>
                        		<td><span class='price'>$use_bonus_tot_str 원</span></td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>$totpaystr</td>
                        		<td><span class='price'>$money_to_pay_str 원</span></td>
                       		</tr>
	";
}
$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>결제방법</td>
                        		<td>$paystr $account_str</td>
                       		</tr>
";
if( $use_bonus_tot < $mon_tot_freight ){
	if($paymethod== 'byonline'){
		$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>입금자명</td>
                        		<td>$money_sender</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>입금예정일</td>
                        		<td>$pay_day</td>
                       		</tr>
		";
	}
}

if(!empty($field1_text)){
	$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>$field1_text</td>
                        		<td>$field1</td>
                       		</tr>
	";
}

if(!empty($field2_text)){
	$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>$field2_text</td>
                        		<td>$field2</td>
                       		</tr>
	";
}

if(!empty($field3_text)){
	$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>$field3_text</td>
                        		<td>$field3</td>
                       		</tr>
	";
}

if(!empty($field4_text)){
	$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>$field4_text</td>
                        		<td>$field4</td>
                       		</tr>
	";
}
      		
if(!empty($field5_text)){
	$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>$field5_text</td>
                        		<td>$field5</td>
                       		</tr>
	";
}
$mailcontent .= "
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>기타요청</td>
                        		<td>$message</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>구매자</td>
                        		<td>$name</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>연락처</td>
                        		<td>$tel1</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>휴대폰번호</td>
                        		<td>$tel2</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>이메일</td>
                        		<td>$email</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>주소</td>
                        		<td>[$buyer_zip] $buyer_address $buyer_address_d</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>받는사람</td>
                        		<td>$receiver</td>
                       		</tr>
							$freight_code_str
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>연락처</td>
                        		<td>$rev_tel</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>휴대폰번호</td>
                        		<td>$rev_tel1</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='#F7F7F7' class='text_14_s2'><img src='http://$HTTP_HOST/market/image/icon_4.gif' width='15' height='9' align='absmiddle'>배송지주소</td>
                        		<td>[$zip] $address&nbsp;&nbsp;$address_d</td>
                       		</tr>
                        	<tr>
                        		<td bgcolor='F1766C' height='3' colspan='2'></td>
                       		</tr>
                        </table>
<!------------------------------------- 내용 끝 ----------------------------------------->
					</td>
				</tr>
			</table>
		</td>
		<td width='1' bgcolor='E4E4E4'></td>
	</tr>
	<tr>
		<td height='20' colspan='3'></td>
	</tr>
</table>
<table width='630' border='0' align='center' cellpadding='10' cellspacing='7' bgcolor='#EFEFEF'>
	<tr>
		<td width='638' bgColor='#FFFFFF' class='text_18'>[$shopname]쇼핑몰 고객센터</b> : 전화) <span class='mypage_1'>[$shoptel1]</span>, email : <span class='mypage_1'>[$shopemail]</span>
</table>
<table width='650' border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td height='20'></td>
	</tr>
	<tr>
		<td width='20'><img src='http://$HTTP_HOST/market/image/mail/bottom_l.gif' width='20' height='70'></td>
		<td align='center' background='http://$HTTP_HOST/market/image/mail/bottom_bg.gif'><a href='http://$HTTP_HOST' target='_blank'><img src='http://$HTTP_HOST/market/image/mail/bottom_type.gif' width='260' height='70' border='0'></a></td>
		<td width='20'><img src='http://$HTTP_HOST/market/image/mail/bottom_r.gif' width='20' height='70'></td>
	</tr>
</table>
</body>
</html>
";
mail($email, "주문하신 상품이 배송지로 출발하였습니다.", "$mailcontent", "From: $shopname<$shopemail>\nContent-type: text/html", "-f $shopemail");

//===================== 배송메일 발송후 주문을 배송완료로 변경하기 =======================
$sql = "update $Order_ProTable set status='3' where order_num='$order_num'";
$res = mysql_query( $sql, $dbconn );

//구매자 정보 알아내기
$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$id = mysql_result($dbresult,0,0);
$tel2 = mysql_result($dbresult,0,1);
$name = mysql_result($dbresult,0,2);

/** //================== SMS DB 설정 파일을 불러옴 ===========================================
include "../../connect_sms.php"; **/
include "../../market/include/getmartinfo.php";

/** //================== SMS 전송 ============================================================
$tr_senddate = date("YmdHis");
$tran_phone = "$tel2";//받는 사람 번호
$tran_callback = "$shop_tel";//보내는 사람 번호
$tran_msg = "$name"."님이 주문하신 상품이 배송되었습니다.송장번호 "."$pro_freight_code"."[$mart_id]";

$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
$sms_res = mysql_query( $sms_sql, $connect );

if( !$sms_res ){
	echo "
	<script>
		alert('문자 전송 실패');
	</script>
	";
}
//========================================================================================**/

echo ("
	<script language='javascript'>
	alert(\"배송중 메일이 보내졌습니다.\");
	window.close();
	window.opener.location.reload();
	</script>
");
?>
<?
mysql_close($dbconn);
?>