<?
$id="confirm"; 
/*
$_zb_url = "http://www.pusanmakeup.com/bbs/"; //제로보드를 설치한 웹 경로
$_zb_path = "/home2/boom/public_html/bbs/"; //제로보드를 설치한 절대경로(제로보드 관리자 페이지에서 알 수 있음)
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

	if($no) {		//넘어오는 글 번호가 있을때 (수정)
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
<title>무제 문서</title>
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
			alert("작성자를 입력하세요");
			form.writer.focus();
			return;
		}
		if(form.passwd.value == "") {
			alert("비밀번호를 입력하세요");
			form.passwd.focus();
			return;
		}
		if(form.subject.value == "") {
			alert("글제목을 입력하세요");
			form.subject.focus();
			return;
		}

		//입력한 값을 iframe으로 넘김
		sendVal="<input type='hidden' name='no' value='<?= $no ?>'>";
		sendVal=sendVal+"<input type='hidden' name='mode' value='<?= $mode ?>'>";
		
		<?
		if($member[level] == 1){
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
		sendVal=sendVal+"<input type='hidden' name='flag' value='Y'>"; //flag=Y일때만 아이프레임에서 작업되도록
	
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
<body topmargin="0" leftmargin="0" bgcolor="C7AB6A">
<div id="Layer1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
	  <textarea name="textarea" cols="0" rows="0" id="txtResource id #2" style="display:none;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="285" height="355">
              <param name="movie" value="../swf/support_menu.swf?pageNum=4">
              <param name="quality" value="high"><param name="wmode" value="transparent"><param name="menu" value="false">
              <embed src="../swf/support_menu.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="285" height="355"></embed>
            </object>
</textarea>
          <script>printEmbed("txtResource id #2")</script>
	  </td>
    </tr>
  </table>
</div>
<div id="Layer2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
	  <textarea name="textarea" cols="0" rows="0" id="txtResource id #3" style="display:none;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="278" height="191">
              <param name="movie" value="../swf/sub1.swf">
              <param name="quality" value="high"><param name="wmode" value="transparent"><param name="menu" value="false">
              <embed src="../swf/sub1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="278" height="191"></embed>
            </object>
</textarea>
          <script>printEmbed("txtResource id #3")</script>
	  </td>
    </tr>
  </table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="../images/sub_up_bg.jpg"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="285"><img src="../images/main_1.jpg" width="285" height="134" border="0" usemap="#home"></td>
        <td width="528" background="../images/main_2.jpg">
		<textarea name="textarea" cols="0" rows="0" id="txtResource id #1" style="display:none;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="528" height="134">
              <param name="movie" value="../swf/main_menu.swf?pageNum=4&subNum=4">
              <param name="quality" value="high"><param name="wmode" value="transparent"><param name="menu" value="false">
              <embed src="../swf/main_menu.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="528" height="134"></embed>
            </object>
</textarea>
          <script>printEmbed("txtResource id #1")</script>
		</td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="../images/main_3.jpg" width="167" height="56"></td>
          </tr>
          <tr>
            <td height="28"><? include '../inc/top.htm'; ?></td>
          </tr>
          <tr>
            <td><img src="../images/main_7.jpg" width="167" height="50"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="285"><img src="../images/sub_img1.jpg" width="285" height="151"></td>
            <td><img src="../images/sub_img2.jpg" width="695" height="151"></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="F3E5C1"><table width="980" border="0" cellpadding="0" cellspacing="0" background="../images/sub_page_bg.jpg">
      <tr>
        <td width="285" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="204">&nbsp;</td>
          </tr>
          <tr>
            <td><img src="../images/sub_banner.jpg" width="285" height="130" border="0" usemap="#banner"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td valign="top"><table width="634" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="../images/support_title4.gif" width="634" height="38"></td>
          </tr>
          <tr>
            <td><table width="634" border="0" cellspacing="0" cellpadding="0">
              <tr><form name="frm" method="post">
                <td>&nbsp;</td>
                <td><TABLE class=board cellSpacing=0 cellPadding=0 width="95%" border=0 align="center">
                  <TR>
                    <TD bgColor=#f2dbcb colSpan=6 height=2 width="661"></TD>
                  </TR>
                  <TR class=bg_board02>
                    <TD class=padd height=27 width="87" bgcolor="#F2DBCB"><p align="center">작성자</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01 width="255">&nbsp;
                        <INPUT class="input" style="WIDTH: 150px" maxLength="20" name="writer" value="<?= $writer ?>">

						

<?
if($_SESSION[ss_mb_level] == 10){
?>
					<BR>	
				<input type='checkbox' name='notice_orderby1' value='y' onclick="notice_chk();">공지글
				<input type='checkbox' name='notice_orderby2' value='y' checked onclick="notice_chk2();">일반글
<?
}
?>
						
						
						</TD>
                    <TD class=padd width="69" bgcolor="#F2DBCB"><p align="center"><IMG src="img/brd_pw.gif" width="37" height="12"></TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01 width="248">&nbsp;
                        <INPUT class="input" style="WIDTH: 60px" type="passwd" maxLength=4 name="passwd">
                      &nbsp;&nbsp;(영문,숫자4자리)</TD>
                  </TR>
                  <TR bgColor=#f2dccb>
                    <TD colSpan=6 height=1 width="661"></TD>
                  </TR>
                  <TR bgColor=#f8ede5>
                    <TD colSpan=6 height=2 width="661"></TD>
                  </TR>
                  <TR class=bg_board02>
                    <TD class=padd height=27 width="87" bgcolor="#F2DBCB"><p align="center"><IMG src="img/brd_mail03.gif" width="28" height="12"></TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01 width="255">&nbsp;
                        <INPUT class="input" style="WIDTH: 150px" maxLength="50" name="email" value="<?= $email ?>"></TD>
                    <TD class=padd width="69" bgcolor="#F2DBCB"><p align="center">전화번호</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
						<TD class=padd01 width="248">&nbsp;


		<?
		if($mode == "insert" || $no > "5962"){
			$tel_ex = explode("-",$row[TEL]);
		?>

							<INPUT class="input" style="WIDTH: 40px" type="text" maxLength=15 name="tel1" value="<?= $tel_ex[0] ?>">
							-
							<INPUT class="input" style="WIDTH: 50px" type="text" maxLength=15 name="tel2" value="<?= $tel_ex[1] ?>">
							-
							<INPUT class="input" style="WIDTH: 50px" type="text" maxLength=15 name="tel3" value="<?= $tel_ex[2] ?>">
		<?
		}else{
			$tel = $row[TEL];

		?>
							<INPUT class="input" style="WIDTH: 150px" type="text" maxLength=15 name="tel" value="<?= $tel ?>">
		<?
		}
		?>








						</TD>
                  </TR>
                  <TR bgColor=#f8ede5>
                    <TD colSpan=6 height=1 width="661"></TD>
                  </TR>
                  <TR bgColor=#ffffff>
                    <TD colSpan=6 height=2 width="661"></TD>
                  </TR>
                  <TR class=bg_board02>
                    <TD class=padd height=27 width="87" bgcolor="#F2DBCB"><p align="center">예약일자</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01 width="255">&nbsp;
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
					  년
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
                      월
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
                      일
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
                  </script>                    </TD>
                    <TD class=padd width="69" bgcolor="#F2DBCB"><p align="center">예약시각</TD>
                    <TD width="1"><IMG src="img/bullet02.gif"></TD>
                    <TD class=padd01 width="248">&nbsp;
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
                      시
                      <select name="booktime_mm">
                          <option value="00" selected>00</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="40">40</option>
                          <option value="50">50</option>
                        </select>
                      분
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
                  </script>                    </TD>
                  </TR>
                  <TR bgColor=#f8ede5>
                    <TD colSpan=6 height=1 width="661"></TD>
                  </TR>
                  <TR bgColor=#ffffff>
                    <TD colSpan=6 height=2 width="661"></TD>
                  </TR>
                </TABLE></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><TABLE cellSpacing=0 cellPadding=0 width="95%" bgColor=#ffffff border=0 align="center">
                  <TR>
                    <TD align=middle width="87" bgColor=#F4EEDE height="30">제목</TD>
                    <TD width="539" height="30" vAlign=top bgcolor="#F4EEDE" class=title>&nbsp;
                        <INPUT class="input" maxLength="50" style="width:500px" name="subject" value="<?= $subject ?>"></TD>
                  </TR>
                  <TR>
                    <TD height=1 width="87"></TD>
                    <TD width="539" height="1"></TD>
                  </TR>
                  <TR>
                    <TD style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 14px" vAlign=top align=middle width="87" bgColor=#F4EEDE><img src="img/brd_cont.gif" border="0"></TD>
                    <TD width="539" vAlign=top bgcolor="#F4EEDE" class=board_cts01>&nbsp;
                        <TEXTAREA class="input" name="content" rows=10 cols="72"><?= $content ?>
                  </TEXTAREA></TD>
                  </TR>
                </TABLE></td>
              </tr></form>
              <tr>
                <td>&nbsp;</td>
                <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="35"><div align="right"><IMG alt=등록 src="img/btn_regi.gif" border=0 width="54" height="20" style="cursor:hand" onClick="sendForm()"> <A href="booking_list.php?page=<?= $page ?>"><IMG alt=목록 hspace=5 src="img/btn_list.gif" border=0 width="54" height="20"></A></div></td>
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
            </table></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="../images/sub_bg.jpg"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../images/sub_copy.jpg" width="980" height="216"></td>
      </tr>
    </table></td>
  </tr>
</table>

<map name="home"><area shape="rect" coords="77,33,223,131" href="../main/start.htm">
</map>
<map name="banner">
<area shape="rect" coords="52,4,225,64" href="../booking/booking_list.php"><area shape="rect" coords="52,65,225,123" href="../main/company3.htm">
</map></body>
<iframe id="ifmRegist" src="booking_write_ok.php" frameborder="0"  leftmargin="0"  topmargin="0" scrolling="no"  width="0" height="0"></iframe>
</html>
<?
	//$newDb->dbClose();
?>
