<?
    session_start();

//$id="confirm"; 
   $site_path = "/home/pusanmakeup/public_html/bbs/";
   $site_url = "./bbs/";
   require_once($site_path."include/lib.inc.php");
/*$_zb_url = "http://www.pusanmakeup.com/bbs/"; //���κ��带 ��ġ�� �� ���
$_zb_path = "/home2/boom/public_html/bbs/"; //���κ��带 ��ġ�� ������(���κ��� ������ ���������� �� �� ����)
include $_zb_path."lib.php";
include $_zb_path."outlogin.php";
*/
/*
if(!$connect) $connect = dbconn();

if(!$member) $member = member_info();

   
    include "../lib/lib.php";

    //$newDb = new MysqlConnect;

   */ /* �� ������ �ҷ��´�. */
    $sql = "SELECT * FROM TB_BOOKING WHERE NO = $no";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    
    //�亯���̸� �θ���� ��й�ȣ�� �����´�.
    if($row[LEVELNO] > 0) {
        $sql = "SELECT * FROM TB_BOOKING WHERE NO = $row[REF] ";
        $result = mysql_query($sql);
        $row1 = mysql_fetch_array($result);
    }

    if($row[PASSWD] == $_SESSION["booking_passwd"] || $_SESSION["booking_passwd"] == $row1[PASSWD] || $_SESSION[ss_mb_level] == 10) {
        $subject = stripslashes($row[SUBJECT]);
        if($row[STATUS] == "1") {
            $status = "��û";
        } else if($row[STATUS] == "2") {
            $status = "����";
        } else if($row[STATUS] == "3") {
            $status = "�Ա�Ȯ����";
        } else if($row[STATUS] == "4") {
            $status = "�Ϸ�";
        } else {
            $status = "";
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
    function allblur() {
         for (i = 0; i < document.links.length; i++)
              document.links[i].onfocus = document.links[i].blur;
    }

    function sendDelete() {
		var sendVal;
		if("<?= $row[STATUS] ?>" != "1") {
			alert("��û���°� �ƴ� ������ �����Ͻ� �� �����ϴ�.\n����ڿ��� �����Ͻʽÿ�.");
			return;
		}
        if(confirm("�����Ͻðڽ��ϱ�?")) {
            sendVal="<input type='hidden' name='no' value='<?=$no?>'>";
            sendVal=sendVal+"<input type='hidden' name='page' value='<?=$page?>'>";
            sendVal=sendVal+"<input type='hidden' name='flag' value='Y'>"; //flag=Y�϶��� ���������ӿ��� �۾��ǵ���
        
            window.ifmDelete.frmResult.innerHTML=sendVal;
            window.ifmDelete.frmResult.submit();
		}
	}

    function sendPay() {
		if("<?= $row[STATUS] ?>" == "3") {
			alert("�������� ���� ������ �Ա�Ȯ�� ��û�� �Ͻ� �� �����ϴ�.");
			return;
		}
        window.open("booking_pay.php?no=<?= $no ?>","pay","toolbar=no,ocation=no,status=no,scrollbars=no,resizable=yes,width=400,height=210");
    }

    function sendModify() {
		if("<?= $row[STATUS] ?>" != "1") {
			alert("��û���� ���ุ �����Ͻ� �� �ֽ��ϴ�.\n����ڿ��� �����Ͻʽÿ�.");
			return;
		}
        location.href = "booking_write.php?no=<?= $no ?>&page=<?= $page ?>&mode=update";
    }
    function sendReply() {
        location.href="./booking_reply.php?search=<?=$search?>&keyword=<?=$keyword?>&no=<?=$no?>&page=<?=$page?>&mode=reply"
    }
//-->
</script>

</head>
<script language='JavaScript' src='../printEmbed.js'></script>
<body topmargin="0" leftmargin="0">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><TABLE class=board cellSpacing=0 cellPadding=0 width="95%" border=0 align="center">
              <TR>
                <TD bgColor=#0D2465 colSpan=6 height=2 width="661"></TD>
              </TR>
              <TR class=bg_board02>
                <TD class=padd height=27 width="87"><p align="center">�ۼ���</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 width="255">&nbsp;
                    <?= $row[WRITER] ?></TD>
               
				<TD class=padd width="69"><p align="center">�۾� ��¥</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 width="248">&nbsp;<?= $row[WDATE]?></TD>
				
              </TR>
              <TR bgColor=#0D2465>
                <TD colSpan=6 height=1 width="661"></TD>
              </TR>
              <TR class=bg_board02>
                <TD class=padd height=27 width="87"><p align="center">�̸���</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 width="255">&nbsp;
                    <?= $row[EMAIL] ?></TD>
                <TD class=padd width="69"><p align="center">��ȭ��ȣ</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 width="248">&nbsp;
                    <?= $row[TEL] ?></TD>
              </TR>
              <TR bgColor=#0D2465>
                <TD colSpan=6 height=1 width="661"></TD>
              </TR>
				<?
				if($row[notice_orderby] == 0){
				?>
              <TR class=bg_board02>
                <TD class=padd height=27 width="87"><p align="center">��������</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 width="255">&nbsp;
                    <?= substr($row[BOOKDATE],0,4)."�� ".substr($row[BOOKDATE],4,2)."�� ".substr($row[BOOKDATE],6,2)."��" ?></TD>
                <TD class=padd width="69"><p align="center">����ð�</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 width="248">&nbsp;
                    <?= substr($row[BOOKTIME],0,2)."�� ".substr($row[BOOKTIME],2,2)."��" ?></TD>
              </TR>
              <TR bgColor=#0D2465>
                <TD colSpan=6 height=1 width="661"></TD>
              </TR>
			  <?
				}
				?>

            </TABLE></td>
          </tr>
          <tr>
            <td><TABLE cellSpacing=0 cellPadding=0 width="95%" bgColor=#ffffff border=0 align="center">
              <TR>
                <TD align=middle width="87" height="30"><div align="center">����</div></TD>
                <TD width="539" height="30" vAlign=top class=title>&nbsp;
                    <?= $row[SUBJECT] ?></TD>
              </TR>
              <TR bgColor=#0D2465>
                <TD height=1 width="87"></TD>
                <TD width="539" height="1"></TD>
              </TR>
              <TR>
                <TD align=middle width="87"><div align="center">���� </div></TD>
                <TD width="539" vAlign=top class=board_cts01>
					<?=str_replace("\n","<br>",nl2br($row[CONTENT]))?>
					<?//nl2br($row[CONTENT])?>
				</TD>
              </TR>
            </TABLE></td>
          </tr>
          <tr>
            <td><TABLE cellSpacing=0 cellPadding=0 width="95%" border=0 align="center">
              <TR bgColor=#0D2465>
                <TD height=1 ></TD>
                <td></td>
              </TR>
              <TR>
                <TD height=10 ></TD>
                <td>&nbsp;</td>
              </TR>
              <TR>
                <TD vAlign=bottom>

				<?
				if($_SESSION[ss_mb_level] == 10){
				?>
				<IMG src="img/btn_re.gif" alt=�亯 width="57" height="24" hspace=5 border=0 style="cursor:hand" onClick="sendReply()">
				<?
				}
				?>

				<?
				if($row[notice_orderby] > 0){
					if($_SESSION[ss_mb_level] == 10){
				?>
				<IMG alt=���� src="img/btn_modify.gif" border=0 style="cursor:hand;" onClick="sendModify()"> <IMG alt=���� hspace=5 src="img/btn_delete.gif" border=0 style="cursor:hand" onClick="sendDelete()">
                    <!--<IMG alt=�Ա�Ȯ�ο�û src="img/btn_money.gif" border=0 style="cursor:hand;" onClick="sendPay()">-->
				<?
					}
				}else{
				?>
				<IMG alt=���� src="img/btn_modify.gif" border=0 style="cursor:hand;" onClick="sendModify()"> <IMG alt=���� hspace=5 src="img/btn_delete.gif" border=0 style="cursor:hand" onClick="sendDelete()">
                    <!--<IMG alt=�Ա�Ȯ�ο�û src="img/btn_money.gif" border=0 style="cursor:hand;" onClick="sendPay()">-->

				<?
				}
				?>				</TD>
                <TD vAlign=bottom align=right><A href="booking_list.php?search=<?=$search?>&keyword=<?=$keyword?>&page=<?=$page?>" target="_self"><IMG alt=��� hspace=5 src="img/btn_list.gif" border=0></A> </TD>
              </TR>
            </TABLE></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
</table>

<map name="home"><area shape="rect" coords="77,33,223,131" href="../main/start.htm">
</map>
<map name="banner">
<area shape="rect" coords="52,4,225,64" href="../booking/booking_list.php"><area shape="rect" coords="52,65,225,123" href="../main/company3.htm">
</map>
<iframe id="ifmDelete" src="booking_delete.php" frameborder="0"  leftmargin="0"  topmargin="0" scrolling="no"  width="0" height="0"></iframe>
</body>
</html>
<? 
       // $newDb->dbClose();
        
    } else {
?>
	<script language="javascript">
		alert("�ۼ��ڸ� �� �� �ֽ��ϴ�.");
		location.href='booking_list.php?page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>';
	</script>
<?
    }
?>
