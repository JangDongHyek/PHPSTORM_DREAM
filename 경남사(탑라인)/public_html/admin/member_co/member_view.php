<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows>0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$member_confirm = $ary[member_confirm];
	}

	$SQL = "select * from $Join_Form_SetTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$passport_use = $ary[passport_use];
		$zip_use = $ary[zip_use];
		$address_use = $ary[address_use];
		$tel_use = $ary[tel_use];
		$tel1_use = $ary[tel1_use];
		$email_use = $ary[email_use];
		$chuchon_use = $ary[chuchon_use];
		$msg_use = $ary[msg_use];
		$job_use = $ary[job_use];
		$com_name_use = $ary[com_name_use];
		$homepage_use = $ary[homepage_use];
		$hobby_use = $ary[hobby_use];
		$religion_use = $ary[religion_use];
		$ext1_field = $ary[ext1_field];
		$ext1_use = $ary[ext1_use];
		$ext2_field = $ary[ext2_field];
		$ext2_use = $ary[ext2_use];
		$ext3_field = $ary[ext3_field];
		$ext3_use = $ary[ext3_use];
		$ext4_field = $ary[ext4_field];
		$ext4_use = $ary[ext4_use];
		$sel_field = $ary[sel_field];
		$opt1_field = $ary[opt1_field];
		$opt2_field = $ary[opt2_field];
		$opt3_field = $ary[opt3_field];
		$opt4_field = $ary[opt4_field];
		$sel_use = $ary[sel_use];
	}

	$SQL = "select * from $Mart_Member_NewTable where username = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$username = $ary[username];
		$mart_id = $ary[mart_id];
		$password = $ary[password];
		$name = $ary[name];
		$passport1 = $ary[passport1];
		$passport2 = $ary[passport2];
		$email = $ary[email];
		$tel = $ary[tel];
		$tel1 = $ary[tel1];
		$zip = $ary[zip];
		$address = $ary[address];
		$date = $ary[date];
		$address_d = $ary[address_d];
		$partner = $ary[partner];
		$is_member = $ary[is_member];
		$msg = $ary[msg];
		$customer = $ary[customer];
		$job = $ary[job];
		$com_name = $ary[com_name];
		$homepage = $ary[homepage];
		$hobby = $ary[hobby];
		$religion = $ary[religion];
		$ext1_content = $ary[ext1_content];
		$ext2_content = $ary[ext2_content];
		$ext3_content = $ary[ext3_content];
		$ext4_content = $ary[ext4_content];
		$sel_content = $ary[sel_content];
		$if_maillist = $ary[if_maillist];
		$login_date = $ary[login_date];
		$login_count = $ary[login_count];
		$provider_id = $ary[provider_id];//쿠폰을 지급한 업체회원사
	
		$member_type = $ary[member_type];
		$co_name = $ary[co_name];
		$co_tel = $ary[co_tel];
		$co_zip = $ary[co_zip];
		$co_address1 = $ary[co_address1];
		$co_address2 = $ary[co_address2];
		$co_number = $ary[co_number];
		$co_content = $ary[co_content];
		$co_auth = $ary[co_auth];




		$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
		$passport2 = substr($passport2,0,1).'******';

		//========================= 업체회원사명을 가져옴 ====================================
		$mem_sql = "select name from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
		$mem_res = mysql_query($mem_sql, $dbconn);
		$mem_row = mysql_fetch_array( $mem_res );
		$mem_name = $mem_row[name];
		if( !$mem_name ){
			$mem_name = "일반업체회원";
		}

		if( $mem_res ){
			mysql_free_result( $mem_res );
		}
	}
	include "../admin_head.php";
?>
<script language="JavaScript">
function Tcheck(target, cmt, astr, lmin, lmax)
{
	var i
	var t = target.value

	if (t.length < lmin || t.length > lmax) {
		if (lmin == lmax) alert(cmt + '는 ' + lmin + ' Byte 이어야 합니다.');
			 else alert(cmt + '는 ' + lmin + ' ~ ' + lmax + ' Byte 이내로 입력하세요.');
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

function Eaddcheck(target, cmt)
{
	var i
	var t = target.value

	if (t.length > 1) {
	        for (i=0; i<t.length; i++)
	                if(t.substring(i,i+1) == '@') {
				return false;
			}
	}
        	alert(cmt + '를 정확히 입력하여 주십시오.');
	target.focus()
	return true	
}


function checkform(f)
{
	var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	var Digit = '1234567890'

	//if (Tcheck(f.password, '비밀번호', Alpha + Digit, 4, 8)) return false;
	
	if (f.name.value=="") {
	        alert("\n이름을 입력하세요.");
	        f.name.focus();
	        return false;
	}
	
}
function find_zip()
	{
	        	var Sel = window.open ( '../../market/member/find_zip.php', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
	}
function find_zip2()
	{
	        	var Sel = window.open ( '../../market/member/find_zip2.php', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
	}
function really()
{
	if(confirm("\n삭제하시겠습니까?\n\n포인트도 삭제되며 복구는 되지 않습니다.")){
    window.location.href='member_view.php?flag=del&username=<?=$username?>';
  }
	
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>업체회원 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="90%" bgcolor="#FFFFFF" valign="top"><br>현재 쇼핑몰에 가입한 모든 업체회원들의 신상정보를 기록/관리하는 곳입니다.<br>또한 각각의 업체회원별로 적립된 포인트를 확인하실 수 있습니다.<br></td>
					</tr>
					<tr>
						<td width="90%" bgcolor="#FFFFFF" valign="top"></td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
							<table border="0" width="100%">
								<tr>
									<td width="100%" height="20"><p align="center"><b>[업체회원 상세정보]</b></td>
								</tr>
							</table>
						</td>
					</tr>
					<form method="post" name="f" onsubmit="return checkform(this)">
					<input type=hidden name='flag' value='update'>
					<input type=hidden name='username' value='<?=$username?>'>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
							<table border="0" width="97%">
								<tr>
									<td width="100%" bgcolor="#999999">
										<table border="0" width="100%" cellspacing="1" cellpadding="3">
										<tr>
											 <td align="left" width="15%" bgColor="#c8dfec">최종로그인</td>
											 <td align="left" width="85%" bgColor="#ffffff" colspan="3">
											 <?=$login_date?> (로그인 횟수 : <?=$login_count?>번)</td>
										  </tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">업체회원가입일</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><?=$date_str?></td>
											<td width="15%" bgcolor="#C8DFEC" align="left">성명</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><input name="name" value="<?=$name?>" size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">ID</td>
											<td bgcolor="#FFFFFF" align="left"><p align="left"><?=$username?></td>
											<td bgcolor="#C8DFEC" align="left">이메일</td>
											<td bgcolor="#FFFFFF" align="left"><p align="left"><input name="email" value="<?=$email?>" size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">비밀번호</td>
											<td bgcolor="#FFFFFF" align="left"><input name="password" type='password' value="" size="13" class="input_03" style="width:80%"></td>
											<td bgcolor="#C8DFEC" align="left">추천인</td>
											<td bgcolor="#FFFFFF" align="left"><input name="partner" value="<?=$partner?>" size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">주민등록번호</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3"><?=$passport1?>-<?=$passport2?></td>
										</tr>
										<!-- <tr>
											<td bgcolor="#C8DFEC" align="left">인터넷신청업체회원</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3">
												 <input name="customer" type="radio" value="y" <?if($customer == 'y') echo "checked";?>>예&nbsp; 
												 <input name="customer" type="radio" value="n0" <?if($customer == 'n') echo " checked";?>>아니오&nbsp;&nbsp;
												(인터넷 상품을 신청하고 쿠폰을 지급받은 업체회원)
											</td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">쿠폰발급업체회원사</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3"><?=$mem_name?></td>
										</tr> -->
										<tr>
											<td bgcolor="#C8DFEC" align="left">우편번호</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3">
												<input name="zip" value='<?=$zip?>' size="13" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" readonly>
												<input onclick="javascript:find_zip();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="찾기">
											</td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">주소</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="address" value='<?=$address?>' size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">상세주소</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="address_d" value='<?=$address_d?>' size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">연락처</td>
											<td bgcolor="#FFFFFF" align="left"><input name="tel" value='<?=$tel?>' size="13" class="input_03" style="width:80%"></td>
											<td bgcolor="#C8DFEC" align="left">기타 연락처</td>
											<td bgcolor="#FFFFFF" align="left"><input name="tel1" value='<?=$tel1?>' size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											 <td align="left" bgColor="#c8dfec">뉴스레터<br>
											 수신여부</td>
											 <td align="left" bgColor="#ffffff" colSpan="3">
												 <input name="if_maillist" type="radio" value="1"
												 <?
												 if($if_maillist == '1') echo " checked";
												 ?>
												 >예&nbsp; 
												 <input name="if_maillist" type="radio" value="0"
												 <?
												 if($if_maillist == '0') echo " checked";
												 ?>
												 >아니오
											 </td>
										  </tr>



									<?
									if($member_type == "C"){
									?>
										<tr>
											<td bgcolor="#C8DFEC" align="center" colspan=4>업체정보</td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">승인여부</td>
											<td bgcolor="#FFFFFF" align="left" colspan=3>
											<?
											if($co_auth == "Y"){
												$co_auth_chk1 = "checked";
											}else{
												$co_auth_chk2 = "checked";
											}
											?>
												<input type="radio" name="co_auth" value='N' <?=$co_auth_chk2?>>미승인 &nbsp;
												<input type="radio" name="co_auth" value='Y' <?=$co_auth_chk1?>>승인
											</td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">업소명</td>
											<td bgcolor="#FFFFFF" align="left">
												<input name="co_name" value='<?=$co_name?>' size="13" class="input_03" style="width:80%">
											</td>
											<td bgcolor="#C8DFEC" align="left">전화번호</td>
											<td bgcolor="#FFFFFF" align="left"><input name="co_tel" value='<?=$co_tel?>' size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">우편번호</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3">
												<input name="co_zip" value='<?=$co_zip?>' size="13" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" readonly>
												<input onclick="javascript:find_zip2();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="찾기">
											</td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">주소</td>
											<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="co_address1" value='<?=$co_address1?>' size="13" class="input_03" style="width:80%"><BR>
											<input name="co_address2" value='<?=$co_address2?>' size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">사업자번호</td>
											<td bgcolor="#FFFFFF" align="left" colspan=3><input name="co_number" value='<?=$co_number?>' size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" align="left">간단소개</td>
											<td bgcolor="#FFFFFF" align="left" colspan='3'><textarea cols="55" name="co_content" rows="4" class="input_03" style="width:80%"><?=$co_content?></textarea></td>
										</tr>
										<?
										}
										?>
										
										
										
										
										<?
										if($ext1_field != ""){
										?>
										<tr>
											<td bgcolor="#C8DFEC" align="left"><?=$ext1_field?></td>
											<td bgcolor="#FFFFFF" align="left"><input name="ext1_content" value='<?=$ext1_content?>' size="13" class="input_03" style="width:80%"></td>
											<td bgcolor="#C8DFEC" align="left"></td>
											<td bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($ext2_field != ""){
										?>
										<tr>
											<td bgcolor="#C8DFEC" align="left"><?=$ext2_field?></td>
											<td bgcolor="#FFFFFF" align="left"><input name="ext2_content" value='<?=$ext2_content?>' size="13" class="input_03" style="width:80%"></td>
											<td bgcolor="#C8DFEC" align="left"></td>
											<td bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($ext3_field != ""){
										?>
										<tr>
											<td bgcolor="#C8DFEC" align="left"><?=$ext3_field?></td>
											<td bgcolor="#FFFFFF" align="left"><input name="ext3_content" value='<?=$ext3_content?>' size="13" class="input_03" style="width:80%"></td>
											<td bgcolor="#C8DFEC" align="left"></td>
											<td bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($ext4_field != ""){
										?>
										<tr>
											<td bgcolor="#C8DFEC" align="left"><?=$ext4_field?></td>
											<td bgcolor="#FFFFFF" align="left"><input name="ext4_content" value='<?=$ext4_content?>' size="13" class="input_03" style="width:80%"></td>
											<td bgcolor="#C8DFEC" align="left"></td>
											<td bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($sel_field != ""){
										?>
										<tr>
											<td bgcolor="#C8DFEC" align="left"><?=$sel_field?></td>
											<td bgcolor="#FFFFFF" align="left">
												<select name='sel_content' size="1" style="BACKGROUND-COLOR: rgb(255,255,255); BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; BORDER-TOP: rgb(0,0,0) 1px solid; HEIGHT: 18px">
												<option value="">====</option>
												<option value="<?=$opt1_field?>" 
												<?
												if($sel_content == $opt1_field) echo " selected";
												?>
												><?=$opt1_field?></option>
												<option value="<?=$opt2_field?>"
												<?
												if($sel_content == $opt2_field) echo " selected";
												?>
												><?=$opt2_field?></option>
												<option value="<?=$opt3_field?>"
												<?
												if($sel_content == $opt3_field) echo " selected";
												?>
												><?=$opt3_field?></option>
												<option value="<?=$opt4_field?>"
												<?
												if($sel_content == $opt4_field) echo " selected";
												?>
												><?=$opt4_field?></option>
												</select>
											</td>
											<td bgcolor="#C8DFEC" align="left"></td>
											<td bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										?>
										<?
										if($member_confirm==1){
										?>
										<tr> 
											<td align="left" bgColor="#c8dfec">승인및관리</td>
											<td align="left" colspan="3" bgColor="#ffffff">
											<?
											if($is_member == 0){
												echo ("
												<input onclick=\"window.location.href='member_view.php?flag=member_confirm&username=$username&is_member=1'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='승인'>&nbsp; 
												");
											}
											if($is_member == 1){
												echo ("
												<input onclick=\"window.location.href='member_view.php?flag=member_confirm&username=$username&is_member=0'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='취소'>&nbsp; 
												");
											}
											?>
											</td>
										</tr>
										<?
										}
										?>          
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
							<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정">
							&nbsp; 
							<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
							&nbsp; 
							<input onclick="really()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제">
							&nbsp; 
							<input onclick="window.location.href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="리스트로">
						</td>
					</tr>
</form>
				</table>


<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
elseif ($flag == "update") {
	//$passport = $passport1.$passport2;
	if($password)
		$update_password_str = "password = password('$password'),";
	else
		$update_password_str = "";
	$SQL = "update $Mart_Member_NewTable set name = '$name', $update_password_str email = '$email', tel = '$tel', tel1 = '$tel1', zip = '$zip', address = '$address', address_d = '$address_d', partner = '$partner', msg = '$msg', customer='$customer', job = '$job', com_name = '$com_name', homepage = '$homepage', hobby = '$hobby', religion = '$religion', ext1_content = '$ext1_content', ext2_content = '$ext2_content', ext3_content = '$ext3_content', ext4_content = '$ext4_content', sel_content = '$sel_content', if_maillist='$if_maillist',co_auth='$co_auth'  where username = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL= member_list.php'>";
}
else if($flag=="member_confirm"){
	$SQL = "update $Mart_Member_NewTable set is_member = '$is_member' where username = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL= member_list.php'>";
}
else if($flag=="del"){
	$SQL = "delete from $BonusTable where id = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $Mart_Member_NewTable where username = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL= member_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>