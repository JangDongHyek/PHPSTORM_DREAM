<?
include "../lib/Mall_Admin_Session.php";
?>
<?
function check_email($email, $check_dns = false){ 
  if( (preg_match('/(@.*@)|(..)|(@.)|(.@)|(^.)/', $email)) || (preg_match('/^.+@([?)[a-zA-Z0-9-.]+.([a-zA-Z]{2,3}|[0-9]{1,3})(]?)$/', $email)) ){ 
	 if($check_dns){ 
		$host = explode('@', $email); 
		// Check for MX record 
		if( checkdnsrr($host[1], 'MX') ) return true; 
		// Check for A record 
		if( checkdnsrr($host[1], 'A') ) return true; 
		// Check for CNAME record 
		if( checkdnsrr($host[1], 'CNAME') ) return true; 
	 }else{ 
		return true; 
	 } 
  } 
  return false; 
} 

$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	$shopname = mysql_result($dbresult, 0, "shopname");
	$name = mysql_result($dbresult, 0, "name");
	$passport = mysql_result($dbresult, 0, "passport");
	$tel1 = mysql_result($dbresult, 0, "tel1");
	$tel2 = mysql_result($dbresult, 0, "tel2");
	$shopmail = mysql_result($dbresult, 0, "email");
	$place = mysql_result($dbresult, 0, "place");
	
}
if($flag == ""){
	/*
	$SQL = "select * from $Email_ResTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);	
	if($numRows > 0){
		echo "
		<script>
		alert(\"이미 예약된 메일이 있어 메일을 보내실 수 없습니다.\\n메일은 하루에 한통 보내실 수 있습니다.\")
		history.go(-1)
		</script>
		";
		exit;
	}*/
	include "../admin_head.php";
?>
<script>
var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}
function re_init(){
	document.writeform.reset();
	init();
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.content.value;
	f.editBox.focus();
	f.editBox.setFocus();
}


function checkform(f){
	if(f.subject.value == ""){
		alert("제목을 입력하세요.");
		f.subject.focus();
		return false;
	}
	f.editBox.editmode = "html";
	f.content.value = f.editBox.html;
	return true;
}
function cant_send(){
	alert("테스트 몰에서는 메일을 보낼수 없습니다.");
	return;
}	
function cant_send1(){
	alert("이미 예약된 메일이 있습니다.");
	return;
}	
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</SCRIPT>
</head>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원/마일리지관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
				<td width="90%" bgcolor="#FFFFFF"><strong>&nbsp;&nbsp; [전체회원 이메일 발송]</strong>   <br> 
					<span class='aa'><font color='red'>&nbsp;&nbsp; 메일는 하루에 한번 예약하실 수 있습니다. <br>
					&nbsp;&nbsp; 한번 보내실때 메일내용 크기는 100k로 제한되어 있습니다.<br>
					&nbsp;&nbsp; 예약된 메일은 매일 오전 5시에서 7시 사이에 보내집니다.<br> 
					&nbsp;&nbsp; <br> 
					</font>
			</td>       
			</tr>       
<form action='mail_send.php' name="writeform" method="post" onsubmit='return checkform(this)'>
<input type="hidden" name="flag" value="send">
<input type="hidden" name="shopname" value="<?echo $shopname?>">
<input type="hidden" name="shopmail" value="<?echo $shopmail?>">
<input type="hidden" name="content" value="<?echo $content?>">
<input type="hidden" name="keyset" value="<?echo $keyset?>">
<input type="hidden" name="searchword" value="<?echo $searchword?>">
<input type="hidden" name="grp_no" value="<?echo $grp_no?>">
						
				<tr>     
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				<table border="0" width="97%">     
					<tr>     
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">     
							<tr>     
								<td width="14%" bgcolor="#C8DFEC" align="left">
									날짜</td>     
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?echo date("Y-m-d")?></td>     
							</tr>     
							<tr>     
								<td width="14%" bgcolor="#C8DFEC" align="left">
									보내는	이</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?echo $shopname?></td>      
							</tr>      
							<tr>      
								<td width="14%" bgcolor="#C8DFEC" align="left">
									보내는 이메일</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?echo $shopmail?></td>      
							</tr>      
							<?
							if(!empty($grp_no)){
								
								$SQL = "select * from $Member_GroupTable where grp_no='$grp_no' and mart_id='$mart_id'";
									 $dbresult = mysql_query($SQL,$dbconn);
									 mysql_data_seek($dbresult,0);
											$ary = mysql_fetch_array($dbresult);
											$grp_no = $ary["grp_no"];
											$grp_name = $ary["grp_name"];
										$grp_detail = $ary["grp_detail"];
										$area_use = $ary["area_use"];
										$sex_use = $ary["sex_use"];
										$age_use = $ary["age_use"];
										$login_use = $ary["login_use"];
										$money_use = $ary["money_use"];
										$bonus_use = $ary["bonus_use"];
										$area = $ary["area"];
										$sex = $ary["sex"];
										$age_from = $ary["age_from"];
										$age_to = $ary["age_to"];
										$login_from = $ary["login_from"];
										$login_to = $ary["login_to"];
										$money_from = $ary["money_from"];
										$money_to = $ary["money_to"];
										$bonus_from = $ary["bonus_from"];
										$bonus_to = $ary["bonus_to"];
										  
										  $today_year = date("y") + 100;
														
											$SQL1 = "select count(*) from $MemberTable where mart_id='$mart_id' and perms='3'";
											$SQL_AREA = " and binary address like '%$area%' ";
											$SQL_SEX = " and substring(passport2,1,1) ='$sex'";
											$SQL_AGE = " and ($today_year - substring(passport1,1,2)*1) between $age_from and $age_to ";
											$SQL_LOGIN = " and login_count between $login_from and $login_to ";
											$SQL_MONEY = " and money_total between $money_from and $money_to ";
											$SQL_BONUS = " and bonus_total between $bonus_from and $bonus_to ";
											
											$SQL2 = " and if_maillist='1'";
													
											if($area_use == '1')
												$SQL1 = $SQL1.$SQL_AREA;
											if($sex_use == '1')
												$SQL1 = $SQL1.$SQL_SEX;
											if($sex_use == '1')
												$SQL1 = $SQL1.$SQL_SEX;
											if($age_use == '1')
												$SQL1 = $SQL1.$SQL_AGE;
											if($login_use == '1')
												$SQL1 = $SQL1.$SQL_LOGIN;
											if($money_use == '1')
												$SQL1 = $SQL1.$SQL_MONEY;
											if($bonus_use == '1')
												$SQL1 = $SQL1.$SQL_BONUS;				
										
										$dbresult1 = mysql_query($SQL1, $dbconn);
											$numRows1 = mysql_result($dbresult1,0,0);
											
											$SQL3 = $SQL1.$SQL2;
											$dbresult3 = mysql_query($SQL3, $dbconn);
											$numRows3 = mysql_result($dbresult3,0,0);
											
											$email_list = "$grp_name 회원에게 발송합니다. ( 메일 수신 허용 : <font color='#FF0000'>$numRows3</font> / 전체 : $numRows1 명) ";		
							}
							else{
								if($keyset == '' && $searchword == '') {
												$SQL = "select * from $MemberTable where mart_id='$mart_id' and perms='3'";
												$dbresult = mysql_query($SQL, $dbconn);
												$numRows = mysql_num_rows($dbresult);
												
												$SQL = "select * from $MemberTable where mart_id ='$mart_id' and perms='3'";
												$dbresult = mysql_query($SQL, $dbconn);
												$numRows1 = mysql_num_rows($dbresult);
												$email_list = "전체 회원에게 발송합니다. ( 메일 수신 허용 : <font color='#FF0000'>$numRows1</font> / 전체 : $numRows 명) ";		
											}
											else{
												$SQL = "select * from $MemberTable where $keyset like '%$searchword%' and mart_id='$mart_id' and perms='3'";
												$dbresult = mysql_query($SQL, $dbconn);
												$numRows = mysql_num_rows($dbresult);
												$email_list = "";		
												for ($i=0; $i < $numRows; $i++) {
													mysql_data_seek($dbresult,$i);
													$ary = mysql_fetch_array($dbresult);
													$email = $ary["email"];
													if($email!=''&&check_email($email)){
														if($email_list == '') $email_list = $email;
														else $email_list = $email_list.",".$email;
													}
												}
											}
										}	
										?>
										<tr>
								<td width="14%" bgcolor="#C8DFEC" align="left">
									받는 이</td>
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?echo $email_list?></td>
							</tr>
							
							<tr>      
								<td width="14%" bgcolor="#C8DFEC" align="left">
									제목</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									
									<input name="subject" size="67" class="input_03">
									&nbsp;
									</td>      
							</tr>      
							<tr>      
								<td width="62%" bgcolor="#C8DFEC" align="left" colspan="2">    
										<p align="center">내 용</td>      
							</tr>         
							<tr>      
								<td width="51%" bgcolor="#FFFFFF" align="left" colspan="2" class="aa">    
										<p align="center">
										<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
										<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력<br>
										<OBJECT id=editBox data=../editor/Editorx.htm width=530 height=350 type=text/x-scriptlet></OBJECT>    
										</p>    
								</td>      
							</tr>      
							</table>      
						</td>
					</tr>
				<tr>      
					<td width="100%" bgcolor="#FFFFFF" height="35" align="center">
						<?
						if($Mall_Admin_ID == 'test' ||$Mall_Admin_ID == 'guest1'){
							echo "<input onclick='cant_send()' class='aa' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='전송'>&nbsp;";   
						}
						else{
							$SQL = "select * from $Email_ResTable where mart_id='$mart_id'";
							$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if($numRows > 0)
								echo "<input onclick='cant_send1()' class='aa' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='전송'>&nbsp;";
								else
							echo "<input class='aa' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='submit' value='전송'>&nbsp;";
						}
						?>
						<input onclick = 're_init()' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="재입력">&nbsp;
						<input onclick = "window.location.href='member_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로">
					</td>
				</tr>
</form>
				</table>
			</td>
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
}else{
	
	$SQL = "select * from $Email_ResTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);	
	/*if($numRows > 0){
		echo "
		<script>
		alert(\"이미 예약된 메일이 있어 메일을 보내실 수 없습니다.\\n메일은 하루에 한통 보내실 수 있습니다.\")
		history.go(-1);
		</script>
		";
		exit;
	}*/	
	
	if(strlen($content)>122400){
		echo "
		<script>
		alert(\"메일 내용은 100k를 넘을수 없습니다.\");
		history.go(-1);
		</script>
		";
		exit;
	}	
	
	if(!empty($grp_no)){
	 $SQL = "select * from $Member_GroupTable where grp_no='$grp_no' and mart_id='$mart_id'";
	 $dbresult = mysql_query($SQL,$dbconn);
	 mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$grp_no = $ary["grp_no"];
		$grp_name = $ary["grp_name"];
		$grp_detail = $ary["grp_detail"];
		$area_use = $ary["area_use"];
		$sex_use = $ary["sex_use"];
		$age_use = $ary["age_use"];
		$login_use = $ary["login_use"];
		$money_use = $ary["money_use"];
		$bonus_use = $ary["bonus_use"];
		$area = $ary["area"];
		$sex = $ary["sex"];
		$age_from = $ary["age_from"];
		$age_to = $ary["age_to"];
		$login_from = $ary["login_from"];
		$login_to = $ary["login_to"];
		$money_from = $ary["money_from"];
		$money_to = $ary["money_to"];
		$bonus_from = $ary["bonus_from"];
		$bonus_to = $ary["bonus_to"];
	  
		$today_year = date("y") + 100;
					
		$SQL1 = "select email from $MemberTable where mart_id='$mart_id' ";
		$SQL_AREA = " and binary address like '%$area%' ";
		$SQL_SEX = " and substring(passport2,1,1) ='$sex'";
		$SQL_AGE = " and ($today_year - substring(passport1,1,2)*1) between $age_from and $age_to ";
		$SQL_LOGIN = " and login_count between $login_from and $login_to ";
		$SQL_MONEY = " and money_total between $money_from and $money_to ";
		$SQL_BONUS = " and bonus_total between $bonus_from and $bonus_to ";
		$SQL2 = " and if_maillist='1'";
				
		if($area_use == '1')
			$SQL1 = $SQL1.$SQL_AREA;
		if($sex_use == '1')
			$SQL1 = $SQL1.$SQL_SEX;
		if($sex_use == '1')
			$SQL1 = $SQL1.$SQL_SEX;
		if($age_use == '1')
			$SQL1 = $SQL1.$SQL_AGE;
		if($login_use == '1')
			$SQL1 = $SQL1.$SQL_LOGIN;
		if($money_use == '1')
			$SQL1 = $SQL1.$SQL_MONEY;
		if($bonus_use == '1')
			$SQL1 = $SQL1.$SQL_BONUS;				
		
		$SQL3 = $SQL1.$SQL2;
		$dbresult3 = mysql_query($SQL3, $dbconn);
		$numRows3 = mysql_num_rows($dbresult3);
		$email_list = '';
		$email_count = 0;		
		for ($i=0; $i < $numRows; $i++) {
			$email = $msyql_result($dbresult3,$i,0);
			if($email!=''&&check_email($email)){
				$email_count++;
				if($email_list == '') $email_list = $email;
				else $email_list = $email_list.",".$email;
			}
		}
	}else{
	  if($keyset == '' && $searchword == '') 
			$SQL = "select * from $MemberTable where mart_id='$mart_id' and perms='3'";
		else
			$SQL = "select * from $MemberTable where $keyset like '%$searchword%' and mart_id='$mart_id' and perms='3'";
		
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		$email_list = '';
		$email_count = 0;		
		for ($i=0; $i < $numRows; $i++) {
			mysql_data_seek($dbresult,$i);
			$ary = mysql_fetch_array($dbresult);
			$email = $ary["email"];
			$content = $content;
			$result= mail("$email", "$subject", "$content", "From: $shopname<$shopmail>\nContent-type: text/html");
			
			if($email!=''&&check_email($email)){
				$email_count++;
				if($email_list == '') $email_list = $email;
				else $email_list = $email_list.",".$email;
			}
		}
	}
	/*
	$SQL1 = "insert into $Email_ResTable (mart_id, email_list, subject, shopname, shopmail, content) 
	values ('$mart_id', '$email_list', '$subject', '$shopname', '$shopmail', '$content')";
	$dbresult1 = mysql_query($SQL1, $dbconn);*/
	
	if( $result ){
		echo ("
			<script>
			alert('$email_count 통의 메일이 발송되었습니다.');
			</script>
		");
	}else{
		echo ("
			<script>
			alert('메일 발송에 실패했습니다.');
			history.go(-1);
			</script>
		");
	}

	if(!empty($grp_no))
	echo "<meta http-equiv='refresh' content='0; URL=mem_grp_mem_list.php?grp_no=$grp_no'>";
	else
	echo "<meta http-equiv='refresh' content='0; URL=inmall_member_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>