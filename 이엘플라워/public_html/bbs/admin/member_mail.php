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
				echo '���� : <br>'.$subject."<br><br>";
				echo "���� : <br>";
				echo $content;
				echo '<br><br><input type="button" onclick="self.close()" value=" �� �� " style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
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
				echo '���Ϲ߼ۿϷ�<br>
        <input type="button" class="button1" onclick="self.close()" value=" �� �� "> 
				';




			break;


			case 'send' : 
				echo "<link href=\"../admin/admin.css\" rel=\"stylesheet\" type=\"text/css\">";
				// SELECT ������ Ȯ���Ѵ�.
				$is_select = eregi('^SELECT[[:space:]]+', $condition);
				if(!$is_select) {
					echo "�ùٸ� ������ �ƴմϴ�. SELECT���� ����Ҽ� �ֽ��ϴ�.";
					exit;
				}
				// mb_email �ʵ尡 �ִ��� Ȯ���Ѵ�.
				$rs = query($condition,$dbcon);
				$email_count=mysql_num_rows($rs);
				if($email_count==0) {
					echo "�߼۴���� �����ϴ�.";
					exit;
				}
				$data=mysql_fetch_assoc($rs);
				$tmp=array_keys($data);
				if(!in_array('mb_email',$tmp)) {
					echo "���ǿ� mb_email �ʵ尡 �����ؾ� �մϴ�.";
					exit;
				}
				echo '���Ϲ߼���(�� '.$email_count.' �� �߼���)
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
				echo '���Ϲ߼ۿϷ�<br>
        <input type="button" class="button1" onclick="self.close()" value=" �� �� "> 
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
<title>Let's080 ver <?=$C_RGBOARD_VERSION?> - ������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../admin/admin.css" rel="stylesheet" type="text/css">
<script src="./editor/easyEditor.js"></script>

</head>

<body>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">���� 
      �߼� (�뷮�� ������ �߼��Ͻ÷��� ���� ���Ϲ߼����α׷��� �̿��ϼ���)</font></td>
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
            <td width="100" height="24" align="center" bgcolor="f0f0f0">�߼����̸���</td>
            <td><input name="from_email" type="text" class="input1" id="from_email" value="<?=$from_email?>" size="80" required email itemname="�߼����̸���"></td>
          </tr>
		  <input name="content_type" type="hidden" value="1" size="80">          
          <tr> 
            <td height="24" align="center" bgcolor="f0f0f0">����</td>
            <td><input name="subject" type="text" class="input1" id="subject" value="<?=$subject?>" size="80" required itemname="�̸�������"></td>
          </tr>
          <tr> 
            <td align="center" bgcolor="f0f0f0">����</td>
            <td><textarea name="content" id="content"><?=$content?></textarea></td>
          </tr>
          <tr> 
            <td align="center" bgcolor="#f0f0f0">�߼�����</td>
            <td><textarea name="condition" cols="80" rows="4" class="input1" id="condition"><?=$condition?></textarea> 
              <br> <strong>&nbsp;<font color="#0000FF">mysql������ �ۼ� �Ͻʽÿ�</font></strong><br> 
              &nbsp;mb_mailing : ���ϼ��ſ��� 1=&gt;����,0=&gt;�����<br> &nbsp;mb_id : ���̵� 
              , mb_nick : �г��� , mb_name : �̸� , mb_email : �̸���<br> &nbsp;mb_sex 
              : ���� , mb_job : ���� , mb_hobby : ���</td>
          </tr>
          <tr> 
            <td height="24" align="center" bgcolor="f0f0f0">�׽�Ʈ���̵�</td>
            <td><input name="test_id" type="text" class="input1" id="test_id" value="<?=$test_id?>" size="30">
              <input type=button class=button1 onclick="popup_mb_list('mail_list', './','test_id','','','0')" value='ȸ������'>(�ش� ���̵��� �̸��Ϸ� ������ �߼۵˴ϴ�.)<br>
              ȸ������ �������� ���������� �߼��� �Ǵ��� �׽�Ʈ �غ�����.<br>
            </td>
          </tr>
        </table>
				<br>
				<?
				if($pre_mode){
				?>
					<input type="button" class="button1" onclick="send_email_checkall()" value="���Ϲ߼�"> 
					&nbsp; 
				<?
				}	else {
				?>
					<input type="button" class="button1" onclick="send_email()" value="���Ϲ߼�">
					&nbsp; 
				<?
				}
				?>
				<input type="button" class="button1" onclick="send_test()" value="�׽�Ʈ�߼�">
        &nbsp;
				<input type="button" class="button1" onclick="preview()" value="�̸�����">
        &nbsp;
        <input type="button" class="button1" onclick="self.close()" value=" �� �� "> 
      </td>
  </tr>
  <script>
		var ed = new easyEditor("content"); //�ʱ�ȭ id�Ӽ���
		ed.init(); //�������� ����
</script>
 </form>
</table>
<script language="JavaScript" type="text/JavaScript">
	var f = document.mail_list;
	function send_email_checkall()
	{


	var content = ed.getHtml(); //��ü�� textarea�� �ۼ���HTML�� ����
	if(content=="")
	{
			alert("������ �����ּ���!");
			ed.focus();
			return false;
	}



		if(!f.onsubmit()) return false;
		if(!confirm('(���Ϲ߼��� �Ϸ�ɶ����� â�� ����������.)')) return;
		f.mode.value="checkall";
		f.target="_self";
		f.action="?";
		f.submit();
	}
	function send_email()
	{
		if(!f.onsubmit()) return false;
		if(!confirm('�߼����ǿ� ���� ������ �߼��մϴ�.\nȮ���մϱ�?\n(���Ϲ߼��� �Ϸ�ɶ����� â�� ����������.)')) return;
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