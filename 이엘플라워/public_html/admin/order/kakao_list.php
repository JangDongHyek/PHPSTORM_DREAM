<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	

/*SMS $SQL = "select * from $Sms_ConfigTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$sms_user = $ary[sms_user];
	$sms_passwd = $ary[sms_passwd];
	$mart_name = $ary[mart_name];
	$callback_num1 = $ary[callback_num1];
	$callback_num2 = $ary[callback_num2];
	$callback_num3 = $ary[callback_num3];
	$admin_num1 = $ary[admin_num1];
	$admin_num2 = $ary[admin_num2];
	$admin_num3 = $ary[admin_num3];
	$if_money_chk_msg = $ary[if_money_chk_msg];
	$money_chk_msg = $ary[money_chk_msg];
	$if_product_send_msg = $ary[if_product_send_msg];
	$product_send_msg = $ary[product_send_msg];
	$if_order_cancel_msg = $ary[if_order_cancel_msg];
	$order_cancel_msg = $ary[order_cancel_msg];
	$if_order_cancel_msg_admin = $ary[if_order_cancel_msg_admin];
	$order_cancel_msg_admin = $ary[order_cancel_msg_admin];
}*/

if($update_flag == ''){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$if_provider = mysql_result($dbresult, 0, "if_provider");
		
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows>0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$if_gnt_item = $ary[if_gnt_item];
	}

	if($icash_id !=''){
		$method = "<a href='http://txdman.icash.co.kr' target='_new'>[ICASH ī�������Ȳ]</a>";
	}
	if($telec_id !=''){
		$method = "<a href='http://www.ebizpro.co.kr' target='_new'' target='_new'>[TELEC ī�������Ȳ]</a>";
	}
	if($prepay_id !=''){
		$method = "<a href='https://pg.pre-pay.co.kr:4002/login.htm' target='_new'>[PREPAY ī�������Ȳ]</a>";
	}
	if($allthegate_id !=''){
		$method = "<a href='http://www.allthegate.com/login/r_login.jsp' target='_new'>[ALLTHEGATE ī�������Ȳ]</a>";
	}
	if($tgcorp_id !=''){
		$method = "<a href='https://npg.tgcorp.com/mdbop/login.jsp' target='_new'>[TGCORP ī�������Ȳ]</a>";
	}
	if($if_provider == 1 || $if_gnt_item == 1){
		$method = "<a href='order_gnt.php'>[GNT�ֹ���Ȳ]</a>";
	}

	$method = "<a href='https://pgweb.uplus.co.kr' target='_new'>[LG������ ī�������Ȳ]</a>";
	
	$today = date("Ymd");
	include "../admin_head.php";
	include "../stat/cal.php";

	if( $QryFromDate ){
		$QryFromDate = substr($QryFromDate,0,10);
	}else{
		$QryFromDate = date("Y-m-d",strtotime(date("Y-m-d")." -15 day"));
	}
	if( $QryToDate ){
		$QryToDate = substr($QryToDate,0,10);
	}else{
		$QryToDate = date("Y-m-d",strtotime(date("Y-m-d")." +15 day"));
	}

	if($QryMonth == '') $QryMonth = date("Y-m");
?>
<script>
function goTo(f){
	f.submit();
}
function go_today(){
	window.location.href='order_new.php?today=<?=$today?>&flag=today';
}
function checkform(f){
	if(f.searchword.value==""){
		alert("�˻�� �Է��ϼ���.");
		f.searchword.focus();
		return false;
	}
	return true;
}

function changeDate(set,day){
	
	var date = new Date(<?=date("Y")?>,<?=date("m")?>-1,<?=date("d")?>);//�տ���¥
	var date2 = new Date(<?=date("Y")?>,<?=date("m")?>-1,<?=date("d")?>);//�ڿ���¥
	
	if(0<day){
		if(set=="date"){
			date2.setDate(date2.getDate()+day);
			
		}else{
			date2.setMonth(date2.getMonth()+day+1);	
		}
	}else if(day==0){
		
	}else{
		if(set=="date"){
			date.setDate(date.getDate()+day);
		}else{
			date.setMonth((date.getMonth()+day));	
		}
	}
	var currentMonth=date.getMonth()+1;
	var currentDate=date.getDate();
	var nextMonth=date2.getMonth()+1;
	var nextDate=date2.getDate();
	if(currentMonth<10){
		currentMonth="0"+currentMonth;
	}
	if(currentDate<10){
		currentDate="0"+currentDate;
	}
	if(nextMonth<10){
		nextMonth="0"+nextMonth;
	}
	if(nextDate<10){
		nextDate="0"+nextDate;
	}
	$("#QryFromDate").val(date.getFullYear()+"-"+currentMonth+"-"+currentDate);
	$("#QryToDate").val(date2.getFullYear()+"-"+nextMonth+"-"+nextDate)

}

function fn_betdate(objname1, objname2, difvalue){	//'���س�¥�� �������� ���� ��¥ ��������
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
function fn_getdate(datArg){	//'���� ���� ��������
	var datD = datArg;
	var strTemp = "";
	strTemp = strTemp + datD.getFullYear() + "-";
	strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2) + "-";
	strTemp = strTemp + fn_numformat(datD.getDate(),2);
	return strTemp;
}
function fn_numformat(intNum, intLen){	//'���ڼ��� ���߾� 0�� ���� ���� ����
	var strNum = intNum + "";
	var strTemp = "";
	for(i = 0; i < (eval(intLen) - strNum.length); i++){
		strTemp = "0" + strTemp;
	}
	strTemp = strTemp + strNum;
	return strTemp;
}
function MM_findObj(n, d, f) { //'��ü�� ã��
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
//���� ������
function goSms(){
	var hp="";
	var isChecked=false;
	for(var i=0;i<$("input[name='checkSel[]']").size();i++){
		if($("input[name='checkSel[]']").eq(i).prop("checked")){
			var no=$("input[name='checkSel[]']").eq(i).val();
			hp+=$("#order-hp"+no).val()+",";
			isChecked=true;
		}
	}
	if(isChecked==false){
		alert("üũ�ڽ� �ϳ� �̻� üũ�� �Ǿ��־�� �մϴ�.");
		return;
	}
	hp=hp.substring(0,hp.length-1);
	window.open("../sms/sms_write.php?hp="+hp,"sms","width=475;height=350,scrollbars=1");
	
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu4.html'; ?>
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
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�ֹ�����</span> &gt; <span class="text_gray2_c">īī������ �ֹ� </span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
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
			<!--���ʺκн���-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>īī������ �ֹ� </b></td>
				</tr>
			</table>

			<!--���� START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">
					�ֹ���ȣ�� Ŭ���Ͻø� �ֹ��� ���� �󼼳����� ���������� �������� �̵��մϴ�.<br>
					�ֹ��˻��� ����, 3��, ������ ������ �˻������ϸ�, ��ȸ�Ⱓ�� ������ �Է��Ͽ� �˻��ϽǼ��� �ֽ��ϴ�.<br>
					<font color='#6C6FFA'>��������� ���θ����� ���������� ��Ÿ���� ���Դϴ�.<br>
					�ſ�ī��� �������� ���, �ſ�ī�� ���з� �������� �� ī����� �����ڸ��� �����ϼż� Ȯ���Ͻñ� �ٶ��ϴ�.</font><br>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" align="center">
					<b><a href='order_new.php'>[��ü�ֹ���Ȳ]</a> <?=$method?></b>
				</td>
				</tr>

		

		
		<tr>
			<td>
			
						
	  </td>
  </tr>
	<tr>


					<form name='list' action='order_new.php' method='post'>
								<input type='hidden' name='update_flag' value='update'>
								<input type='hidden' name='page' value='<?=$page?>'>
								<input type='hidden' name='keyset' value='<?=$keyset?>'>
								<input type='hidden' name='searchword' value='<?=$searchword?>'>
								<input type='hidden' name='flag' value='<?=$flag?>'>
								<input type='hidden' name='cnfPagecount' value='<?=$cnfPagecount?>'>
								<input type='hidden' name='QryFromDate' value='<?=$QryFromDate?>'>
								<input type='hidden' name='QryToDate' value='<?=$QryToDate?>'>
								<input type='hidden' name='status_flag' value='<?=$status_flag?>'>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
						
						<tr>
							<td width="100%" height="10" align="center">
							<table border="0" width="95%"
							cellspacing="0" cellpadding="0">
							 <tr>
								<td width="100%" height="10"></td>
							 </tr>
							 <tr>
							
							 <tr>
								<td width="100%"></td>
							 </tr>
							</table>
							</td>
						</tr>
						<tr>
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="8%" bgcolor="#FFFFFF" align="center">��ȣ</td>
									<td width="14%" bgcolor="#FFFFFF" align="center">�ֹ���ȣ</td>
									<td width="10%" bgcolor="#FFFFFF" align="center">�̸�</td>
									<td width="16%" bgcolor="#FFFFFF" align="center">��¥</td>
									<td width="14%" bgcolor="#FFFFFF" align="center">�Ѱ�����</td>
									<td width="34%" bgcolor="#FFFFFF" align="center">�������</td>

								</tr>
<?
//����¡ �����
// ������ ���� 
$page_set = 10; // �������� �ټ� 
$block_set = 5; // �������� ���� 
 
$query = "SELECT count(idx) as total FROM kakaoOrder where status<>'D' "; 
$result = mysql_query($query); 
$row = mysql_fetch_array($result); 
 
$total = $row[total]; // ��ü�ۼ� 
 
$total_page = ceil ($total / $page_set); // ����������(�ø��Լ�) 
$total_block = ceil ($total_page / $block_set); // �Ѻ���(�ø��Լ�) 
 
if (!$page) $page = 1; // ����������(�Ѿ�°�) 
$block = ceil ($page / $block_set); // �����(�ø��Լ�) 
 
$limit_idx = ($page - 1) * $page_set; // limit������ġ 
 

 
// ��������ȣ & �� ���� 
$first_page = (($block - 1) * $block_set) + 1; // ù��° ��������ȣ 
$last_page = min ($total_page, $block * $block_set); // ������ ��������ȣ 
 
$prev_page = $page - 1; // ���������� 
$next_page = $page + 1; // ���������� 
 
$prev_block = $block - 1; // ������ 
$next_block = $block + 1; // ������ 
 
// �������� ���� ���������� �Ϸ���... 
$prev_block_page = $prev_block * $block_set; // ������ ��������ȣ 
// �������� ���� ù�������� �Ϸ���... 
//$prev_block_page = $prev_block * $block_set - ($block_set - 1); 
$next_block_page = $next_block * $block_set - ($block_set - 1); // ������ ��������ȣ 
 
$no=$total-$limit_idx;
$statusArray=array("S"=>"����","F"=>"��������","C"=>"�������");
$sql="select * from kakaoOrder where status<>'D' order by idx desc LIMIT $limit_idx, $page_set";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){?>
								<tr>
									<td width="8%" bgcolor="#FFFFFF" align="center"><?=$no?></td>
									<td width="14%" bgcolor="#FFFFFF" align="center"><a href="./kakao_view.php?idx=<?=$row[idx]?>"><?=$row[orderNo]?></a></td>
									<td width="10%" bgcolor="#FFFFFF" align="center"><a href="./kakao_view.php?idx=<?=$row[idx]?>"><?=$row[member_name]?></a></td>
									<td width="16%" bgcolor="#FFFFFF" align="center"><a href="./kakao_view.php?idx=<?=$row[idx]?>"><?=substr($row[approved_at],0,10)?></a></td>
									<td width="14%" bgcolor="#FFFFFF" align="center"><a href="./kakao_view.php?idx=<?=$row[idx]?>"><?=number_format($row[payPrice])?>��</a></td>
									<td width="34%" bgcolor="#FFFFFF" align="center">
										<a href="./kakao_view.php?idx=<?=$row[idx]?>">
										<?=$statusArray[$row[status]]?>
										</a>
									</td>
								</tr>
<? $no--;}?>
								<tr>
									<td colspan="6" style="background-color:#fff">
										<table>
											<tbody>
												<tr>
													<?
													// ����¡ ȭ�� 
echo ($prev_page > 0) ? "<td><a href='$PHP_SELF?page=$prev_page'>[����������]</a></td>  " : "<td></td>"; 
echo ($prev_block > 0) ? "<a href='$PHP_SELF?page=$prev_block_page'>[ó��]</a> " : "<td></td> "; 
 
for ($i=$first_page; $i<=$last_page; $i++) { 
echo ($i != $page) ? "<td><a href='$PHP_SELF?page=$i'>$i</a></td> " : "<td><b>$i</b></td> "; 
} 
 
echo ($next_block <= $total_block) ? "<td><a href='$PHP_SELF?page=$next_block_page'>...</a></td> " : "<td></td>"; 
echo ($next_page <= $total_page) ? "<td><a href='$PHP_SELF?page=$next_page'>[����������]</a></td>" : "<td></td>"; 
?>
													<td></td>
												</tr>
											</tbody>
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

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?}?>
<?
mysql_close($dbconn);
?>
