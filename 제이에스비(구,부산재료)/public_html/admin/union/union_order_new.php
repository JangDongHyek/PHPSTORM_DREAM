<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

if($update_flag == ''){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$icash_id = mysql_result($dbresult, 0, "icash_id");
	$telec_id = mysql_result($dbresult, 0, "telec_id");	
	$if_provider = mysql_result($dbresult, 0, "if_provider");
		
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$union_freight_limit  = $ary["union_freight_limit"];
		$union_freight_cost  = $ary["union_freight_cost"];
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
        	<td width="100%"><img src="../images/a6.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#B584C6"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><span class="bb"><br>
        		<small>▶</small> <font face="돋움">쇼핑몰의 <strong>공동구매 <br>
        		&nbsp; 상품 주문을 관리</strong>하실 수 <br>
        		&nbsp;&nbsp; 있습니다.<br>
        		<br>
        		</font></span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#B584C6" height="1"></td>
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
						조회기간을 따로이 입력하여 검색하실수도 있습니다.<br>
						주문관리는 일반출력과 디테일출력으로 구성되어 있습니다.<br><br>
						디테일출력은 주문건수가 많을때 주문을 한눈에 보실 수 있으며, <br>
						수정, 입금확인, 배송시작메일 등	을 일괄적으로 처리할 수 있습니다.
        		<br>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<p style="padding-left: 5px" align="center"><strong>
        		<br>
        		<span class="cc">
        		<a href='union_order_new.php'>[전체주문현황]</a>
        		<?
        		if($icash_id !='') echo "<a href='http://txdman.icash.co.kr' target='_new'>[ICASH 카드결제현황]</a>";
        		if($telec_id !='') echo "<a href='https://www.telec.co.kr/shopadmin/index.html' target='_new'>[TELEC 카드결제현황]</a>";
        		?>
        		</span></strong><br>
        		<br>
        		</td>
      	</tr>
      	<form action='union_order_new.php' id=form1 name=form1 method=post>
      	<input type=hidden name='flag' value='find'>
      	<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
      	<tr>
        	<td vAlign="top" width="100%" bgColor="#ffffff" height="3">
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
                        			<span class="bb"></span>
                        			<?
                        			echo "
                        			<a href='../to_excel/union_order_list.php?flag=$flag&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>
                        			<img src='../images/excel.gif' align='bottom' border='0' WIDTH='84' HEIGHT='18'>
                        			</a>
                        			";
                        			?></td>
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
        			<form action='union_order_new.php' method=post>
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
                  				
                  				<form action='union_order_new.php' method='post' onsubmit='return checkform(this)'>
                  				<input type='hidden' name='flag' value='search'>
                  				<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
                  				<tr>
                    				<td width="50%">&nbsp; 
                    					<!--<input class="aa" onclick="window.location.href='union_order_detail_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="디테일 출력">--> </td>
                    				<td width="50%">
                    					<p align="right"><span class="bb">
                    					<select class="aa" name="keyset" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
                      					<option value="name">이름</option>
                      					<option value="money_sender">입금자명</option>
                      					<option value="order_union_num">날짜</option>
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
              			
              			<form action='union_order_new.php' method='post'>
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
              			if($flag == "search")
				            	$SQL = "select * from $Union_Order_BuyTable where $keyset like '%$searchword%' and mart_id='$mart_id' order by substring(union_order_num,2,8) desc , substring(union_order_num,10) desc";
										else if($flag == 'find'){
				            	$SQL = "select * from $Union_Order_BuyTable 
				            	where mart_id='$mart_id' 
				            	and concat(substring(union_order_num,2,4),'-',substring(union_order_num,6,2),'-',substring(union_order_num,8,2))
				            	between concat(substring('$QryFromDate',1,4),'-',substring('$QryFromDate',6,2),'-',substring('$QryFromDate',9,2))
				            	and concat(substring('$QryToDate',1,4),'-',substring('$QryToDate',6,2),'-',substring('$QryToDate',9,2))
				            	order by substring(union_order_num,2,8) desc , substring(union_order_num,10)*1 desc";
				            }	
				            else	
											$SQL = "select * from $Union_Order_BuyTable 
											where mart_id='$mart_id' 
											order by substring(union_order_num,2,8) desc , substring(union_order_num,10)*1 desc";
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
											$union_order_num = $ary["union_order_num"];
											$paymethod = $ary["paymethod"];
											$date = $ary["date"];
											$status = $ary["status"];
											$card_paid = $ary["card_paid"];
											
											$j = $numRows - $i;
											$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
											
											if($paymethod == 'byonline') $paymethod_str = '온라인입금';
											if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
											if($paymethod == 'bytelec') {
												$paymethod_str = '신용카드(TELEC)';
												if($card_paid == 't') $paymethod_str = "신용카드(<font color='green'>성공</font>)";
												else $paymethod_str = "신용카드(<font color='red'>실패</font>)";
											}
											if($paymethod == 'byaccount') {
												if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
												else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
											}
											
											if($status == 0) $status_str = "신청";
											if($status == 1) $status_str = "주문";
											if($status == 5) $status_str = "주문취소";
											if($status == 2) $status_str = "입금확인";
											if($status == 6) $status_str = "배송중";
											if($status == 3) $status_str = "배송완료";
											if($status == 7) $status_str = "교환";
											if($status == 4) $status_str = "환불";
									
											$SQL1 = "select * from $Union_OrderTable where union_order_num = '$union_order_num' and mart_id='$mart_id'";
							          		//echo "sql=$SQL";
											$dbresult1 = mysql_query($SQL1, $dbconn);
											$numRows1 = mysql_num_rows($dbresult1);
											if ($numRows1 > 0){
												mysql_data_seek($dbresult1, 0);
												$ary1=mysql_fetch_array($dbresult1);
												$item_no = $ary1["item_no"];
												$item_name = $ary1["item_name"];
												$quantity = $ary1["quantity"];
												$type = $ary1["type"];
											}	
											
											if($type == 'slide'){		
												$SQL2 = "select * from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
												//echo "sql=$SQL";
												$dbresult2 = mysql_query($SQL2, $dbconn);
												$numRows2 = mysql_num_rows($dbresult2);
												if($numRows2 > 0){
													mysql_data_seek($dbresult2, 0);
													$ary2=mysql_fetch_array($dbresult2);
													$price_str = number_format($price);
													$number1_from = $ary2["number1_from"];
													$number1_to = $ary2["number1_to"];
													$number2_from = $ary2["number2_from"];
													$number2_to = $ary2["number2_to"];
													$number3_from = $ary2["number3_from"];
													
													$price1 = $ary2["price1"];
													$price1_str = number_format($price1);
													$price2 = $ary2["price2"];
													$price2_str = number_format($price2);
													$price3 = $ary2["price3"];
													$price3_str = number_format($price3);
													$current_num = $ary2["current_num"];
													$current_num_str = number_format($current_num);
													
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
											
												$SQL3 = "select * from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
												//echo "sql=$SQL";
												$dbresult3 = mysql_query($SQL3, $dbconn);
												$numRows3 = mysql_num_rows($dbresult3);
												if($numRows3 > 0){
													mysql_data_seek($dbresult3, 0);
													$ary3=mysql_fetch_array($dbresult3);
													$z_price = $ary3["z_price"];
													$z_price_str = number_format($z_price);
													
													$current_price = $z_price;
												}
											}
											
											$item_detail_head = $item_detail_body = $item_detail_tail ="";
											$item_detail_head = "
									<tr>
                		<td align='middle' width='98%' bgColor='#F3F3F3' colspan='6'>
                		<table border='0' width='100%'>
                  		<tr>
              				";
											$item_detail_body .= "<td width='50%'><span class='aa'><img src='../images/dot.gif' width='5' height='7'>$item_name : $quantity</span></td>";
											$item_detail_tail = "
											</tr>
		                </table>
		                </td>
		              </tr>
		              		";
		              		$item_detail_str = $item_detail_head.$item_detail_body.$item_detail_tail;
		              		
		              		$mon_tot = $quantity * $current_price;
											
											if($mon_tot >= $union_freight_limit) 
												$freight_fee = 0;
											else $freight_fee = $union_freight_cost;
											
											$mon_tot_freight = $mon_tot + $freight_fee;
											
											$mon_tot_freight_str = number_format($mon_tot_freight);
											
											echo "
										<tr>
                			<input type='hidden' name='union_order_num[]' value='$union_order_num'>
                			<td width='8%' bgcolor='#FFFFFF' align='center' rowspan='2'><span class='aa'>$j</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'>
                				<a href='union_order_detail.php?union_order_num=$union_order_num'>
                				<span class='aa'>$union_order_num</span></a></td>
                			<td width='20%' bgcolor='#FFFFFF' align='center'>
                				<span class='aa'>$name</span></td>
                			<td width='18%' bgcolor='#FFFFFF' align='center'>
                				<span class='aa'>$date_str</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'>
                				<span class='aa'>$mon_tot_freight_str 원</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'>
                			";
           	     			echo "<span class='bb'>
                			<select name='status[]' class='aa' style='height: 18px; background-color: rgb(193,219,227); border: 1px solid black' size='1'>
		                  <option value='1'";
		                  if($status == '1') echo " selected";
		                  echo ">주문</option>
		                  <option value='5'
		                  ";
		                  if($status == '5') echo " selected";
		                  echo ">주문취소</option>
		                  <option value='2'
		                  ";
		                  if($status == '2') echo " selected";
		                  echo ">입금확인/출고중</option>
		                  <option value='6'
		                  ";
		                  if($status == '6') echo " selected";
		                  echo ">배송중</option>
		                  <option value='3'
		                  ";
		                  if($status == '3') echo " selected";
		                  echo ">배송완료</option>
		                  <option value='7'
		                  ";
		                  if($status == '7') echo " selected";
		                  echo ">교환</option>
		                  <option value='4'
		                  ";
		                  if($status == '4') echo " selected";
		                  echo ">환불</option>
		                	</select></span>
                			";			
                			echo "</td>
                			<td width='18%' bgcolor='#FFFFFF' align='center'><span class='aa'>$paymethod_str</span></td>	
              			</tr>
              				$item_detail_str
              				";
              			}
              			?>
              			</table>
            		</td>
          		</tr>
        			<tr>
			        <td vAlign="top" width="100%" bgColor="#ffffff">
			        <span class="aa"><p align="right">　</span><span class="bb">
			        <input class="aa" style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="진행상태 저장"></span><span class="aa"></span></td>
			      </tr>
			      </form>
			      </table>
        		</center></div><p align="center">　</p>
        		</div>
        	</td>
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
        			<a href='union_order_new.php?page=1&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>처음</a> 
        			");
        		}
        	
        		if($start_page > 1){
					echo ("
					<a href='union_order_new.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>
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
					<a href='union_order_new.php?page=$i&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='union_order_new.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>
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
        			<a href='union_order_new.php?page=$total_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>끝</a> 
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
}
else if($update_flag=='update'){
	for($i=0; $i<count($union_order_num); $i++) {
		$SQL = "update $Union_Order_BuyTable set status='$status[$i]' where union_order_num='$union_order_num[$i]' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=union_order_new.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>";
}	
?>
<?
mysql_close($dbconn);
?>