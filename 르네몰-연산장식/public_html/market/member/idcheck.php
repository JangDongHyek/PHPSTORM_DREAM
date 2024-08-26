<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
$sql = "select username from $Mart_Member_NewTable where mart_id='$mart_id' and username ='$user_id'";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows($res);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>▒ 아이디중복확인 ▒</title>
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function codeout(id){
	opener.document.f.username.value = id
	opener.f.password.focus();
	self.close();
}
function Tcheck(target, cmt, astr, lmin, lmax){
	var i
	var t = target.value

	if (t.length < lmin || t.length > lmax) {
		if (lmin == lmax) alert(cmt + '는 ' + lmin + ' 자 이어야 합니다.');
			 else alert(cmt + '는 ' + lmin + ' ~ ' + lmax + ' 자 이내의 영문 및 숫자로 입력하세요.');
		target.focus()
		return true
	}
	if (astr.length > 1) {
	        for (i=0; i<t.length; i++)
	                if(astr.indexOf(t.substring(i,i+1))<0) {
				alert(cmt + '에 허용할 수 없는 문자가 입력되었습니다');
				target.focus()
				return true
			}
	}
        return false
	
}

function CheckForm(theform){
	var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	var Digit = '1234567890'
	
	if (Tcheck(theform.user_id, '희망 ID', Alpha + Digit, 4, 10)) return false;
		 
	return true;
}
//-->
</script>
</head>

<body onload='document.id_input.user_id.focus();'>
<form name="id_input" onSubmit="return CheckForm(this);">
<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
<input type='hidden' name='form_info' value='f.username'>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="10" rowspan="3"></td>
		<td height="70"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        	<tr>
        		<td background="../image/blank/title_bg.gif"><img src="../image/blank/title_7.gif" width="190" height="70"></td>
        		<td width="20"><img src="../image/blank/title_right.gif" width="20" height="70"></td>
        		</tr>
        	</table></td>
		<td width="10" rowspan="3"></td>
	</tr>
	<tr>
		<td valign="top">
			<table width="100%" height="100%"  border="0" cellpadding="10" cellspacing="0">
				<tr>
					<td valign="top">
						<table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
							<tr>
								<td width="90" height="4" bgcolor="1F76AF"></td>
							</tr>
							<tr align="center">
								<td height="40">
									<table width="90%"  border="0" cellspacing="0" cellpadding="2">
										<tr>
<?
if( $tot == 0 ){
?>
											<td class="text_name">
												<img src="../image/icon_4.gif" width="15" height="9" align="absmiddle"><b><?=$user_id?></b>는 사용가능한 ID입니다.
											</td>
											<td width="60"><img src="../image/bu_use.gif" width="50" height="20" border="0" style='cursor:hand' onClick="codeout('<?=$user_id?>');"></td>
<?
}else{
?>
											<td class="text_name">
												<img src="../image/icon_4.gif" width="15" height="9" align="absmiddle"><b><?=$user_id?></b>는 사용중인 ID입니다.
											</td>
											<td width="60"></td>
<?
}
?>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="1F76AF" height="4"></td>
							</tr>
							<tr>
								<td height="100"  bgcolor="#F7F7F7">
									<table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td height="30" align="center" class="text_14_s2">중복확인할 아이디를 입력하세요! </td>
										</tr>
										<tr>
											<td height="30" align="center">
												<input type="text" name='user_id' class="input_03" size="15"> <input type='image' src="../image/bu_search3.gif" width="40" height="20" border="0" align="absmiddle" onfocus='blur();'></a>
											</td>
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
		<td height="50">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        		<tr>
					<td width="20"><img src="../image/blank/bottom_left.gif" width="20" height="50"></td>
					<td align="center" background="../image/blank/bottom_bg.gif"><img src="../image/bu_close.gif" width="60" height="20" style="cursor:hand;" onclick="window.close()"></td>
					<td width="20"><img src="../image/blank/bottom_right.gif" width="20" height="50"></td>
        		</tr>
        	</table>
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>