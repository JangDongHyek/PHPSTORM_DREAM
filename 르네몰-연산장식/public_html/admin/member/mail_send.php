<?
include "../lib/Mall_Admin_Session.php";

include "../admin_head.php";

require_once("../../phpmailer/class.phpmailer.php");


if($mail_type == "suntak"){
	for($i=0; $i<sizeof($loan_number); $i++){
		$query = "select * from $Mart_Member_NewTable where mart_id='$mart_id' and username='$loan_number[$i]' and if_maillist='1'";
		$result	=	mysql_query($query,$dbconn);
		$rows	=	mysql_fetch_array($result);

		if($rows[email] != "@"){
			if($SEL){
				$SEL .= ",";
			}
			$SEL .= $rows[email];
		}
	}
}
?>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
if(!$username)
{
	$left_menu = "5";
	include "../include/left_menu_layer.php"; 
}
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>
<script>
/*var blnBodyLoaded = false;
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
}*/


function checkform(f){
	if(f.subject.value == ""){
		alert("제목을 입력하세요.");
		f.subject.focus();
		return false;
	}
//	f.editBox.editmode = "html";
//	f.content.value = f.editBox.html;
	oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	var content=oEditors.getById["content"].getIR();
	content=content.replace("<P>&nbsp;</P>","");
	if (content== "" ){ 
		 alert("내용을 입력하세요."); 
		 oEditors.getById["content"].exec("FOCUS", []); 
		return false;
	}
	f.submit();	


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
</head>
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
if ($flag == "") {
	$SQL = "select * from $Email_ResTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);	
	/*if($numRows > 0){
		echo "
		<script>
		alert(\"이미 예약된 메일이 있어 메일을 보내실 수 없습니다.\\n메일은 하루에 한통 보내실 수 있습니다.\")
		history.go(-1)
		</script>
		";
		exit;
	}*/
?>
<script src="../../editor/easyEditor.js"></script>
		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center" style="table-layout:fixed">
			<tr>
				<td width="90%" bgcolor="#FFFFFF"><b>&nbsp;&nbsp; [전체회원 이메일 발송]</b>   <br> 
					</font>
			</td>       
			</tr>       
			<form action='mail_send.php' name="writeform" method="post" onsubmit='return checkform(this)'>
			<input type="hidden" name="flag" value="send">
			<input type="hidden" name="shopname" value="<?=$shopname?>">
			<input type="hidden" name="shopmail" value="<?=$shopmail?>">
			<!-- <input type="hidden" name="content" value="<?=$content?>"> -->
			<input type="hidden" name="keyset" value="<?=$keyset?>">
			<input type="hidden" name="searchword" value="<?=$searchword?>">
			<input type="hidden" name="grp_no" value="<?=$grp_no?>">
			<input type="hidden" name="grp_no" value="<?=$grp_no?>">
			<input type="hidden" name="SEL" value="<?=$SEL?>">
			<input type="hidden" name="mail_type" value="<?=$mail_type?>">
			<input type="hidden" name="mem_grade_search" value="<?=$mem_grade_search?>">

			
			<tr>     
				<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				<table border="0" width="97%" style="table-layout:fixed">     
					<tr>     
						<td width="100%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">     
							<tr>     
								<td width="14%" bgcolor="#C8DFEC" align="left">
									날짜</td>     
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?=date("Y-m-d")?></td>     
							</tr>     
							<tr>     
								<td width="14%" bgcolor="#C8DFEC" align="left">
									보내는	이</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?=$shopname?></td>      
							</tr>      
							<tr>      
								<td width="14%" bgcolor="#C8DFEC" align="left">
									보내는 이메일</td>      
								<td width="48%" bgcolor="#FFFFFF" align="left">
									<?=$shopmail?></td>      
							</tr>      
							<?
							if(!empty($grp_no)){								
											
							}
							else{ //전체,검색
											$loan_number_size = sizeof($loan_number);
											if($loan_number_size > 0){
														for($i=0; $i<sizeof($loan_number); $i++){
															$query = "select * from $Mart_Member_NewTable where mart_id='$mart_id' and username='$loan_number[$i]' and if_maillist='1'";
															$result	=	mysql_query($query,$dbconn);
															$rows	=	mysql_fetch_array($result);
															$email = $rows[email];
															if($email!=''&&check_email($email)){
																if($email_list == '') $email_list = $email;
																else $email_list = $email_list.",".$email;
															}
														}
											}
											else if($keyset == '' && $searchword == '' && $mail_type == "all") {
															$SQL = "select * from $Mart_Member_NewTable where mart_id='$mart_id'";
															$dbresult = mysql_query($SQL, $dbconn);
															$numRows = mysql_num_rows($dbresult);
															
															$SQL = "select * from $Mart_Member_NewTable where mart_id='$mart_id' and if_maillist='1'";
															$dbresult = mysql_query($SQL, $dbconn);
															$numRows1 = mysql_num_rows($dbresult);
															$email_list = "전체 회원에게 발송합니다. ( 메일 수신 허용 : <font color='#FF0000'>$numRows1</font> / 전체 : $numRows 명) ";		
											}											
											else if($mem_grade_search == 'y') {
												$SQL = "select * from $Mart_Member_NewTable where mem_grade='2' and mart_id='$mart_id' and if_maillist='1'";
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

											}else{
												$SQL = "select * from $Mart_Member_NewTable where $keyset like '%$searchword%' and mart_id='$mart_id' and if_maillist='1'";
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
									<?=$email_list?></td>
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
<!---------------------------------------------- 에디터 시작 ------------------------------------------------->
<script type="text/javascript" src="../../smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<input type='hidden' name='secontent' value=''>
<textarea name="content" id="content" rows="10" cols="100" style="width:100%; height:412px; display:none;"><?=$content?></textarea>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "../../smarteditor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		fOnBeforeUnload : function(){
			//alert("아싸!");	
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["content"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	alert(form.ir1.value);
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.



	try {
		return false;
		//elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["content"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>
<!---------------------------------------------- 에디터 끝 ------------------------------------------------->
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
						<br>
						※메일 발송시간이 오래 걸리므로 완료 메세지 나올때 까지 기다려 주시기 바랍니다.
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
}
else {
	
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
	 
	}else{
			$content = $content."<br><br><b>회신시 메일주소: $shopmail</b>";

			if($SEL){
					$sel_ex =explode(",",$SEL);
					$email_count = 0;		
					for($i=0;$i<sizeof($sel_ex);$i++){
						$email = $sel_ex[$i];
						$email_list = '';
						$content = stripslashes($content);
						$content = $content;

						$content = str_replace("</P>", "<br />", $content);
						$content = str_replace("<P>", "", $content);

						
						$email_count++;


				/*		$mail = new PHPMailer();
						$mail->ContentType = "text/html";
						$mail->CharSet = "euc-kr";
						$mail->Encoding = "base64";
						$mail->SMTPAuth = true; // turn on SMTP authentication
						$mail->Username = "itforyou0088@gmail.com"; // SMTP 사용자 이름
						$mail->Password = "3001jun3001"; // SMTP 비밀번호
						$webmaster_email = "$shopmail"; // 답변을 받을 이메일
						$email="$email"; // 받을 이메일
						$toname="$shopname"; // 받을 이름
						$mail->From = $email;
						$mail->FromName = "$shopname"; // 보내는 사람 이름
						$mail->AddAddress($email,$toname);
						$mail->AddReplyTo($webmaster_email,"Webmaster");
						$mail->WordWrap = 50; // set word wrap
						$mail->IsHTML(true); // HTML의 형식으로 보냄
						$mail->Subject = "$subject"; // 메일 이름
						$mail->Body = "$content"; // 내용
						$mail->AltBody = "$content";
						$mail->IsSMTP();
						$mail->Send();
						*/


?>
			<form name=f method=post action="./sample_mail_send.php">
			<input type=hidden name="from" value="<?=$shopmail?>">
			<input type=hidden name="from_name" value="<?=$shopname?>">
			<input type=hidden name="to" value="<?=$email?>">
			<input type=hidden name="to_name" value="<?=$shopname?>">
			<input type=hidden name="subject" value="<?=$subject?>">
			<input type=hidden name="content" value="<?=$content?>">
			</form>
			<script type="text/javascript">
			<!--
				document.f.submit();
			//-->
			</script>
<?





						if($email!=''&&check_email($email)){
							if($email_list == '') $email_list = $email;
							else $email_list = $email_list.",".$email;
						}
					}
		}else{
					if($keyset == '' && $searchword == '' && $mail_type == "all"){ 
						$SQL = "select * from $Mart_Member_NewTable where mart_id='$mart_id' and if_maillist='1'";
					}elseif($mem_grade_search == 'y'){
						$SQL = "select * from $Mart_Member_NewTable where mem_grade='2' and mart_id='$mart_id' and if_maillist='1'";
					}else{
						$SQL = "select * from $Mart_Member_NewTable where $keyset like '%$searchword%' and mart_id='$mart_id' and if_maillist='1'";
					}

					$dbresult = mysql_query($SQL, $dbconn);
					$numRows = mysql_num_rows($dbresult);
					$email_list = '';
					$email_count = 0;		
					for ($i=0; $i < $numRows; $i++) {
						mysql_data_seek($dbresult,$i);
						$ary = mysql_fetch_array($dbresult);
						$email = $ary["email"];
						$content = stripslashes($content);
						$content = $content;
		
		/*
						$mail = new PHPMailer();
						$mail->ContentType = "text/html";
						$mail->CharSet = "euc-kr";
						$mail->Encoding = "base64";
						$mail->SMTPAuth = true; // turn on SMTP authentication
						$mail->Username = "itforyou0088@gmail.com"; // SMTP 사용자 이름
						$mail->Password = "3001jun3001"; // SMTP 비밀번호
						$webmaster_email = "$shopmail"; // 답변을 받을 이메일
						$email="$email"; // 받을 이메일
						$toname="$shopname"; // 받을 이름
						$mail->From = $email;
						$mail->FromName = "$shopname"; // 보내는 사람 이름
						$mail->AddAddress($email,$toname);
						$mail->AddReplyTo($webmaster_email,"Webmaster");
						$mail->WordWrap = 50; // set word wrap
						$mail->IsHTML(true); // HTML의 형식으로 보냄
						$mail->Subject = "$subject"; // 메일 이름
						$mail->Body = "$content"; // 내용
						$mail->AltBody = "$content";
						$mail->IsSMTP();
						$mail->Send();

*/
?>

			<form name=f method=post action="./sample_mail_send.php">
			<input type=hidden name="from" value="<?=$shopmail?>">
			<input type=hidden name="from_name" value="<?=$shopname?>">
			<input type=hidden name="to" value="<?=$email?>">
			<input type=hidden name="to_name" value="<?=$shopname?>">
			<input type=hidden name="subject" value="<?=$subject?>">
			<input type=hidden name="content" value="<?=$content?>">
			</form>
			<script type="text/javascript">
			<!--
				document.f.submit();
			//-->
			</script>
<?
						
						if($email!=''&&check_email($email)){
							$email_count++;
							if($email_list == '') $email_list = $email;
							else $email_list = $email_list.",".$email;
						}
					}
		}

	}
	/*
	$SQL1 = "insert into $Email_ResTable (mart_id, email_list, subject, shopname, shopmail, content) 
	values ('$mart_id', '$email_list', '$subject', '$shopname', '$shopmail', '$content')";
	$dbresult1 = mysql_query($SQL1, $dbconn);*/
	if( $mail ){
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
	echo "<meta http-equiv='refresh' content='0; URL=member_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>
