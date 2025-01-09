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
if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
else include('../include/head_alltemplate.inc');
?>

<?
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/topmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
	
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
	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	
    	<table border="0" width="500">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<img src="../images/order-title.gif" WIDTH="89" HEIGHT="27"></td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
if($ti_line_img != '' && file_exists("$Co_img_UP/design2/$ti_line_img")){
	echo "	
<img src='$Co_img_DOWN/design2/$ti_line_img'>
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
        	<td width="100%" height="20"><span class="aa"></span></td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<div align="center"><center>
        		
        		<table border="0" width="95%">
          		<tr>
            		<td width="100%" bgcolor="#808080" height="2" colspan="5"></td>
          		</tr>
          		<tr>
            		<td width="17%" align="center" height="22">
            			<p align="center"><span class="aa">주문번호</span>
					</td>
            		<td width="15%" height="22" align="center">
            			<span class="aa">주문일</span>
					</td>
            		<td width="18%" height="22" align="center">
            			<span class="aa">총결제액</span>
					</td>
            		<td width="20%" height="22" align="center">
            			<p align="center"><span class="aa">주문상태</span>
					</td>
            		<td width="15%" height="22" align="center">
            			<span class="aa">배송추적</span>
					</td>
          		</tr>
          		<tr>
            		<td width="100%" background="../images/left_dot.gif" colspan="5"></td>
          		</tr>
<?
$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and name='$name_query' and order_num = '$order_num_query' and status != 0 and status != 9 order by substring(order_num,1,8) desc , substring(order_num,9)*1 desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);

if ($cnfPagecount == "") $cnfPagecount = 10;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$total_page = ($numRows - 1) / $cnfPagecount;
$total_page = intval($total_page)+1;
	
if($page % 10 == 0)
$start_page = $page - 9;
else
$start_page = $page - ($page % 10) + 1;

$end_page = $start_page + 9;
if($end_page >= $total_page)
$end_page = $total_page;
$prev_start_page = $start_page - 10;
$next_start_page = $start_page + 10;

for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
		
	$order_num_query = $ary["order_num"];
	$date = str_replace("-","",$ary["date"]);
	$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
	$status = $ary["status"]; 
	$freight_fee = $ary["freight_fee"];

	if($status == 1) $status_str = "주문";
	if($status == 5) $status_str = "주문취소";
	if($status == 2) $status_str = "입금확인";
	if($status == 6) $status_str = "배송중";
	if($status == 3) $status_str = "배송완료";
	if($status == 7) $status_str = "교환";
	if($status == 4) $status_str = "환불";

	$SQL1 = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num_query' and status > 0";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	$mon_tot = 0;
	for ($j=0; $j<$numRows1; $j++) {
		mysql_data_seek($dbresult1,$j);
		$ary1 = mysql_fetch_array($dbresult1);
		$order_pro_no = $ary1["order_pro_no"];
		$z_price = $ary1["z_price"];
		$bonus = $ary1["bonus"];
		$use_bonus = $ary1["use_bonus"];
		$status = $ary1["status"];
		$quantity = $ary1["quantity"];
		$sum = $z_price*$quantity;
		
		$mon_tot += $sum; //합계금액
	}
	$mon_tot_str = number_format($mon_tot);
	$mon_tot_freight_str = number_format($mon_tot + $freight_fee);
?>
				<tr>
            		<td width='17%' height='20' align='center'>
            			<a href='order_detail.php?target=order_nomem.php&mart_id=<?=$mart_id?>&order_num_query=<?=$order_num_query?>&order_num=<?=$order_num?>'><span class='bb'><?=$order_num_query?></span></a>
					</td>
            		<td width='15%' height='20' align='center'>
            			<span class='bb'><?=$date_str?></span>
					</td>
            		<td width='18%' height='20' align='right'>
            			<span class='bb'><?=$mon_tot_freight_str?> 원</span>
					</td>
            		<td width='20%' height='20' align='center'>
            			<span class='bb'><?=$status_str?></span>
					</td>
            		<td width='15%' height='20' align='center'>
					</td>
          		</tr>
<?
	if(($i + 1) < ($cnfPagecount+$skipNum) && ($i + 1) < $numRows){
?>
          		<tr>
            		<td width='100%' height='1' align='center' colspan='5' bgcolor='#C0C0C0'></td>
          		</tr>
<?
	}
}
?>
          		<tr>
            		<td width="100%" bgcolor="#808080" height="2" colspan="5"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="11" colspan="5">
            			<p align="right">
            			<span class="aa">
<?
if($page == 1){
	echo ("
	처음
	");
}
else{
	echo ("
	<a href='order_nomem.php?passport1=$passport1&passport2=$passport2&mart_id=$mart_id&order_num=$order_num&page=1'>처음</a> 
	");
}

if($start_page > 1){
	echo ("
	<a href='order_nomem.php?passport1=$passport1&passport2=$passport2&mart_id=$mart_id&order_num=$order_num&page=$prev_start_page'>
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
	<a href='order_nomem.php?passport1=$passport1&passport2=$passport2&mart_id=$mart_id&order_num=$order_num&page=$i'>$i</a> 
		");
	}
}
if($end_page < $total_page){
	echo ("
	<a href='order_nomem.php?passport1=$passport1&passport2=$passport2&mart_id=$mart_id&order_num=$order_num&page=$next_start_page'>
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
	<a href='order_nomem.php?passport1=$passport1&passport2=$passport2&mart_id=$mart_id&order_num=$order_num&page=$total_page'>끝</a> 
	");
}
?>
						</span>
            		</td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="11" colspan="5">
            			<span class="aa"></span><span class="bb">주문번호를 클릭하시면 자세한 주문내역을 확인하실 수 
            			있습니다.</span><span class="aa"></span></td>
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
 </td>
</tr>
</table>
<?
include( '../include/bottom.inc' );
?>
</body>
</html>
<?
mysql_close($dbconn);
?>