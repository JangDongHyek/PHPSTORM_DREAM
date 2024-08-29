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

?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<SCRIPT language=JavaScript>
function check_form2(f2){
	if(f2.me_delivery.value==""){
		alert("배송업체를 입력하세요");
		f2.me_delivery.focus();
		return false;
	}
	return true;
}

function check_form(f){
	if(f.old_password.value==""){
		alert("비밀번호를 입력하세요");
		f.old_password.focus();
		return false;
	}

	if(f.password1.value!=f.password2.value){
		alert("비밀번호를 확인하세요.");
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

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>마이페이지</b>
	
		<?
		if(strstr($kind,'fran(')&&$gubun=='1'){
		echo "&nbsp;&nbsp;<a href='my_fran.php'><img src='../images/per.gif' width='123' height='28' border='0'></a>";
		}
		?>
					</td>
				</tr>
			</table>

			<!--내용 START~~--><br>
		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				비밀번호를 설정하실 때는 전화번호 혹은 동일한 숫자의 
				나열등은 피하시는 것이 좋으며, <br>
				정기적으로 변경해주시는 것이 필요합니다.<br>
				온라인택배서비스및 신용카드지불서비스의 사용자&nbsp; ID와 
				비밀번호는 각 서비스업체에서 <br>
				발급한 아이디와 비밀번호를 입력하세요.<br>
			</td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>
<form action='mypage2.php' name='f2' method=post onsubmit="return check_form2(this)">
<input type="hidden" name="flag" value="delivery_add" >
			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="0" valign="top">
				<table border="0" width="90%">
					<tr>
						<td width="100%">
						착불배송금액&nbsp; <input name="me_delivery_price" size="10" value='<?=$me_delivery_price?>' class="input_03">원

						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						착불배송업체&nbsp; <input name="pro_delivery" size="16" value='' class="input_03">
					<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="추가">&nbsp; 
						<?
							$query = "select * from $Add_Freight_Name";
							$dbresult = mysql_query($query, $dbconn); 
						?>
						<select>
						<?
							for($zz=0;$rows=mysql_fetch_array($dbresult);$zz++){
						?>
							<option><?=$rows[pro_delivery]?></option>
						<?
						}
						?>
						</select>				
						</td>
					</tr>					
				</table>
			</td>
			</tr>
</form>
<form action='mypage2.php' name='f' method=post onsubmit="return check_form(this)">
<input type="hidden" name="flag" value="update" >

			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
			
				<table border="0" width="100%">
					<tr>
						<td width="25%">상점 ID<br>관리자ID</td>
						<td width="20%">
							<?echo $mart_id?><br><?=$usernaem?></td>
						<td width="15%" align=right>비밀번호 : <br />새 비밀번호 : <br>비밀번호확인 : </td>
						<td width="40%">
							<input type='password' name="old_password" value='<?echo $password?>' size="24" class="input_03"><br /> <input type='password' name="password1" value='<?echo $password?>' size="24" class="input_03"> 비밀번호 변경시 입력<br><input type='password' name="password2" value='<?echo $password?>' size="24" class="input_03"></td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="2" valign="top">
				<table border="0" width="90%">
					<tr>
						<td width="100%" colspan="4"><span class="cc"><b>KCP 정보<br>
							<br>
							</b></td>
					</tr>
					<tr>
						<td width="25%" align="center">Site ID</td>
						<td width="25%">
							<input name="kcp_site_cd" size="20" value='<?=$kcp_site_cd?>' class="input_03"></td>
						<td width="25%" align="center">Site Key </td>
						<td width="25%"><input name="kcp_site_key" size="30" value='<?=$kcp_site_key?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%" align="center">Site Name </td>
						<td width="25%">
							<input name="kcp_site_name" size="20" value='<?=$kcp_site_name?>' class="input_03"></td>
						<td width="25%" align="center">Site Logo</td>
						<td width="25%"><input name="kcp_site_logo" size="40" value='<?=$kcp_site_logo?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%" align="center">할부선택 </td>
						<td width="25%">
							<input name="kcp_quotaopt" size="20" value='<?=$kcp_quotaopt?>' class="input_03"></td>
						<td width="25%" align="center">포인트 사용 </td>
						<td width="25%"><input type="radio" name="use_point" size="20" value='1' id='use' <? if($use_point=="1") echo "checked"; ?>><label for='use'>사용</label> <input type="radio" name="use_point" size="20" value='0' id='nouse' <? if($use_point=="0") echo "checked"; ?>><label for='nouse'>사용안함</label></td>
					</tr>					
				</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF"></td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
				<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp; 
				<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="재입력"> 
			</td>
			</tr>
		</table>
</form>
<br>
			<!--내용 END~~-->
		</td>
	</tr>
</form>
</table>
</body>
</html>
<?
}
elseif($flag == "delivery_add"){
		$SQL = "insert into $Add_Freight_Name (num,pro_delivery) values ('','$pro_delivery')";
		$dbresult = mysql_query($SQL, $dbconn); 
		echo "<meta http-equiv='refresh' content='0; URL=mypage2.php'>";
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
				window.alert('이전 비밀번호가 올바르지 않습니다.');
				history.go(-1);
				</script>
			");
			exit;
		}
	}

	$SQL = "update $MemberTable set me_delivery='$me_delivery', me_delivery_price='$me_delivery_price' where mart_id='$mart_id' and password=password('$old_password')";
	$dbresult = mysql_query($SQL, $dbconn); 
	
	$SQL = "update kcp_config set kcp_site_cd='$kcp_site_cd', kcp_site_key='$kcp_site_key', kcp_site_name='$kcp_site_name', kcp_site_logo='$kcp_site_logo', kcp_quotaopt='$kcp_quotaopt', use_point='$use_point'  where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=mypage2.php'>";
}
?>	
<?
mysql_close($dbconn);
?>