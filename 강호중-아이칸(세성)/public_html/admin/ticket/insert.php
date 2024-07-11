<?
include "../lib/Mall_Admin_Session.php";
?>
<?
include "../admin_head.php";
?>
<?
$date = date("dHis");
$date1 =  rand(0, date("is")-1);
$t_title = "$mart_id"."_"."$date"."$date1";
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

	if (f.t_money.value=="") {
		alert("쿠폰 금액을 입력하세요.");
		f.t_money.focus();
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
					<td width="90%" bgcolor="#FFFFFF" valign="top">쿠폰을 관리 하는 곳입니다.<br></td>
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
								<td width="100%" height="20"><p align="center"><b>[쿠폰 추가]</b></td>
							</tr>
						</table>
					</td>
					</tr>
					
				<form method="post" name="f" onsubmit="return checkform(this)" enctype="multipart/form-data" action='regist.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'>
				<input type='hidden' name='flag' value='insert'>
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
											<td width="75%" bgcolor="#FFFFFF"><input name="t_title" value='<?=$t_title?>' size="30" class="input_03" style='ime-mode:inactive'></td>
										</tr>
										<tr>
											<td width="25%" bgcolor="#C8DFEC">쿠폰 금액</td>
											<td width="75%" bgcolor="#FFFFFF"><input name="t_money" value='<?=$t_money?>' size="20" class="input_03" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">원 (숫자만 입력하세요)</td>
										</tr>
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
									</table>
								</td>
							</tr>
						</table>
					</td>
					</tr>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="등 록">
						&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
						&nbsp; 
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