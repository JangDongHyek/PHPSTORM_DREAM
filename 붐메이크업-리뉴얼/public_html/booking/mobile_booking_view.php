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
		<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../bbs/skin/board/blue/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript"> 
try {
	top.document.title='::::::::::�ո���ũ���Դϴ�:::::::::: > (�ʵ�)������ҽ� �����ȯ�ҿ����� �ȳ��Դϴ�!!^^*'
} catch (Exception) {
}
</script>
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
<link rel="stylesheet" href="../css/board.css"/>
<div align="center">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>����� Ȩ������</title>
<link rel="stylesheet" type="text/css" href="../css/board.css"/>
</head>
 
<body>
 
<!-- ž�޴� ����-->
<div class="top" style="">
<div id="ht">
        <div class="mb">
          <div class="ml"><img src="../mobile/images/top.jpg" width="300" height="83" border="0" usemap="#Map2" /></div>
	      <div class="ml"><img src="../mobile/images/logo_main.jpg" width="300" height="36" border="0" usemap="#Map_tmenu"/></div>
        </div> 
</div>
<map name="Map2" id="Map2">
  <area shape="rect" coords="1,0,125,79" href="../mobile/index.htm" />
</map>
<map name="Map_tmenu" id="Map_tmenu">
	          <area shape="rect" coords="64,5,127,34" href="../bbs/mobile_list.php?bbs_id=pro_style1" />
              <area shape="rect" coords="127,5,169,34" href="../bbs/mobile_list.php?bbs_id=pro_gallery03" />
  <area shape="rect" coords="-1,5,65,34" href="../mobile/s1.htm" />
              <area shape="rect" coords="168,5,227,34" href="../bbs/mobile_list.php?bbs_id=noticee" />
			  <area shape="rect" coords="227,5,297,34" href="../mobile/s5.htm" />
</map></div>
<div class="body">
	<div id="dt5"><div><img src="../mobile/images/confirm.gif" alt="�Ա�Ȯ��" width="300" height="33" border="0" usemap="#Map3" style="width:300; border-box; max-width:100% !important;">
<map name="Map3" id="Map3"><area shape="rect" coords="5,3,94,31" href="../bbs/mobile_list.php?bbs_id=confirm" />
<area shape="rect" coords="95,5,200,28" href="../bbs/mobile_list.php?bbs_id=yeyak" /><area shape="rect" coords="198,4,292,29" href="../bbs/mobile_list.php?bbs_id=confirm" />
</map></div>
	</div></div>
	<!--�Խ��� ����Ʈ ����-->
	<div class="board_list">
<link rel=stylesheet href='../bbs/skin/board/blue/style.css'>
 
<SCRIPT LANGUAGE="JavaScript"> 
<!--
function img_new_window(name,title) {
	if(name=='')
		return;
	var x=screen.width/2-150/2; //â�� ȭ�� �߾����� ��ġ 
	var y=(screen.height-30)/2-150/2;
	window.open('../bbs/skin/board/blue/img_view.php?image='+name+'&title='+title,'','width=150,height=150,scrollbars=1,resizable=1,top='+y+',left='+x)
}
//-->
</SCRIPT>
<div class="board_login">
	<span>
				<a href=../bbs/mb_logout.php?url=%2Fbbs%2Fmobile_view.php%3F%26bbs_id%3Dconfirm%26page%3D%26doc_num%3D2921 ><IMG src="../bbs/skin/board/blue/images/head_img06.gif" border=0></a>
			</span>
</div><br>
<map name="Map" id="Map">
<area shape="rect" coords="3,6,66,36" href="../mobile/s1.htm" />
<area shape="rect" coords="63,6,128,36" href="../bbs/mobile_list.php?bbs_id=pro_style1" />
<area shape="rect" coords="125,6,168,36" href="../bbs/mobile_list.php?bbs_id=pro_gallery01" />
<area shape="rect" coords="167,6,230,36" href="../bbs/mobile_list.php?bbs_id=noticee" />
<area shape="rect" coords="227,6,298,36" href="../mobile/s5.htm" />
</map>
<map name="Map2" id="Map2"><area shape="rect" coords="5,5,124,79" href="../mobile/index.htm" />
</map>	
 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><TABLE class=board cellSpacing=0 cellPadding=0 width="95%" border=0 align="center">
              <TR>
                <TD bgColor=#0D2465 colSpan=6 height=2 ></TD>
              </TR>
              <TR class=bg_board02>
                <TD class=padd height=27 width="87"><p align="center">�ۼ���</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01>&nbsp;
                    <?= $row[WRITER] ?></TD>
               
				<TD class=padd width="69"><p align="center">�۾� ��¥</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 >&nbsp;<?= $row[WDATE]?></TD>
				
              </TR>
              <TR bgColor=#0D2465>
                <TD colSpan=6 height=1 ></TD>
              </TR>
              <TR class=bg_board02>
                <TD class=padd height=27 width="87"><p align="center">�̸���</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01>&nbsp;
                    <?= $row[EMAIL] ?></TD>
                <TD class=padd width="69"><p align="center">��ȭ��ȣ</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 >&nbsp;
                    <?= $row[TEL] ?></TD>
              </TR>
              <TR bgColor=#0D2465>
                <TD colSpan=6 height=1 ></TD>
              </TR>
				<?
				if($row[notice_orderby] == 0){
				?>
              <TR class=bg_board02>
                <TD class=padd height=27 width="87"><p align="center">��������</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01>&nbsp;
                    <?= substr($row[BOOKDATE],0,4)."�� ".substr($row[BOOKDATE],4,2)."�� ".substr($row[BOOKDATE],6,2)."��" ?></TD>
                <TD class=padd width="69"><p align="center">����ð�</TD>
                <TD width="1"><IMG src="img/bullet02.gif"></TD>
                <TD class=padd01 >&nbsp;
                    <?= substr($row[BOOKTIME],0,2)."�� ".substr($row[BOOKTIME],2,2)."��" ?></TD>
              </TR>
              <TR bgColor=#0D2465>
                <TD colSpan=6 height=1 ></TD>
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
                <TD  height="30" vAlign=top class=title>&nbsp;
                    <?= $row[SUBJECT] ?></TD>
              </TR>
              <TR bgColor=#0D2465>
                <TD height=1 width="87"></TD>
                <TD  height="1"></TD>
              </TR>
              <TR>
                <TD align=middle width="87"><div align="center">���� </div></TD>
                <TD  vAlign=top class=board_cts01>
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

				<? /*
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
				}*/
				?>				</TD>
                <TD vAlign=bottom align=right><A href="mobile_booking_list.php?search=<?=$search?>&keyword=<?=$keyword?>&page=<?=$page?>" target="_self"><IMG alt=��� hspace=5 src="img/btn_list.gif" border=0></A> </TD>
              </TR>
            </TABLE></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
</table>
	
<div id="foot">
	   <div class="mbottom"><img src="../mobile/images/bottom.jpg" width="300" height="159" border="0" usemap="#copy"/></div>
</div>
 <map name="copy" id="copy">
           <area shape="rect" coords="102,10,198,54" href="tel:0518059996" />
           <area shape="rect" coords="5,10,98,54" href="../bbs/mobile_write.php?bbs_id=confirm" />
           <area shape="rect" coords="200,10,294,54" href="../main/index.htm" />
</map></div>
</body>
</html>
<script src="../bbs/skin/board/blue/script.js"></script>
<?} else {
?>
	<script language="javascript">
		alert("�ۼ��ڸ� �� �� �ֽ��ϴ�.");
		location.href='booking_list.php?page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>';
	</script>
<?
    }
?>
