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
                <td><!--���� �ٵ�--><link rel=stylesheet type=text/css href="/css/css.css">

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
99 ���� 
1 ���̵� ���� ���� 
2 �н����尡 ���� ���� 
3 �޴»�� ��ȭ��ȣ�� ���� ���� 
4 �������� ��ȭ��ȣ�� ���� ���� 
5 ���޳����� ���� ���� 
6 �޴� �����ȭ��ȣ�� �߸��Ǿ� ���� 
7 ���̵�� �н����尡 Ʋ�� 
8 �ܾ׺��� 
*/

if($result_code == 99){
	echo "[�߼ۼ���]���ڸ޼��� �߼��� �����Ǿ����ϴ�";
}else if($result_code == 1){
	echo "[�߼۽���]���̵� ���� �ֽ��ϴ� ";
}else if($result_code == 2){
	echo "[�߼۽���]�н����尡 ���� �ֽ��ϴ� ";
}else if($result_code == 3){
	echo "[�߼۽���]�޴»�� ��ȭ��ȣ�� ���� �ֽ��ϴ�";
}else if($result_code == 4){
	echo "[�߼۽���]�������� ��ȭ��ȣ�� ���� �ֽ��ϴ� ";
}else if($result_code == 5){
	echo "[�߼۽���]���޳����� ���� �ֽ��ϴ� ";
}else if($result_code == 6){
	echo "[�߼۽���]�޴� �����ȭ��ȣ�� �߸��Ǿ� �ֽ��ϴ� ";
}else if($result_code == 7){
	echo "[�߼۽���]���̵�� �н����尡 Ʋ���ϴ� ";
}else if($result_code == 8){
	echo "[�߼۽���]�ܾ��� �����մϴ�";
}
?></b>						
			<BR><BR>			
		<input type="button" value="Ȯ��" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" onclick="javascript:location.href='./sms_send.php';">		
						
						
						
						
			</td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<? include("admin.footer.php"); ?>
                </BODY>
</HTML>
