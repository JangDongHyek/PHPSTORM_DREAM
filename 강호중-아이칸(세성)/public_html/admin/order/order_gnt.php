<?
include "../lib/Mall_Admin_Session.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$freight_limit = mysql_result($dbresult, 0, "freight_limit");
$freight_cost = mysql_result($dbresult, 0, "freight_cost");	
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	


if($update_flag == ''){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$icash_id = mysql_result($dbresult, 0, "icash_id");
	$telec_id = mysql_result($dbresult, 0, "telec_id");	
	$prepay_id = mysql_result($dbresult, 0, "prepay_id");	
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
function goTo1(f){
	f.flag.value = '';
	f.keyset.value = '';
	f.searchword.value = '';
	f.QryFromDate.value = '';
	f.QryToDate.value = '';
	f.page.value = '';
	f.submit();
}
function goTo(f){
	
	f.submit();
}
function go_today(){
	window.location.href='order_gnt.php?today=<?echo $today?>&flag=today';
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
function toggle(val) {
	dl = document.list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
}
function add_list_print(){
	dl = document.list;
	dl.update_flag.value='add_list_print'
	dl.submit();
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
						조회기간을 따로이 입력하여 검색하실수도 있습니다.<br>
						<strong>[GNT주문현황]</strong>
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
        		<a href='order_new.php'>[전체주문현황]</a>
        		<?
        		if($icash_id !='') echo "<a href='http://txdman.icash.co.kr' target='_new'>[ICASH 카드결제현황]</a>";
        		if($telec_id !='') echo "<a href='http://www.ebizpro.co.kr' target='_new'' target='_new'>[TELEC 카드결제현황]</a>";
        		if($prepay_id !='') echo "<a href='https://pg.pre-pay.co.kr:4002/login.htm' target='_new'>[PREPAY 카드결제현황]</a>";
        		?>
        		</span></strong><br>
        		<br>
        		</td>
      	</tr>
      	<form action='order_gnt.php' id=form1 name=form1 method=post>
      	<input type=hidden name='flag' value='find'>
      	<input type=hidden name='seller_id' value='<?echo $seller_id?>'>
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
                        		<td width="26%">
                        			<input name="QryFromDate" value="<?echo $QryFromDate?>" class="bb" style="width: 67; border: 1px solid #6b6b6b" size="16"> 
                        			<font color="#3D918A"><span class="bb">~</span></font>
                        			<input name="QryToDate" value="<?echo $QryToDate?>" class="bb" style="width: 67; border: 1px solid #6b6b6b" size="16"></td>
                        		<td width="33%">
                        			<img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:0')" src="../images/ib_N0001.gif" align="bottom" border="0" WIDTH="28" HEIGHT="18"> 
                        			<img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:2')" src="../images/ib_N0002.gif" align="bottom" border="0" WIDTH="28" HEIGHT="18"> 
                        			<img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:6')" src="../images/ib_N0003.gif" align="bottom" border="0" WIDTH="32" HEIGHT="18"> <span class="bb"></span></td>
                        	</tr>
                      		<tr>
		                        <td width="13%" height="10"></td>
		                        <td width="26%"></td>
		                        <td width="33%"></td>
		                      </tr>
		                      <tr>
		                        <td width="13%"><span class="bb">&nbsp; 진행처리</span></td>
		                        <td width="59%" colspan="2"><span class="bb">
		                        <select name="status_flag" class="aa" style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px" size="1">
		                        <option value=""
		                        <?
		                        if($status_flag == '') echo " selected";
					                  ?>
		                        >전체</option>
		                        <option value='2'
					                  <?
					                  if($status_flag == '2') echo " selected";
					                  ?>
					                  >주문</option>
					                  <option value='3'
					                  <?
					                  if($status_flag == '3') echo " selected";
					                  ?>
					                  >주문취소</option>
					                  <option value='4'
					                  <?
					                  if($status_flag == '4') echo " selected";
					                  ?>
					                  >입금확인</option>
					                  <option value='5'
					                  <?
					                  if($status_flag == '5') echo " selected";
					                  ?>
					                  >배송중</option>
					                  <option value='6'
					                  <?
					                  if($status_flag == '6') echo " selected";
					                  ?>
					                  >배송완료</option>
					                  <option value='7'
					                  <?
					                  if($status_flag == '7') echo " selected";
					                  ?>
					                  >교환</option>
					                	<option value='8'
					                  <?
					                  if($status_flag == '8') echo " selected";
					                  ?>
					                  >환불</option>
					                	</select></span>
		                        </select> 
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
		                        <input type='image' src="../images/ggo.gif" border="0" WIDTH="39" HEIGHT="18">
                      			<?
                      			echo "
                      			<a href='../to_excel/order_gnt_list.php?flag=$flag&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>
                      			<img src='../images/excel.gif' align='bottom' border='0' WIDTH='84' HEIGHT='18'>
                      			</a>
                      			";
                      			?>
                      			</td>
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
        			<form action='order_gnt.php' method=post>
        			<input type=hidden name='flag' value='<?echo $flag?>'>
      				<input type='hidden' name='keyset' value='<?echo $keyset?>'>
        			<input type='hidden' name='searchword' value='<?echo $searchword?>'>
        			<input type=hidden name='QryFromDate' value='<?echo $QryFromDate?>'>
      				<input type=hidden name='QryToDate' value='<?echo $QryToDate?>'>
      				<input type=hidden name='page' value=''>
      				<tr>
        				<td width="100%"><p align="right"><br>
            			<select name="seller_id" onchange="goTo1(this.form)" class="aa" style="background-color: #FECB8E; border-left: 1px dotted rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0)" size="1">
            			<option value="">전체판매상점</option>
            			<?
            			$SQL = "select mart_id from $MartMngInfoTable where provider_id ='$Mall_Admin_ID'";
									//echo "sql=$SQL";
									$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
									for($i=0;$i<$numRows;$i++){
										$seller_id_tmp = mysql_result($dbresult,$i,0); //공급받는 곳 mart_id
										echo "
									<option value='$seller_id_tmp'
            				";
            			if($seller_id == $seller_id_tmp) echo " selected";
            				echo "
            				>$seller_id_tmp</option>
            				";
									}
									?>
									</select>&nbsp;&nbsp;&nbsp; 
            			
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
                  				
                  				<form action='order_gnt.php' method='post' onsubmit='return checkform(this)'>
                  				<input type='hidden' name='flag' value='search'>
                  				<input type='hidden' name='seller_id' value='<?echo $seller_id?>'>
                  				<input type='hidden' name='page' value=''>
                  				<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
                  				<tr>
                    				<td width="50%">&nbsp; 
                    				<span class='aa'>*날짜검색시 입력예: 20031212</span></td>
                    				<td width="50%">
                    					<p align="right"><span class="bb">
                    					<select class="aa" name="keyset" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
                      					<option value="name">이름</option>
                      					<option value="order_num">날짜</option>
                      					<option value="item_name">상품명</option>
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
              			<form name='list' action='order_gnt.php' method='post'>
              			<input type='hidden' name='update_flag' value='update'>
              			<input type='hidden' name='seller_id' value='<?echo $seller_id?>'>
              			<input type='hidden' name='page' value='<?echo $page?>'>
              			<input type='hidden' name='keyset' value='<?echo $keyset?>'>
              			<input type='hidden' name='searchword' value='<?echo $searchword?>'>
              			<input type='hidden' name='flag' value='<?echo $flag?>'>
              			<input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
              			<input type='hidden' name='QryFromDate' value='<?echo $QryFromDate?>'>
              			<input type='hidden' name='QryToDate' value='<?echo $QryToDate?>'>
              			<input type='hidden' name='status_flag' value='<?echo $status_flag?>'>
              			
              			<tr>
	                		<td width="8%" bgcolor="#FFFFFF" align="center"><span class="aa">번호</span></td>
	                		<td width="14%" bgcolor="#FFFFFF" align="center"><span class="aa">주문번호</span></td>
	                		<td width="20%" bgcolor="#FFFFFF" align="center"><span class="aa">이름</span></td>
	                		<td width="18%" bgcolor="#FFFFFF" align="center"><span class="aa">날짜</span></td>
	                		<td width="14%" bgcolor="#FFFFFF" align="center"><span class="aa">총결제액</span></td>
	                		<td width="14%" bgcolor="#FFFFFF" align="center"><span class="aa">진행상태</span></td>
	                	</tr>
              			<?
              			if(!empty($status_flag)) {
              				$status_str_T2 = " and T2.status='$status_flag' ";
              				$status_str = " and status='$status_flag' ";
              			}
              			else {
              				$status_str_T2 = '';
              				$status_str = '';
              			}
              			if($seller_id == ''){
	              			if($flag == "today")
	              				$SQL = "select DISTINCT T1.order_num from $Order_BuyTable T1, $Order_ProTable T2 
	              				where T1.date like '%$today%' and 
	              				(T1.order_num = T2.order_num and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2) 
	              				order by T2.order_pro_no desc";
											else if($flag == "search")
					    					if($keyset == 'item_name')
					    						$SQL = "select DISTINCT order_num from $Order_ProTable where 
					    						(provider_id ='$Mall_Admin_ID' and status >= 2)
					    						and binary item_name like '%$searchword%' 
					    						order by order_pro_no desc";
					    					else if($keyset == 'name')
					    						$SQL = "select DISTINCT T1.date from $Order_BuyTable T1, $Order_ProTable T2  where 
					    						(T1.order_num = T2.order_num and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
					    						and binary T1.name like '%$searchword%' 
					    						order by T2.order_pro_no desc";
					    					else
					    						$SQL = "select DISTINCT T1.order_num from $Order_BuyTable T1, $Order_ProTable T2 where 
					    						(T1.order_num = T2.order_num and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
					    						and binary T1.$keyset like '%$searchword%' 
					    						order by T2.order_pro_no desc";
					    				else if($flag == 'find'){
					            	$SQL = "select DISTINCT T1.order_num from $Order_BuyTable T1, $Order_ProTable T2  where 
					    					(T1.order_num = T2.order_num and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
					            	and concat(substring(T1.date,1,4),'-',substring(T1.date,5,2),'-',substring(T1.date,7,2)) 
					            	between concat(substring('$QryFromDate',1,4),'-',substring('$QryFromDate',6,2),'-',substring('$QryFromDate',9,2))
					            	and concat(substring('$QryToDate',1,4),'-',substring('$QryToDate',6,2),'-',substring('$QryToDate',9,2))
					            	order by T2.order_pro_no desc";
					            }	
					            else	
												$SQL = "select distinct order_num from $Order_ProTable  where 
					    					provider_id ='$Mall_Admin_ID' and status >= 2 $status_str
												order by order_pro_no desc";
										}
										else{
											if($flag == "today")
	              				$SQL = "select DISTINCT T1.order_num from $Order_BuyTable T1, $Order_ProTable T2 
	              				where T1.date like '%$today%' and T1.mart_id = '$seller_id' and   
	              				(T1.order_num = T2.order_num and T2.mart_id = '$seller_id' and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2) 
	              				order by T2.order_pro_no desc";
											else if($flag == "search")
					    					if($keyset == 'item_name')
					    						$SQL = "select DISTINCT order_num from $Order_ProTable where 
					    						(mart_id='$seller_id' and provider_id ='$Mall_Admin_ID' and status >= 2 $status_str)
					    						and binary item_name like '%$searchword%' 
					    						order by order_pro_no desc";
					    					else if($keyset == 'name')
					    						$SQL = "select DISTINCT T1.order_num from $Order_BuyTable T1, $Order_ProTable T2  where 
					    						(T1.order_num = T2.order_num and T1.mart_id='$seller_id' and T2.mart_id='$seller_id' and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
					    						and binary T1.name like '%$searchword%' 
					    						order by T2.order_pro_no desc";
					    					else
					    						$SQL = "select DISTINCT T1.order_num from $Order_BuyTable T1, $Order_ProTable T2 where 
					    						(T1.order_num = T2.order_num and T1.mart_id='$seller_id' and T2.mart_id='$seller_id' and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
					    						and binary T1.$keyset like '%$searchword%' 
					    						order by T2.order_pro_no desc";
					    				else if($flag == 'find'){
					            	$SQL = "select DISTINCT T1.order_num from $Order_BuyTable T1, $Order_ProTable T2  where 
					    					(T1.order_num = T2.order_num and T1.mart_id='$seller_id' and T2.mart_id='$seller_id' and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
					            	and concat(substring(T1.date,1,4),'-',substring(T1.date,5,2),'-',substring(T1.date,7,2)) 
					            	between concat(substring('$QryFromDate',1,4),'-',substring('$QryFromDate',6,2),'-',substring('$QryFromDate',9,2))
					            	and concat(substring('$QryToDate',1,4),'-',substring('$QryToDate',6,2),'-',substring('$QryToDate',9,2))
					            	order by T2.order_pro_no desc";
					            }	
					            else	
												$SQL = "select distinct order_num from $Order_ProTable where 
					    					mart_id='$seller_id' and provider_id ='$Mall_Admin_ID' and status >= 2 $status_str
												order by order_pro_no desc";
										}
										//if($REMOTE_ADDR == '210.220.110.64') echo "sql=$SQL";
										
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
											$order_num = mysql_result($dbresult,$i,0);	
											
											$SQL1 = "select name,freight_fee,date from $Order_BuyTable where order_num = '$order_num'";
											//echo "sql1=$SQL1";
											$dbresult1 = mysql_query($SQL1, $dbconn);
											$name = mysql_result($dbresult1,0,0);
											$freight_fee = mysql_result($dbresult1,0,1);
											$date = mysql_result($dbresult1,0,2);
											
											
											
											$j = $numRows - $i;
											$date = str_replace("-","",$date);
											$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);						
											
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
											
											$SQL1 = "select item_name,item_code,provide_price,status,quantity,send_date,mart_id from $Order_ProTable where order_num = '$order_num' and provider_id='$Mall_Admin_ID'";
											//echo "sql1=$SQL1";
											$dbresult1 = mysql_query($SQL1, $dbconn);
											$numRows1 = mysql_num_rows($dbresult1);
											$mon_tot = 0;
											for ($k=0; $k<$numRows1; $k++) {
												
												$item_name = mysql_result($dbresult1,$k,0);
												$item_code = mysql_result($dbresult1,$k,1);
												$provide_price = mysql_result($dbresult1,$k,2);
												$status_temp = mysql_result($dbresult1,$k,3);
												$quantity = mysql_result($dbresult1,$k,4);
												$sum = $provide_price*$quantity;
												$send_date = mysql_result($dbresult1,$k,5);
												$mart_id_tmp = mysql_result($dbresult1,$k,6);
												
												$mon_tot += $sum; //합계금액
											
												if($item_code != '') $item_code_str = "($item_code)";
												else $item_code_str = "";
												$item_detail_body .= "<td width='50%'><span class='aa'><img src='../images/dot.gif' width='5' height='7'>$item_name$item_code_str : $quantity</span></td>";
												
												if($k%2 == 1) $item_detail_body .= "</tr><tr>";
											}
											
											$mon_tot_str = number_format($mon_tot + $freight_cost);
											if($k > 0)
											$item_detail_str = $item_detail_head.$item_detail_body.$item_detail_tail;
											else $item_detail_str = "";
											
											echo "
										<tr>
                			<input type='hidden' name='order_num[]' value='$order_num'>
                			<input type='hidden' name='status_old[]' value='$status_temp'>
                			<td width='8%' bgcolor='#FFFFFF' align='center' rowspan='2'><span class='aa'>$j
                			<input type='checkbox' name='checkSel[]' value='$order_num'></span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'><a href='order_detail_gnt.php?order_num=$order_num&seller_id=$seller_id'><span class='aa'>$order_num($mart_id_tmp)</span></a></td>
                			<td width='20%' bgcolor='#FFFFFF' align='center'><span class='aa'>$name</span></td>
                			<td width='18%' bgcolor='#FFFFFF' align='center'><span class='aa'>$date_str</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'><span class='aa'>$mon_tot_str 원</span></td>
                			<td width='14%' bgcolor='#FFFFFF' align='center'>
                			";
                			echo "
                			<span class='bb'>
                			<select name='status[]' class='aa' style='height: 18px; background-color: rgb(193,219,227); border: 1px solid black' size='1'>
		                  <option value='2'
		                  ";
		                  if($status_temp == '2') echo " selected";
		                  echo ">주문</option>
		                  <option value='3'
		                  ";
		                  if($status_temp == '3') echo " selected";
		                  echo ">주문취소</option>
		                  <option value='4'
		                  ";
		                  if($status_temp == '4') echo " selected";
		                  echo ">입금확인</option>
		                  <option value='5'
		                  ";
		                  if($status_temp == '5') echo " selected";
		                  echo ">배송중</option>
		                  <option value='6'
		                  ";
		                  if($status_temp == '6') echo " selected";
		                  echo ">배송완료</option>
		                  <option value='7'
		                  ";
		                  if($status_temp == '7') echo " selected";
		                  echo ">교환</option>
		                	<option value='8'
		                  ";
		                  if($status_temp == '8') echo " selected";
		                  echo ">환불</option>
		                	</select></span>
                			";
                			echo "
                			</td>
                		</tr>
              				$item_detail_str
              				";
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
        <td vAlign="top" width="100%" bgColor="#ffffff">
        <span class="aa"><p align="right">　</span><span class="bb">
        <input class="aa" style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="진행상태 저장">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span class="aa"></span></td>
      </tr>
      </form>
      <tr>
        <td width="100%" height="10"><div align="center"><center><table border="0" width="95%"
        cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" height="10"></td>
          </tr>
          <tr>
            <td width="100%" bgColor="#7bbebd"><table cellSpacing="1" cellPadding="3" width="100%" border="0">
              <tr>
                <td width="100%" bgColor="#e9f5f5" height="30"><table width="100%" border="0">
                  <tr>
                    <td width="100%">
                    <input onclick="javascript:toggle(1)" class="aa" style="BORDER-RIGHT: #3d918a 1px solid; BORDER-TOP: #3d918a 1px solid; BORDER-LEFT: #3d918a 1px solid; COLOR: #3d918a; BORDER-BOTTOM: #3d918a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="전체선택"> 
                    <input onclick="javascript:toggle(0)" class="aa" style="BORDER-RIGHT: #3d918a 1px solid; BORDER-TOP: #3d918a 1px solid; BORDER-LEFT: #3d918a 1px solid; COLOR: #3d918a; BORDER-BOTTOM: #3d918a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="선택해제">
                    &nbsp; &nbsp;<span class="bb">
                    <font color="#3d918a">선택한 주문을</font> </span>
                    <input onclick="add_list_print()" class="aa" style="BORDER-RIGHT: #3d918a 1px solid; BORDER-TOP: #3d918a 1px solid; BORDER-LEFT: #3d918a 1px solid; COLOR: #3d918a; BORDER-BOTTOM: #3d918a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="주소출력">&nbsp; </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td width="100%"></td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#FFFFFF" height="20"><span class="aa"></span></td>
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
        			<a href='order_gnt.php?page=1&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>처음</a> 
        			");
        		}
        	
        		if($start_page > 1){
					echo ("
					<a href='order_gnt.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>
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
					<a href='order_gnt.php?page=$i&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='order_gnt.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>
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
        			<a href='order_gnt.php?page=$total_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>끝</a> 
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
else if($update_flag == 'add_list_print'){
	$order_num_list = '';
	for($k=0; $k<count($checkSel); $k++) {
		if($k+1 < count($checkSel))
			$order_num_list .= $checkSel[$k].'|';
		else
			$order_num_list .= $checkSel[$k];
	}
	echo "
	<script>
	window.open( 'add_list_print.php?order_num_list=$order_num_list', '','toolbar=no,width=610,height=300,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');
	</script>
	";
	
	echo "<meta http-equiv='refresh' content='0; URL=order_gnt.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>";
}
else if($update_flag=='update'){
	
	for($i=0; $i<count($order_num); $i++) {
		$SQL = "update $Order_ProTable set status='$status[$i]' where order_num='$order_num[$i]' and provider_id='$Mall_Admin_ID'";
		$dbresult = mysql_query($SQL, $dbconn);
		if($status_old[$i] != '6'&& $status[$i] == '6'){
			$send_date = date("Y-m-d H:i:s");
			$SQL = "update $Order_ProTable set send_date='$send_date' where order_num='$order_num[$i]' and provider_id='$Mall_Admin_ID'";
			$dbresult = mysql_query($SQL, $dbconn);
		}
		if($status_old[$i] == '6'&& $status[$i] != '6'){
			$SQL = "update $Order_ProTable set send_date='' where order_num='$order_num[$i]' and provider_id='$Mall_Admin_ID'";
			$dbresult = mysql_query($SQL, $dbconn);
		}	
	}
	
	echo "<meta http-equiv='refresh' content='0; URL=order_gnt.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&seller_id=$seller_id&status_flag=$status_flag'>";
}	
?>
<?
mysql_close($dbconn);
?>