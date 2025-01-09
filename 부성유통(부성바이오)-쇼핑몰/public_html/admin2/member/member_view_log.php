<?
include "../lib/Mall_Admin_Session.php";
?>
<?

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
	
	if( $customer == 'y' ){
		$customer_str = "예";
	}else{
		$customer_str = "아니오";
	}

	$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
	$passport2 = substr($passport2,0,1).'******';
}
include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
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
									<td width="100%" height="20"><p align="center"><b>[회원 상세정보]</b></td>
								</tr>
							</table>
						</td>
					</tr>
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
											<td width="15%" bgcolor="#C8DFEC" align="left">회원가입일</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><?=$date_str?></td>
											<td width="15%" bgcolor="#C8DFEC" align="left">성명</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><input name="name" value="<?=$name?>" size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">ID</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><p align="left"><?=$username?></td>
											<td width="15%" bgcolor="#C8DFEC" align="left">이메일</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><p align="left"><input name="email" value="<?=$email?>" size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">비밀번호</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><input name="password" value="<?=$password?>" size="13" class="input_03" style="width:80%"></td>
											<td width="15%" bgcolor="#C8DFEC" align="left">추천인</td>
											<td width="35%" bgcolor="#FFFFFF" align="left"><input name="partner" value="<?=$partner?>" size="13" class="input_03" style="width:80%"></td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">주민등록번호</td>
											<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3"><?=$passport1?>-<?=$passport2?></td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">인터넷신청회원</td>
											<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
												 <?=$customer_str?>&nbsp;&nbsp;(인터넷 상품을 신청하고 쿠폰을 지급받은 회원)
											</td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">우편번호</td>
											<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
												<input name="zip" value='<?=$zip?>' size="13" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" readonly>
												<input onclick="javascript:find_zip();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="찾기">
												</td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">주소</td>
											<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
												<input name="address" value='<?=$address?>' size="13" class="input_03" style="width:80%">
											</td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">상세주소</td>
											<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
												<input name="address_d" value='<?=$address_d?>' size="13" class="input_03" style="width:80%">
											</td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">연락처</td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="tel" value='<?=$tel?>' size="13" class="input_03" style="width:80%">
											</td>
											<td width="15%" bgcolor="#C8DFEC" align="left">기타 연락처</td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="tel1" value='<?=$tel1?>' size="13" class="input_03" style="width:80%">
											</td>
										</tr>
										<tr>
											 <td align="left" width="15%" bgColor="#c8dfec">뉴스레터<br>
											 수신여부</td>
											 <td align="left" width="85%" bgColor="#ffffff" colSpan="3">
											 <input name="if_maillist" type="radio" value="1" <?if($if_maillist == '1') echo " checked";?>>예&nbsp; 
											 <input name="if_maillist" type="radio" value="0" <?if($if_maillist == '0') echo " checked";?>>아니오</td>
										  </tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">하고싶은말</td>
											<td width="85%" bgcolor="#FFFFFF" align="left" colspan='3'>
												<textarea cols="55" name="msg" rows="4" class="input_03" style="width:80%"><?=$msg?></textarea>
												
											</td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">직업</td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="job" value='<?=$job?>' size="13" class="input_03" style="width:80%">
											</td>
											<td width="15%" bgcolor="#C8DFEC" align="left">직장/학교명</td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="com_name" value='<?=$com_name?>' size="13" class="input_03" style="width:80%">
											</td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">홈페이지 주소</td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="homepage" value='<?=$homepage?>' size="13" class="input_03" style="width:80%">
											</td>
											<td width="15%" bgcolor="#C8DFEC" align="left">취미</td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="hobby" value='<?=$hobby?>' size="13" class="input_03" style="width:80%">
											</td>
										</tr>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left">종교</td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="religion" value='<?=$religion?>' size="13" class="input_03" style="width:80%">
											</td>
											<td width="15%" bgcolor="#C8DFEC" align="left"></td>
											<td width="35%" bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										if($ext1_field != ""){
										?>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left"><?=$ext1_field?></td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="ext1_content" value='<?=$ext1_content?>' size="13" class="input_03" style="width:80%">
												</td>
											<td width="15%" bgcolor="#C8DFEC" align="left"></td>
											<td width="35%" bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($ext2_field != ""){
										?>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left"><?=$ext2_field?></td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="ext2_content" value='<?=$ext2_content?>' size="13" class="input_03" style="width:80%">
											</td>
											<td width="15%" bgcolor="#C8DFEC" align="left"></td>
											<td width="35%" bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($ext3_field != ""){
										?>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left"><?=$ext3_field?></td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="ext3_content" value='<?=$ext3_content?>' size="13" class="input_03" style="width:80%">
											</td>
											<td width="15%" bgcolor="#C8DFEC" align="left"></td>
											<td width="35%" bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($ext4_field != ""){
										?>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left"><?=$ext4_field?></td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
												<input name="ext4_content" value='<?=$ext4_content?>' size="13" class="input_03" style="width:80%">
											</td>
											<td width="15%" bgcolor="#C8DFEC" align="left"></td>
											<td width="35%" bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										if($sel_field != ""){
										?>
										<tr>
											<td width="15%" bgcolor="#C8DFEC" align="left"><?=$sel_field?></td>
											<td width="35%" bgcolor="#FFFFFF" align="left">
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
											<td width="15%" bgcolor="#C8DFEC" align="left"></td>
											<td width="35%" bgcolor="#FFFFFF" align="left"></td>
										</tr>
										<?
										}
										?>
										<?
										if($member_confirm==1){
										?>
											<tr> 
										<td align="left" width="15%" bgColor="#c8dfec">승인및관리</td>
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
								<tr>
									<td align='right'><input type='button' value='창닫기'  style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' onclick='self.close();'></td>
								</tr>
							</table>

						</td>
					</tr>
				</table>

</body>
</html>
<?
mysql_close($dbconn);
?>