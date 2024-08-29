<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
$SQL = "select * from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, "perms");
if($perms == "4") {
	echo ("		
	<script>
		alert('미등록 쇼핑몰입니다.');
		history.go(-1);
	</script>
	");
	exit;
}

if($target == "") $target="order.php";
include( '../include/getmartinfo.php' );
if($flag == ''){

	if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
	else include('../include/head_alltemplate.inc');
?>
<script>
function really(){
	if(confirm("정말 주문을 취소하시겠습니까?")) return true;
	else return false;
}
</script>
<script>
function receipt_win(mart_id,order_num){
	var url = "../receipt/receipt.php?mart_id="+mart_id+"&order_num="+order_num
	var uploadwin = window.open(url,"receipt","width=560,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
}
</script>

<?
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/topmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) include( '../include/topmenu_template6.inc' );

if(strstr($icon_module,"icon7")!=false) include( '../include/leftmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/leftmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/leftmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/leftmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/leftmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) {
?>
<!--검색부분-->
<table width="990" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
  <form name=search onsubmit='return frm_search(this)' action='../product/search.php'>
	<input type=hidden name='search_type' value='item'>
	<input type=hidden name='mart_id' value='<?=$mart_id?>'>
	<tr>
    <td width="30" height="30">&nbsp;</td>
    <td width="500" background="../images/template6/image/top/search_bg.gif" class="text_left"><img src="../images/template6/image/nevigation_icon.gif" width="17" height="14" align="absmiddle">
    홈 &gt; 주문조회
    </td>
    <td width="460" align="right" background="../images/template6/image/top/search_bg.gif" class="text_right"><input name="itemname" type="text" class="input_search">
        <a href='javascript:document.search.submit()'><img src="../images/template6/image/top/bu_search.gif" width="56" height="22" border="0" align="absmiddle"></a></td>
  </tr>
  </form>
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
</table>
<!--검색부분끝-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">
   <!--타이들이미지 시작-->
   <table width="960" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td background="../images/template6/image/product/title_bg.gif"><img src="../images/template6/image/product/title_1.gif" width="130" height="40"><img src="../images/template6/image/product/title_type.gif" width="180" height="40"></td>
     </tr>
  </table>
  <!--타이들이미지  끝-->
  <table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
<?
	include( '../include/leftmenu_template6.inc' );
}
?>
	<td width="609" valign="top" bgcolor='#ffffff' align="center">
    	<table border="0" width="571">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
if($ti_order3_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_order3_img")){
	echo "	
<img src='$Co_img_DOWN$mart_id/design2/$ti_order3_img' WIDTH='120' HEIGHT='27'>
	";
}
else{
	echo "
<img src='../images/detailorder-title.gif' WIDTH='120' HEIGHT='27'>
	";
}
?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
if($ti_line_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_line_img")){
	echo "	
<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' WIDTH='571' HEIGHT='12'>
	";
}
else{
	echo "
<img src='../images/line.gif' WIDTH='571' HEIGHT='12'>
	";
}
?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="20"></td>
      	</tr>
<?
$SQL = "select * from $Order_BuyTable where order_num='$order_num_query' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$name = $ary["name"];
	$passport1 = $ary["passport1"];
	$passport2 = $ary["passport2"];
	$tel1 = $ary["tel1"];
	$tel2 = $ary["tel2"];
	$email = $ary["email"];
	$receiver = $ary["receiver"];
	$rev_tel = $ary["rev_tel"];
	$rev_tel1 = $ary["rev_tel1"];
	$zip = $ary["zip"];
	$address = $ary["address"];
	$address_d = $ary["address_d"];
	$message = $ary["message"];
	$paymethod = $ary["paymethod"];
	$account_no = $ary["account_no"];
	$status = $ary["status"];
	$date = $ary["date"];
	$pay_day = $ary["pay_day"];
	$money_sender = $ary["money_sender"];
	$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
	$if_use_bonus = $ary["if_use_bonus"];
	$use_bonus_tot = $ary["use_bonus_tot"];
	$freight_fee = $ary["freight_fee"];
	$keeper_message = $ary["keeper_message"];
}
if($paymethod== 'byonline'){
	$paymethod_str = "온라인입금";
}
if($paymethod== 'bycard' || $paymethod== 'bytelec' || $paymethod== 'byesignpay' || $paymethod== 'byprepay' || $paymethod== 'byallthegate' || $paymethod== 'bytgcorp' ||$paymethod== 'by_dacom_card' ){
	$paymethod_str = "카드결제";
}
if($paymethod== 'byaccount'||$paymethod== 'by_telec_account'||$paymethod== 'by_allthegate_account'||$paymethod== 'by_tg_account'){
	$paymethod_str = "계좌이체";
}

?>
		<tr>
        	<td width="100%" align="center">
        		<table border="0" width="540" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" colspan="4">
						<span class="bb"><?=$name?>님이 구매하신 상품의 상세내역입니다.</span><span class="aa"><br><br></span>
            		</td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#808080" height="2" colspan="4"></td>
          		</tr>
          		<tr> 
					<td align=left width=377 bgColor=#efefef colSpan=3 height=25> 
						<P style="PADDING-LEFT: 10px"><SPAN class=aa>주문 내역</SPAN></P>
					</td>
					<td align=right width=159 bgColor=#efefef height=25><span class=aa>
<?
if($status < 2){
?>
						<a href='order_detail.php?flag=cancel&order_pro_no=<?=$order_pro_no?>&order_num_query=<?=$order_num_query?>&mart_id=<?=$mart_id?>&order_num=<?=$order_num?>&target=<?=$target?>&passport1=<?=$passport1?>&passport2=<?=$passport2?>' onclick='return really()'><img src='../images/cancel.gif' width='59' height='20' border='0'></a>
<?
}
if($status == 8){
?>
						<font color='red'>고객주문취소</font>
<?
}	
?>
						</span>
					</td>
            	</tr>
            	<tr>
            		<td width="536" background="../images/left_dot.gif" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">주문번호</span>
					</td>
            		<td width="153" height="25">
            			<span class="bb"><?=$order_num_query?></span>
					</td>
            		<td width="147" height="25">
            			<span class="bb">주문일시</span>
					</td>
            		<td width="159" height="25">
            			<span class="bb"><?=$date_str?></span>
					</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="532" height="10" align="center" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td align="center" colspan="4" bgcolor="#808080">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td bgcolor="#FFFFFF" align="center"><span class="aa">상품명</span></td>
                			<td bgcolor="#FFFFFF" align="center"><span class="aa">단가</span></td>
                			<td bgcolor="#FFFFFF" align="center"><span class="aa">수량</span></td>
                			<td bgcolor="#FFFFFF" align="center"><span class="aa">소계</span></td>
                		</tr>
<?
$SQL = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num_query' and status > 0 order by order_pro_no desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$mon_tot = 0;
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$order_pro_no = $ary["order_pro_no"];
	$mart_id = $ary["mart_id"];
	$item_name = $ary["item_name"];
	$opt = $ary["opt"];
	$z_price = $ary["z_price"];
	$bonus = $ary["bonus"];
	
	$item_no_forcash = $ary["item_no"];
	$z_price_str = number_format($z_price);
	$bonus_str = number_format($bonus);
	
	$use_bonus = $ary["use_bonus"];
	$quantity = $ary["quantity"];
	$sum = $z_price*$quantity;
	$sum_str = number_format($sum);
	$mon_tot += $sum;
	
	$if_cash_str = '';
	$SQL_T = "select if_cash,mart_id from item where item_no='$item_no_forcash'";
	$dbresult_T = mysql_query($SQL_T, $dbconn);
	$if_cash = mysql_result($dbresult_T,0,0);
	$mart_id_tmp = mysql_result($dbresult_T,0,1);
	
	if($mart_id == $mart_id_tmp){
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' WIDTH='46' HEIGHT='15' absalign='middle'>";
	}else{
		$SQL_T = "select if_cash from gnt_item where seller_id='$mart_id' and item_no='$item_no_forcash'";
		$dbresult_T = mysql_query($SQL_T, $dbconn);
		$numRows_T = mysql_num_rows($dbresult_T);
		if($numRows_T > 0)
		$if_cash = mysql_result($dbresult_T,0,0);
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' WIDTH='46' HEIGHT='15' absalign='middle'>";
	}
?>
						<tr>
                			<td bgcolor='#FFFFFF'>
								<span class='bb'><?=$item_name?> <?=$if_cash_str?>
<?
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
?>
								<br><img src='../images/optionbar.gif'>옵션:
<?
		$opts = explode("!", $opt);
		if(strstr($opts[0],'^'))
			$opts_1 = explode("^", $opts[0]);
		else {
			$opts_1[0] = $opts[0];
			$opts_1[1] = '';
		}
		if($opts_1[0] != "")
			echo "$opts_1[0]";
		if($opts_1[1] != "")
			echo "($opts_1[1] 원)&nbsp;";
		if($opts[1] != "")
			echo "$opts[1]&nbsp;";
		if($opts[2] != "")
			echo "$opts[2]";
	}
?>
								</span>
							</td>
                			<td bgcolor='#FFFFFF' align='right'><span class='bb'><?=$z_price_str?> 원</span></td>
                			<td bgcolor='#FFFFFF' align='center'><span class='bb'><?=$quantity?></span></td>
                			<td bgcolor='#FFFFFF' align='right'><span class='bb'><?=$sum_str?> 원</span></td>
                		</tr>
<?
}
if($freight_fee == ''){
	if($mon_tot >= $freight_limit){
		$freight_fee = 0;
	}else{
		$freight_fee = $freight_cost;
	}
}
$mon_tot_freight = $mon_tot + $freight_fee;
?>
              			
              			<tr>
                			<td bgcolor="#FFFFFF" colspan="3" align="center">
                				<span class="aa">배송비</span>
							</td>
                			<td bgcolor="#FFFFFF"><span class="bb"><p align="right"><?=number_format($freight_fee)?> 원</span></td>
                		</tr>
              			<tr>
                			<td bgcolor="#FFFFFF" colspan="3" align="center"><span class="aa">합 &nbsp;&nbsp; 계</span><span class="bb"></span></td>
                			<td bgcolor="#FFFFFF"><span class="bb"><p align="right"><font color='#ff0000'><?=number_format($mon_tot_freight)?> 원</font></span></td>
              			</tr>
            			</table>
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="10" align="center" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="536" height="10" align="left" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="536" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4" bgcolor="#EFEFEF">
            			<p style="padding-left: 10px"><span class="aa">배송지 정보</span>
					</td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#EFEFEF" background="../images/left_dot.gif"><span class="aa"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<p align="left"><span class="bb">수령자</span></td>
            		<td width="208" height="25" align="center">
            			<span class="bb"><p align="left"><?=$receiver?></span></td>
            		<td width="125" height="25" align="center"></td>
            		<td width="126" height="25" align="center"></td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="center" colspan="4" bgcolor="#C0C0C0"><span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center"><span class="bb"><p align="left">연락처</span></td>
            		<td width="210" height="25"><span class="bb"><?=$rev_tel?></span></td>
            		<td width="126" height="25"><span class="bb">기타 연락처</span></td>
            		<td width="127" height="25"><p align="left"><span class="bb"><?=$rev_tel1?></span></td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"><span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left"><span class="bb">주소</span></td>
            		<td width="433" height="25" colspan="3">
            			<span class="bb"><?=$address?>&nbsp;<?=$address_d?></span></td>
          		</tr>
          		<tr>
            		<td width="562" height="10" align="left" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="562" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4" bgcolor="#EFEFEF"><p style="padding-left: 10px"><span class="aa">결제방법 및 금액</span></td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" background="../images/left_dot.gif"><span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            		<span class="bb">결제방법</span></td>
            		<td width="155" height="25"><span class="bb"><?=$paymethod_str?></span></td>
            		<td width="154" height="25"><span class="bb">금액</span></td>
            		<td width="154" height="25"><span class="bb"><?=number_format($mon_tot_freight)?> 원</span></td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">입금자명</span></td>
            		<td width="155" height="25">
            			<span class="bb"><?=$money_sender?></span></td>
            		<td width="154" height="25">
            			<span class="bb">입금예정일</span></td>
            		<td width="154" height="25">
            			<span class="bb"><?=$pay_day?></span></td>
          		</tr>
<?
if($if_use_bonus != 1) $use_bonus_tot = 0;
$use_bonus_tot_str = number_format($use_bonus_tot);

$money_to_pay = $mon_tot_freight - $use_bonus_tot;
$money_to_pay_str = number_format($money_to_pay);
?>
				<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">마일리지 사용</span></td>
            		<td width="155" height="25">
            			<span class="bb"><?=$use_bonus_tot_str?> 원</span></td>
            		<td width="154" height="25">
            			<span class="bb">실제 결제해야할 금액</span></td>
            		<td width="154" height="25">
            			<span class="bb"><?=$money_to_pay_str?> 원</span></td>
          		</tr>
          		<tr>
            		<td width="562" height="10" align="left" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="562" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4" bgcolor="#EFEFEF"><p style="padding-left: 10px"><span class="aa">요구 사항</span></td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#EFEFEF" background="../images/left_dot.gif"><span class="aa"></span></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4"><br>
            			<span class="bb"><?=$message?></span></td>
          		</tr>
          		<tr>
            		<td width="562" height="10" align="left" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="562" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4" bgcolor="#EFEFEF"><p style="padding-left: 10px"><span class="aa">고객님께 알려드립니다.</span></td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#EFEFEF" background="../images/left_dot.gif"><span class="aa"></span></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4"><br>
            			<span class="bb"><?=$keeper_message?></span></td>
          		</tr>
          		<tr>
            		<td width="536" height="10" align="center" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#808080" height="2" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"><span class="zz"></span></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"><p align="center">&nbsp; &nbsp; 
            			<input class="bb" onclick="window.location.href='<?=$target?>?mart_id=<?=$mart_id?>&order_num_query=<?=$order_num_query?>&name_query=<?=$name?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="리스트로">
<?
if($if_receipt == 't'){
?>
						<input class="bb" onclick="receipt_win('<?=$mart_id?>', '<?=$order_num_query?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="영수증 출력"></strong>
<?
}
?>
            		</td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
    	</table>
	</td>
</tr>
</table>
</td>
</tr>
</table>
<?
include( '../include/bottom.inc' );
?>
</body>
</html>
<?
}
if ($flag == "cancel") {
	/** include "../../admin/sms/class.sms.php";	//sms 발송
	$SMS = new SMS;
	$SMS->SMS_Login($sms_user,$sms_passwd); **/
	
	if($if_order_cancel_msg == '1'){	
		$SQL = "select tel2,name from $Order_BuyTable where order_num = '$order_num_query'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			$tel2_tmp = mysql_result($dbresult,0,0);
			$name_tmp = mysql_result($dbresult,0,1);
		}

		$callback = "$callback_num1$callback_num2$callback_num3";		
		$order_cancel_msg_tmp = str_replace('[SHOP_NAME]',$mart_name,$order_cancel_msg); 
		$order_cancel_msg_tmp = str_replace('[MEM_NAME]',$name_tmp,$order_cancel_msg_tmp); 
		$sms_client_num = str_replace('-','',$tel2_tmp); 
		
		$SMS->Add($sms_client_num,"$callback","$mart_name","$order_cancel_msg_tmp","");
	}
	if($if_order_cancel_msg_admin == '1'){
		$SQL = "select name from $Order_BuyTable where order_num = '$order_num_query'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			$name_tmp = mysql_result($dbresult,0,0);
		}
		$callback = "$callback_num1$callback_num2$callback_num3";		
		$admin_num = "$admin_num1$admin_num2$admin_num3";
		$order_cancel_msg_admin_tmp = str_replace('[SHOP_NAME]',$mart_name,$order_cancel_msg_admin); 
		$order_cancel_msg_admin_tmp = str_replace('[MEM_NAME]',$name_tmp,$order_cancel_msg_admin_tmp); 
		
		$SMS->Add($admin_num,"$callback","$mart_name","$order_cancel_msg_admin_tmp","");
	}		
	
	/**if($if_order_cancel_msg == '1' || $if_order_cancel_msg_admin == '1'){	//sms 설정
		$result = $SMS->Send();
		if ($result) {
			$success = $fail = 0;
			foreach($SMS->Result as $result) {
				list($phone,$code)=explode(":",$result);
				if ($code=="Error") {
					//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
					$fail++;
				} else {
					//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
					$success++;
				}
			}
			//echo $success.'건을 전송했으며'.$fail.'건을 보내지 못했습니다.';
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		else echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
	}**/
			
	//사용한 보너스 복구
	$SQL = "select id, use_bonus_tot from $Order_BuyTable where order_num = '$order_num_query' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	
	$SQL1 = "select * from $BonusTable where order_num='$order_num_query' and bonus<0 and mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	
	if($numRows > 0 &&$numRows1>0){
		$id = mysql_result($dbresult,0,0);
		$use_bonus_tot = mysql_result($dbresult,0,1);
		
		if(!empty($id)&&!empty($use_bonus_tot)){
			//회원테이블에서 보너스 총액 복구
			$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//보너스 테이블에서 삭제
			$SQL = "delete from $BonusTable where order_num='$order_num_query' and bonus<0 and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
		}	
	}
	
	$SQL = "update $Order_BuyTable set status='8' where order_num = '$order_num_query' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	echo "<meta http-equiv='refresh' content='0; URL=$target?mart_id=$mart_id&order_num=$order_num&passport1=$passport1&passport2=$passport2'>";
}
?>
<?
mysql_close($dbconn);
?>