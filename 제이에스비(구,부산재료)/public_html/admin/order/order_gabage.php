<?
include "../lib/Mall_Admin_Session.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	

/*SMS $SQL = "select * from $Sms_ConfigTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$sms_user = $ary["sms_user"];
	$sms_passwd = $ary["sms_passwd"];
	$mart_name = $ary["mart_name"];
  $callback_num1 = $ary["callback_num1"];
  $callback_num2 = $ary["callback_num2"];
  $callback_num3 = $ary["callback_num3"];
  $admin_num1 = $ary["admin_num1"];
  $admin_num2 = $ary["admin_num2"];
  $admin_num3 = $ary["admin_num3"];
  $if_money_chk_msg = $ary["if_money_chk_msg"];
  $money_chk_msg = $ary["money_chk_msg"];
  $if_product_send_msg = $ary["if_product_send_msg"];
  $product_send_msg = $ary["product_send_msg"];
  $if_order_cancel_msg = $ary["if_order_cancel_msg"];
  $order_cancel_msg = $ary["order_cancel_msg"];
  $if_order_cancel_msg_admin = $ary["if_order_cancel_msg_admin"];
  $order_cancel_msg_admin = $ary["order_cancel_msg_admin"];
}*/

if($update_flag == ''){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$icash_id = mysql_result($dbresult, 0, "icash_id");
	$telec_id = mysql_result($dbresult, 0, "telec_id");	
	$prepay_id = mysql_result($dbresult, 0, "prepay_id");	
	$allthegate_id = mysql_result($dbresult, 0, "allthegate_id");	
	$if_provider = mysql_result($dbresult, 0, "if_provider");
		
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows>0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$if_gnt_item = $ary["if_gnt_item"];
	}
	
	$today = date("Ymd");
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script>
function goTo(f){
	f.submit();
}
function go_today(){
	window.location.href='order_new.php?today=<?echo $today?>&flag=today';
}
function checkform(f){
	if(f.searchword.value==""){
		alert("검색어를 입력하세요.");
		f.searchword.focus();
		return false;
	}
	return true;
}

function fn_betdate(objname1, objname2, difvalue){	//'기준날짜를 기준으로 이후 날짜 가져오기
	obj1 = MM_findObj(objname1,document,form1);
	obj2 = MM_findObj(objname2,document,form1);
	var datD = new Date(<?echo date("Y")?>,<?echo date("m")?>-1,<?echo date("d")?>);
	var arrValue = new Array();
	obj2.value = fn_getdate(datD);
	arrValue = difvalue.split(":");
	if(arrValue[0] == "D"){
		datD.setDate(datD.getDate() - eval(arrValue[1]));
	}
	if(arrValue[0] == "M"){
		datD.setMonth(datD.getMonth() - eval(arrValue[1]));
	}
	obj1.value = fn_getdate(datD);
}
function fn_getdate(datArg){	//'현재 날자 가져오기
	var datD = datArg;
	var strTemp = "";
	strTemp = strTemp + datD.getYear() + "-";
	strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2) + "-";
	strTemp = strTemp + fn_numformat(datD.getDate(),2);
	return strTemp;
}
function fn_numformat(intNum, intLen){	//'글자수에 맞추어 0을 더한 숫자 생성
	var strNum = intNum + "";
	var strTemp = "";
	for(i = 0; i < (eval(intLen) - strNum.length); i++){
		strTemp = "0" + strTemp;
	}
	strTemp = strTemp + strNum;
	return strTemp;
}
function MM_findObj(n, d, f) { //'객체명 찾기
	var p,i,x;
	if(!d) d = document;
	if((p = n.indexOf("?"))>0 && parent.frames.length) {
		d = parent.frames[n.substring(p+1)].document;
		n = n.substring(0,p);
	}
	if(!(x = d[n]) && d.all) x = d.all[n];
	for (i = 0;!x && i<d.forms.length;i++) x = d.forms[i][n];
	for(i = 0;!x && d.layers && i<d.layers.length;i++) x = MM_findObj(n,d.layers[i].document);
	if(!x  &&  document.getElementById) x = document.getElementById(n); 
	if(f) x = d.form1[n];
	return x;
}
</script>
</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top">
    	<p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a4.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><span class="bb"><br>
        		<small>▶</small> <font face="돋움">쇼핑몰 <strong>주문현황 및 <br>
        		&nbsp;&nbsp; 배송정보</strong>를 관리하실 <br>
        		&nbsp;&nbsp;&nbsp; 수 있습니다.<br>
        		<small>▶</small> <a href='order_new.php'>주문관리</a>
        		</font><br>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#98A043" height="1"></td>
      	</tr>
    	</table>
    	
    	<p align="left"><br>
    	<br>
    </td>
    <td width="1" bgcolor="#808080"><br>
    </td>
    <td width="646" bgcolor="#FFFFFF" valign="top">
    	<div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
        		<p style="padding-left: 10px"><span class="aa">
        		주문번호를 클릭하시면 주문에 대한 상세내역과 수정가능한 페이지로 이동합니다.<br>
						주문검색은 오늘, 3일, 일주일 단위로 검색가능하며,
						조회기간을 따로이 입력하여 검색하실수도 있습니다.<br><br><br>
						</font>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<form action='order_gabage.php' id=form1 name=form1 method=post>
      	<input type=hidden name='flag' value='find'>
      	<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
      	<tr>
        	<td vAlign="top" width="100%" bgColor="#ffffff" height="3">
        	<br>
        		<div align="center"><center>
        			<table border="0" width="95%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td>
            			<table cellSpacing="0" cellPadding="0" width="100%" border="0">
              		<tr>
                		<td width="100%" bgColor="#cccccc">
                			<table cellSpacing="1" cellPadding="3" width="100%" border="0">
											<tr>
                    		<td width="100%" bgColor="#f7f7f7" height="20">
                    			<table cellSpacing="0" cellPadding="0" width="100%" border="0">
                      		<?
                      		if($QryFromDate == '') $QryFromDate = date("Y-m-d");
                      		if($QryToDate == '') $QryToDate = date("Y-m-d");
                      		?>
                      		<tr>
                        		<td width="13%">
                        			<span class="bb">&nbsp; 조회기간</span></td>
                        		<td width="37%">
                        			<input name="QryFromDate" value="<?echo $QryFromDate?>" class="bb" style="width: 67; border: 1px solid #6b6b6b" size="16"> 
                        			<font color="#3D918A"><span class="bb">~</span></font>
                        			<input name="QryToDate" value="<?echo $QryToDate?>" class="bb" style="width: 67; border: 1px solid #6b6b6b" size="16"></td>
                        		<td width="22%">
                        			<img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:0')" src="../images/ib_N0001.gif" align="bottom" border="0" WIDTH="28" HEIGHT="18"> 
                        			<img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:2')" src="../images/ib_N0002.gif" align="bottom" border="0" WIDTH="28" HEIGHT="18"> 
                        			<img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:6')" src="../images/ib_N0003.gif" align="bottom" border="0" WIDTH="32" HEIGHT="18"> <span class="bb"></span></td>
                        		<td width="28%">
                        			<span class="bb"></span>
                        			<input type='image' src="../images/ggo.gif" border="0" WIDTH="39" HEIGHT="18">
                        			<span class="bb"></span></td>
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
        			</form>
        			</table>
        			</center></div>
        			<table border="0" width="100%" height="10" cellspacing="0" cellpadding="0">
        			<tr>
        				<td width="100%"></td>
       				</tr>
        			<form action='order_new.php' method=post>
        			<input type=hidden name='flag' value='<?echo $flag?>'>
      				<input type='hidden' name='keyset' value='<?echo $keyset?>'>
        			<input type='hidden' name='searchword' value='<?echo $searchword?>'>
        			<input type=hidden name='QryFromDate' value='<?echo $QryFromDate?>'>
      				<input type=hidden name='QryToDate' value='<?echo $QryToDate?>'>
      				<input type=hidden name='page' value=''>
      				<tr>
        				<td width="100%"><p align="right"><br>
            			<select name="cnfPagecount" onchange="goTo(this.form)" class="aa" style="background-color: #FECB8E; border-left: 1px dotted rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0)" size="1">
            			<option value=""
            			<?
            			if($cnfPagecount == '') echo " selected";
            			?>
            			>정렬갯수</option>
            			<option value="10"
            			<?
            			if($cnfPagecount == '10') echo " selected";
            			?>
            			>10</option>
            			<option value="15"
            			<?
            			if($cnfPagecount == '15') echo " selected";
            			?>
            			>15</option>
            			<option value="20"
            			<?
            			if($cnfPagecount == '20') echo " selected";
            			?>
            			>20</option>
            			<option value="25"
            			<?
            			if($cnfPagecount == '25') echo " selected";
            			?>
            			>25</option>
            			<option value="30"
            			<?
            			if($cnfPagecount == '30') echo " selected";
            			?>
            			>30</option>
            			</select>&nbsp;&nbsp;&nbsp; </td>
       				</tr>
        			<tr>
        				<td width="100%"></td>
       				</tr>
        			</table>
      			</td>
   				</tr>
    			</form>
    			<tr>
        		<td width="100%" bgcolor="#FFFFFF" valign="top">
        			<div align="center"><div align="center"><center>
        		
        			<table border="0" width="95%">
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="7">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				
                  				<form action='order_gabage.php' method='post' onsubmit='return checkform(this)'>
                  				<input type='hidden' name='flag' value='search'>
                  				<input type='hidden' name='page' value=''>
                  				<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
                  				<tr>
                    				<td width="50%">&nbsp; 
                    					<span class='aa'>*날짜검색시 입력예: 20031212</span></td>
                    				<td width="50%">
                    					<p align="right"><span class="bb">
                    					<select class="aa" name="keyset" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
                      					<option value="name">이름</option>
                      					<option value="money_sender">입금자명</option>
                      					<option value="order_num">날짜</option>
                      					</select></span>
                    					<span class="aa">&nbsp; 
                    					<input name="searchword" size="13" style="border: 1px solid white" class="aa"> &nbsp; </span>
                    					<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="검색">&nbsp;&nbsp; 
                    				</td>
                  				</tr>
                  				</form>
                				
                				</table>
                			</td>
              			</tr>
              			<form name='list' action='order_gabage.php' method='post'>
              			<input type='hidden' name='update_flag' value='update'>
              			<input type='hidden' name='page' value='<?echo $page?>'>
              			<input type='hidden' name='keyset' value='<?echo $keyset?>'>
              			<input type='hidden' name='searchword' value='<?echo $searchword?>'>
              			<input type='hidden' name='flag' value='<?echo $flag?>'>
              			<input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
              			<input type='hidden' name='QryFromDate' value='<?echo $QryFromDate?>'>
              			<input type='hidden' name='QryToDate' value='<?echo $QryToDate?>'>
              			
              			<tr>
	                		<td width="8%" bgcolor="#FFFFFF" align="center"><span class="aa">번호</span></td>
	                		<td width="14%" bgcolor="#FFFFFF" align="center"><span class="aa">주문번호</span></td>
	                		<td width="20%" bgcolor="#FFFFFF" align="center"><span class="aa">이름</span></td>
	                		<td width="18%" bgcolor="#FFFFFF" align="center"><span class="aa">날짜</span></td>
	                		<td width="14%" bgcolor="#FFFFFF" align="center"><span class="aa">총결제액</span></td>
	                		<td width="14%" bgcolor="#FFFFFF" align="center"><span class="aa">진행상태</span></td>
	                		<td width="18%" bgcolor="#FFFFFF" align="center"><span class="aa">결제방법</span></td>
              			</tr>
              			<?
              			if($flag == "today")
              				$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status='9' and date like '%$today%' order by index_no desc";
										else if($flag == "search")
				    					if($keyset == 'name')
				    						$SQL = "select * from $Order_BuyTable 
				    						where mart_id='$mart_id' and status='9' and binary name like '%$searchword%' 
				    						order by index_no desc";
				    					else
				    						$SQL = "select * from $Order_BuyTable  
				    						where mart_id='$mart_id' and status='9' and binary $keyset like '%$searchword%' 
				    						order by index_no desc";
				    				else if($flag == 'find'){
				            	$SQL = "select * from $Order_BuyTable 
				            	where mart_id='$mart_id' and status='9'
				            	and concat(substring(date,1,4),'-',substring(date,5,2),'-',substring(date,7,2)) 
				            	between concat(substring('$QryFromDate',1,4),'-',substring('$QryFromDate',6,2),'-',substring('$QryFromDate',9,2))
				            	and concat(substring('$QryToDate',1,4),'-',substring('$QryToDate',6,2),'-',substring('$QryToDate',9,2))
				            	order by index_no desc";
				            }	
				            else	
											$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status='9' order by index_no desc";
										
										//echo "sql=$SQL";
										
										$dbresult = mysql_query($SQL, $dbconn);
										$numRows = mysql_num_rows($dbresult);
										if ($cnfPagecount == "") $cnfPagecount = 10;
										if ($page == "") $page = 1;
										$skipNum = ($page - 1) * $cnfPagecount;
										$total_page = ($numRows - 1)/$cnfPagecount;
										$total_page=intval($total_page)+1;	
										
										$prev_page = $page - 1;
										$next_page = $page + 1;
				
				
										for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {	
											if ($i >= $numRows) break;	
											mysql_data_seek($dbresult, $i);	
											$ary=mysql_fetch_array($dbresult);	
											$name = $ary["name"];
											$order_num = $ary["order_num"];
											
											$mon_tot = number_format($ary["mon_tot"]);
											$freight_fee = $ary["freight_fee"];
											$paymethod = $ary["paymethod"];
											$date = $ary["date"];
											$card_paid = $ary["card_paid"];
											
											if($paymethod == 'byonline') $paymethod_str = '온라인입금';
											if($paymethod == 'bycard') {
												if($card_paid == 't') $paymethod_str = "신용카드(<font color='green'>성공</font>)";
												else $paymethod_str = "신용카드(<font color='red'>실패</font>)";
											}
											if($paymethod == 'bytelec') {
												$paymethod_str = '신용카드';
												if($card_paid == 't') $paymethod_str = "신용카드(<font color='green'>성공</font>)";
												else $paymethod_str = "신용카드(<font color='red'>실패</font>)";
											}
											if($paymethod == 'by_dacom_card') {
												$paymethod_str = '신용카드';
												if($card_paid == 't') $paymethod_str = "신용카드(<font color='green'>성공</font>)";
												else $paymethod_str = "신용카드(<font color='red'>실패</font>)";
											}
											if($paymethod == 'byaccount') {
												if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
												else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
											}
											if($paymethod == 'by_telec_account') {
												if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
												else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
											}
											if($paymethod == 'by_allthegate_account') {
												if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
												else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
											}
											if($paymethod == 'byallthegate') {
												$paymethod_str = '신용카드';
											}
											if($paymethod == 'by_dacom_account') {
												if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
												else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
											}
											
											$status = $ary["status"];
											$j = $numRows - $i;
											$date = str_replace("-","",$date);
											$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);						
											if($status == 1) $status_str = "주문";
											if($status == 5) $status_str = "주문취소";
											if($status == 2) $status_str = "입금확인/<br>출고중";
											if($status == 6) $status_str = "배송중";
											if($status == 3) $status_str = "배송완료";
											if($status == 7) $status_str = "교환";
											if($status == 4) $status_str = "환불";
											
											
											$item_detail_head = "
									<tr>
                		<td align='middle' width='98%' bgColor='#F3F3F3' colspan='6'>
                		<table border='0' width='100%'>
                  		<tr>
              				";
											$item_detail_body = "";
											$item_detail_tail = "
											</tr>
		                </table>
		                </td>
		              </tr>";
											
											$SQL1 = "select * from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
											//echo "sql1=$SQL1";
											$dbresult1 = mysql_query($SQL1, $dbconn);
											$numRows1 = mysql_num_rows($dbresult1);
											$mon_tot = 0;
											for ($k=0; $k<$numRows1; $k++) {
												mysql_data_seek($dbresult1,$k);
												$ary1 = mysql_fetch_array($dbresult1);
												$order_pro_no = $ary1["order_pro_no"];
												$item_name = $ary1["item_name"]; 
												$item_code = $ary1["item_code"]; 
												$z_price = $ary1["z_price"];
												$bonus = $ary1["bonus"];
												$use_bonus = $ary1["use_bonus"];
												//$status = $ary1["status"];
												$quantity = $ary1["quantity"];
												$sum = $z_price*$quantity;
												
												$mon_tot += $sum; //합계금액
											
												if($item_code != '') $item_code_str = "($item_code)";
												else $item_code_str = "";
												$item_detail_body .= "<td width='50%'><span class='aa'><img src='../images/dot.gif' width='5' height='7'>$item_name$item_code_str : $quantity</span></td>";
												
												if($k%2 == 1) $item_detail_body .= "</tr><tr>";
											}
											$mon_tot_str = number_format($mon_tot);
											if($k > 0)
											$item_detail_str = $item_detail_head.$item_detail_body.$item_detail_tail;
											else $item_detail_str = $item_detail_head.$item_detail_tail;
											
											echo "
										<tr>
											<td width='8%' bgcolor='#FFFFFF' align='center'><span class='aa'>$j
                			</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'><a href='order_gabage_detail.php?order_num=$order_num'><span class='aa'>$order_num</span></a></td>
                			<td width='20%' bgcolor='#FFFFFF' align='center'><span class='aa'>$name</span></td>
                			<td width='18%' bgcolor='#FFFFFF' align='center'><span class='aa'>$date_str</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'><span class='aa'>$mon_tot_str 원</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'>
                			";
                			if($status == '9'){
	                			echo "
	                			<span class='bb'><font color='red'>삭제</font></span>
	                			";
                			}
                			echo ("
                			</td>
                			<td width='18%' bgcolor='#FFFFFF' align='center'><span class='aa'>$paymethod_str</span></td>
              			</tr>
              				");
              			}
              			?>
              			</table>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        		</div>
        	</td>
      	</tr>
      	
      
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff" height="20"><span class="aa"></span></td>
      </tr>
      	
      <?
		if($page % 10 == 0)
		$start_page = $page - 9;
		else
		$start_page = $page - ($page % 10) + 1;
		
		$end_page = $start_page + 9;
		if($end_page >= $total_page)
			$end_page = $total_page;
		$prev_start_page = $start_page - 10;
		$next_start_page = $start_page + 10;
		?>
		<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<p style="padding-right: 20px" align="right">
        		<span class="aa">
        		<?
        		if($page == 1){
        			echo ("
        			처음
        			");
        		}
        		else{
        			echo ("
        			<a href='order_gabage.php?page=1&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>처음</a> 
        			");
        		}
        	
        		if($start_page > 1){
					echo ("
					<a href='order_gabage.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>
					◁&nbsp; 
					</a>
					");
				}
				else{
					echo ("
					◁&nbsp; 
					");
				}
				for($i=$start_page;$i<=$end_page;$i++){
					if($i == $page){
						echo ("	
						[<b>$i</b>]
						");
					}
					else{
						echo ("
					<a href='order_gabage.php?page=$i&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='order_gabage.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>
					&nbsp;▷
					</a>
					");
				}
				else{
					echo ("
					&nbsp;▷
					");
				}
				if($page == $total_page){
        			echo ("
        			끝
        			");
        		}
        		else{
        			echo ("
        			<a href='order_gabage.php?page=$total_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>끝</a> 
        			");
        		}
        		?>
				
			</td>
      	</tr>
      	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>