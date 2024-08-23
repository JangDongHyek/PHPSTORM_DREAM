<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	$src[] = "/(\\\\')/";
	$tar[] = "'";
	$src[] = "/(\\\\\")/";
	$tar[] = "\"";
	$src[] = "/(\\\\\\\)/";
	$tar[] = "\\";
	$src[] = "/(\\\\\\\)/";
	$tar[] = "\\";
	$condition=preg_replace($src,$tar,$condition);
	
	if($mode!='')  {
		$content=stripslashes($content);
		$subject=stripslashes($subject);
		switch ($mode) {
			case 'preview' : 
				if($use_php=='1') {
					$src[] = "/(<"."\\?)/";
					$tar[] = "[";
					$src[] = "/(\\?".">)/";
					$tar[] = "]";
					$content=preg_replace($src,$tar,$content);
					$subject=preg_replace($src,$tar,$subject);
				}
				$content = rg_conv_text($content,$content_type);
				echo "<base href=\"about:blank\">";
				echo '제목 : <br>'.$subject."<br><br>";
				echo "내용 : <br>";
				echo $content;
				echo '<br><br><input type="button" onclick="self.close()" value=" 닫 기 " style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
				';
			break;
			case 'test' :
				$condition="SELECT * FROM $db_table_member WHERE mb_id='$test_id'";
			case 'checkall' :



					
					
					
					
					
					
					
					
					

				$send_content=$content;
				$send_subject=$subject;

					
					
					
					for($i=0; $i<sizeof($loan_number); $i++){
						$query = "select * from rg_member where mb_num='$loan_number[$i]' AND mb_mailing='1'";
						$result	=	mysql_query($query,$dbcon);
						$rows	=	mysql_fetch_array($result);

							rg_mail("$from_email","$rows[mb_email]","","",$send_subject,$send_content);
							echo $rows[mb_email].'<script>self.scrollBy(0, 50)</script><br>'."\n";
						
					}
				echo '메일발송완료<br>
        <input type="button" class="button1" onclick="self.close()" value=" 닫 기 "> 
				';




			break;


			case 'send' : 
				echo "<link href=\"../admin/admin.css\" rel=\"stylesheet\" type=\"text/css\">";
				// SELECT 문인지 확인한다.
				$is_select = eregi('^SELECT[[:space:]]+', $condition);
				if(!$is_select) {
					echo "올바른 조건이 아닙니다. SELECT문만 사용할수 있습니다.";
					exit;
				}
				// mb_email 필드가 있는지 확인한다.
				$rs = query($condition,$dbcon);
				$email_count=mysql_num_rows($rs);
				if($email_count==0) {
					echo "발송대상이 없습니다.";
					exit;
				}
				$data=mysql_fetch_assoc($rs);
				$tmp=array_keys($data);
				if(!in_array('mb_email',$tmp)) {
					echo "조건에 mb_email 필드가 존재해야 합니다.";
					exit;
				}
				echo '메일발송중(총 '.$email_count.' 건 발송중)
<br>'."\n";
				echo '<!---------------------------------------------------------->'."\n";
				echo '<!---------------------------------------------------------->'."\n";
				echo '<!---------------------------------------------------------->'."\n";
				echo '<!---------------------------------------------------------->'."\n";
				echo '<!---------------------------------------------------------->'."\n";
				$send_content=$content;
				$send_subject=$subject;
				ob_end_clean();
				do {
					$mb_email='';
					extract($data);
					if($use_php=='1') {
						ob_start();
						eval('?>'.$content.'<?');
						$send_content=ob_get_contents();
						ob_end_clean();
			
						ob_start();
						eval('?>'.$subject.'<?');
						$send_subject=ob_get_contents();
						ob_end_clean();
					}
					$send_content = rg_conv_text($send_content,$content_type);
					echo $mb_email.'<script>self.scrollBy(0, 50)</script><br>'."\n";
					flush();
					rg_mail("$from_email","$mb_email","","",$send_subject,$send_content);
				} while ($data=mysql_fetch_assoc($rs));
				echo '메일발송완료<br>
        <input type="button" class="button1" onclick="self.close()" value=" 닫 기 "> 
				';
			break;
		}
		exit;
	}

	if($test_id=='') $test_id=$mb[mb_id];
	if($from_email=='') $from_email=$site[st_email];

	if($condition=='' && !$pre_mode){
		$condition = "SELECT * FROM `$db_table_member`
WHERE (1=1) AND mb_mailing='1'";
	}
	eval("\$condition=\"$condition\";");
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Let's080 ver <?=$C_RGBOARD_VERSION?> - 관리자</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../admin/admin.css" rel="stylesheet" type="text/css">
<script src="./editor/easyEditor.js"></script>

</head>

<body>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">메일 
      발송 (대량의 메일을 발송하시려면 전문 메일발송프로그램을 이용하세요)</font></td>
  </tr>
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="mail_list" method="post" action="?">
<input name="mode" type="hidden" value="">
<?
for($j=0; $j<sizeof($loan_number); $j++){
	echo"<input type=hidden name=\"loan_number[]\" value=\"$loan_number[$j]\">";
}
?>  <tr>
    <td align="center">
        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td width="100" height="24" align="center" bgcolor="f0f0f0">발송자이메일</td>
            <td><input name="from_email" type="text" class="input1" id="from_email" value="<?=$from_email?>" size="80" required email itemname="발송자이메일"></td>
          </tr>
		  <input name="content_type" type="hidden" value="1" size="80">          
          <tr> 
            <td height="24" align="center" bgcolor="f0f0f0">제목</td>
            <td><input name="subject" type="text" class="input1" id="subject" value="<?=$subject?>" size="80" required itemname="이메일제목"></td>
          </tr>
          <tr> 
            <td align="center" bgcolor="f0f0f0">내용</td>
            <td><textarea name="content" id="content"><?=$content?></textarea></td>
          </tr>
          <tr> 
            <td align="center" bgcolor="#f0f0f0">발송조건</td>
            <td><textarea name="condition" cols="80" rows="4" class="input1" id="condition"><?=$condition?></textarea> 
              <br> <strong>&nbsp;<font color="#0000FF">mysql문으로 작성 하십시요</font></strong><br> 
              &nbsp;mb_mailing : 메일수신여부 1=&gt;수신,0=&gt;비수신<br> &nbsp;mb_id : 아이디 
              , mb_nick : 닉네임 , mb_name : 이름 , mb_email : 이메일<br> &nbsp;mb_sex 
              : 성별 , mb_job : 직업 , mb_hobby : 취미</td>
          </tr>
          <tr> 
            <td height="24" align="center" bgcolor="f0f0f0">테스트아이디</td>
            <td><input name="test_id" type="text" class="input1" id="test_id" value="<?=$test_id?>" size="30">
              <input type=button class=button1 onclick="popup_mb_list('mail_list', './','test_id','','','0')" value='회원선택'>(해당 아이디의 이메일로 메일이 발송됩니다.)<br>
              회원에게 보내기전 정상적으로 발송이 되는지 테스트 해보세요.<br>
            </td>
          </tr>
        </table>
				<br>
				<?
				if($pre_mode){
				?>
					<input type="button" class="button1" onclick="send_email_checkall()" value="메일발송"> 
					&nbsp; 
				<?
				}	else {
				?>
					<input type="button" class="button1" onclick="send_email()" value="메일발송">
					&nbsp; 
				<?
				}
				?>
				<input type="button" class="button1" onclick="send_test()" value="테스트발송">
        &nbsp;
				<input type="button" class="button1" onclick="preview()" value="미리보기">
        &nbsp;
        <input type="button" class="button1" onclick="self.close()" value=" 닫 기 "> 
      </td>
  </tr>
  <script>
		var ed = new easyEditor("content"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>
 </form>
</table>
<script language="JavaScript" type="text/JavaScript">
	var f = document.mail_list;
	function send_email_checkall()
	{


	var content = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
	if(content=="")
	{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
	}



		if(!f.onsubmit()) return false;
		if(!confirm('(메일발송이 완료될때까지 창을 닫지마세요.)')) return;
		f.mode.value="checkall";
		f.target="_self";
		f.action="?";
		f.submit();
	}
	function send_email()
	{
		if(!f.onsubmit()) return false;
		if(!confirm('발송조건에 따라 메일을 발송합니다.\n확실합니까?\n(메일발송이 완료될때까지 창을 닫지마세요.)')) return;
		f.mode.value="send";
		f.target="_self";
		f.action="?";
		f.submit();
	}
	function send_test()
	{
		if(!f.onsubmit()) return false;
		f.mode.value="test";
		window.open('','send_test','left=70,top=70,width=650,height=650,scrollbars=0');

		f.target="send_test";
		f.action="?";
		f.submit();
	}
	function preview()
	{
		if(!f.onsubmit()) return false;
		f.mode.value="preview";
		window.open('','mail_preview','left=70,top=70,width=650,height=650,scrollbars=1');

		f.target="mail_preview";
		f.action="?";
		f.submit();
//		mail_preview=window.open('','mail_preview','');
//		mail_preview.document.write(f.content.value);
	}
</script>
</body>
</html>
<script src="../admin/script.js"></script>