<?
include "../lib/Mall_Admin_Session.php";
include "../admin_head.php";
include "../stat/cal.php";
$statusArray=array("S"=>"����","F"=>"��������","C"=>"�������");

$sql="select * from kakaoOrder where idx='$idx'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
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
					<td bgcolor="#FFFFFF" valign="top" align="center">��ǰ</td>
					<td bgcolor="#FFFFFF" valign="top" align="center">�ɼ�</td>
					<td bgcolor="#FFFFFF" valign="top" align="center">�����ݾ�</td>
					<td bgcolor="#FFFFFF" valign="top" align="center">������</td>
					<td bgcolor="#FFFFFF" valign="top" align="center">����</td>
				</tr>
				<?
					$sql="select * from item where item_no='$row[item_no]'";
					$result2=mysql_query($sql);
					$row2=mysql_fetch_array($result2);
				?>
				<tr>
					<td width="110" bgcolor="#FFFFFF" valign="top" align="center">
						<img src="/co_img/elfower/<?=$row2[img]?>" width="100"><br/>
						<?=$row2[item_name]?>
					</td>
					<td bgcolor="#FFFFFF" valign="middle" align="center">
						<?
							for($i=1;$i<=6;$i++){
								echo $row[opt.$i._name]?$row[opt.$i._name]."(".number_format($row[opt.$i._price])."��)<br/>":"";
							}
						?>
					</td>
					<td bgcolor="#FFFFFF" valign="middle" align="center"><?=number_format($row[payPrice])?>��</td>
					<td bgcolor="#FFFFFF" valign="middle" align="center"><?=$row[approved_at]?></td>
					<td bgcolor="#FFFFFF" valign="middle" align="center"><?=$statusArray[$row[status]]?></td>
				</tr>
			
			
			</table>
<br>
			<?
				$sql="select * from mart_member_new where username='$row[member_id]'";

				$result3=mysql_query($sql);
				$row3=mysql_fetch_array($result3);
			?>
			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<Td colspan="4">�ֹ���&����� ����</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" valign="top" align="center">�̸�</td>
					<td bgcolor="#FFFFFF" valign="top" align="center"><?=$row[member_name]?></td>
					<td bgcolor="#FFFFFF" valign="top" align="center">�̸���</td>
					<td bgcolor="#FFFFFF" valign="top" align="center"><?=$row3[email]?></td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" valign="top" align="center">����ó</td>
					<td bgcolor="#FFFFFF" valign="top" align="center"><?=$row3[tel]?></td>
					<td bgcolor="#FFFFFF" valign="top" align="center">�޴���</td>
					<td bgcolor="#FFFFFF" valign="top" align="center"><?=$row3[tel1]?></td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" valign="top" align="center">�����</td>
					<td bgcolor="#FFFFFF" valign="top" align="center" colspan="3">
						<?=$row[member_addr]?>
					</td>
				</tr>
				
			
			
			</table>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>
