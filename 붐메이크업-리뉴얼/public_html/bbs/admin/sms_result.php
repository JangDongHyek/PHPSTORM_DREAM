<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <link href="../admin/admin.css" rel="stylesheet" type="text/css">
  <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
  </style>
</HEAD>

 <BODY>
<table width="744" border="0" cellspacing="0" cellpadding="0">

              
              <tr>
                <td><!--메일 바디--><link rel=stylesheet type=text/css href="/css/css.css">

</head>

<body>
<form name='signform' method='post' action='./sms_send_process.php' >
<input type=hidden name='mode' value=''>
<input type=hidden name='delmsgnum' value=''>
<input type=hidden name='allPhone' value=''>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td bgcolor="#E2D7E3"><img src="images/admin_main.jpg" width="1000" height="136" /></td>
    </tr>
    <tr>
      <td height="9"></td>
    </tr>
  </table>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
 
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="205" rowspan="2" valign="top"><? include 'menu.php'; ?></td>
          <td width="796" valign="top"><img src="images/sms_title.gif" width="789" height="40"></td>
          <th rowspan="2">&nbsp;</th>
        </tr>
        <tr>
          <td valign="top" align="center">
            
						
						
<B>						
<?
/*
99 성공 
1 아이디가 빠져 있음 
2 패스워드가 빠져 있음 
3 받는사람 전화번호가 빠져 있음 
4 연락받을 전화번호가 빠져 있음 
5 전달내용이 빠져 있음 
6 받는 사람전화번호가 잘못되어 있음 
7 아이디와 패스워드가 틀림 
8 잔액부족 
*/

if($result_code == 99){
	echo "[발송성공]문자메세지 발송이 성공되었습니다";
}else if($result_code == 1){
	echo "[발송실패]아이디가 빠져 있습니다 ";
}else if($result_code == 2){
	echo "[발송실패]패스워드가 빠져 있습니다 ";
}else if($result_code == 3){
	echo "[발송실패]받는사람 전화번호가 빠져 있습니다";
}else if($result_code == 4){
	echo "[발송실패]연락받을 전화번호가 빠져 있습니다 ";
}else if($result_code == 5){
	echo "[발송실패]전달내용이 빠져 있습니다 ";
}else if($result_code == 6){
	echo "[발송실패]받는 사람전화번호가 잘못되어 있습니다 ";
}else if($result_code == 7){
	echo "[발송실패]아이디와 패스워드가 틀립니다 ";
}else if($result_code == 8){
	echo "[발송실패]잔액이 부족합니다";
}
?></b>						
			<BR><BR>			
		<input type="button" value="확인" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" onclick="javascript:location.href='./sms_send.php';">		
						
						
						
						
			</td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<? include("admin.footer.php"); ?>
                </BODY>
</HTML>
