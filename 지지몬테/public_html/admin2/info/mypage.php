<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from kcp_config where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$col = mysql_fetch_array($dbresult);
	$kcp_site_cd = $col["kcp_site_cd"];
	$kcp_site_key = $col["kcp_site_key"];
	$kcp_site_name = $col["kcp_site_name"];
	$kcp_site_logo = $col["kcp_site_logo"];
	$kcp_quotaopt = $col["kcp_quotaopt"];
	$use_point = $col["use_point"];

	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		$mart_id = mysql_result($dbresult, 0, "mart_id");
		$category = mysql_result($dbresult, 0, "category");
		$shopname = mysql_result($dbresult, 0, "shopname");
		$name = mysql_result($dbresult, 0, "name");
		$bossname = mysql_result($dbresult, 0, "bossname");
		$description = mysql_result($dbresult, 0, "description");
		$passport = mysql_result($dbresult, 0, "passport");
		$tel1 = mysql_result($dbresult, 0, "tel1");
		$tel2 = mysql_result($dbresult, 0, "tel2");
		$email = mysql_result($dbresult, 0, "email");
		$place = mysql_result($dbresult, 0, "place");
		$urlinfo = mysql_result($dbresult, 0, "urlinfo");
		$service_name = mysql_result($dbresult, 0, "service_name");
		$service_status = mysql_result($dbresult, 0, "service_status");
		$date = mysql_result($dbresult, 0, "date");
		$service_date = substr(mysql_result($dbresult, 0, "service_date"),0,8);
		$pay_sys = mysql_result($dbresult, 0, "pay_sys");
		$pay_month = mysql_result($dbresult, 0, "pay_month");
		$pay_sys_next = mysql_result($dbresult, 0, "pay_sys_next");
		$pay_month_next = mysql_result($dbresult, 0, "pay_month_next");		
		$service_date_str = substr($service_date,0,4)."/".substr($service_date,4,2)."/".substr($service_date,6,2);
	}

	$SQL = "select * from $MemberTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		$me_delivery = mysql_result($dbresult, 0, "me_delivery");
		$me_delivery_price = mysql_result($dbresult, 0, "me_delivery_price");
		$usernaem = mysql_result($dbresult, 0, "username");
	}
	include "../admin_head.php"
?>
<SCRIPT language=JavaScript>
function check_form(f){
	if(f.old_password.value==""){
		alert("��й�ȣ�� �Է��ϼ���");
		f.old_password.focus();
		return false;
	}

	if(f.password1.value!=f.password2.value){
		alert("��й�ȣ�� Ȯ���ϼ���.");
		f.password1.value = "";
		f.password2.value = "";
		f.password1.focus();
		return false;
	}
	return true;
}
function find_zip()
{
		var Sel = window.open ( 'find_zip_etrans.php', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}		
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onLoad="InitializeStaticMenu();">
<?  include '../inc/menu1.html'; ?>
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
            <td width="310"><img src="../img/main_title.gif" width="310" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�⺻����</span> &gt; <span class="text_gray2_c">���������� </span> </div></td>
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
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>����������</b>
	
		<?
		if(strstr($kind,'fran(')&&$gubun=='1'){
		echo "&nbsp;&nbsp;<a href='my_fran.php'><img src='../images/per.gif' width='123' height='28' border='0'></a>";
		}
		?>				  </td>
				</tr>
			</table>

			<!--���� START~~--><br>






<!---------------------------------------- ������� ���� ---------------------------------------------------->

<form action='mypage.php' name='f' method=post onsubmit="return check_form(this)">
<input type="hidden" name="flag" value="update" >
		<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">

			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
			
				<table border="0" width="100%">
					<tr>
						<td width="15%" align=right>��й�ȣ : <br />�� ��й�ȣ : <br>�� ��й�ȣ ��Ȯ�� : </td>
						<td width="40%">
							<input type='password' name="old_password" value='<?echo $password?>' size="24" class="input_03"><br /> 
							<input type='password' name="password1" value='<?echo $password?>' size="24" class="input_03"> ������ ��й�ȣ �Է�<br>
							<input type='password' name="password2" value='<?echo $password?>' size="24" class="input_03">				
							<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="�Ϸ�">&nbsp; 
							<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="���Է�"> 
						</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
</form>
<!---------------------------------------- ������� �� ---------------------------------------------------->

<BR>

<!---------------------------------------- �ù�� ���� ---------------------------------------------------->
<SCRIPT LANGUAGE="JavaScript">
<!--
	function loadData(){
	  var form = document.f2;
	  var tmpp = form.num_default.value;
	  location.href = "mypage.php?add_num="+tmpp;
	}	
	function loadData2(){
	  var form = document.f2;
	  var tmpp = form.num_use.value;
	  location.href = "mypage.php?del_num="+tmpp;
	}	
//-->
</SCRIPT>
<?
	if($add_num){//�߰�
		$sql = "select * from add_freight_default where num='$add_num'";
		$result = mysql_query($sql, $dbconn);
		$rows=mysql_fetch_array($result);
		if($rows[pro_delivery]){
			$sql="insert into add_freight_name values('','$rows[pro_delivery]','$rows[pro_delivery_url]')";
			$result = mysql_query($sql, $dbconn);
			$sql="delete from add_freight_default where num='$add_num'";
			$result = mysql_query($sql, $dbconn);
		}
	}
	if($del_num){//�߰�
		$sql = "select * from add_freight_name where num='$del_num'";
		$result = mysql_query($sql, $dbconn);
		$rows=mysql_fetch_array($result);
		if($rows[pro_delivery]){
			$sql="insert into add_freight_default values('','$rows[pro_delivery]','$rows[pro_delivery_url]')";
			$result = mysql_query($sql, $dbconn);
			$sql="delete from add_freight_name where num='$del_num'";
			$result = mysql_query($sql, $dbconn);
		}
	}
?>


		<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
		<form action='mypage.php' name='f2' method=post>
			<tr>
				<td width="100%" bgcolor="#6084D5" height="1" valign="top" colspan=2></td>
			</tr>
			<tr>
				<td width="45%" align=center bgcolor="#FFFFFF" height="0" valign="top">
					<b>��ü �ù�� ����Ʈ
				</td>
				<td width="10%" align=center bgcolor="#FFFFFF" height="0" valign="top">
				&nbsp;
				</td>	
				<td width="45%" align=center bgcolor="#FFFFFF" height="0" valign="top">
				    <b>����� �ù�� ����Ʈ
				</td>
			</tr>
			<tr>
				<td align=center bgcolor="#FFFFFF" height="0" valign="top">
						<?
							$query = "select * from add_freight_default where 1 order by binary(pro_delivery) asc";
							$dbresult = mysql_query($query, $dbconn); 
						?>
						<select size=20 name="num_default" style="width:140pt">
						<?
							for($zz=0;$rows=mysql_fetch_array($dbresult);$zz++){
						?>
							<option value="<?=$rows[num]?>"><?=$rows[pro_delivery]?></option>
						<?
						}
						?>
						</select>	
						<BR>
						�ؼ����� "����ϱ⢺" ��ư�� �����ø�<BR> "����� �ù�� ����Ʈ"�� �̵��� �˴ϴ�
				</td>
				<td align=center valign=middle bgcolor="#FFFFFF" height="0" valign="top">
				<font style="cursor:hand;" onClick="loadData()">����ϱ⢺</font>
				<BR>
				<BR>
				<font style="cursor:hand;" onClick="loadData2()">�������ϱ�</font>
				</td>	
				<td align=center bgcolor="#FFFFFF" height="0" valign="top">
						<?
							$query = "select * from add_freight_name where 1 order by binary(pro_delivery) asc";
							$dbresult = mysql_query($query, $dbconn); 
						?>
						<select size=20 name="num_use" style="width:140pt">
						<?
							for($zz=0;$rows=mysql_fetch_array($dbresult);$zz++){
						?>
							<option value="<?=$rows[num]?>"><?=$rows[pro_delivery]?></option>
						<?
						}
						?>
						</select>	
						<BR>
						�ؼ����� "�������ϱ�" ��ư�� �����ø�<BR> �ش� �ù��� ������� �ʽ��ϴ�.
						</td>
			</tr>
		</form>
		</table>
<!---------------------------------------- �ù�� ���� �� ---------------------------------------------------->




</body>
</html>
<?
}
elseif ($flag == "update") {
	if($password1)
	{
		$SQL = "update $MemberTable set password = password('$password1') where mart_id='$mart_id' and password=password('$old_password')";
		$dbresult = mysql_query($SQL, $dbconn); 
		if(!mysql_affected_rows($dbconn))
		{
			echo ("
				<script>
				window.alert('���� ��й�ȣ�� �ùٸ��� �ʽ��ϴ�.');
				history.go(-1);
				</script>
			");
			exit;
		}
	}

	//$SQL = "update $MemberTable set me_delivery='$me_delivery', me_delivery_price='$me_delivery_price' where mart_id='$mart_id' and password=password('$old_password')";
	//$dbresult = mysql_query($SQL, $dbconn); 
	
	//$SQL = "update kcp_config set kcp_site_cd='$kcp_site_cd', kcp_site_key='$kcp_site_key', kcp_site_name='$kcp_site_name', kcp_site_logo='$kcp_site_logo', kcp_quotaopt='$kcp_quotaopt', use_point='$use_point'  where mart_id='$mart_id'";
	//$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=mypage.php'>";
}
?>	
<?
mysql_close($dbconn);
?>
