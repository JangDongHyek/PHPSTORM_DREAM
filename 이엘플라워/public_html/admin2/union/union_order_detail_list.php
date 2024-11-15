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

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$freight_limit = mysql_result($dbresult, 0, "freight_limit");
$freight_cost = mysql_result($dbresult, 0, "freight_cost");	
$union_freight_limit = mysql_result($dbresult, 0, "union_freight_limit");
$union_freight_cost = mysql_result($dbresult, 0, "union_freight_cost");	
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	

$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_provider = $ary["if_provider"];
	$if_seller = $ary["if_seller"];
}

if($update_flag == ''){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$icash_id = mysql_result($dbresult, 0, "icash_id");
	$telec_id = mysql_result($dbresult, 0, "telec_id");	
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
//function go_today(){
//	window.location.href='order.php?today=20030416&flag=today';
//}
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
      if (dl.elements[i].name == 'union_order_num[]')
        dl.elements[i].checked = val;
    }
}
function money_ok_mail(){
	dl = document.list;
	dl.update_flag.value='money_ok';
	dl.submit();
}
function send_ok_mail(){
	dl = document.list;
	dl.update_flag.value='send_ok';
	dl.submit();
}
function delete_confirm(){
	if(confirm("\n정말로 삭제하시겟습니까?\n\n삭제하시면 현주문과 관련된 데이타가\n\n삭제되며 복구는 되지않습니다.")){
		dl = document.list;
		dl.update_flag.value='delete'
		dl.submit();
	}
	return false;
}
</script>
<script>
function printWin(){ 
	window.open('', 'printWin', 'width=650,height=500,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
	dl = document.list;
	dl.action='union_order_print_list.php'
	dl.target='printWin'
	dl.submit();
}	
</script>
<script>
function receipt_win(mart_id){
	window.open('',"receipt","width=590,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
	dl = document.list;
	dl.action='../../market/receipt/union_receipt_list.php?mart_id='+mart_id
	dl.target='receipt'
	dl.submit();
}
</script>

</head>
<body bgColor="#ffffff" leftMargin="0" topMargin="0">

<table height="100%" cellSpacing="0" cellPadding="0" width="780" border="0">
<tbody>
  <tr>
    <td vAlign="top" width="106"><p align="left"><br>
    <br>
    <br>
    </p>
    <table cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr>
        <td width="100%"><img src="../images/a6.gif" WIDTH="160" HEIGHT="36"></td>
      </tr>
      <tr>
        <td width="100%" bgColor="#98a043" height="1"></td>
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
        <td width="100%" bgColor="#98a043" height="1"></td>
      </tr>
    </table>
    <p align="left"><br>
    <br>
    </td>
    <td width="1" bgColor="#808080"><br>
    </td>
    <td vAlign="top" width="646" bgColor="#ffffff"><div align="center"><center>
    <table cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr>
        <td vAlign="top" width="90%" bgColor="#ffffff"><br>
        <p style="PADDING-LEFT: 10px"><span class="aa">주문번호를 클릭하시면 주문에 
        대한 상세내역을 확인하실 수있는 페이지로 이동합니다.<br>
        디테일 출력의 경우는 공급업체 정보를 제외한 모든 정보를 한 눈에 
        보실 수 있으며,<br>
        각각 주문의 내용 수정시, 체크박스에 먼저 체크를 한 후 수정, 또는 
        해당버튼을 클릭하시면<br>
        일괄적으로 모두 실행됩니다.<br>
        <br>
        </span></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#808080" height="1"></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff" height="3"><p align="center"><strong><span class="cc"><br>
        <a href="union_order_detail_list.php">[전체주문현황]</a> 
    		<?
    		if($icash_id !='') echo "<a href='http://txdman.icash.co.kr' target='_new'>[ICASH 카드결제현황]</a>";
    		if($telec_id !='') echo "<a href='https://www.telec.co.kr/shopadmin/index.html' target='_new'>[TELEC 카드결제현황]</a>";
    		?>
        <br>
        </span></strong><br>
        </td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff" height="3"><div align="center"><center>
        <table border="0" width="95%" cellspacing="0" cellpadding="0">
     		<form id=form1 name=form1 method=post>
      	<input type=hidden name='flag' value='find'>
      	<input type=hidden name='page' value=''>
      	<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
      	<tr>
          <td><table cellSpacing="0" cellPadding="0" width="100%" border="0">
            <tr>
              <td width="100%" bgColor="#cccccc"><table cellSpacing="1" cellPadding="3" width="100%" border="0">
                <tr>
                  <td width="100%" bgColor="#f7f7f7" height="20">
                  	<table cellSpacing="0" cellPadding="0" width="100%" border="0">
                    <?
                		if($QryFromDate == '') $QryFromDate = date("Y-m-d");
                		if($QryToDate == '') $QryToDate = date("Y-m-d");
                		?>
                   	<tr>
                      <td width="13%"><span class="bb">&nbsp; 조회기간</span></td>
                      <td width="37%">
                      <input name="QryFromDate" value="<?echo $QryFromDate?>" class="bb" style="width: 67; border: 1px solid #6b6b6b" size="16"> 
                      <font color="#3D918A"><span class="bb">~</span></font><font color="#3d918a"> </font>
                      <input name="QryToDate" value="<?echo $QryToDate?>" class="bb" style="width: 67; border: 1px solid #6b6b6b" size="16"></td>
                      <td width="22%">
                      <img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:0')" src="../images/ib_N0001.gif" align="bottom" border="0" WIDTH="28" HEIGHT="18"> 
                      <img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:2')" src="../images/ib_N0002.gif" align="bottom" border="0" WIDTH="28" HEIGHT="18"> 
                      <img onclick="javascript:fn_betdate('QryFromDate', 'QryToDate', 'D:6')" src="../images/ib_N0003.gif" align="bottom" border="0" WIDTH="32" HEIGHT="18"> 
                      <span class="bb"></span></td>
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
        </center></div><table border="0" width="100%" height="10" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%"></td>
          </tr>
          <tr>
            <td width="100%"></td>
          </tr>
          <form method=post>
  			<input type=hidden name='flag' value='<?echo $flag?>'>
				<input type=hidden name='QryFromDate' value='<?echo $QryFromDate?>'>
      	<input type=hidden name='QryToDate' value='<?echo $QryToDate?>'>
      	<input type='hidden' name='keyset' value='<?echo $keyset?>'>
  			<input type='hidden' name='searchword' value='<?echo $searchword?>'>
  			<input type='hidden' name='page' value=''>
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
        </form>
          <tr>
            <td width="100%"><div align="center"><center><table border="0" width="95%">
              <tr>
                <td><table cellSpacing="0" cellPadding="0" width="100%" border="0">
                  <tr>
                    <td width="100%" bgColor="#7C6D61">
                    <table cellSpacing="1" cellPadding="3" width="100%" border="0">
                    	<tr>
                      <td width="100%" bgColor="#D0CDBC" height="20">
                      <table border="0" width="100%">
	                      <tr>
	                      <td width="100%"><span class="cc">
	                      <input onclick="javascript:toggle(1)" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="전체선택"></span>
	                      <span class="aa"> </span><strong><span class="cc">
	                      <input onclick="javascript:toggle(0)" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="선택해제"></span>
	                      <span class="dd">하여</span></strong></td>
	                      </tr>
	                      <tr>
	                      <td width="100%" height="8"><span class="cc"><strong></strong></span></td>
	                      </tr>
	                      <tr>
	                      <td width="100%"><strong><span class="dd"><p align="right"></span><span class="cc">
	                      <input onclick="document.list.submit()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="수정"></span></strong> <strong><span class="cc">
	                      <input onclick="document.list.reset()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="재입력"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="javascript:money_ok_mail()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="입금확인메일"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="javascript:send_ok_mail()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="배송시작메일"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="javascript:printWin()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="프린트"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="receipt_win('<?echo $Mall_Admin_ID?>')" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="영수증 출력"> 
	                      <input onclick="delete_confirm()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="삭제"></span>
	                      <span class="dd"></span></strong></td>
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
              <tr>
                <td width="100%"></td>
              </tr>
            </table>
            </center></div></td>
          </tr>
        </table>
        </td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center>
        <table width="95%" border="0">
          <tr>
            <td width="90%" bgColor="#999999">
            <table cellSpacing="1" cellPadding="3" width="100%" border="0">
              <tr>
                <td width="100%" bgColor="#7C6D61" colSpan="4">
                <table cellSpacing="0" cellPadding="0" width="100%" border="0">
                
                <form method='post' onsubmit='return checkform(this)'>
        				<input type='hidden' name='flag' value='search'>
        				<input type='hidden' name='page' value=''>
        				<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
      	
        				<tr>
                  <td width="126">
                  	<span class="bb">
                  	<input class="aa" onclick="window.location.href='union_order_new.php'" style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="button" value="일반 출력"></span></td>
                  <td width="424">
                  	<p align="right"><span class="bb">
                  	<select class="aa" style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px" size="1" name="keyset">
                    <option value="name" selected>이름</option>
                    <option value="money_sender">입금자명</option>
                    <option value="order_num">날짜</option>
                  	</select></span> <span class="aa">&nbsp; 
                  	<input class="aa" style="BORDER-RIGHT: white 1px solid; BORDER-TOP: white 1px solid; BORDER-LEFT: white 1px solid; BORDER-BOTTOM: white 1px solid" size="13" name="searchword"> &nbsp; </span>
                  	<span class="bb">
                  	<input class="aa" style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"></span>
                  </td>
                </tr>
                </form>
              	</table>
                </td>
              </tr>
              <form method='post' name='list'>
	            <input type='hidden' name='update_flag' value='update'>
	            <input type=hidden name='flag' value='<?echo $flag?>'>
							<input type=hidden name='QryFromDate' value='<?echo $QryFromDate?>'>
			      	<input type=hidden name='QryToDate' value='<?echo $QryToDate?>'>
	      			<input type=hidden name='page' value='<?echo $page?>'>
	      			<input type=hidden name='keyset' value='<?echo $keyset?>'>
	      			<input type=hidden name='searchword' value='<?echo $searchword?>'>
	      			<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
              
              <?
	      			if($flag == "search")
	    					$SQL = "select * from $Union_Order_BuyTable where $keyset like '%$searchword%' and mart_id='$mart_id' order by substring(union_order_num,2,8) desc , substring(union_order_num,10)*1 desc";
	            else if($flag == 'find'){
	            	$SQL = "select * from $Union_Order_BuyTable where 
	            	concat(substring(union_order_num,2,4),'-',substring(union_order_num,6,2),'-',substring(union_order_num,8,2)) 
	            	between concat(substring('$QryFromDate',1,4),'-',substring('$QryFromDate',6,2),'-',substring('$QryFromDate',9,2))
	            	and concat(substring('$QryToDate',1,4),'-',substring('$QryToDate',6,2),'-',substring('$QryToDate',9,2))
	            	and mart_id='$mart_id' order by substring(union_order_num,2,8) desc , substring(union_order_num,10)*1 desc";
	            }	
	            else	
								$SQL = "select * from $Union_Order_BuyTable where mart_id='$mart_id' order by substring(union_order_num,2,8) desc , substring(union_order_num,10)*1 desc";
							
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
	
							$count = 0;
							for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {	
								if ($i >= $numRows) break;	
								mysql_data_seek($dbresult, $i);	
								$ary=mysql_fetch_array($dbresult);	
								$union_order_num = $ary["union_order_num"];
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
								$resd = $ary["resd"];
								$address = $ary["address"];
								$address_d = $ary["address_d"];
								$message = $ary["message"];
								$paymethod = $ary["paymethod"];
								$account_no = $ary["account_no"];
								$freight_code = $ary["freight_code"];
								$status = $ary["status"];
								$date = $ary["date"];
								$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2)."/".substr($date,8);
								$pay_day = $ary["pay_day"];
								$money_sender = $ary["money_sender"];
								
								$number = $i+1;
								if($paymethod == 'byonline') $paymethod_str = '온라인입금';
								if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
								if($paymethod == 'bytelec') $paymethod_str = '신용카드(TELEC)';
								if($paymethod == 'byaccount') $paymethod_str = '계좌이체(TELEC)';
								
								if($account_no != 0){
									$SQL0 = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
									$dbresult0 = mysql_query($SQL0, $dbconn);
									mysql_data_seek($dbresult0,0);
									$ary0 = mysql_fetch_array($dbresult0);
									$account_no = $ary0["account_no"];
									$bank_name = $ary0["bank_name"];
									$bank_number = $ary0["bank_number"];
									$owner_name = $ary0["owner_name"];
								}
								echo "
							<tr>
                <td align='middle' width='75%' bgColor='#B6AE90' colspan='4'>
                <p align='left'>
                <input type='checkbox' name='union_order_num[]' value='$union_order_num|$count'>
                <span class='bb'><strong> $number. [<a href='union_order_detail.php?union_order_num=$union_order_num'>주문번호 $union_order_num</a> | $name($id)님의 주문내역]&nbsp; </strong></span></td>
              </tr>
              <tr>
                <td align='middle' width='75%' bgColor='#8fbecd' colSpan='4'>
                <table cellSpacing='0' cellPadding='0' width='100%' border='0'>
                  <tr>
                    <td width='50%'>&nbsp; <strong><span class='dd'>주문자 정보 </span></strong></td>
                    <td width='50%'></td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <td align='middle' width='75%' bgColor='#ffffff' colspan='4'></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>이름</span></td>
                <td align='left' width='29%' bgColor='#ffffff'><span class='aa'>
                <input name='name[]' value='$name' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>이메일</span></td>
                <td align='left' width='22%' bgColor='#ffffff'><span class='aa'>
                <input name='email[]' value='$email' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>전화</span></td>
                <td align='left' width='29%' bgColor='#ffffff'><span class='aa'>
                <input name='tel[]' value='$tel' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>핸드폰</span></td>
                <td align='left' width='22%' bgColor='#ffffff'><span class='aa'>
                <input name='tel1[]' value='$tel1' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>입금자명</span></td>
                <td align='left' width='29%' bgColor='#ffffff'><span class='aa'>
                <input name='money_sender[]' value='$money_sender' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>입금예정일</span></td>
                <td align='left' width='22%' bgColor='#ffffff'><span class='aa'>
                <input name='pay_day[]' value='$pay_day' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>주문일시</span></td>
                <td align='middle' width='29%' bgColor='#ffffff'><span class='aa'>
                <p align='left'>$date_str</span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'></span></td>
                <td align='left' width='22%' bgColor='#ffffff'><span class='aa'>
                </span></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>메모</span></td>
                <td align='middle' width='63%' bgColor='#ffffff' colSpan='3'><span class='aa'><p align='left'>
                <textarea name='message[]' class='aa' style='BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid' rows='6' cols='51'>$message</textarea></span></td>
              </tr>
              <tr>
                <td align='middle' width='75%' bgColor='#8fbecd' colSpan='4'>
                <table cellSpacing='0' cellPadding='0' width='100%' border='0'>
                  <tr>
                    <td width='50%'>&nbsp; <strong><span class='dd'>수신자 정보 </span></strong></td>
                    <td width='50%'></td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>이름</span></td>
                <td align='left' width='29%' bgColor='#ffffff'><span class='aa'>
                <input name='receiver[]' value='$receiver' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>전화</span></td>
                <td align='left' width='22%' bgColor='#ffffff'><span class='aa'>
                <input name='rev_tel[]' value='$rev_tel' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>우편번호</span></td>
                <td align='left' width='29%' bgColor='#ffffff'><span class='aa'>
                <input name='zip[]' value='$zip' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>기타연락처</span></td>
                <td align='left' width='22%' bgColor='#ffffff'><span class='aa'>
                <input name='rev_tel1[]' value='$rev_tel1' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'> </span></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>주소</span></td>
                <td align='left' width='63%' bgColor='#ffffff' colSpan='3'>
                <input name='address[]' value='$address' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='50'> </td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>상세주소</span></td>
                <td align='left' width='63%' bgColor='#ffffff' colSpan='3'>
                <input name='address_d[]' value='$address_d' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='50'> </td>
              </tr>
              <tr>
                <td align='middle' width='75%' bgColor='#8fbecd' colSpan='4'>
                <table cellSpacing='0' cellPadding='0' width='100%' border='0'>
                  <tr>
                    <td width='100%'>&nbsp; <strong><span class='dd'>결제 정보 </span></strong></td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>결제방법</span></td>
                <td align='middle' width='29%' bgColor='#ffffff'>
                <p align='left'><span class='aa'>$paymethod_str</span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>계좌정보</span></td>
                <td align='middle' width='22%' bgColor='#ffffff'><p align='left'><span class='aa'>
                $bank_name $bank_number</span></td>
              </tr>
              <tr>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>송장번호</span></td>
                <td align='middle' width='29%' bgColor='#ffffff'><span class='aa'><p align='left'>
                <input name='freight_code[]' value='$freight_code' class='aa' style='BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid' size='18'></span></td>
                <td align='middle' width='12%' bgColor='#ffffff'>
                <span class='aa'>진행처리</span></td>
                <td align='middle' width='22%' bgColor='#ffffff'>
                <p align='left'><span class='bb'>
                <select name='status[]' class='aa' style='BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px' size='1'>
                ";
                echo "<option value='0'";
                if($status == 0) echo " selected";
        				echo ">신청</option>
        				<option value='1'";
        				if($status == 1) echo " selected";
        				echo ">주문</option>
        				<option value='5'";
        				if($status == 5) echo " selected";
        				echo ">주문취소</option>
      					<option value='2'";
        				if($status == 2) echo " selected";
        				echo ">입금확인</option>
        				<option value='6'";
        				if($status == 6) echo " selected";
        				echo ">배송중</option>
        				<option value='3'";
        				if($status == 3) echo " selected";
        				echo ">배송완료</option>
        				<option value='7'";
        				if($status == 7) echo " selected";
        				echo ">교환</option>
        				<option value='4'";
        				if($status == 4) echo " selected";
        				echo "
        				>환불</option>
                </span> </td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td width='100%' bgColor='#999999'>
            <table cellSpacing='1' cellPadding='3' width='100%' border='0'>
              <tr>
                <td width='100%' bgColor='#8fbecd' colSpan='4'>
                <table cellSpacing='0' cellPadding='0' width='100%' border='0'>
                  <tr>
                    <td width='100%'>&nbsp; <strong><span class='dd'>주문 내역</span></strong></td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <td align='middle' width='35%' bgColor='#ffffff'><span class='aa'>상품명(사이버머니)</span></td>
                <td align='middle' width='15%' bgColor='#ffffff'><span class='aa'>수량</span></td>
                <td align='middle' width='25%' bgColor='#ffffff'><span class='aa'>가격</span></td>
                <td align='middle' width='25%' bgColor='#ffffff'><span class='aa'>합계</span></td>
              </tr>
              	";
              	$SQL1 = "select * from $Union_OrderTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
								//echo "sql=$SQL";
								$dbresult1 = mysql_query($SQL1, $dbconn);
								$numRows1 = mysql_num_rows($dbresult1);
								if($numRows1 > 0){
									mysql_data_seek($dbresult1,0);
									$ary1 = mysql_fetch_array($dbresult1);
									$item_no = $ary1["item_no"];
									$item_name = $ary1["item_name"];
									$quantity = $ary1["quantity"];
									$status  = $ary1["status"];
									$type = $ary1["type"];
									$opt = $ary1["opt"];
									if($type == 'limit'){
										$current_price = Get_Limit_Price($item_no, $Mall_Admin_ID);
									}
									if($type == 'slide'){
										$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
									}
								}
								$current_price_str = number_format($current_price);
								$mon_tot = $current_price * $quantity;
								$mon_tot_str = number_format($mon_tot);	
              	echo "
							<tr>
          			<td width='35%' bgcolor='#FFFFFF'><span class='aa'>$item_name
                ";	
                if(isset($opt)&&$opt!=""&&$opt!="!!"){
				        	echo "	
				        	<br>
				          		<img src='../images/optionbar.gif'>옵션:
				          ";
				          $opts = explode("!", $opt);
			        		if($opts[1] != "")
			        			echo "$opts[1]&nbsp;";
			        		if($opts[2] != "")
			        			echo "$opts[2]";
					    	}
              	echo "
						    </span></td>
          			<td width='15%' bgcolor='#FFFFFF'><p align='center'><span class='aa'>
          				$quantity </span></td>
          			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$current_price_str 원</span></td>
          			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$mon_tot_str 원</span></td>
        			</tr>
              	";
              	if($mon_tot >= $union_freight_limit) 
									$freight_fee = 0;
								else $freight_fee = $union_freight_cost;
								$freight_fee_str = number_format($freight_fee);
								
								$mon_tot_freight = $mon_tot + $freight_fee;
              	$mon_tot_freight_str = number_format($mon_tot_freight);
              	echo "
              <tr>
          			<td width='35%' bgcolor='#FFFFFF'><span class='aa'><p align='center'>배송비</span></td>
          			<td width='65%' bgcolor='#FFFFFF' align='center' colspan='3'>
          				<span class='aa'><p align='right'>$freight_fee_str 원</span></td>
        			</tr>
        			<tr>
          			<td width='100%' bgcolor='#FFFFFF' colspan='4'><span class='aa'><p align='right'>구매 
          				총액: $mon_tot_freight_str 원<br>
          			</span>
          			</td>
        			</tr>
              	";
              	$count++;
              }
              ?>
              </form>
             	</table>
            </td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      <tr>
        <td vAlign='top' width='100%' bgColor='#ffffff'><div align='center'><center>
        <table border="0" width="95%">
          <tr>
            <td><table cellSpacing="0" cellPadding="0" width="100%" border="0">
              <tr>
                <td width="100%" bgColor="#7C6D61">
                <table cellSpacing="1" cellPadding="3" width="100%" border="0">
                  <tr>
                    <td width="100%" bgColor="#D0CDBC" height="20">
                    <table border="0" width="100%">
	                      <tr>
	                      <td width="100%"><span class="cc">
	                      <input onclick="javascript:toggle(1)" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="전체선택"></span>
	                      <span class="aa"> </span><strong><span class="cc">
	                      <input onclick="javascript:toggle(0)" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="선택해제"></span>
	                      <span class="dd">하여</span></strong></td>
	                      </tr>
	                      <tr>
	                      <td width="100%" height="8"><span class="cc"><strong></strong></span></td>
	                      </tr>
	                      <tr>
	                      <td width="100%"><strong><span class="dd"><p align="right"></span><span class="cc">
	                      <input onclick="document.list.submit()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="수정"></span></strong> <strong><span class="cc">
	                      <input onclick="document.list.reset()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="재입력"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="javascript:money_ok_mail()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="입금확인메일"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="javascript:send_ok_mail()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="배송시작메일"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="javascript:printWin()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="프린트"></span></strong> 
	                      <strong><span class="cc">
	                      <input onclick="receipt_win('<?echo $Mall_Admin_ID?>')" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="영수증 출력"> 
	                      <input onclick="delete_confirm()" class="bb" style="BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; COLOR: #7b7d7b; BORDER-BOTTOM: #7b7d7b 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="삭제"></span>
	                      <span class="dd"></span></strong></td>
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
          <tr>
            <td width="100%"></td>
          </tr>
          <tr>
            <td width="100%"></td>
          </tr>
        </table>
        </center></div></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><span class="aa"></span></td>
      </tr>
      <tr>
        <td vAlign="top" width="100%" bgColor="#ffffff"><span class="aa"><p align="right">　</span><span class="bb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span class="aa"></span></td>
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
			<tr align="middle">
        <td vAlign="top" width="100%" bgColor="#ffffff">
        <p style="PADDING-RIGHT: 20px" align="right">
        <span class="aa">
        <?
    		if($page == 1){
    			echo ("
    			처음
    			");
    		}
    		else{
    			echo ("
    			<a href='union_order_detail_list.php?page=1&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>처음</a> 
    			");
    		}
    	
        if($start_page > 1){
					echo ("
					<a href='union_order_detail_list.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>
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
					<a href='union_order_detail_list.php?page=$i&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='union_order_detail_list.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>
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
        			<a href='union_order_detail_list.php?page=$total_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>끝</a> 
        	");
        }
        ?>
        </span></td>
      </tr>
    </table>
    </center></div></td>
  </tr>
</tbody>
</table>
</body>
</html>
<?
}
if($update_flag == 'update'){	
	
	for($i=0; $i<count($union_order_num); $i++) {
		$j_tmp = explode("|", $union_order_num[$i]);
		$j = $j_tmp[1];
		$union_order_num_tmp = $j_tmp[0];
		
		$SQL = "update $Union_Order_BuyTable set name='$name[$j]', email='$email[$j]', tel='$tel[$j]', tel1='$tel1[$j]', message='$message[$j]',
		receiver='$receiver[$j]', rev_tel='$rev_tel[$j]', rev_tel1='$rev_tel1[$j]', zip='$zip[$j]', address='$address[$j]',  
		address_d='$address_d[$j]', freight_code='$freight_code[$j]', status = '$status[$j]', money_sender='$money_sender[$j]',
		pay_day = '$pay_day[$j]'  where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Union_OrderTable set status='$status[$j]' where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}		

	echo "<meta http-equiv='refresh' content='0; URL=union_order_detail_list.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>";
}

if($update_flag == 'money_ok'){
$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	$ary=mysql_fetch_array($dbresult);
	$shopname = $ary["shopname"];
	$shopemail  = $ary["email"];
	$icash_id  = $ary["icash_id"];
	$shoptel1= $ary["tel1"];
}
	for($k=0; $k<count($union_order_num); $k++) {
		$j_tmp = explode("|", $union_order_num[$k]);
		$union_order_num_tmp = $j_tmp[0];
		$mailcontent = ("
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<title>입금이 확인되었습니다.</title>
<style type='text/css'>
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
</head>

<body topmargin='0' bgcolor='#FFFFFF' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD'>
<table border='0' width='750' cellspacing='0' cellpadding='0' height='100%'>
<tr>
	<td width='609' valign='top'>
    	<div align='center'><center>
    	
    	<table border='0' width='571'>
      	<tr>
        	<td width='100%' height='15'></td>
      	</tr>
      	<tr>
        	<td width='100%'>
        		<div align='center'><center>
        		<table border='0' width='540' cellspacing='0' cellpadding='0'>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' colspan='4'><span class='aa'>
            			안녕하세요 $shopname 쇼핑몰입니다.<br>
            			고객님이 주문하신 상품에 대해 입금확인이 완료되었습니다.<br>
									입금내역은 아래와 같습니다.<br>
            			<br>
            			</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
          		</tr>
          		<tr>
            		<td width='536' align='left' height='25' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>주문 내역</span></td>
          		</tr>
          		<tr>
            		<td width='536' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif' colspan='4'></td>
          		</tr>
	");          			

	$SQL = "select * from $Union_Order_BuyTable where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);	
		$ary=mysql_fetch_array($dbresult);	
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
		$resd = $ary["resd"];
		$address = $ary["address"];
		$address_d = $ary["address_d"];
		$message = $ary["message"];
		$paymethod = $ary["paymethod"];
		$account_no = $ary["account_no"];
		$freight_code = $ary["freight_code"];
		$status = $ary["status"];
		$date = $ary["date"];
		$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2)."/".substr($date,8);
		$pay_day = $ary["pay_day"];
		$money_sender = $ary["money_sender"];
	}
		
		
	if($paymethod == 'byonline') $paymethod_str = '온라인입금';
	if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
	if($paymethod == 'bytelec') $paymethod_str = '신용카드(TELEC)';
	if($paymethod == 'byaccount') $paymethod_str = '계좌이체(TELEC)';
		
	if($account_no != 0){
		$SQL = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$account_no = $ary["account_no"];
		$bank_name = $ary["bank_name"];
		$bank_number = $ary["bank_number"];
		$owner_name = $ary["owner_name"];
	}
		
	$mailcontent .= "
							<tr>
            		<td width='99' height='25' align='center'>
            			<p align='left'><span class='bb'>주문번호</span></td>
            		<td width='153' height='25' align='center'><p align='left'>
            			<span class='bb'>$union_order_num_tmp</span></td>
            		<td width='147' height='25' align='center'>
            			<p align='left'>
            			<span class='bb'>주문일시</span></td>
            		<td width='159' height='25' align='center'>
            			<p align='left'>
            			<span class='bb'>$date_str</span></td>
          		</tr>
          		<tr>
            		<td width='536' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='center'>
            			<p align='left'><span class='bb'>주문자명</span></td>
            		<td width='145' height='25'>
            			<span class='bb'>$name</span></td>
            		<td width='144' height='25'>
            			<span class='bb'>연락처</span></td>
            		<td width='144' height='25'>
            			<span class='bb'>$tel1</span></td>
          		</tr>
          		<tr>
            		<td width='532' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='532' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td align='center' colspan='4' bgcolor='#808080'>
            			<table border='0' width='100%' cellspacing='1' cellpadding='3'>
              			<tr>
                			<td bgcolor='#FFFFFF' align='center' width='50%'><span class='aa'>상품명</span></td>
                			<td bgcolor='#FFFFFF' align='center' width='20%'><span class='aa'>단가</span></td>
                			<td bgcolor='#FFFFFF' align='center' width='10%'><span class='aa'>수량</span></td>
                			<td bgcolor='#FFFFFF' align='center' width='20%'><span class='aa'>소계</span></td>
              			</tr>
	";             

	$SQL = "select * from $Union_OrderTable where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$item_no = $ary["item_no"];
		$item_name = $ary["item_name"];
		$quantity = $ary["quantity"];
		$status  = $ary["status"];
		$type = $ary["type"];
		$opt = $ary["opt"];
		if($type == 'limit'){
			$current_price = Get_Limit_Price($item_no, $Mall_Admin_ID);
		}
		if($type == 'slide'){
			$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
		}
	}
	$current_price_str = number_format($current_price);
	$mon_tot = $current_price * $quantity;
	$mon_tot_str = number_format($mon_tot);	
	$mailcontent .= "						
										<tr>
                			<td bgcolor='#FFFFFF' width='50%'>
                				<span class='bb'>$item_name
	";                			
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
		$mailcontent .= ("
								<br>
					          		<img src='http://bluecart.co.kr/autocart/market/images/optionbar.gif'>옵션:
		");
		$opts = explode("!", $opt);
		if(strstr($opts[0],'^'))
			$opts_1 = explode("^", $opts[0]);
		else {
			$opts_1[0] = $opts[0];
			$opts_1[1] = '';
		}		        		
		if($opts_1[0] != "")
			$mailcontent .= "$opts_1[0]";
		if($opts_1[1] != "")
			$mailcontent .= "($opts_1[1] 원)&nbsp;";
		if($opts[1] != "")
			$mailcontent .= "$opts[1]&nbsp;";
		if($opts[2] != "")
			$mailcontent .= "$opts[2]";
	}
	$mailcontent .= ("
                				</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<p align='right'><span class='bb'>$current_price_str 원</span></td>
                			<td bgcolor='#FFFFFF' width='10%'>
                				<p align='center'><span class='bb'>$quantity</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<p align='right'><span class='bb'>$mon_tot_str 원</span></td>
              			</tr>
  ");

	if($mon_tot >= $union_freight_limit) 
		$freight_fee = 0;
	else $freight_fee = $union_freight_cost;

	$freight_fee_str = number_format($freight_fee);
	$mon_tot_freight = $mon_tot + $freight_fee;
	$mon_tot_freight_str = number_format($mon_tot_freight);

	$mailcontent .= ("
						<tr>
                			<td bgcolor='#FFFFFF' width='80%' colspan='3'>
                				<p align='center'><span class='aa'>배송료</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<span class='bb'><p align='right'>$freight_fee_str 원</span></td>
              			</tr>
              			<tr>
                			<td bgcolor='#FFFFFF' width='80%' colspan='3'>
                				<p align='center'><span class='aa'>합&nbsp;&nbsp; 
                				계</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<span class='bb'><p align='right'>
                				$mon_tot_freight_str 원</span></td>
              			</tr>
            			</table>
            		</td>
          		</tr>
          		<tr>
            		<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='536' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='536' height='2' align='left' colspan='4' bgcolor='#808080'></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>배송지 정보</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
            			<span class='aa'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='center'>
            			<p align='left'><span class='bb'>수령자</span></td>
            		<td width='208' height='25' align='center'>
            			<span class='bb'><p align='left'>$receiver</span></td>
            		<td width='125' height='25' align='center'></td>
            		<td width='126' height='25' align='center'></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='center' colspan='4' bgcolor='#C0C0C0'>
            		<span class='bb'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='center'>
            			<span class='bb'><p align='left'>연락처</span></td>
            		<td width='210' height='25'>
            			<span class='bb'>$rev_tel</span></td>
            		<td width='126' height='25'>
            			<span class='bb'>기타 연락처</span></td>
            		<td width='127' height='25'>
            			<p align='left'><span class='bb'>$rev_tel1</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'>
            			<span class='bb'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='left'>
            			<span class='bb'>주소</span></td>
            		<td width='433' height='25' colspan='3'>
            			<span class='bb'>$address&nbsp;&nbsp;$address_d</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='10' align='left' colspan='4'></td>
          		</tr>
          		<tr>
            		<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>결제방법 및 금액</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
            			<span class='bb'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='left'>
            			<span class='bb'>결제방법</span></td>
            		<td width='155' height='25'>
            			<span class='bb'>
            			$paymethod_str
            			</span>
            		</td>
            		<td width='154' height='25'>
            			<span class='bb'>금액</span></td>
            		<td width='154' height='25'>
            			<span class='bb'>$mon_tot_freight_str 원</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='left'>
            			<span class='bb'>입금자명</span></td>
            		<td width='155' height='25'>
            			<span class='bb'>$money_sender</span></td>
            		<td width='154' height='25'>
            			<span class='bb'>입금예정일</span></td>
            		<td width='154' height='25'>
            			<span class='bb'>$pay_day</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>요구 사항</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
            			<span class='aa'></span></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4'><br>
            		<span class='bb'>$message</span></td>
          		</tr>
          		<tr>
            		<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'><span class='zz'></span></td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'><span class='zz'>
            			<p align='center'> 
            			<span class='bb'>문의사항이 있으시면 전화 $shoptel1, <br>email:$shopemail 으로 연락주시기 바랍니다.
            			</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'></td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html> 
	");
		mail($email, "입금확인 되었습니다.", "$mailcontent", "From: $shopname 입니다.<$shopemail>\nContent-type: text/html");
		echo ("
		<script>
		alert(\"메일이 보내졌습니다.\");
		</script>
		");
	}

	echo "<meta http-equiv='refresh' content='0; URL=union_order_detail_list.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>";
}
if($update_flag == 'send_ok'){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$shopname = $ary["shopname"];
		$shopemail  = $ary["email"];
		$icash_id  = $ary["icash_id"];
		$shoptel1= $ary["tel1"];
	}
	for($k=0; $k<count($union_order_num); $k++) {
		$j_tmp = explode("|", $union_order_num[$k]);
		$union_order_num_tmp = $j_tmp[0];
		
		$mailcontent = ("
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<title>고객님이 주문하신 상품이 배송지로 출발하였습니다. </title>
<style type='text/css'>
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
</head>

<body topmargin='0' bgcolor='#FFFFFF' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD'>
<table border='0' width='750' cellspacing='0' cellpadding='0' height='100%'>
<tr>
	<td width='609' valign='top'>
    	<div align='center'><center>
    	
    	<table border='0' width='571'>
      	<tr>
        	<td width='100%' height='15'></td>
      	</tr>
      	<tr>
        	<td width='100%'>
        		<div align='center'><center>
        		<table border='0' width='540' cellspacing='0' cellpadding='0'>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' colspan='4'><span class='aa'>
            			안녕하세요 $shopname 쇼핑몰입니다.<br>
            			고객님이 주문하신 상품이 배송지로 출발하였습니다. <br>
            			배송기간은 1~3일이내에 받아보실 수 있습니다.<br>
            			<br>
            			</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
          		</tr>
          		<tr>
            		<td width='536' align='left' height='25' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>주문 내역</span></td>
          		</tr>
          		<tr>
            		<td width='536' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif' colspan='4'></td>
          		</tr>
	");          			

	$SQL = "select * from $Union_Order_BuyTable where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);	
		$ary=mysql_fetch_array($dbresult);	
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
		$resd = $ary["resd"];
		$address = $ary["address"];
		$address_d = $ary["address_d"];
		$message = $ary["message"];
		$paymethod = $ary["paymethod"];
		$account_no = $ary["account_no"];
		$freight_code = $ary["freight_code"];
		$status = $ary["status"];
		$date = $ary["date"];
		$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2)."/".substr($date,8);
		$pay_day = $ary["pay_day"];
		$money_sender = $ary["money_sender"];
	}

	if($paymethod == 'byonline') $paymethod_str = '온라인입금';
	if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
	if($paymethod == 'bytelec') $paymethod_str = '신용카드(TELEC)';
	if($paymethod == 'byaccount') $paymethod_str = '계좌이체(TELEC)';
		
	if($account_no != 0){
		$SQL = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$account_no = $ary["account_no"];
		$bank_name = $ary["bank_name"];
		$bank_number = $ary["bank_number"];
		$owner_name = $ary["owner_name"];
	}
		
	$mailcontent .= "
							<tr>
            		<td width='99' height='25' align='center'>
            			<p align='left'><span class='bb'>주문번호</span></td>
            		<td width='153' height='25' align='center'><p align='left'>
            			<span class='bb'>$union_order_num_tmp</span></td>
            		<td width='147' height='25' align='center'>
            			<p align='left'>
            			<span class='bb'>주문일시</span></td>
            		<td width='159' height='25' align='center'>
            			<p align='left'>
            			<span class='bb'>$date_str</span></td>
          		</tr>
          		<tr>
            		<td width='536' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='center'>
            			<p align='left'><span class='bb'>주문자명</span></td>
            		<td width='145' height='25'>
            			<span class='bb'>$name</span></td>
            		<td width='144' height='25'>
            			<span class='bb'>연락처</span></td>
            		<td width='144' height='25'>
            			<span class='bb'>$tel1</span></td>
          		</tr>
          		<tr>
            		<td width='532' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='532' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td align='center' colspan='4' bgcolor='#808080'>
            			<table border='0' width='100%' cellspacing='1' cellpadding='3'>
              			<tr>
                			<td bgcolor='#FFFFFF' align='center' width='50%'><span class='aa'>상품명</span></td>
                			<td bgcolor='#FFFFFF' align='center' width='20%'><span class='aa'>단가</span></td>
                			<td bgcolor='#FFFFFF' align='center' width='10%'><span class='aa'>수량</span></td>
                			<td bgcolor='#FFFFFF' align='center' width='20%'><span class='aa'>소계</span></td>
              			</tr>
	";             

	$SQL = "select * from $Union_OrderTable where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$item_no = $ary["item_no"];
		$item_name = $ary["item_name"];
		$quantity = $ary["quantity"];
		$status  = $ary["status"];
		$type = $ary["type"];
		$opt = $ary["opt"];
		if($type == 'limit'){
			$current_price = Get_Limit_Price($item_no, $Mall_Admin_ID);
		}
		if($type == 'slide'){
			$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
		}
	}
	$current_price_str = number_format($current_price);
	$mon_tot = $current_price * $quantity;
	$mon_tot_str = number_format($mon_tot);	
	$mailcontent .= "						
										<tr>
                			<td bgcolor='#FFFFFF' width='50%'>
                				<span class='bb'>$item_name
	";                			
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
		$mailcontent .= ("
								<br>
					          		<img src='http://bluecart.co.kr/autocart/market/images/optionbar.gif'>옵션:
		");
		$opts = explode("!", $opt);
		if(strstr($opts[0],'^'))
			$opts_1 = explode("^", $opts[0]);
		else {
			$opts_1[0] = $opts[0];
			$opts_1[1] = '';
		}		        		
		if($opts_1[0] != "")
			$mailcontent .= "$opts_1[0]";
		if($opts_1[1] != "")
			$mailcontent .= "($opts_1[1] 원)&nbsp;";
		if($opts[1] != "")
			$mailcontent .= "$opts[1]&nbsp;";
		if($opts[2] != "")
			$mailcontent .= "$opts[2]";
	}
	$mailcontent .= ("
                				</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<p align='right'><span class='bb'>$current_price_str 원</span></td>
                			<td bgcolor='#FFFFFF' width='10%'>
                				<p align='center'><span class='bb'>$quantity</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<p align='right'><span class='bb'>$mon_tot_str 원</span></td>
              			</tr>
  ");

	if($mon_tot >= $union_freight_limit) 
		$freight_fee = 0;
	else $freight_fee = $union_freight_cost;

	$freight_fee_str = number_format($freight_fee);
	$mon_tot_freight = $mon_tot + $freight_fee;
	$mon_tot_freight_str = number_format($mon_tot_freight);

	$mailcontent .= ("
						<tr>
                			<td bgcolor='#FFFFFF' width='80%' colspan='3'>
                				<p align='center'><span class='aa'>배송료</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<span class='bb'><p align='right'>$freight_fee_str 원</span></td>
              			</tr>
              			<tr>
                			<td bgcolor='#FFFFFF' width='80%' colspan='3'>
                				<p align='center'><span class='aa'>합&nbsp;&nbsp; 
                				계</span></td>
                			<td bgcolor='#FFFFFF' width='20%'>
                				<span class='bb'><p align='right'>
                				$mon_tot_freight_str 원</span></td>
              			</tr>
            			</table>
            		</td>
          		</tr>
          		<tr>
            		<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='536' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='536' height='2' align='left' colspan='4' bgcolor='#808080'></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>배송지 정보</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
            			<span class='aa'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='center'>
            			<p align='left'><span class='bb'>수령자</span></td>
            		<td width='208' height='25' align='center'>
            			<span class='bb'><p align='left'>$receiver</span></td>
            		<td width='125' height='25' align='center'></td>
            		<td width='126' height='25' align='center'></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='center' colspan='4' bgcolor='#C0C0C0'>
            		<span class='bb'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='center'>
            			<span class='bb'><p align='left'>연락처</span></td>
            		<td width='210' height='25'>
            			<span class='bb'>$rev_tel</span></td>
            		<td width='126' height='25'>
            			<span class='bb'>기타 연락처</span></td>
            		<td width='127' height='25'>
            			<p align='left'><span class='bb'>$rev_tel1</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'>
            			<span class='bb'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='left'>
            			<span class='bb'>주소</span></td>
            		<td width='433' height='25' colspan='3'>
            			<span class='bb'>$address&nbsp;&nbsp;$address_d</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='10' align='left' colspan='4'></td>
          		</tr>
          		<tr>
            		<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>결제방법 및 금액</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
            			<span class='bb'></span></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='left'>
            			<span class='bb'>결제방법</span></td>
            		<td width='155' height='25'>
            			<span class='bb'>
            			$paymethod_str
            			</span>
            		</td>
            		<td width='154' height='25'>
            			<span class='bb'>금액</span></td>
            		<td width='154' height='25'>
            			<span class='bb'>$mon_tot_freight_str 원</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='left'>
            			<span class='bb'>입금자명</span></td>
            		<td width='155' height='25'>
            			<span class='bb'>$money_sender</span></td>
            		<td width='154' height='25'>
            			<span class='bb'>입금예정일</span></td>
            		<td width='154' height='25'>
            			<span class='bb'>$pay_day</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
            			<p style='padding-left: 10px'><span class='aa'>요구 사항</span></td>
          		</tr>
          		<tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
            			<span class='aa'></span></td>
          		</tr>
          		<tr>
            		<td width='562' height='25' align='left' colspan='4'><br>
            		<span class='bb'>$message</span></td>
          		</tr>
          		<tr>
            		<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'><span class='zz'></span></td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'><span class='zz'>
            			<p align='center'> 
            			<span class='bb'>문의사항이 있으시면 전화 $shoptel1, <br>email:$shopemail 으로 연락주시기 바랍니다.
            			</span>
            		</td>
          		</tr>
          		<tr>
            		<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'></td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html> 
	");
		mail($email, "주문하신 상품이 배송지로 출발하였습니다.", "$mailcontent", "From: $shopname 입니다.<$shopemail>\nContent-type: text/html");
		echo ("
			<script>
			alert(\"메일이 보내졌습니다.\");
			</script>
		");
	}

	echo "<meta http-equiv='refresh' content='0; URL=union_order_detail_list.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>";
}
if($update_flag == "delete"){
	for($k=0; $k<count($union_order_num); $k++) {
		$j_tmp = explode("|", $union_order_num[$k]);
		$union_order_num_tmp = $j_tmp[0];
		
		$SQL = "select * from $Union_OrderTable where union_order_num = '$union_order_num_tmp' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$item_no = $ary["item_no"];
			$item_name = $ary["item_name"];
			$quantity = $ary["quantity"];
			$status  = $ary["status"];
			$type = $ary["type"];
			$opt = $ary["opt"];
		}
		
		//구매량 원래대로 복원.
		$SQL = "update $Union_ItemTable set current_num = current_num-$quantity where item_no = '$item_no' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "delete from $Union_OrderTable where union_order_num = '$union_order_num_tmp' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		$SQL = "delete from $Union_Order_BuyTable where union_order_num = '$union_order_num_tmp' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=union_order_detail_list.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate'>";
}
?>
<?
mysql_close($dbconn);
?>