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
include( '../include/getmartinfo.php' );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ks_c_5601-1987">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<title>거래 영수증</title>
<style type="text/css">
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {  line-height: 13pt; font-size: 9pt; color: #ffffff}
.cc {  font-size: 9pt; color: #4CAABE}

A            {font-size: 9pt;line-height: 12pt;text-decoration: none; }  
 A:hover      {text-decoration: none;  }  -->
</style>
<script langauage="Javascript">
<!-- 
  function hidestatus(){ 
  window.status='' 
  return true 
  } 

  if (document.layers) 
  document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT) 

  document.onmouseover=hidestatus 
  document.onmouseout=hidestatus 
//--> 
</script> 
</head>

<body onLoad="window.print();">

<table border="0" width="550">
  <tr>
    <td width="100%" colspan="2"><p align="center"><u><strong><font size="3" color="#000000">거 
    &nbsp; 래&nbsp;&nbsp; 영&nbsp; 수&nbsp; 증</font><font size="3" color="#3F74B5"><br>
    <br>
    </font></strong></u></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#FFFFFF" valign="top"><table border="1" width="100%"
    bordercolor="#7D7D7D" cellspacing="0" cellpadding="0" style="border: thin">
      <tr>
        <td width="100%" colspan="3" height="35" bgcolor="#81B0E0"><p align="center"><span
        class="aa"><strong>영 수 증 (공급받는자용)</strong></span></td>
      </tr>
<?
$SQL = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' and status > 0 order by order_pro_no desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$mon_tot = 0;
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$order_pro_no = $ary[order_pro_no];
	$z_price = $ary[z_price];
	$bonus = $ary[bonus];
	$use_bonus = $ary[use_bonus];
	$status = $ary[status];
	$quantity = $ary[quantity];
	$opt = $ary[opt];
	$opt1_price = $ary[opt1_price];
	$opt2_price = $ary[opt2_price];
	$opt3_price = $ary[opt3_price];
	$opt1_quantity_total = $ary[opt1_quantity_total];
	$opt2_quantity_total = $ary[opt2_quantity_total];
	$opt3_quantity_total = $ary[opt3_quantity_total];

	$sum = $z_price*$quantity;

	$sum_total = $sum;
	
	$mon_tot += $sum; //합계금액

	
	$opts = explode("!", $opt);
	if($opts[0] != ""){
		$opt1_arr = explode("^", $opts[0]);
		if($opt1_arr[1] != ""){
			$sum_total = $sum_total + ($opt1_price * $opt1_quantity_total);
		}else{
		}
	}
	if($opts[1] != ""){
		$opt2_arr = explode("^", $opts[1]);
		//echo "옵션2 : ";
		if($opt2_arr[1] != ""){
			$sum_total = $sum_total + ($opt2_price * $opt2_quantity_total);
		}else{
		}
	}
	if($opts[2] != ""){
		$opt3_arr = explode("^", $opts[2]);
		if($opt3_arr[1] != ""){
			$sum_total = $sum_total + ($opt3_price * $opt3_quantity_total);
		}else{
		}
	}

	$tot_price_str = $tot_price_str + $sum_total;

}

$SQL = "select * from $ReceiptTable where mart_id ='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	$company_no = mysql_result($dbresult, 0, "company_no");
	$company_name = mysql_result($dbresult, 0, "company_name");
	$bossname = mysql_result($dbresult, 0, "bossname");
	$tel = mysql_result($dbresult, 0, "tel");
	$company_kind1 = mysql_result($dbresult, 0, "company_kind1");
	$company_kind2 = mysql_result($dbresult, 0, "company_kind2");
	$receipt_address = mysql_result($dbresult, 0, "address");
}

$SQL = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$id = $ary[id];
	$name = $ary[name];
	$passport1 = $ary[passport1];
	$passport2 = $ary[passport2];
	$tel1 = $ary[tel1];
	$tel2 = $ary[tel2];
	$email = $ary[email];
	$receiver = $ary[receiver];
	$rev_tel = $ary[rev_tel];
	$rev_tel1 = $ary[rev_tel1];
	$zip = $ary[zip];
	$address = $ary[address];
	$address_d = $ary[address_d];
	$message = $ary[message];
	$paymethod = $ary[paymethod];
	$account_no = $ary[account_no];
	$status = $ary[status];
	$date = substr($ary[date],0,10);
	$money_sender = $ary[money_sender];
	$freight_fee = $ary[freight_fee];
}
if($id == "") $id = "비회원";
?>
		<tr>
        <td width="11%" style="border-right: thin; border-top: thin; border-bottom: thin"
        rowspan="6"><p align="center"><span class="aa">공<br>
        급<br>
        자</span></td>
        <td width="39%" style="border-right: thin; border-top: thin; border-bottom: thin"
        align="center" height="25"><span class="aa">사업자등록번호</span></td>
        <td width="50%" style="border-top: thin; border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=$company_no?></span></td>
      </tr>
      <tr>
        <td width="39%" style="border-right: thin; border-bottom: thin" align="center" height="25"><span
        class="aa">상호</span></td>
        <td width="50%" style="border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=$company_name?></span></td>
      </tr>
      <tr>
        <td width="39%" style="border-right: thin; border-bottom: thin" align="center" height="25"><span
        class="aa">대표</span></td>
        <td width="50%" style="border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=$bossname?></span></td>
      </tr>
      <tr>
        <td width="39%" style="border-right: thin; border-bottom: thin" align="center" height="76"><span
        class="aa">소재지</span></td>
        <td width="50%" style="border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=$receipt_address?>
        </span></td>
      </tr>
      <tr>
        <td width="39%" style="border-right: thin; border-bottom: thin" align="center" height="25"><span
        class="aa">업태</span></td>
        <td width="50%" style="border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=$company_kind1?></span></td>
      </tr>
      <tr>
        <td width="39%" style="border-right: thin; border-bottom: thin" align="center" height="25"><span
        class="aa">종목</span></td>
        <td width="50%" style="border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=$company_kind2?></span></td>
      </tr>
      <tr>
        <td width="50%" style="border-right: thin; border-bottom: thin" colspan="2" height="25"><span
        class="aa">&nbsp; 공급가액</span></td>
        <td width="50%" style="border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=number_format($tot_price_str)?>원</span></td>
      </tr>
      <tr>
        <td width="50%" style="border-right: thin" colspan="2" height="25"><span class="aa">&nbsp; 
        공급받는자</span></td>
        <td width="50%"><p style="padding-left: 5px"><span class="aa"><?=$name?></span></td>
      </tr>
    </table>
    </td>
    <td width="50%" bgcolor="#FFFFFF" valign="top"><table border="1" width="100%"
    bordercolor="#7D7D7D" cellspacing="0" cellpadding="0" style="border: thin">
      <tr>
        <td width="100%" colspan="2" height="35" bgcolor="#81B0E0"><p align="center"><span
        class="aa"><strong>주 문 정 보</strong></span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin; border-top: thin" height="25"><span class="aa"> 
        &nbsp; 주문번호</span></td>
        <td width="71%" style="border-top: thin"><p style="padding-left: 5px"><span class="aa"><?=$order_num?></span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin; border-top: thin" height="25"><span class="aa"> 
        &nbsp; 주문일자</span></td>
        <td width="71%" style="border-top: thin"><p style="padding-left: 5px"><span class="aa"><?=$date?></span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin; border-top: thin" height="25"><span class="aa"> 
        &nbsp; 주문자</span></td>
        <td width="71%" style="border-top: thin"><p style="padding-left: 5px"><span class="aa"><?=$name?></span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin; border-top: thin" height="25"><span class="aa"> 
        &nbsp; ID</span></td>
        <td width="71%" style="border-top: thin"><p style="padding-left: 5px"><span class="aa"><?=$id?></span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin; border-top: thin" height="76"><span class="aa"> 
        &nbsp; 주소</span></td>
        <td width="71%" style="border-top: thin"><p style="padding-left: 5px"><span class="aa"><?=$address?>&nbsp;<?=$address_d?></span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin; border-top: thin; border-bottom: thin"
        height="25"><span class="aa">&nbsp; 총금액</span></td>
        <td width="71%" style="border-top: thin; border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=number_format($tot_price_str)?>원</span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin; border-bottom: thin" height="25"><span
        class="aa">&nbsp; 수신자</span></td>
        <td width="71%" style="border-bottom: thin"><p style="padding-left: 5px"><span class="aa"><?=$receiver?></span></td>
      </tr>
      <tr>
        <td width="29%" style="border-right: thin" height="25"><span class="aa">&nbsp; 연락처</span></td>
        <td width="71%"><p style="padding-left: 5px"><span class="aa"><?=$rev_tel?></span></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="100%" colspan="2" height="10"></td>
  </tr>
  <tr>
    <td width="100%" colspan="2" height="10"><table border="1" width="100%" cellspacing="0"
    cellpadding="0" bordercolor="#7D7D7D" style="border: thin">
      <tr>
        <td width="7%" height="25" align="center"><span class="aa">번호</span></td>
        <td width="44%" align="center"><span class="aa">내역</span></td>
        <td width="17%" align="center"><span class="aa">단가</span></td>
        <td width="10%" align="center"><span class="aa">수량</span></td>
        <td width="22%" align="center"><span class="aa">금액</span></td>
      </tr>
      <?
      	$SQL = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' and status > 0 order by order_pro_no desc";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		$mon_tot = 0;
		for ($i=0; $i<$numRows; $i++) {
			mysql_data_seek($dbresult,$i);
			$ary = mysql_fetch_array($dbresult);
			$order_pro_no = $ary[order_pro_no];
			$mart_id = $ary[mart_id];
			$item_name = $ary[item_name];
			$opt = $ary[opt];
			$z_price = $ary[z_price];
			$opt1_price = $ary[opt1_price];
			$opt2_price = $ary[opt2_price];
			$opt3_price = $ary[opt3_price];
			$opt1_quantity_total = $ary[opt1_quantity_total];
			$opt2_quantity_total = $ary[opt2_quantity_total];
			$opt3_quantity_total = $ary[opt3_quantity_total];
			$bonus = $ary[bonus];
			
			$z_price_str = number_format($z_price);
			$bonus_str = number_format($bonus);
			
			$use_bonus = $ary[use_bonus];
			$status = $ary[status];
			$quantity = $ary[quantity];
			$sum = $z_price*$quantity;
			$sum_total = $sum;
			
			$sum_str = number_format($sum);
			//echo "opt=$opt";
			
			$mon_tot += $sum;
			$j = $i + 1;
?>
			<tr>
        <td width='7%' align='center' height='25'><span class='aa'><?=$j?></span></td>
        <td width='44%' align='center'><span class='aa'><?=$item_name?><BR>
<?
$opts = explode("!", $opt);

if($opts[0] != ""){
	$opt1_arr = explode("^", $opts[0]);
	if($opt1_arr[1] != ""){
		echo $opt1_arr[0]."<BR>";
		$opt1_qtt_str = "".$opt1_quantity_total."<BR>";
		$opt1_price_str = "".number_format($opt1_price)."<BR>";
		$sum_total = $sum_total + ($opt1_price * $opt1_quantity_total);
	}else{
		$opt1_qtt_str = "";
		$opt1_price_str = "";
		//echo $opt1_arr[0];
		//echo "<BR>";
	}
}
if($opts[1] != ""){
	$opt2_arr = explode("^", $opts[1]);
	if($opt2_arr[1] != ""){
		echo $opt2_arr[0]."<BR>";
		$opt2_qtt_str = "".$opt2_quantity_total."<BR>";
		$opt2_price_str = "".number_format($opt2_price)."<BR>";
		$sum_total = $sum_total + ($opt2_price * $opt2_quantity_total);
	}else{
		$opt2_qtt_str = "";
		$opt2_price_str = "";
		//echo $opt2_arr[0];
		//echo "<BR>";
	}
}
if($opts[2] != ""){
	$opt3_arr = explode("^", $opts[2]);
	if($opt3_arr[1] != ""){
		echo $opt3_arr[0]."<BR>";
		$opt3_qtt_str = "".$opt3_quantity_total."<BR>";
		$opt3_price_str = "".number_format($opt3_price)."<BR>";
		$sum_total = $sum_total + ($opt3_price * $opt3_quantity_total);
	}else{
		$opt3_qtt_str = "";
		$opt3_price_str = "";
		//echo $opt3_arr[0];
		//echo "<BR>";
	}
}

$tot_price_str = $tot_price_str + $sum_total;
?>
		</span></td>
        <td width='17%' align='center'><span class='aa'><?=$z_price_str?><BR>
<?
echo $opt1_price_str;
echo $opt2_price_str;
echo $opt3_price_str;
?>
		</span></td>
        <td width='10%' align='center'><span class='aa'><?=$quantity?><BR>
<?
echo $opt1_qtt_str;
echo $opt2_qtt_str;
echo $opt3_qtt_str;
?>
<?
$opt1_qtt_str = "";
$opt1_price_str = "";
$opt2_qtt_str = "";
$opt2_price_str = "";
$opt3_qtt_str = "";
$opt3_price_str = "";
?>
		</span></td>
        <td width='22%' align='center'><span class='aa'><?=number_format($sum_total)?></span></td>
      </tr>
<?
      }
      if($freight_fee == ''){
      	if($mon_tot >= $freight_limit) 
					$freight_fee = 0;
				else $freight_fee = $freight_cost;
			}
		$mon_tot_freight = $mon_tot + $freight_fee;
		?>	
		<!-- <tr>
        <td width="100%" colspan="5" height="25"><p align="right"><span class="aa">배송비 : <?=number_format($freight_fee)?>원 
        &nbsp;&nbsp; </span></td>
      </tr> -->
    </table>
    </td>
  </tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>