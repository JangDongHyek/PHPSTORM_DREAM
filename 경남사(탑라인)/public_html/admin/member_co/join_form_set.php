<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $Join_Form_SetTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$ary=mysql_fetch_array($dbresult);
		$passport_use = $ary["passport_use"];
		$zip_use = $ary["zip_use"];
		$address_use = $ary["address_use"];
		$tel_use = $ary["tel_use"];
		$tel1_use = $ary["tel1_use"];
		$email_use = $ary["email_use"];
		$chuchon_use = $ary["chuchon_use"];
		$msg_use = $ary["msg_use"];
		$job_use = $ary["job_use"];
		$com_name_use = $ary["com_name_use"];
		$homepage_use = $ary["homepage_use"];
		$hobby_use = $ary["hobby_use"];
		$religion_use = $ary["religion_use"];
		$ext1_field = $ary["ext1_field"];
		$ext1_use = $ary["ext1_use"];
		$ext2_field = $ary["ext2_field"];
		$ext2_use = $ary["ext2_use"];
		$ext3_field = $ary["ext3_field"];
		$ext3_use = $ary["ext3_use"];
		$ext4_field = $ary["ext4_field"];
		$ext4_use = $ary["ext4_use"];
		$sel_field = $ary["sel_field"];
		$opt1_field = $ary["opt1_field"];
		$opt2_field = $ary["opt2_field"];
		$opt3_field = $ary["opt3_field"];
		$opt4_field = $ary["opt4_field"];
		$sel_use = $ary["sel_use"];
	}

	include "../admin_head.php";
?>

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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>업체회원가입설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="90%" bgcolor="#FFFFFF" height="40">쇼핑몰 업체회원가입시 필요한 입력항목과 꼬리글을 관리합니다.</td>
			</tr>
			
			<form method='post'>
			<input type='hidden' name='flag' value='update'>
			
			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				
				<table border="0" width="97%">
					<tr>
						<td width="100%" bgcolor="#e7e7e7">
							
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="100%" bgcolor="#F7F7F7" align="center" colspan="4">
									<strong>가입시 
									입력항목 선택</strong></td>
							</tr>
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="center">
									<strong>기본입력항목</strong></td>
								<td width="85%" bgcolor="#FFFFFF" align="center" colspan="3">
									<p align="left">
									<small><font color="red">V</font></small>&nbsp;이름&nbsp;&nbsp;
									<small><font color="red">V</font></small>&nbsp;아이디&nbsp;&nbsp;
									<small><font color="red">V</font></small>&nbsp;비밀번호&nbsp;&nbsp; 
									<small><font color="red">V</font></small>&nbsp;비밀번호확인</td>
							</tr>
							<tr>
								<td width="100%" bgcolor="#FFFFFF" align="center" colspan="4"><p align="left"><font color="#0000FF">
									아래 항목에 대하여 필수입력 혹은 선택입력할 것인지를 
									선택하세요.<br>
									또, 추가하실 항목이 있다면, 추가항목의 blank에 입력하시면 됩니다.</font></td>
							</tr>
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>주민등록번호</strong></td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									
									<input name="passport_use" type="radio" value="0"
									<?
									if($passport_use == 0 || $passport_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="passport_use" type="radio" value="1"
									<?
									if($passport_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="passport_use" type="radio" value="2"
									<?
									if($passport_use == 2) echo " checked"; 
									?>
									>사용않음</td>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>직업</strong></td>
								<td width="28%" bgcolor="#FFFFFF" align="left">
									
									<input name="job_use" type="radio" value="0"
									<?
									if($job_use == 0 || $job_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="job_use" type="radio" value="1"
									<?
									if($job_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="job_use" type="radio" value="2"
									<?
									if($job_use == 2) echo " checked"; 
									?>
									>사용않음</td>
							</tr>
							
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>우편번호</strong></td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									
									<input name="zip_use" type="radio" value="0"
									<?
									if($zip_use == 0 || $zip_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="zip_use" type="radio" value="1"
									<?
									if($zip_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="zip_use" type="radio" value="2"
									<?
									if($zip_use == 2) echo " checked"; 
									?>
									>사용않음</td>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>직장/학교명</strong></td>
								<td width="28%" bgcolor="#FFFFFF" align="left">
									
									<input name="com_name_use" type="radio" value="0"
									<?
									if($com_name_use == 0 || $com_name_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="com_name_use" type="radio" value="1"
									<?
									if($com_name_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="com_name_use" type="radio" value="2"
									<?
									if($com_name_use == 2) echo " checked"; 
									?>
									>사용않음</td>
							</tr>
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>주소</strong></td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									
									<input name="address_use" type="radio" value="0"
									<?
									if($address_use == 0 || $address_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="address_use" type="radio" value="1"
									<?
									if($address_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="address_use" type="radio" value="2"
									<?
									if($address_use == 2) echo " checked"; 
									?>
									>사용않음</td>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>홈페이지주소</strong></td>
								<td width="28%" bgcolor="#FFFFFF" align="left">
									
									<input name="homepage_use" type="radio" value="0"
									<?
									if($homepage_use == 0 || $homepage_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="homepage_use" type="radio" value="1"
									<?
									if($homepage_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="homepage_use" type="radio" value="2"
									<?
									if($homepage_use == 2) echo " checked"; 
									?>
									>사용않음</td>
							</tr>
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>연락처</strong></td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									
									<input name="tel_use" type="radio" value="0"
									<?
									if($tel_use == 0 || $tel_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="tel_use" type="radio" value="1"
									<?
									if($tel_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="tel_use" type="radio" value="2"
									<?
									if($tel_use == 2) echo " checked"; 
									?>
									>사용않음</td>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>취미</strong></td>
								<td width="28%" bgcolor="#FFFFFF" align="left">
									
									<input name="hobby_use" type="radio" value="0"
									<?
									if($hobby_use == 0 || $hobby_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="hobby_use" type="radio" value="1"
									<?
									if($hobby_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="hobby_use" type="radio" value="2"
									<?
									if($hobby_use == 2) echo " checked"; 
									?>
									>사용않음</td>
							</tr>
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>핸드폰</strong></td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									
									<input name="tel1_use" type="radio" value="0"
									<?
									if($tel1_use == 0 || $tel1_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="tel1_use" type="radio" value="1"
									<?
									if($tel1_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="tel1_use" type="radio" value="2"
									<?
									if($tel1_use == 2) echo " checked"; 
									?>
									>사용않음</td>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>종교</strong></td>
								<td width="28%" bgcolor="#FFFFFF" align="left">
									
									<input name="religion_use" type="radio" value="0"
									<?
									if($religion_use == 0 || $religion_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="religion_use" type="radio" value="1"
									<?
									if($religion_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="religion_use" type="radio" value="2"
									<?
									if($religion_use == 2) echo " checked"; 
									?>
									>사용않음</td>
							</tr>
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>E-mail</strong></td>
								<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
									
									<input name="email_use" type="radio" value="0"
									<?
									if($email_use == 0 || $email_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="email_use" type="radio" value="1"
									<?
									if($email_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="email_use" type="radio" value="2"
									<?
									if($email_use == 2) echo " checked"; 
									?>
									>사용않음</td>
							</tr>
							<!-- <tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>추천인</strong></td>
								<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
									
									<input name="chuchon_use" type="radio" value="0"
									<?
									if($chuchon_use == 0 || $chuchon_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="chuchon_use" type="radio" value="1"
									<?
									if($chuchon_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="chuchon_use" type="radio" value="2"
									<?
									if($chuchon_use == 2) echo " checked"; 
									?>
									>사용않음&nbsp;&nbsp; 
									<font color="#0000FF">* 
									파트너쉽프로그램이용시 반드시 선택하셔야 합니다.</font></td>
							</tr> -->
							<tr>
								<td width="15%" bgcolor="#F7F7F7" align="left">
									<strong>하고싶은 말</strong></td>
								<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
									
									<input name="msg_use" type="radio" value="0"
									<?
									if($msg_use == 0 || $msg_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="msg_use" type="radio" value="1"
									<?
									if($msg_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="msg_use" type="radio" value="2"
									<?
									if($msg_use == 2) echo " checked"; 
									?>
									>사용않음</td>
							</tr>
							<!-- <tr>
								<td width="15%" bgcolor="#F7F7F7" align="left" rowspan="3">
									<strong>추가 
									항목</strong></td>
								<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
									
									<input name="ext1_field" value='<?echo $ext1_field?>' size="17" class="input_03" size="20"> 
									&nbsp;&nbsp; 
									<input name="ext1_use" type="radio" value="0"
									<?
									if($ext1_use == 0 || $ext1_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="ext1_use" type="radio" value="1"
									<?
									if($ext1_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="ext1_use" type="radio" value="2"
									<?
									if($ext1_use == 2) echo " checked"; 
									?>
									>사용않음<br>
									<input name="ext2_field" value='<?echo $ext2_field?>' size="17" class="input_03" size="20"> 
									&nbsp;&nbsp; 
									<input name="ext2_use" type="radio" value="0"
									<?
									if($ext2_use == 0 || $ext2_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="ext2_use" type="radio" value="1"
									<?
									if($ext2_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="ext2_use" type="radio" value="2"
									<?
									if($ext2_use == 2) echo " checked"; 
									?>
									>사용않음<br>
									<input name="ext3_field" value='<?echo $ext3_field?>' size="17" class="input_03" size="20"> 
									&nbsp;&nbsp; 
									<input name="ext3_use" type="radio" value="0"
									<?
									if($ext3_use == 0 || $ext3_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="ext3_use" type="radio" value="1"
									<?
									if($ext3_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="ext3_use" type="radio" value="2"
									<?
									if($ext3_use == 2) echo " checked"; 
									?>
									>사용않음<br>
									<input name="ext4_field" value='<?echo $ext4_field?>' size="17" class="input_03" size="20"> 
									&nbsp;&nbsp; 
									<input name="ext4_use" type="radio" value="0"
									<?
									if($ext4_use == 0 || $ext4_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="ext4_use" type="radio" value="1"
									<?
									if($ext4_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="ext4_use" type="radio" value="2"
									<?
									if($ext4_use == 2) echo " checked"; 
									?>
									>사용않음<br>
									</td>
							</tr>
							<tr>
								<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
									
									<font color="#0000FF"><br>
									선택형 항목을 만들때 이용하세요.&nbsp;&nbsp;&nbsp;&nbsp; 출력예) 
									피부타입&nbsp; </font>
									<select size="1" style="BACKGROUND-COLOR: rgb(255,255,255); BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; BORDER-TOP: rgb(0,0,0) 1px solid; HEIGHT: 18px">
										<option selected value="1">지성</option>
										<option value="2">건성</option>
										<option value="3">복합성</option>
										<option value="4">중성</option>
									</select> <br>
									<br>
								</td>
							</tr>
							<tr>
								<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
									
									<input name="sel_field" value='<?echo $sel_field?>' size="17" class="input_03" size="20"> 
									&nbsp;&nbsp;
									1.<input name="opt1_field" value='<?echo $opt1_field?>' size="9" class="input_03" size="20"> 
									2.<input name="opt2_field" value='<?echo $opt2_field?>' size="9" class="input_03" size="20"> 
									3.<input name="opt3_field" value='<?echo $opt3_field?>' size="9" class="input_03" size="20"> 
									4.<input name="opt4_field" value='<?echo $opt4_field?>' size="9" class="input_03" size="20">
									<br>
									<input name="sel_use" type="radio" value="0"
									<?
									if($sel_use == 0 || $sel_use == "") echo " checked"; 
									?>
									>필수&nbsp; 
									<input name="sel_use" type="radio" value="1"
									<?
									if($sel_use == 1) echo " checked"; 
									?>
									>선택&nbsp; 
									<input name="sel_use" type="radio" value="2"
									<?
									if($sel_use == 2) echo " checked"; 
									?>
									>사용않음<br></td>
							</tr> -->
							</table>
						</td>
					</tr>
				</table>
				</center></div></td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="right"></td>
			</tr>
			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="40"><p align="center">
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="저장">&nbsp;
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">&nbsp;
				</td>
			</tr>
			</form>
			<tr align="center">
			<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
			</tr>
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
	$SQL = "select * from $Join_Form_SetTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows == 0){
		$SQL = "insert into $Join_Form_SetTable (mart_id, passport_use, zip_use, address_use, tel_use, tel1_use, ".
		"email_use, chuchon_use, msg_use, job_use, com_name_use, homepage_use, hobby_use, religion_use, ext1_field, ".
		"ext1_use, ext2_field, ext2_use, ext3_field, ext3_use, ext4_field, ext4_use, sel_field, opt1_field, opt2_field, ".
		"opt3_field, opt4_field, sel_use) ".
		"values ('$mart_id', '$passport_use', '$zip_use', '$address_use', '$tel_use', '$tel1_use', '$email_use', ".
		"'$chuchon_use', '$msg_use', '$job_use', '$com_name_use', '$homepage_use', '$hobby_use', '$religion_use', ".
		"'$ext1_field', '$ext1_use', '$ext2_field', '$ext2_use', '$ext3_field', '$ext3_use', '$ext4_field', ".
		"'$ext4_use', '$sel_field', '$opt1_field', '$opt2_field', '$opt3_field', '$opt4_field', '$sel_use')";
	}else{
		$SQL = "update $Join_Form_SetTable set passport_use = '$passport_use', zip_use = '$zip_use', ".
		"address_use = '$address_use', tel_use = '$tel_use', tel1_use = '$tel1_use', email_use = '$email_use', ".
		"chuchon_use = '$chuchon_use', msg_use = '$msg_use', job_use = '$job_use', com_name_use = '$com_name_use', ".
		"homepage_use = '$homepage_use', hobby_use = '$hobby_use', religion_use = '$religion_use', ".
		"ext1_field = '$ext1_field', ext1_use = '$ext1_use', ext2_field = '$ext2_field', ext2_use = '$ext2_use', ".
		"ext3_field = '$ext3_field', ext3_use = '$ext3_use', ext4_field = '$ext4_field', ext4_use = '$ext4_use', ".
		"sel_field = '$sel_field', opt1_field = '$opt1_field', opt2_field = '$opt2_field', opt3_field = '$opt3_field', ".
		"opt4_field = '$opt4_field', sel_use = '$sel_use' where mart_id='$mart_id'";
	}
	
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=join_form_set.php'>";
}
?>	
<?
mysql_close($dbconn);
?>