<?
include "../lib/Mall_Admin_Session.php";
include "../admin_head.php";
include "./cal.php";
?>
<script>
function fn_betdate(objname1, objname2, difvalue){	//'기준날짜를 기준으로 이후 날짜 가져오기
	obj1 = MM_findObj(objname1,document,form1);
	obj2 = MM_findObj(objname2,document,form1);
	var datD = new Date(<?=date("Y")?>,<?=date("m")?>-1,<?=date("d")?>);
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
	strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2);
	//strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2) + "-";
	//strTemp = strTemp + fn_numformat(datD.getDate(),2);
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
<script>
function goto_byselect(sel, targetstr)
{
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
     if (targetstr == 'blank') {
       window.open(sel.options[index].value, 'win1');
     } else {
       var frameobj;
       if ((frameobj = eval(targetstr)) != null)
         frameobj.location = sel.options[index].value;
     }
  }
}

function checkform(){
	var frm = document.form1;
	var Digit = '1234567890'
	
	if (frm.QryFromDate.value==""){
		alert("시작월을 입력하세요");
		frm.QryFromDate.focus();
		return false;
	}
	else{
		var len =frm.QryFromDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryFromDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("형식에 맞게 입력 하세요");
				frm.QryFromDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryToDate.value==""){
		alert("종료월을 입력하세요");
		frm.QryToDate.focus();
		return false;
	}
	else{
		var len =frm.QryToDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryToDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("형식에 맞게 입력 하세요");
				frm.QryToDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryMonth.value==""){
		alert("해당월을 입력하세요");
		frm.QryMonth.focus();
		return false;
	}
	else{
		var len =frm.QryMonth.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryMonth.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("형식에 맞게 입력 하세요");
				frm.QryMonth.focus();
				return false;
			}
			ret = false;
		}	
	}
	return true;
}

function item_search(){
	if(checkform() == false) return false;
	var f=document.form1;
	if(f.item_name.value == ''){
		alert("검색어를 입력해 주세요.");
		f.item_name.focus();
		return false;
	}
	f.search_flag.value = 'item';
	f.submit();
}
function category_search(){
	if(checkform() == false) return false;
	var f=document.form1;
	if(f.category_num.value == ''){
		alert("\n카테고리를 선택하세요.");
		f.category_num.focus();
		return;
	}
	f.search_flag.value = 'category';
	f.submit();
}

</script>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onload="InitializeStaticMenu();">
<?  include '../inc/menu7.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title7.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span> <span class="text_gray2_c">통계관리</span> &gt; <span class="text_gray2_c">판매통계</span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--왼쪽부분시작-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>판매통계 > 상품별</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" bgcolor="#FFFFFF">판매에 대한 통계로써, 조건별로 검색하실 수 있습니다. 조건별 통계를 이용하여 이동하세요.<br>배송완료된 상품만 통계에 포함됩니다.</td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" height="3" valign="top"><table border="0" width="320" cellspacing="0" cellpadding="0">

          <tr>
            <td width="20"></td>
            <td width="300"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%" bgcolor="#CCCCCC"><table border="0" width="100%" cellspacing="1" cellpadding="3">
                  <tr>
                    <td width="100%" bgcolor="#F7F7F7" height="20"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="33%" height="25"><p align="left"><span class="aa">조건 검색</span></td>
                        <td width="67%" height="25" align="right">
							<select class="bb" onChange="goto_byselect(this, 'self')" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; height: 18px">
							<option value="sale_age.php">연령별</option>
							<option value="sale_region.php">지역별</option>
							<option value="sale_item.php" selected>상품별</option>
							<option value="sale_period.php">기간별</option>
							</select>
						</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <td width="100%"><br>
                </td>
              </tr>
            </table>
            </td>
          </tr>
        </table>
        <table border="0" width="580" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20"></td>
            <td width="560"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%" bgcolor="#7BBEBD"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="100%" bgcolor="#7BBEBD">
						<form id=form1 action='sale_item.php' name=form1 method=post>
						<input type='hidden' name='flag' value='search'>
						<input type='hidden' name='search_flag' value=''>
						<input type='hidden' name='page' value='1'>
						<table border="0" width="100%" cellspacing="1" cellpadding="3">				
							<tr>
								<td width="100%" bgcolor="#E9F5F5" height="30">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
<?
if($QryFromDate == '') $QryFromDate = date("Y-m");
if($QryToDate == '') $QryToDate = date("Y-m");
if($QryMonth == '') $QryMonth = date("Y-m");
?>
                      				<tr>
										<td width="101%" height="25" colspan="5">
											<table border="0" width="553" cellspacing="1" cellpadding="2">
												<tr>
													<td width="3%">
														<input type="radio" value="months" name="out_form" <?if($out_form == 'months'||$out_form == '') echo "checked"?>>
													</td>
													<td width="164%" colspan="2">기간을 정하여 검색합니다.</td>
												</tr>
												<tr>
													<td width="3%"></td>
													<td width="30%">
														<input name="QryFromDate" value="<?=$QryFromDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="8"> 
														<font color="#3d918a">~</font> 
														<input name="QryToDate" value="<?=$QryToDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="7">
													</td>
													<td width="67%" valign="top">
														<input type='button' class='butt_none' style='width:40' value='1개월' onClick="fn_betdate('QryFromDate', 'QryToDate', 'M:1')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='2개월' onClick="fn_betdate('QryFromDate', 'QryToDate', 'M:2')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='3개월' onClick="fn_betdate('QryFromDate', 'QryToDate', 'M:3')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='4개월' onClick="fn_betdate('QryFromDate', 'QryToDate', 'M:4')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='5개월' onClick="fn_betdate('QryFromDate', 'QryToDate', 'M:5')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='6개월' onClick="fn_betdate('QryFromDate', 'QryToDate', 'M:6')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='12개월' onClick="fn_betdate('QryFromDate', 'QryToDate', 'M:12')">
													</td>
												</tr>
												<tr>
													<td width="3%" height="8">
														<input type="radio" value="1month" name="out_form" <? if($out_form == '1month') echo "checked"?>>
													</td>
													<td width="164%" colspan="2">월단위로 검색합니다.</td>
												</tr>
												<tr>
													<td width="3%" height="8"></td>
													<td width="164%" colspan="2">
														<table border="0" width="100%" cellspacing="0" cellpadding="0">
															<tr>
																<td width="19%">
																	<input name="QryMonth" value="<?=$QryMonth?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="7">
																</td>
																<td width="81%"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="19%" height="25"></td>
										<td width="82%" height="25" colspan="4"></td>
									</tr>
									<tr>
										<td width="19%" height="25">&nbsp; 상품명 검색</td>
										<td width="50%" height="25">
											<input class="aa" name="item_name" value='<?=$item_name?>' style="width:85%;BORDER-BOTTOM: #929292 1px solid; BORDER-LEFT: #929292 1px solid;  BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid" size="20">
										</td>
										<td width="13%" height="25">정렬순서</td>
											<td width="20%" height="25">
												<select class="bb" name='order1' size="1" style="height: 18px; border: 1px solid black">
													<option value="item_name" <?if($order1 == 'item_name') echo "selected";?>>상품명순</option>
													<option value="item_company" <?if($order1 == 'item_company') echo "selected";?>>제조사순</option>
													<option value="reg_date" <?if($order1 == 'reg_date') echo "selected";?>>등록순</option>
													<option value="price" <?if($order1 == 'price') echo "selected";?>>가격순</option>
												</select>
											</td>
											<td width="19%" height="25">
												<img onClick="item_search()" src="../images/ggo.gif" border="0" width="39" height="18" style='cursor:hand'>
											</td>
										</tr>
										<tr>
											<td width="19%" height="25">&nbsp; 카테고리별<br>&nbsp; 검색</td>
											<td width="50%" height="25">
												<select class="bb" name='category_num' size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; height: 18px">
<?
$SQL = "select * from $CategoryTable where prevno=0 and mart_id='$mart_id' order by category_num desc";
$dbresult = mysql_query($SQL, $dbconn);

$tmp_category_num = $category_num;
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$category_num_tmp = $ary["category_num"];
	$category_name = $ary["category_name"];
	
	echo ("
	<option value='$category_num_tmp'
	");		
	if($category_num == $category_num_tmp) echo " selected";
	echo (" style='color:#000000; background-color:#dddddd;'>▷$category_name</option>
	");
	
	$SQL1 = "select * from $CategoryTable where prevno=$category_num_tmp and mart_id='$mart_id' order by category_num desc";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	
	for($j=0;$j<$numRows1;$j++){
		mysql_data_seek($dbresult1,$j);
		$ary1 = mysql_fetch_array($dbresult1);
		$category_num1_tmp = $ary1["category_num"];
		$category_name1 = $ary1["category_name"];
				
		echo ("
	<option value='$category_num1_tmp'
		");	
	if($category_num == $category_num1_tmp) echo " selected";
		echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>");
	}
}
?>
												</select>
											</td>
											<td width="13%" height="25">정렬순서</td>
											<td width="20%" height="25">
												<select class="bb" name='order2' size="1" style="height: 18px; border: 1px solid black">
													<option value="item_name" <?if($order2 == 'item_name') echo "selected";?>>상품명순</option>
													<option value="item_company" <?if($order2 == 'item_company') echo "selected";?>>제조사순</option>
													<option value="reg_date" <?if($order2 == 'reg_date') echo "selected";?>>등록순</option>
													<option value="price" <?if($order2 == 'price') echo " selected";?>>가격순</option>
												</select>
											</td>
											<td width="19%" height="25"><img onClick="category_search(this.form)" src="../images/ggo.gif" border="0" width="39" height="18" style='cursor:hand'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</form>

                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td width="20" height="5"></td>
            <td width="560" height="5"><span class="bb"><br>
            </span></td>
          </tr>
<?
if($flag == 'search'){
?>
	      	<tr>
            <td width="20" height="5"></td>
            <td width="560" height="5"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="90%" bgcolor="#999999">
					<table border="0" width="100%" cellspacing="1" cellpadding="3">
<?
	if($search_flag == 'item'){
		$SQL = "select * from $ItemTable where mart_id='$mart_id' and lower(item_name) like lower('%$item_name%') order by $order1";
	}
	if($search_flag == 'category'){
		$SQL = "select * from $ItemTable where mart_id='$mart_id' and (category_num = $category_num or prevno = $category_num) order by $order2";
	}
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
		
	$sum_tot = 0;
	$quantity_total = 0;

	$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

	$QryFromDate1 = $QryFromDate."-01";
	$QryToDate1 = $QryToDate."-".$to_end_day;

	for ($i=0; $i < $numRows; $i++) {	
		mysql_data_seek($dbresult, $i);	
		$ary=mysql_fetch_array($dbresult);	
		$item_no = $ary["item_no"];
		$item_name_tmp = $ary["item_name"];

		if($out_form == 'months'){								
			$SQL1 = "select T1.z_price,T1.quantity from $Order_ProTable T1, $Order_BuyTable T2 where T1.mart_id='$mart_id' and T1.item_no = '$item_no' and T1.order_num = T2.order_num and T2.status = '3' and ( T2.date >= '$QryFromDate1' and T2.date <= '$QryToDate1')";
		}
		if($out_form == '1month'){
			$SQL1 = "select T1.z_price,T1.quantity from $Order_ProTable T1, $Order_BuyTable T2 where T1.mart_id='$mart_id' and T1.item_no = '$item_no' and T1.order_num = T2.order_num and T2.status = '3' and ( T2.date >= '$QryFromDate1' and T2.date <= '$QryToDate1')";
		}

		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
		for($j=0;$j<$numRows1;$j++){
			mysql_data_seek($dbresult1,$j);
			$ary1=mysql_fetch_array($dbresult1);
			$z_price = $ary1[0];
			$quantity = $ary1[1];
			$quantity_total += $quantity;
			$sum = $z_price * $quantity;
			$sum_tot += $sum;
			
		}
	}

	$quantity_total_str = number_format($quantity_total);
	$sum_tot_str = number_format($sum_tot);
	
	if($out_form == '1month'){
		$QryMonth_1 = substr($QryMonth,0,4);
		$QryMonth_2 = substr($QryMonth,5,2);

		$qry_month_str = "$QryMonth_1 년 $QryMonth_2 월";
	}
	if($out_form == 'months'){
		$QryFromDate_1 = substr($QryFromDate,0,4);
		$QryFromDate_2 = substr($QryFromDate,5,2);
		$QryToDate_1 = substr($QryToDate,0,4);
		$QryToDate_2 = substr($QryToDate,5,2);

		$qry_month_str = "$QryFromDate_1 년 $QryFromDate_2 월 ~ $QryToDate_1 년 $QryToDate_2 월";
	}
?>
						<tr>
							<td width='102%' bgcolor='#8FBECD' colspan='3'>
								<table border='0' width='100%' cellspacing='0' cellpadding='0'>
									<tr>
										<td width='39%' height='25'><b><?=$qry_month_str?></b></td>
										<td width='61%' height='25' align='right'><b><font color='#000000'>총매출 : <?=$sum_tot_str?>원 (<?=$quantity_total_str?>EA)</font></b></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td width='60%' bgcolor='#FFFFFF' align='left' colspan='3' height='25'><img src='../images/t-icon.gif' width='298' height='28'></td>
						</tr>
						<tr align='center' height='25'>
							<td width='46%' bgcolor='#EFEFEF'>상품명(item_no)</td>
							<td width='20%' bgcolor='#EFEFEF'>판매갯수</td>
							<td width='3%' bgcolor='#EFEFEF'>판매액</td>
						</tr>
<?          	
	if($search_flag == 'item'){
		$SQL = "select * from $ItemTable where mart_id='$mart_id' and lower(item_name) like lower('%$item_name%') order by $order1";
	}
	if($search_flag == 'category'){
		$SQL = "select * from $ItemTable where mart_id='$mart_id' and (category_num = $category_num or prevno = $category_num) order by $order2";
	}
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);

				
	if ($cnfPagecount == "") $cnfPagecount = 10;
	if ($page == "") $page = 1;
	$skipNum = ($page - 1) * $cnfPagecount;
	$total_page = ($numRows - 1)/$cnfPagecount;
	$total_page=intval($total_page)+1;	
	
	$prev_page = $page - 1;
	$next_page = $page + 1;

	if($page % 10 == 0)
	$start_page = $page - 9;
	else
	$start_page = $page - ($page % 10) + 1;
	
	$end_page = $start_page + 9;
	if($end_page >= $total_page)
		$end_page = $total_page;
	$prev_start_page = $start_page - 10;
	$next_start_page = $start_page + 10;
		
				
	for($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){	
		if ($i >= $numRows) break;	
		mysql_data_seek($dbresult, $i);	
		$ary=mysql_fetch_array($dbresult);	
		$item_no = $ary["item_no"];
		$item_name_tmp = $ary["item_name"];
					
		if($out_form == 'months'){								
			$sum_tot_3 = 0;
			$sum_tot_4 = 0;
			$sum_tot_5 = 0;
			$sum_tot_etc = 0;
			$quantity_tot_3 = 0;
			$quantity_tot_4 = 0;
			$quantity_tot_5 = 0;
			$quantity_tot_etc = 0;
			
			for($k=1;$k<9;$k++){
				$SQL1 = "select T1.z_price, T1.quantity from $Order_ProTable T1, $Order_BuyTable T2 where T1.mart_id='$mart_id' and T1.item_no = '$item_no' and T1.order_num = T2.order_num and T2.status = '$k'and ( T2.date >= '$QryFromDate1' and T2.date <= '$QryToDate1' )";
				$dbresult1 = mysql_query($SQL1, $dbconn);
				$numRows1 = mysql_num_rows($dbresult1);
				
				for($j=0;$j<$numRows1;$j++){
					mysql_data_seek($dbresult1,$j);
					$ary1=mysql_fetch_array($dbresult1);
					$z_price = $ary1[0];
					$quantity = $ary1[1];
					
					$sum = $z_price * $quantity;
					//$quantity_total += $quantity;	
					
					if($k == 3){
						$sum_tot_3 += $sum;
						$quantity_tot_3 += $quantity;
					}else if($k == 4){
						$sum_tot_4 += $sum;
						$quantity_tot_4 += $quantity;
					}else if($k == 5||$k == 8 ){
						$sum_tot_5 += $sum;
						$quantity_tot_5 += $quantity;
					}else{
						$sum_tot_etc += $sum;
						$quantity_tot_etc += $quantity;
					}
				}
			}
		}else if($out_form == '1month'){								
			$sum_tot_3 = 0;
			$sum_tot_4 = 0;
			$sum_tot_5 = 0;
			$sum_tot_etc = 0;
			$quantity_total = 0;
				
			$SQL1 = "select T1.z_price, T1.quantity from $Order_ProTable T1, $Order_BuyTable T2 where T1.mart_id='$mart_id' and T1.item_no = '$item_no' and T1.order_num = T2.order_num and T2.status = '3' and ( T2.date >= '$QryFromDate1' and T2.date <= '$QryToDate1' )";

			$dbresult1 = mysql_query($SQL1, $dbconn);
			$numRows1 = mysql_num_rows($dbresult1);
			
			for($j=0;$j<$numRows1;$j++){
				mysql_data_seek($dbresult1,$j);
				$ary1=mysql_fetch_array($dbresult1);
				$z_price = $ary1[0];
				$quantity = $ary1[1];
				$sum = $z_price * $quantity;
				$quantity_total+=$quantity;	
					
				if($k == 3) $sum_tot_3+=$sum;
				else if($k == 4) $sum_tot_4+=$sum;
				else if($k == 5||$k == 8) $sum_tot_5+=$sum;
				else  $sum_tot_etc+=$sum;
			}
		}
			
		$sum_tot_3_str = number_format($sum_tot_3);
		$sum_tot_4_str = number_format($sum_tot_4);
		$sum_tot_5_str = number_format($sum_tot_5);
		$sum_tot_etc_str = number_format($sum_tot_etc);

		$quantity_tot_3_str = number_format($quantity_tot_3);
		$quantity_tot_4_str = number_format($quantity_tot_4);
		$quantity_tot_5_str = number_format($quantity_tot_5);
		$quantity_tot_etc_str = number_format($quantity_tot_etc);
?>	
						<tr>
							<td width='39%' height='52' align='center' bgcolor='#FFFFFF'><?=$item_name_tmp?> (<?=$item_no?>)</td>
							<td width='15%' height='52' align='right' bgcolor='#FFFFFF'>
								<table border='0' width='100%' cellspacing='1' cellpadding='2'>
									<tr>
										<td width='12%'><img src='../images/tt-1.gif' width='11' height='11'></td>
										<td width='88%' align='right'><b><font color='#588ECD'><?=$quantity_tot_3_str?> EA</font></b></td>
									</tr>
									<tr>
										<td><img src='../images/tt-2.gif' width='11' height='10'></td>
										<td align='right'><font color='#A5BEE7'><?=$quantity_tot_4_str?> EA</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-3.gif' width='11' height='10'></td>
										<td align='right'><font color='#42BEB5'><?=$quantity_tot_5_str?> EA</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-4.gif' width='11' height='10'></td>
										<td align='right'><font color='#FFAE31'><?=$quantity_tot_etc_str?> EA</font></td>
									</tr>
								</table>
							</td>
							<td width='48%' height='52' align='left' bgcolor='#FFFFFF'>
								<table border='0' width='100%' cellspacing='1' cellpadding='2'>
									<tr>
										<td width='12%'><img src='../images/tt-1.gif' width='11' height='11'></td>
										<td width='88%' align='right'><b><font color='#588ECD'><?=$sum_tot_3_str?> 원</font></b></td>
									</tr>
									<tr>
										<td><img src='../images/tt-2.gif' width='11' height='10'></td>
										<td align='right'><font color='#A5BEE7'><?=$sum_tot_4_str?> 원</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-3.gif' width='11' height='10'></td>
										<td align='right'><font color='#42BEB5'><?=$sum_tot_5_str?> 원</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-4.gif' width='11' height='10'></td>
										<td align='right'><font color='#FFAE31'><?=$sum_tot_etc_str?> 원</font></td>
									</tr>
								</table>
							</td>
						</tr>
<?
	}
?>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" height="8"></td>
              </tr>
              <tr>
                <td width="100%" align="right">
<?
if($page == 1){
	echo ("
	처음
	");
}else{
	echo ("
	<a href='sale_item.php?page=1&flag=$flag&search_flag=$search_flag&item_name=$item_name&category_num=$category_num&order1=$order1&order2=$order2&QryFromDate=$QryFromDate&QryToDate=$QryToDate&QryMonth=$QryMonth&out_form=$out_form'>처음</a> 
	");
}

if($start_page > 1){
			echo ("
			<a href='sale_item.php?page=$prev_start_page&flag=$flag&search_flag=$search_flag&item_name=$item_name&category_num=$category_num&order1=$order1&order2=$order2&QryFromDate=$QryFromDate&QryToDate=$QryToDate&QryMonth=$QryMonth&out_form=$out_form'>
			◁&nbsp; 
			</a>
			");
}else{
	echo ("
	◁&nbsp; 
	");
}
for($i=$start_page;$i<=$end_page;$i++){
	if($i == $page){
		echo ("	
	[<b>$i</b>]
		");
	}else{
		echo ("
			<a href='sale_item.php?page=$i&flag=$flag&search_flag=$search_flag&item_name=$item_name&category_num=$category_num&order1=$order1&order2=$order2&QryFromDate=$QryFromDate&QryToDate=$QryToDate&QryMonth=$QryMonth&out_form=$out_form'>$i</a> 
		");
	}
}
if($end_page < $total_page){
	echo ("
			<a href='sale_item.php?page=$next_start_page&flag=$flag&search_flag=$search_flag&item_name=$item_name&category_num=$category_num&order1=$order1&order2=$order2&QryFromDate=$QryFromDate&QryToDate=$QryToDate&QryMonth=$QryMonth&out_form=$out_form'>
			&nbsp;▷
			</a>
	");
}else{
	echo ("
			&nbsp;▷
	");
}
if($page == $total_page){
	echo ("
	끝
	");
}else{
	echo ("
	<a href='sale_item.php?page=$total_page&flag=$flag&search_flag=$search_flag&item_name=$item_name&category_num=$category_num&order1=$order1&order2=$order2&QryFromDate=$QryFromDate&QryToDate=$QryToDate&QryMonth=$QryMonth&out_form=$out_form'>끝</a> 
	");
}
?>
        		</td>
              </tr>
            </table>
            </td>
          </tr>
<?
}
?>
        	<tr>
            <td width="20" height="5"></td>
            <td width="560" height="5"></td>
          </tr>
        </table>
        </td>
      </tr>
      <tr>
        <td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      </tr>
      <tr align="center">
        <td width="100%" bgcolor="#FFFFFF" valign="top"><p align="right"></td>
      </tr>
    </table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>