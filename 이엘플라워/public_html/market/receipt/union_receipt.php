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

<body>
<table border="0" width="550">
<tr>
    <td width="100%" colspan="2">
    	<p align="center">
    	<font size="3" color="#3F74B5">
    	<u><strong>거 &nbsp; 래&nbsp;&nbsp; 영&nbsp; 수&nbsp; 증<br>
    	<br>
    	</strong></u></font>
    </td>
</tr>
<tr>
    <td width="50%" bgcolor="#999999">
    	<table border="0" width="100%" cellspacing="1" cellpadding="2">
      	<tr>
        	<td width="100%" colspan="3" bgcolor="#81B0E0" height="35">
        		<p align="center">
        		<strong><span class="bb">영 수 증 (공급받는자용)</span></strong></td>
      	</tr>
      	<?
  		$SQL = "select * from $Union_OrderTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$union_no = $ary["union_no"];
			$mart_id = $ary["mart_id"];
			$item_no = $ary["item_no"];
			$item_name = $ary["item_name"];
			$quantity = $ary["quantity"];
			$type = $ary["type"];
		}
		
		if($type == 'slide'){
			$SQL = "select * from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if($numRows > 0){
				mysql_data_seek($dbresult, 0);
				$ary=mysql_fetch_array($dbresult);
				$item_no = $ary["item_no"];
				$item_name = $ary["item_name"];
				$price = $ary["price"];
				$price_str = number_format($price);
				$number1_from = $ary["number1_from"];
				$number1_to = $ary["number1_to"];
				$number2_from = $ary["number2_from"];
				$number2_to = $ary["number2_to"];
				$number3_from = $ary["number3_from"];
				
				$price1 = $ary["price1"];
				$price1_str = number_format($price1);
				$price2 = $ary["price2"];
				$price2_str = number_format($price2);
				$price3 = $ary["price3"];
				$price3_str = number_format($price3);
				$img = $ary["img"];
				$opt = $ary["opt"];
				$item_explain = $ary["item_explain"];
				$item_company = $ary["item_company"];
				$current_num = $ary["current_num"];
				$current_num_str = number_format($current_num);
				$item_code = $ary["item_code"];
				$icon_no = $ary["icon_no"];
				$use_opt1 = $ary["use_opt1"];
				$use_opt23 = $ary["use_opt23"];
	
				if($current_num >= $number1_from && $current_num <= $number1_to){ 
					$current_price = $price1;
				}
				else if($current_num >= $number2_from && $current_num <= $number2_to){ 
					$current_price = $price2;
				}
				else if($current_num >= $number3_from){ 
					$current_price = $price3;
				}
				else {
					$current_price = $price1;
				}
				$current_price_str = number_format($current_price);
			}
		}
		if($type == 'limit'){		
		
			$SQL = "select * from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if($numRows > 0){
				mysql_data_seek($dbresult, 0);
				$ary=mysql_fetch_array($dbresult);
				$item_no = $ary["item_no"];
				$item_name = $ary["item_name"];
				$price = $ary["price"];
				$price_str = number_format($price);
				$z_price = $ary["z_price"];
				$z_price_str = number_format($z_price);
				$limit_total = $ary["limit_total"];
				$limit_total_str = number_format($limit_total);
				$img = $ary["img"];
				$opt = $ary["opt"];
				$item_explain = $ary["item_explain"];
				$item_company = $ary["item_company"];
				$item_code = $ary["item_code"];
				$icon_no = $ary["icon_no"];
				$use_opt1 = $ary["use_opt1"];
				$use_opt23 = $ary["use_opt23"];
				$current_num = $ary["current_num"];
				$current_num_str = number_format($current_num);
				$can_buy = $limit_total - $current_num;
			
				$current_price = $z_price;
				$current_price_str = number_format($current_price);
				
			}
		}
		
		$mon_tot = $quantity * $current_price;
		$mon_tot_str = number_format($mon_tot);
              			
		
		$SQL = "select * from $ReceiptTable where mart_id ='$mart_id'";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		if(mysql_num_rows($dbresult)>0){
			$company_no = mysql_result($dbresult, 0, "company_no");
			$company_name = mysql_result($dbresult, 0, "company_name");
			$bossname = mysql_result($dbresult, 0, "bossname");
			$tel = mysql_result($dbresult, 0, "tel");
			$company_kind1 = mysql_result($dbresult, 0, "company_kind1");
			$company_kind2 = mysql_result($dbresult, 0, "company_kind2");
			$address = mysql_result($dbresult, 0, "address");
		}
	
		$SQL = "select * from $Union_Order_BuyTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$id = $ary["id"];
			$name = $ary["name"];
			$passport1 = $ary["passport1"];
			$passport2 = $ary["passport2"];
			$tel = $ary["tel"];
			$tel1 = $ary["tel1"];
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
			$money_sender = $ary["money_sender"];
		}
		if($id == "") $id = "비회원";
		?>
				
		<tr>
        	<td width="13%" rowspan="6" bgcolor="#FFFFFF">
        		<p align="center"><span class="aa">공<br>
        		<br>
        		급<br>
        		<br>
        		자</span>
        	</td>
        	<td width="34%" bgcolor="#FFFFFF" align="center"><span class="aa">사업자등록번호</span></td>
        	<td width="53%" bgcolor="#FFFFFF"><span class="aa"><?=$company_no?></span></td>
      	</tr>
      	<tr>
        	<td width="34%" bgcolor="#FFFFFF" align="center"><span class="aa">상호</span></td>
        	<td width="53%" bgcolor="#FFFFFF"><span class="aa"><?=$company_name?></span></td>
      	</tr>
      	<tr>
        	<td width="34%" bgcolor="#FFFFFF" align="center"><span class="aa">대표이사</span></td>
        	<td width="53%" bgcolor="#FFFFFF"><span class="aa"><?=$bossname?></span></td>
      	</tr>
      	<tr>
        	<td width="34%" bgcolor="#FFFFFF" align="center"><span class="aa">소재지</span></td>
        	<td width="53%" bgcolor="#FFFFFF">
        		<span class="aa"><?=$address?></span></td>
      	</tr>
      	<tr>
        	<td width="34%" bgcolor="#FFFFFF" align="center"><span class="aa">업태</span></td>
        	<td width="53%" bgcolor="#FFFFFF"><span class="aa"><?=$company_kind1?></span></td>
      	</tr>
      	<tr>
        	<td width="34%" bgcolor="#FFFFFF" align="center"><span class="aa">종목</span></td>
        	<td width="53%" bgcolor="#FFFFFF"><span class="aa"><?=$company_kind2?></span></td>
      	</tr>
      	<tr>
        	<td width="47%" colspan="2" bgcolor="#FFFFFF" height="15"><span class="aa">공급가액</span></td>
        	<td width="53%" bgcolor="#FFFFFF" height="15"><span class="aa"><?=number_format($mon_tot)?>원</span></td>
      	</tr>
      	<tr>
        	<td width="47%" colspan="2" bgcolor="#FFFFFF" height="25">
        		<span class="aa">공급받는 자</span></td>
        	<td width="53%" bgcolor="#FFFFFF" height="25"><span class="aa"><?=$name?></span></td>
      	</tr>
    	</table>
	</td>
    <td width="50%" bgcolor="#999999">
    	<table border="0" width="100%" cellspacing="1" cellpadding="2">
      	<tr>
        	<td width="100%" colspan="2" bgcolor="#81B0E0" height="35">
        		<p align="center">
        		<strong><span class="bb">주&nbsp; 문&nbsp; 정&nbsp; 보</span></strong></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">주문번호</span></td>
        	<td width="65%" bgcolor="#FFFFFF"><span class="aa"><?=$union_order_num?></span></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">주문일자</span></td>
        	<td width="65%" bgcolor="#FFFFFF"><span class="aa"><?=substr($date,0,8)?></span></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">주문자</span></td>
        	<td width="65%" bgcolor="#FFFFFF"><span class="aa"><?=$name?></span></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">ID</span></td>
        	<td width="65%" bgcolor="#FFFFFF"><span class="aa"><?=$id?></span></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">주소</span></td>
        	<td width="65%" bgcolor="#FFFFFF">
        		<span class="aa"><?=$address?>&nbsp;<?=$address_d?></span></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">총금액</span></td>
        	<td width="65%" bgcolor="#FFFFFF"><span class="aa"><?=number_format($mon_tot)?>원</span></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">수신자</span></td>
        	<td width="65%" bgcolor="#FFFFFF"><span class="aa"><?=$receiver?></span></td>
      	</tr>
      	<tr>
        	<td width="35%" bgcolor="#FFFFFF" height="25" align="center"><span class="aa">연락처</span></td>
        	<td width="65%" bgcolor="#FFFFFF" height="25"><span class="aa"><?=$rev_tel?></span></td>
      	</tr>
    	</table>
    </td>
</tr>
<tr>
    <td width="100%" colspan="2" height="10"></td>
</tr>
<tr>
    <td width="100%" colspan="2" bgcolor="#999999">
    	<table border="0" width="100%" cellspacing="1" cellpadding="3" height="79">
      	<tr>
        	<td width="5%" bgcolor="#FFFFFF" height="19" align="center"><span class="aa">번호</span></td>
        	<td width="35%" bgcolor="#FFFFFF" height="19" align="center"><span class="aa">내역</span></td>
        	<td width="14%" bgcolor="#FFFFFF" height="19" align="center"><span class="aa">단가</span></td>
        	<td width="8%" bgcolor="#FFFFFF" height="19" align="center"><span class="aa">수량</span></td>
        	<td width="18%" bgcolor="#FFFFFF" height="19" align="center"><span class="aa">금액</span></td>
      	</tr>
      	<?
      	echo ("
			
      	<tr>
        	<td width='5%' bgcolor='#FFFFFF' height='18' align='center'>
        		<span class='aa'></span></td>
        	<td width='35%' bgcolor='#FFFFFF' height='18' align='center'>
        		<span class='aa'>$item_name</span></td>
        	<td width='14%' bgcolor='#FFFFFF' height='18' align='center'>
        		<span class='aa'>$current_price_str</span></td>
        	<td width='8%' bgcolor='#FFFFFF' height='18' align='center'>
        		<span class='aa'>$quantity</span></td>
        	<td width='18%' bgcolor='#FFFFFF' height='18' align='center'>
        		<span class='aa'>$mon_tot_str</span></td>
      	</tr>
      	");
      	if($mon_tot >= $union_freight_limit) 
			$freight_fee = 0;
		else $freight_fee = $union_freight_cost;
		
		$mon_tot_freight = $mon_tot + $freight_fee;
		?>	
      	<tr>
        	<td width="80%" bgcolor="#FFFFFF" height="9" align="center" colspan="5">
        		<span class="aa"><p align="right">배송비 : <?=number_format($freight_fee)?>원&nbsp; </span></td>
      	</tr>
    	</table>
	</td>
</tr>
<tr>
    <td width="100%" colspan="2" align='center'>
    	<br>
    	<br>
    	<input class="bb" onclick="window.print();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="프린트하기">&nbsp; 
    </td>
</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>