<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

include "../include/getmartinfo.php";

//================== 업로드 함수 불러옴 ==================================================
include "../upload.php";
$upload_dir = "$UploadRoot$mart_id/";

if($flag == "adduser"){
	$SQL = "select username from $Mart_Member_NewTable where mart_id='$mart_id' and username='$username'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		echo ("
			<script language=javascript>
				alert(\"이미 존재하는 ID입니다.\\n\\n 다른 ID를 입력해주세요.\");
			</script>
			<form name='form' action='join.html' method='post'>
				<input type='hidden' name='mart_id' value='$mart_id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='passport1' value='$passport1'>
				<input type='hidden' name='passport2' value='$passport2'>
				<input type='hidden' name='email' value='$email'>
				<input type='hidden' name='tel_1' value='$tel_1'>
				<input type='hidden' name='tel_2' value='$tel_2'>
				<input type='hidden' name='tel_3' value='$tel_3'>
				<input type='hidden' name='tel1_1' value='$tel1_1'>
				<input type='hidden' name='tel1_2' value='$tel1_2'>
				<input type='hidden' name='tel1_3' value='$tel1_3'>
				<input type='hidden' name='zip' value='$zip'>
				<input type='hidden' name='address' value='$address'>
				<input type='hidden' name='address_d' value='$address_d'>
				<input type='hidden' name='partner' value='$partner'>
				<input type='hidden' name='msg' value='$msg'>
				<input type='hidden' name='job' value='$job'>
				<input type='hidden' name='com_name' value='$com_name'>
				<input type='hidden' name='homepage' value='$homepage'>
				<input type='hidden' name='hobby' value='$hobby'>
				<input type='hidden' name='religion' value='$religion'>
				<input type='hidden' name='ext1_content' value='$ext1_content'>
				<input type='hidden' name='ext2_content' value='$ext2_content'>
				<input type='hidden' name='ext3_content' value='$ext3_content'>
				<input type='hidden' name='ext4_content' value='$ext4_content'>
				<input type='hidden' name='sel_content' value='$sel_content'>
				<input type='hidden' name='if_maillist' value='$if_maillist'>
			</form>
			<script>
			document.form.submit();
			</script>
		");
		exit;
	}

	$SQL = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		$member_confirm = mysql_result($dbresult, 0, "member_confirm");
		$bonus_ok = mysql_result($dbresult, 0, "bonus_ok");
	}
	
	if($member_confirm == 0){
		$is_member = 1;
	}
	if($member_confirm == 1){
		$is_member = 0;
	}

	if( $memberimg_name ){//첨부 파일을 업로드함
		$file = FileUploadName( "", "$upload_dir", $memberimg, $memberimg_name );
	}
	
	$uid = md5(uniqid($hash_secret));
	$date = date("Ymd H:i:s");
	$date1 = date("Y-m-d H:i:s");
	$date2 = date("Y-m");
	$date3 = date("Y-m-d");
	$perms = "10";//회원 등급

	$tel = $tel_1."-".$tel_2."-".$tel_3;
	$tel1 = $tel1_1."-".$tel1_2."-".$tel1_3;

	$encode_password = get_password_str($password);

	$SQL = "insert into $Mart_Member_NewTable (uid, mart_id, username, password, perms, name, passport1, passport2, email, tel, tel1, zip, address, address_d, date, partner, is_member, msg, job, com_name, homepage, hobby, religion, ext1_content, ext2_content, ext3_content, ext4_content,sel_content,if_maillist, member_img) values ('', '$mart_id', '$username', '$encode_password', '$perms', '$name', '$passport1', '$passport2','$email', '$tel', '$tel1', '$zip', '$address', '$address_d', '$date', '$partner', '$is_member', '$msg', '$job', '$com_name', '$homepage', '$hobby', '$religion', '$ext1_content', '$ext2_content', '$ext3_content', '$ext4_content', '$sel_content','$if_maillist', '$file')";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";

	if($init_bonus > 0 && $bonus_ok == 't'){ //적립금 사용할때만 지급
		$write_date = date("Ymd H:i:s");
		$content = "회원가입 적립금"; 
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) ".
		"values ('$mart_id', '$username', '$write_date', '$init_bonus', '$content', 'j')";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total + $init_bonus 
		where username='$username' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}		
	
	//sms보내기
	/**if($if_join_msg == '1'||$if_join_msg_admin == '1'){
		include "../../admin/sms/class.sms.php";
		$SMS = new SMS;
		$SMS->SMS_Login($sms_user,$sms_passwd);
		if($if_join_msg == '1'){
		
			$callback = "$callback_num1$callback_num2$callback_num3";		
			$join_msg = str_replace('[SHOP_NAME]',$mart_name,$join_msg); 
			$join_msg = str_replace('[MEM_NAME]',$name,$join_msg); 
			$sms_client_num = str_replace('-','',$tel1); 

			$SMS->Add($sms_client_num,"$callback","$mart_name","$join_msg","");
		}	
		
		if($if_join_msg_admin == '1'){
		
			$callback = "$callback_num1$callback_num2$callback_num3";		
			$admin_num = "$admin_num1$admin_num2$admin_num3";
			$join_msg_admin = str_replace('[SHOP_NAME]',$mart_name,$join_msg_admin); 
			$join_msg_admin = str_replace('[MEM_NAME]',$name,$join_msg_admin); 

			$SMS->Add($admin_num,"$callback","$mart_name","$join_msg_admin","");
		}
		
		$result = $SMS->Send();
		if ($result) {
			//echo "SMS 서버에 접속했습니다.<br>";
			$success = $fail = 0;
			foreach($SMS->Result as $result) {
				list($phone,$code)=explode(":",$result);
				if ($code=="Error") {
					//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
					$fail++;
				} else {
					//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
					$success++;
				}
			}
			//echo $success.'건을 전송했으며'.$fail.'건을 보내지 못했습니다.';
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		else echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
	}**/
	//if($if_joinmail == '1' && !empty($email)){
		
		$filename = "$Co_img_UP$mart_id/self_design_joinmail";
		
		if($if_self_design_joinmail == 1 && file_exists($filename)){
		
			$fp = fopen($filename,"r");
			$self_design_joinmail = fread($fp, filesize ($filename));
			$mailcontent = $self_design_joinmail;
		}else{
			$mailcontent = "
	<html>
	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
	<title>회원가입 확인메일</title>
	<style type='text/css'>
	<!--
	.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
	.bb {  line-height: 13pt; font-size: 9pt; color: #6B6B6B}
	.ff { font-size: 8pt; color: #6B6B6B}
	.cc {  font-size: 9pt; color: #FF9418}
	.dd {  font-size: 9pt; color: #ffffff}
	.ee {  font-size: 9pt; color: #2F7C99}
	input { BORDER: #acacac 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #eeeeee}
	
	A            {font-size: 9pt;line-height: 12pt;text-decoration: none;color: #000000 }
	 A:hover      {text-decoration: none;  }  -->
	</style>
	</head>
	
	<body>
	
	<table border='0' width='670' cellpadding='3'>
	  <tr>
	    <td width='638' bgColor='#FFFFFF'>
	    <table border='5' width='100%' bordercolor='#E0E0E0' cellspacing='0'>
	      <tr>
	        <td width='100%'><table border='0' width='100%' cellspacing='0' cellpadding='0'>
	          <tr>
	            <td width='100%' bgcolor='#6489C4' height='30'><p align='right'>&nbsp; <span class='dd'>회원가입 
	            확인메일&nbsp;&nbsp; </span></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#F1F1F1' height='1'></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#FFFFFF' height='10'></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#FFFFFF' height='20'><p align='center'>&nbsp;<img src='http://$HTTP_HOST/market/images/top1.gif'
	            width='380' height='57' alt='top1.gif (3325 bytes)'></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#FFFFFF' height='20'><div align='center'><center><table
	            border='0' width='90%' bgcolor='#EBEBEB' cellspacing='0' cellpadding='0'>
	              <tr>
	                <td width='100%' bgcolor='#DBDBDB'></td>
	              </tr>
	            </table>
	            </center></div></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#ffffff' height='62'><div align='center'><center><table
	            border='0' width='90%' cellspacing='0' cellpadding='0'>
	              <tr>
	                <td width='100%' height='10'><span class='aa'></span></td>
	              </tr>
	              <tr>
	                <td width='100%'><span class='aa'>안녕하세요!&nbsp; [name]고객님<br>
	                <br>
	                저희 [shopname]쇼핑몰의 한가족이 되셨습니다.^*^<br>
	                <br>
	                앞으로 저희는 [name]님께 안전하고 우수한 서비스를 드리기 위해 
	                최선을 다할 것을 약속드립니다. <br>
	                다시 한번 회원으로 가입해주심을 감사드립니다.<br>
	                <br>
	                언제나 [name]님 곁에서 함께하며 행복을 드리는 [shopname]쇼핑몰이 되기 위해 
	                열심히 뛰겠습니다. <br>
	                계속 지켜봐 주세요.<br>
	                <br>
	                아이디 : </span><span class='ee'><b>[id]</b></span><span
	                class='aa'> / 비밀번호 :</span><b><span class='cc'> </span><span class='ee'>[password]</span></b></td>
	              </tr>
	              <tr>
	                <td width='100%' height='10'></td>
	              </tr>
	              <tr>
	                <td width='100%' height='10'></td>
	              </tr>
	            </table>
	            </center></div></td>
	          </tr>
	        </table>
	        </td>
	      </tr>
	    </table>
	    </td>
	  </tr>
	</table>
	
	<table border='0' width='678'>
	  <tr>
	    <td width='638' bgColor='#FFFFFF'><table border='5' width='100%' bordercolor='#E0E0E0'
	    cellspacing='0'>
	      <tr>
	        <td width='100%' height='40'><p align='center'><span class='ee'><b>[shopname]쇼핑몰 
	        고객센터</b> : 전화) [tel], email : [email] </span></td>
	      </tr>
	    </table>
	    </td>
	  </tr>
	  <tr>
	    <td width='100%'><span class='aa'><br>
	    </span></td>
	  </tr>
	</table>
	</body>
	</html>
			";
		}
		//echo $shopname;
		$mailcontent = str_replace('[shopname]',$shopname,$mailcontent); 
		$mailcontent = str_replace('[name]',$name,$mailcontent); 
		$mailcontent = str_replace('[id]',$username,$mailcontent); 
		$mailcontent = str_replace('[password]',$password,$mailcontent); 
		$mailcontent = str_replace('[tel]',$shoptel1,$mailcontent); 
		$mailcontent = str_replace('[email]',$shopemail,$mailcontent); 
	  
		$result = mail($email, "회원가입을 축하합니다.", "$mailcontent", "From: $shopname<$shopemail>\nContent-type: text/html");

		if( !$result ){
			echo "
				<script>
				window.alert('회원 가입 축하 이메일을 보내는데 실패했습니다.');
				</script>
			";
		}
	//}
	
	//==================== 해당 정보로 로그인 함 =========================================
	$UnameSess   = $username;
	$MemberLevel  = $perms;
	$MemberName  = $name;
	$MemberEmail  = $email;
	if($is_member){
		//session_register("UnameSess");
		//session_register("MemberLevel");
		//session_register("MemberName");
		//session_register("MemberEmail");
		$_SESSION["UnameSess"] = $username;
		$_SESSION["MemberLevel"] = $perms;
		$_SESSION["MemberName"] = $name;
		$_SESSION["MemberEmail"] = $email;

		//==================== 회원 정보가 맞다면 접속시간을 저장함 ======================
		$sql = "update $Mart_Member_NewTable set login_date='$date1', login_count=login_count+1 where username='$username'";
		$res = mysql_query( $sql, $dbconn );
	}

	echo "<meta http-equiv='refresh' content='0; URL=join_ok.html'>";
}

mysql_close($dbconn);
?>