<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$sql = "select * from $TicketListTable where tl_uid='$tl_uid'";
$res = mysql_query( $sql, $dbconn );
$row = mysql_fetch_array($res);

$tl_id = $row[tl_id];
$provider_id = $row[provider_id];
$tl_money = number_format($row[tl_money]);
$tl_content = $row[tl_content];
$tl_memo = $row[tl_memo];
$tl_ok = $row[tl_ok];
$tl_getdate = $row[tl_getdate];
$tl_regdate = $row[tl_regdate];

$tl_memo = str_replace( "<br>", "\n", $tl_memo );

//============================== 회원사 정보를 불러옴 ====================================
$m_sql = "select name from $MemberTable where username='$provider_id' and mart_id='$mart_id'";
$m_res = mysql_query($m_sql, $dbconn);
$m_row = mysql_fetch_array($m_res);
$member_name = $m_row[name];

if( $res ){
	mysql_free_result( $res );
}
if( $m_res ){
	mysql_free_result( $m_res );
}
?>
<?
include "../admin_head.php";
?>
<script language="JavaScript">
function checkform(f){
	if (f.provider_id.value=="") {
		alert("회원사를 선택하세요.");
		f.provider_id.focus();
		return false;
	}

	if (f.tl_money.value=="") {
		alert("포인트 금액을 입력하세요.");
		f.tl_money.focus();
		return false;
	}
}

function check1(){
	var str = document.f.t_jumin2.value.length;
	if(str == 7) {
	   document.f.t_date.focus();
	   
	}   	
}

function really(){
	if(confirm("\n정말 회원사포인트를 삭제하시겠습니까?\n\n복구는 되지 않습니다.")){
    window.location.href='ticket_regist.php?flag=del&t_uid=<?=$t_uid?>';
  }
	
}

//콤마 넣기(정수만 해당) 
function comma(val){ 
	val = get_number(val); 
	if(val.length <= 3) return val; 

	var loop = Math.ceil(val.length / 3); 
	var offset = val.length % 3; 
	if(offset==0) offset = 3; 
	var ret = val.substring(0, offset); 
	for(i=1;i<loop;i++) { 
	ret += "," + val.substring(offset, offset+3); 
	offset += 3; } return ret; 
} 

//문자열에서 숫자만 가져가기 
function get_number(str){ 
	var val = str; 
	var temp = ""; 
	var num = ""; 

	for(i=0; i<val.length; i++){ 
		temp = val.charAt(i); 
		if(temp >= "0" && temp <= "9") num += temp; 
	} 
	return num; 
}
//숫자만 입력하기 
function checkNumber(){
	var objEv = event.srcElement;
	var num ="0123456789,";
	event.returnValue = true;
	 
	for (var i=0;i<objEv.value.length;i++){
		if(-1 == num.indexOf(objEv.value.charAt(i)))
		event.returnValue = false;
	}
	 
	if (!event.returnValue)
	objEv.value="";
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "7";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>쿠폰 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
						회원사포인트을 관리 하는 곳입니다.<br><br>
					</td>
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
								<td width="100%" height="20"><p align="center"><b>[회원사포인트 수정]</b></td>
							</tr>
						</table>
					</td>
					</tr>
					
				<form method="post" name="f" action='ticket_regist.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
				<input type='hidden' name='tl_uid' value='<?=$tl_uid?>'>
				<input type='hidden' name='tl_ok_old' value='<?=$tl_ok?>'>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"align="center">
						<table border="0" width="97%">
							<tr>
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
										<tr>
											<td width="25%" bgcolor="#C8DFEC">회원사</td>
											<td width="75%" bgcolor="#FFFFFF">
												<select name="provider_id" class='input'>
													<option value="">회원사 선택안함</option>
<?
$sql5 = "select * from $MemberTable where perms='4' order by name asc";
$res5 = mysql_query( $sql5, $dbconn );
$tot5 = mysql_num_rows( $res5 );
if( !$tot5 ){
?>
													<option value="">등록된 회원사가 없습니다.</option>
<?
}else{
?>
<?
	while( $row5 = mysql_fetch_array( $res5 ) ){
?>
													<option value="<?=$row5[username] ?>" <?if($row5[username]==$provider_id){echo ("selected");}?>><?=$row5[name]?></option>
<?
	}
}
if( $res5 ){
	mysql_free_result( $res5 );
}
?>
												</select>											
											</td>
										</tr>
										<tr>
											<td width="25%" bgcolor="#C8DFEC">포인트 금액</td>
											<td width="75%" bgcolor="#FFFFFF"><input name="tl_money" value='<?=$tl_money?>' size="20" class="input_03" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">원 (숫자만 입력하세요)</td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC">포인트 승인</td>
											<td bgcolor="#FFFFFF">
												<select name="tl_ok" class='input'>
													<option value='신청' <?if($tl_ok=="신청"){ echo "selected";}?>>신청</option>
													<option value='승인' <?if($tl_ok=="승인"){ echo "selected";}?>>승인</option>
												</select>
											</td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC">내 역</td>
											<td bgcolor="#FFFFFF"><input type='text' name="tl_content" value='<?=$tl_content?>' size="20" class="input_03" style='ime-mode:active'></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC">메 모</td>
											<td bgcolor="#FFFFFF"><textarea name='tl_memo' cols='70' rows='5' style='ime-mode:active' class="input_03"><?=$tl_memo?></textarea></td>
										</tr> 
										<tr>
											<td bgcolor="#C8DFEC">포인트 신청일</td>
											<td bgcolor="#FFFFFF"><input type='text' name="tl_regdate" value='<?=$tl_regdate?>' size="20" class="input_03" readonly></td>
										</tr> 
										<tr>
											<td bgcolor="#C8DFEC">포인트 지급일</td>
											<td bgcolor="#FFFFFF"><input type='text' name="tl_getdate" value='<?=$tl_getdate?>' size="20" class="input_03" readonly></td>
										</tr> 										
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
						<?=$t_yes_button?>&nbsp;
						<input onclick="really()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제">
						&nbsp; 
						<input onclick="location.href='ticket_list.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="리스트로">
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
mysql_close($dbconn);
?>