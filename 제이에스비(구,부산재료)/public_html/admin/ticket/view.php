<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$sql = "select * from $TicketTable where t_uid='$t_uid'";
$res = mysql_query( $sql, $dbconn );
$row = mysql_fetch_array($res);

$t_id = $row[t_id];
$provider_id = $row[provider_id];
$t_title = $row[t_title];
$t_money = $row[t_money];
$t_name = $row[t_name];
$t_jumin1 = $row[t_jumin1];
$t_jumin2 = $row[t_jumin2];
$t_date = $row[t_date];
$t_getdate = $row[t_getdate];
$t_regdate = $row[t_regdate];
$t_ok = $row[t_ok];
$t_yes = $row[t_yes];
//$t_jumin = "$t_jumin1-$t_jumin2";

if( $t_ok == "y" ){
	$t_ok_str = "<font color='#33A6B3'>받음</font>";
}else{
	$t_ok_str = "<font color='red'>안받음</font>";
}

if( $t_yes == "y" ){
	$t_yes_str = "<font color='#33A6B3'>승인</font>";
}else if( $t_yes == "n" ){
	$t_yes_str = "<font color='red'>취소</font>";
}

if( $t_yes == 'y' && $t_ok == 'n' ){
	$t_yes_button = "<input type='button' value='쿠폰취소' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' onclick='confirm_cancel($t_uid)'>";
}else if( $t_yes == 'y' && $t_ok == 'y' ){
	$t_yes_button = "<input type='button' value='쿠폰취소' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' onclick=\"window.alert('적립금을 지급받았기 때문에 취소할 수 없습니다')\";>";
}else{
	$t_yes_button = "<input type='button' value='쿠폰승인' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' onclick='confirm_ok($t_uid)'>";
}

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

	if (f.t_title.value=="") {
		alert("쿠폰번호를 입력하세요.");
		f.t_title.focus();
		return false;
	}

	if (f.t_name.value=="") {
		alert("쿠폰 받을 사람을 입력하세요.");
		f.t_name.focus();
		return false;
	}
	
	if (f.t_jumin1.value=="") {
		alert("쿠폰 받을 사람의 주민등록번호를 입력하세요.");
		f.t_jumin1.focus();
		return false;
	}

	if (f.t_jumin2.value=="") {
		alert("쿠폰 받을 사람의 주민등록번호를 입력하세요.");
		f.t_jumin2.focus();
		return false;
	}

	if (f.t_date.value==""){
		alert("쿠폰 유효기간을 입력하세요.");
		f.t_date.focus();  
		return false;
	}
}

function check(){
	var str = document.f.t_jumin1.value.length;
	if(str == 6) {
	   document.f.t_jumin2.focus();
	}
} 

function check1(){
	var str = document.f.t_jumin2.value.length;
	if(str == 7) {
	   document.f.t_date.focus();
	   
	}   	
}

function really(){
	if(confirm("\n정말 쿠폰을 삭제하시겠습니까?\n\n복구는 되지 않습니다.")){
    window.location.href='regist.php?flag=del&t_uid=<?=$t_uid?>';
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
						쿠폰을 관리 하는 곳입니다.<br>
						쿠폰 받은 사람을 클릭하시면 쿠폰을 받은 회원에 대한 상세 정보를 볼 수 있습니다.<br>
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
								<td width="100%" height="20"><p align="center"><b>[쿠폰 수정]</b></td>
							</tr>
						</table>
					</td>
					</tr>
					
				<form method="post" name="f" action='regist.php' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
				<input type='hidden' name='t_uid' value='<?=$t_uid?>'>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"align="center">
						<table border="0" width="97%">
							<tr>
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
										<tr>
											<td width="25%" bgcolor="#C8DFEC">쿠폰발행회원사</td>
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
											<td width="25%" bgcolor="#C8DFEC">쿠폰 번호</td>
											<td width="75%" bgcolor="#FFFFFF"><input name="t_title" value='<?=$t_title?>' size="50" class="input_03" style='ime-mode:inactive'></td>
										</tr>
										<tr>
											<td width="25%" bgcolor="#C8DFEC">쿠폰 금액</td>
											<td width="75%" bgcolor="#FFFFFF"><input name="t_money" value='<?=number_format($t_money)?>' size="20" class="input_03" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">원 (숫자만 입력하세요)</td>
										</tr>
<?
if( $t_id ){
?>
										<tr>
											<td bgcolor="#C8DFEC" >쿠폰 받은 사람</td>
											<td bgcolor="#FFFFFF"><a href='../member/member_view.php?username=<?=$t_id?>&t_uid=<?=$t_uid?>'><b>[<?=$t_id?>]</b></a></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC" >쿠폰 받은 날짜</td>
											<td bgcolor="#FFFFFF"><?=$t_getdate?></td>
										</tr>
<?
}
?>
										<tr>
											<td bgcolor="#C8DFEC" >쿠폰 받을 사람 이름</td>
											<td bgcolor="#FFFFFF"><input type='text' name="t_name" value='<?=$t_name?>' size="20" class="input_03" style='ime-mode:active'></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC">쿠폰 받을 사람 주민번호</td>
											<td bgcolor="#FFFFFF"><input type="text" name="t_jumin1" value='<?=$t_jumin1?>' onkeyup='check();' class="input_03" size="10" maxlength='6'> - <input type='password' name="t_jumin2" value='<?=$t_jumin2?>' class="input_03" size="10" maxlength='7' onkeyup='check1();'></td>
										</tr>
										<tr>
											<td bgcolor="#C8DFEC">쿠폰 유효기간</td>
											<td bgcolor="#FFFFFF"><input name="t_date" value="<?=$t_date?>" size="20" class="input_03"> (예: 2005-06) (받드시 이 형식으로 입력)</td>
										</tr>  
										<tr>
											<td bgcolor="#C8DFEC">확 인</td>
											<td bgcolor="#FFFFFF"><?=$t_ok_str?></td>
										</tr> 
										<tr>
											<td bgcolor="#C8DFEC">승인/취소</td>
											<td bgcolor="#FFFFFF"><?=$t_yes_str?></td>
										</tr> 										
									</table>
								</td>
							</tr>
						</table>
					</td>
					</tr>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<!-- <input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정">
						&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
						&nbsp;
						<?=$t_yes_button?>&nbsp;
						<input onclick="really()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제">
						&nbsp;  -->
						<input onclick="location.href='list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="리스트로">
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