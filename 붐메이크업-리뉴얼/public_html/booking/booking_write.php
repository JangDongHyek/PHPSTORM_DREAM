<?
$id="confirm"; 
/*
$_zb_url = "http://www.pusanmakeup.com/bbs/"; //���κ��带 ��ġ�� �� ���
$_zb_path = "/home2/boom/public_html/bbs/"; //���κ��带 ��ġ�� ������(���κ��� ������ ���������� �� �� ����)
include $_zb_path."lib.php";
include $_zb_path."outlogin.php";

if(!$connect) $connect = dbconn();

if(!$member) $member = member_info();

	*/
	
	    $site_path = "/home/pusanmakeup/public_html/bbs/";
   $site_url = "./bbs/";
   require_once($site_path."include/lib.inc.php");

	//$newDb = new MysqlConnect;
	
	$sql = "SELECT MAX(NO) FROM TB_BOOKING";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	if($no) {		//�Ѿ���� �� ��ȣ�� ������ (����)
  		$sql = "SELECT * FROM TB_BOOKING WHERE NO=$no";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$subject = $row[SUBJECT];
		$email = $row[EMAIL];
		$passwd = $row[PASSWD];
		$writer = $row[WRITER];
		$content = $row[CONTENT];

		$bookdate = $row[BOOKDATE];
		$booktime = $row[BOOKTIME];
		$readonly = "readonly";

		if($bookdate) {
			$bookdate_yyyy = substr($bookdate,0,4);
			$bookdate_mm = substr($bookdate,4,2);
			$bookdate_dd = substr($bookdate,6,2);
		}
		if($booktime) {
			$booktime_hh = substr($booktime,0,2);
			$booktime_mm = substr($booktime,2,2);
		}
	}
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>���� ����</title>
<meta http-equiv="imagetoolbar" content="no">
<link href="../style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:0px;
	top:134px;
	width:285px;
	height:350px;
	z-index:1;
	visibility: visible;
}
#Layer2 {
	position:absolute;
	left:660px;
	top:134px;
	width:278px;
	height:191px;
	z-index:2;
	visibility: visible;
}
-->
</style>

<script language="javascript">
<!--
	var time = new Date()
	var year = time.getYear()
	var month = time.getMonth() + 1
	var day = time.getDate()

	year = year.toString();
	if(month < 10 == 1) {
		month = "0"+month.toString();
	} else {
		month = month.toString();
	}
	if(day < 10) {
		day = "0"+day.toString();
	} else {
		day = day.toString();
	}

    function allblur() {
         for (i = 0; i < document.links.length; i++)
              document.links[i].onfocus = document.links[i].blur;
    }

	function sendForm() {
		var form= window.frm;
		var sendVal;
		
		if(form.writer.value == "") {
			alert("�ۼ��ڸ� �Է��ϼ���");
			form.writer.focus();
			return;
		}
		if(form.passwd.value == "") {
			alert("��й�ȣ�� �Է��ϼ���");
			form.passwd.focus();
			return;
		}
		if(form.subject.value == "") {
			alert("�������� �Է��ϼ���");
			form.subject.focus();
			return;
		}

		//�Է��� ���� iframe���� �ѱ�
		sendVal="<input type='hidden' name='no' value='<?= $no ?>'>";
		sendVal=sendVal+"<input type='hidden' name='mode' value='<?= $mode ?>'>";
		
		<?
		if($_SESSION[ss_mb_level] == 10){
		?>
			
			if(form.notice_orderby1.checked == true){
				sendVal=sendVal+"<input type='hidden' name='notice_orderby1' value='"+form.notice_orderby1.value+"'>";
			}
			else if(form.notice_orderby2.checked == true){
				sendVal=sendVal+"<input type='hidden' name='notice_orderby2' value='"+form.notice_orderby2.value+"'>";
			}
		<?
		}
		?>

		
		sendVal=sendVal+"<input type='hidden' name='writer' value='"+form.writer.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='passwd' value='"+form.passwd.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='email' value='"+form.email.value+"'>";
		
		<?
		if($mode == "insert" || $no > "5962"){
			$tel_ex = explode("-",$row[TEL]);
		?>

			sendVal=sendVal+"<input type='hidden' name='tel1' value='"+form.tel1.value+"'>";
			sendVal=sendVal+"<input type='hidden' name='tel2' value='"+form.tel2.value+"'>";
			sendVal=sendVal+"<input type='hidden' name='tel3' value='"+form.tel3.value+"'>";
		<?
		}else{
			$tel = $row[TEL];

		?>
			sendVal=sendVal+"<input type='hidden' name='tel' value='"+form.tel.value+"'>";
		<?
		}
		?>


		


		sendVal=sendVal+"<input type='hidden' name='bookdate' value='"+form.bookdate_yyyy.value+form.bookdate_mm.value+form.bookdate_dd.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='booktime' value='"+form.booktime_hh.value+form.booktime_mm.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='subject' value='"+form.subject.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='content' value='"+form.content.value+"'>";
		sendVal=sendVal+"<input type='hidden' name='page' value='<?=$page?>'>";
		sendVal=sendVal+"<input type='hidden' name='flag' value='Y'>"; //flag=Y�϶��� ���������ӿ��� �۾��ǵ���
	
		window.ifmRegist.frmResult.innerHTML=sendVal;
		window.ifmRegist.frmResult.submit();
	}
//-->
</script>
<?
if($_SESSION[ss_mb_level] == 10){
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function notice_chk(){
		var form= window.frm;
			form.notice_orderby1.checked = true;
			form.notice_orderby2.checked = false;
	}
	function notice_chk2(){
		var form= window.frm;
			form.notice_orderby1.checked = false;
			form.notice_orderby2.checked = true;
	}
//-->
</SCRIPT>
<?
}
?>
</head>
<script language='JavaScript' src='../printEmbed.js'></script>
<body topmargin="0" leftmargin="0">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            <form name="frm" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
                <td><TABLE class=board cellSpacing=0 cellPadding=0 width="95%" border=0 align="center">
                  <TR>
                    <TD bgColor=#0D2465 colSpan=6 height=2 width="661"></TD>
                  </TR>
                  <TR class=bg_board02>
                    <TD class=padd height=27 width="87"><p align="center">�ۼ���</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01>&nbsp;
                        <INPUT class="b_input" style="WIDTH: 150px" maxLength="20" name="writer" value="<?= $writer ?>">

						

<?
if($_SESSION[ss_mb_level] == 10){
?>
					<BR>	
				<input type='checkbox' name='notice_orderby1' value='y' onClick="notice_chk();">������
				<input type='checkbox' name='notice_orderby2' value='y' checked onClick="notice_chk2();">�Ϲݱ�
<?
}
?>					</TD>
                    <TD class=padd width="69"><p align="center">��й�ȣ</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01>&nbsp;
                        <INPUT class="b_input" style="WIDTH: 60px" type="passwd" maxLength=4 name="passwd">
                    &nbsp;&nbsp;(����,����4�ڸ�)</TD>
                  </TR>
                  <TR bgColor=#CDCDCD>
                    <TD colSpan=6 height=1 width="661"></TD>
                  </TR>
                  <TR class=bg_board02>
                    <TD class=padd height=27 width="87"><p align="center">�̸���</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01>&nbsp;
                    <INPUT class="b_input" style="WIDTH: 150px" maxLength="50" name="email" value="<?= $email ?>"></TD>
                    <TD class=padd width="69"><p align="center">��ȭ��ȣ</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
						<TD class=padd01>&nbsp;


		<?
		if($mode == "insert" || $no > "5962"){
			$tel_ex = explode("-",$row[TEL]);
		?>

							<INPUT class="b_input" style="WIDTH: 40px" type="text" maxLength=15 name="tel1" value="<?= $tel_ex[0] ?>">
							-
							<INPUT class="b_input" style="WIDTH: 50px" type="text" maxLength=15 name="tel2" value="<?= $tel_ex[1] ?>">
							-
							<INPUT class="b_input" style="WIDTH: 50px" type="text" maxLength=15 name="tel3" value="<?= $tel_ex[2] ?>">
		<?
		}else{
			$tel = $row[TEL];

		?>
							<INPUT class="b_input" style="WIDTH: 150px" type="text" maxLength=15 name="tel" value="<?= $tel ?>">
		<?
		}
		?>					</TD>
                  </TR>
                  <TR bgColor=#CDCDCD>
                    <TD colSpan=6 height=1 width="661"></TD>
                  </TR>
                  <TR class=bg_board02>
                    <TD class=padd height=27 width="87"><p align="center">��������</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01>&nbsp;
						<?
						$now_year=date("Y");
						?>
						<select name="bookdate_yyyy" style="width:60px;">
                          <?
						  for($h=$now_year;$h<=$now_year+1;$h++){
						  ?>
							 <option value="<?=$h?>"><?=$h?></option>
						  <?
							}
						  ?>
                        </select>   
					  ��
                      <select name="bookdate_mm" style="width:40px">
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                      </select>
                      ��
                      <select name="bookdate_dd" style="width:40px">
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                      </select>
                      ��
                    <script language="javascript">
<?
	if($bookdate_yyyy) {
		echo "frm.bookdate_yyyy.value = '$bookdate_yyyy';";
	} else {
		echo "frm.bookdate_yyyy.value = year;";
	}
	if($bookdate_mm) {
		echo "frm.bookdate_mm.value = '$bookdate_mm';";
	} else {
		echo "frm.bookdate_mm.value = month;";
	}
	if($bookdate_dd) {
		echo "frm.bookdate_dd.value = '$bookdate_dd';";
	} else {
		echo "frm.bookdate_dd.value = day;";
	}
?>
                  </script></TD>
                    <TD class=padd width="69"><p align="center">����ð�</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01>&nbsp;
                        <select name="booktime_hh">
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09" selected>09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">21</option>
                        </select>
                      ��
                      <select name="booktime_mm">
                          <option value="00" selected>00</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="40">40</option>
                          <option value="50">50</option>
                      </select>
                      ��
                    <script language="javascript">
<?
	if($booktime_hh) {
		echo "frm.booktime_hh.value = '$booktime_hh';";
	} else {
		echo "frm.booktime_hh.value = '09';";
	}
	if($booktime_mm) {
		echo "frm.booktime_mm.value = '$booktime_mm';";
	} else {
		echo "frm.booktime_mm.value = '00';";
	}
?>
                  </script></TD>
                  </TR>
                  <TR bgColor=#CDCDCD>
                    <TD colSpan=6 height=1></TD>
                  </TR>
                </TABLE></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><TABLE cellSpacing=0 cellPadding=0 width="95%" bgColor=#ffffff border=0 align="center">
                  <TR>
                    <TD align=middle bgColor=#FFFFFF height="30"><div align="center">����</div></TD>
                    <TD height="30" class=title>&nbsp;
                    <INPUT class="b_input" maxLength="50" style="width:500px" name="subject" value="<?= $subject ?>"></TD>
                  </TR>
                  <TR bgColor=#CDCDCD>
                    <TD height=1 width="87"></TD>
                    <TD height="1"></TD>
                  </TR>
                  <TR>
                    <TD style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 14px" vAlign=top align=middle bgColor=#FFFFFF><div align="center">����</div></TD>
                    <TD height="170" class=board_cts01>&nbsp;
                    <TEXTAREA class="b_textarea" name="content" rows=10 cols="72" style="width:99%"><?=$content ?></TEXTAREA></TD>
                  </TR>
                </TABLE></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <TD bgColor=#0D2465 colSpan=6 height=2 width="661"></TD
                  ></tr>
                  <tr>
                    <td height="35"><div align="center"><IMG alt=��� src="img/btn_regi.gif" border=0  style="cursor:hand" onClick="sendForm()"> <A href="booking_list.php?page=<?= $page ?>"><IMG alt=��� hspace=5 src="img/btn_list.gif" border=0></A></div></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="7">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </form>
            </td>
          </tr>
</table>
        <map name="banner">
<area shape="rect" coords="52,4,225,64" href="../booking/booking_list.php"><area shape="rect" coords="52,65,225,123" href="../main/company3.htm">
</map></body>
<iframe id="ifmRegist" src="booking_write_ok.php" frameborder="0"  leftmargin="0"  topmargin="0" scrolling="no"  width="0" height="0"></iframe>
</html>
<?
	//$newDb->dbClose();
?>
