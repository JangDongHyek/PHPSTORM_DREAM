<!--
  ���� �ؾ� �Һκ� 
	1. succ_url = message_succ.php �� �ִ� ���� ��θ� ���� �ֽñ� �ٶ��ϴ�.  -- ���� �Ͽ��� ��� --
	2. fail_url = message_ fail.php �� �ִ� ���� ��θ� ���� �ֽñ� �ٶ��ϴ�.       -- ���� �Ͽ��� ��� --
	  ����)
		$succ_url = "http://sms.dacom.net:8055/message_succ.php";
		$fail_url = "http://sms.dacom.net:8055/message_fail.php";
	3. uid ���� ID ����
	   ����)
		<input type = "hidden" name = "uid" value = "SM100000">  
-->

<?
	$succ_url = "http://multiall.co.kr/admin/sms/message_succ.php";
	$fail_url = "http://multiall.co.kr/admin/sms/message_fail.php";

	$time = $date.$hour.$min;   // ����ð�

	$array = explode(",",$group_name); // ȣ���ȣ ����
	$arraycount = count($array);

	for($i=0; $i<$arraycount; $i++) { // ������ ���� 
		if(strcmp($array[$i],"") != 0)
			$rec_phone = $rec_phone.trim($array[$i]).";";
	}
?>
<HTML>
<HEAD>
<TITLE> SMS �޼��� ������ </TITLE>
</HEAD>
<BODY>
	<FORM name = "form" method="post">
	<input type='hidden' name='to' value='sms'>
	<input type = "hidden" name = "uid" value = "SM104615">
	<input type = "hidden" name = "time" value = "<? echo "$time";?>">
	<input type = "hidden" name = "receiver" value = '<? echo "$rec_phone";?>'>
	<input type = "hidden" name = "sender" value = '<? echo "$phone";?>'>
	<input type = "hidden" name = "message" value = '<? echo "$to_message";?>'>

	<input type = "hidden" name = "returnurl" value = '<? echo "$succ_url";?>'>
	<input type = "hidden" name = "errorurl" value =  '<? echo "$fail_url";?>'>

	</FORM>
	<script language="JavaScript">
	<!--
		document.form.action="send.php";
		document.form.submit();
	//-->
	</script>
</body>
</html>