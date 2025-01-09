<!--
  셋팅 해야 할부분 
	1. succ_url = message_succ.php 가 있는 절대 경로를 적어 주시기 바랍니다.  -- 성공 하였을 경우 --
	2. fail_url = message_ fail.php 가 있는 절대 경로를 적어 주시기 바랍니다.       -- 실패 하였을 경우 --
	  예제)
		$succ_url = "http://sms.dacom.net:8055/message_succ.php";
		$fail_url = "http://sms.dacom.net:8055/message_fail.php";
	3. uid 서비스 ID 셋팅
	   예제)
		<input type = "hidden" name = "uid" value = "SM100000">  
-->

<?
	$succ_url = "http://multiall.co.kr/admin/sms/message_succ.php";
	$fail_url = "http://multiall.co.kr/admin/sms/message_fail.php";

	$time = $date.$hour.$min;   // 예약시간

	$array = explode(",",$group_name); // 호출번호 정리
	$arraycount = count($array);

	for($i=0; $i<$arraycount; $i++) { // 구분자 설정 
		if(strcmp($array[$i],"") != 0)
			$rec_phone = $rec_phone.trim($array[$i]).";";
	}
?>
<HTML>
<HEAD>
<TITLE> SMS 메세지 보내기 </TITLE>
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