<?
if(!$HTTP_COOKIE_VARS[BEAUTYE_ID]){
	echo "<meta http-equiv='Refresh' content='0; URL=../member1.php'>";
	exit;
}
?>

<html>
<head><title>�Ƹ��ٿ� �� - ��Ƽe��</title>
<META HTTP-EQUIV="Cache-Control" content="No-Cache">
<META HTTP-EQUIV="Pragma" content="No-Cache">
<META HTTP-EQUIV="Expires" CONTENT="0">
<link href="http://www.beautye.net/nzzi.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function na_restore_img_src(name, nsdoc)
{
  var img = eval((navigator.appName.indexOf('Netscape', 0) != -1) ? nsdoc+'.'+name : 'document.all.'+name);
  if (name == '')
    return;
  if (img && img.altsrc) {
    img.src    = img.altsrc;
    img.altsrc = null;
  } 
}

function na_preload_img()
{ 
  var img_list = na_preload_img.arguments;
  if (document.preloadlist == null) 
    document.preloadlist = new Array();
  var top = document.preloadlist.length;
  for (var i=0; i < img_list.length; i++) {
    document.preloadlist[top+i]     = new Image;
    document.preloadlist[top+i].src = img_list[i+1];
  } 
}

function na_change_img_src(name, nsdoc, rpath, preload)
{ 
  var img = eval((navigator.appName.indexOf('Netscape', 0) != -1) ? nsdoc+'.'+name : 'document.all.'+name);
  if (name == '')
    return;
  if (img) {
    img.altsrc = img.src;
    img.src    = rpath;
  } 
}

// -->
</script>
</head>
<?
if($HTTP_COOKIE_VARS[BEAUTYE_GRADE] < 2){
?>
<body oncontextmenu='return false' ondragstart='return false' onselectstart='return false' leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="na_preload_img(false, '../le1_1.gif', '../le2_1.gif', '../le3_1.gif', '../le4_1.gif', '../le5_1.gif', '../le6_1.gif', '../le7_1.gif', '../le8_1.gif', '../le9_1.gif', '../le10_1.gif', '../le11_1.gif');">
<script language=JavaScript>function click() {if ((event.button==2) || (event.button==2)) {alert('�˼��մϴ�. ������ ���콺 �����Դϴ�. - ��Ƽe ');}}document.onmousedown=click// --></script> 
<script language="JavaScript">
<!-- www.tagin.net
function click() { 
     if((event.ctrlKey) || (event.shiftKey)) { 
       alert('Ű�� ����� �� �����ϴ�.'); 
     } 
   } 
document.onmousedown=click; 
document.onkeydown=click; 
-->
</script>
<?
}else{
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="na_preload_img(false, '../le1_1.gif', '../le2_1.gif', '../le3_1.gif', '../le4_1.gif', '../le5_1.gif', '../le6_1.gif', '../le7_1.gif', '../le8_1.gif', '../le9_1.gif', '../le10_1.gif', '../le11_1.gif');">
<?
}
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr> 

    <td background="/image/main_img/top_bg.gif">

            <p><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0" width="963" height="62" vspace="0" hspace="0">
            <param name="movie" value="../img/menu.swf">
            <param name="play" value="true">
            <param name="loop" value="true">
            <param name="quality" value="high">
            <embed src="../img/menu.swf" play="true" loop="true" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="963" height="62"></embed>
            </object></p>
</td>

  </tr>

</table>




<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="950" bgcolor="39372B"><table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr>
<?
include("../include/all_left.html");
include("../include/sung_left.html");
?>

          <td width="655" valign="top" bgcolor="#FFFFFF">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="651">
                                    <p><img src="../img/mj7.jpg" width="659" height="119" border="0"></p>
                                </td>
                            </tr>
                        </table>
                        <table width="660">

<TR>
<TD bgColor=#d9d9d0 width="654"></TD></TR>
<TR>
<TD vAlign=top width="654">
<TABLE cellSpacing=0 cellPadding=0 width="658" align=center border=0>
<TBODY>
<TR>
<TD vAlign=top width="441">
<table>
<TR>
<TD width=213><center><IMG height=88 src="../img/king12.gif" 
width="438"></a></TD></TR>
<TR>
<TD>
<?
$board = "bbs_sung"; //�Խ��� Table ��
$board_type = "magazine"; //�Խ��� Type(board,faq,magazine)
$code_url = $PHP_SELF; // �θ� url ���� ���̺� ������ ���� �ڵ尪
if(!$set || $set == "list"){
	include("../board_sung/board_list.php");
}
else if($set == "write" || $set == "modify" || $set == "reply"){
	include("../board_sung/board_write.php");
}
else if($set == "view"){
	include("../board_sung/board_view.php");
}
?>
</TD>
</TR>
</table>
</TD>
<TD width=1 bgColor=#d9d9d0><IMG height=1 src="blank.gif" 
width=1></TD>
<TD vAlign=top width="216">
<TABLE cellSpacing=0 cellPadding=0 width=200 align=right border=0>
<TBODY>
<TR>
<TD vAlign=top>
<TABLE cellSpacing=0 cellPadding=0 width=200 border=0>
<TBODY>
<TR>
<TD><IMG height=8 src="blank.gif" 
width=1></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR>
<TD width="205">
                                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td width="59">
                                                                                    <p>&nbsp;</p>
                                                                                </td>
                                                                                <td width="59">
<TABLE cellSpacing=0 cellPadding=0 width=200 align=right border=0>
<TBODY>
<TR>
<TD vAlign=top>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR>
<TD width=205>
<TABLE cellSpacing=0 cellPadding=0 border=0>
<TBODY>
<TR>
<TD width=59>
<TABLE cellSpacing=0 cellPadding=0 width=200 align=right border=0>
<TBODY>
<TR>
<TD vAlign=top>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR>
<TD width=205>
<TABLE cellSpacing=0 cellPadding=0 border=0>
<TBODY>
<TR>
<TD width=59>
<TABLE cellSpacing=1 cellPadding=0 width=200 bgColor=#cccccc border=0>
<FORM name=form1 method=post>
<TBODY>
<TR>
<TD bgColor=#ffffff><TABLE cellSpacing=0 cellPadding=0 width="187" align=center border=0>
<TBODY>
<TR>
<TD width="187"><IMG height=82 src="../img/avc3.gif" width=180></TD></TR>
<TR>
<TD width="187"><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD width="187">
<TABLE width="185">
<TBODY>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>1. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=188&opti_ex=������%20��%20�β�����%20â���ؼ�%20������%20��%20����%20.�̷�%20����%20����%20����%20��������%20��ü����%20�Ϳ�%20�Ű���%20����%20������...&check_array=&search_word=&page=1&page_num=1">���� 
                                                                                                                                                                                                    ���� 
                                                                                                                                                                                                    �̷� 
                                                                                                                                                                                                    �� 
                                                                                                                                                                                                    ��ó�ϴ�</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>2. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=189&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">�谨�� 
                                                                                                                                                                                                    �� 
                                                                                                                                                                                                    �� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    �ʹ�</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>3. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=190&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">�����Ŀ��� 
                                                                                                                                                                                                    �׸� 
                                                                                                                                                                                                    ������Ű�� 
                                                                                                                                                                                                    �ʹ�</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>4. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=191&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">���ڰ� 
                                                                                                                                                                                                    �����ϴ� 
                                                                                                                                                                                                    ȲȦ�� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ���� 
                                                                                                                                                                                                    </a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>5. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=192&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">ǥ���� 
                                                                                                                                                                                                    -ǥ���� 
                                                                                                                                                                                                    ���� 
                                                                                                                                                                                                    �� 
                                                                                                                                                                                                    �¸����� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ǥ���Ѵ�</a></p>
 </TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>6. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=193&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">������-�װ� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    �޼Ҹ� 
                                                                                                                                                                                                    ã�� 
                                                                                                                                                                                                    �͵� 
                                                                                                                                                                                                    ���ο� 
                                                                                                                                                                                                    ��ſ�</a></p>
 </TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>7. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=194&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">���� 
                                                                                                                                                                                                    �������� 
                                                                                                                                                                                                    ����� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ����</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>8. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=195&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">�������� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ���ϴ�, 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    �ֵ����� 
                                                                                                                                                                                                    ��� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ��ũ��</a></p>
 </TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>9. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=196&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">ü�� 
                                                                                                                                                                                                    ������ 
                                                                                                                                                                                                    ���� 
                                                                                                                                                                                                    �� 
                                                                                                                                                                                                    �������� 
                                                                                                                                                                                                    ��� 
                                                                                                                                                                                                    �˷��ش�</a></p>
 </TD>
</TR>
</TBODY></TABLE></TD></TR>
<TR>
<TD width="187"><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD bgColor=#cccccc width="187"><IMG height=1 
src="http://www.dong100.com/image/main_img/blank.gif" width=1></TD></TR>
<TR>
<TD width="187"><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD width="187"><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR></TBODY></TABLE></TD></TR><INPUT type=hidden value=0002 
name=cd_event> <INPUT type=hidden value=20050702164055 name=dt_entry> <INPUT 
type=hidden name=cd_id> </FORM></TBODY></TABLE></TD>
</TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<P>&nbsp;</P></TD>
</TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<P>&nbsp;</P></td>
                                                                                <td width="59">
                                                                                    <p>&nbsp;</p>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
</TD></TR>
                                                                <tr>
<TD width="205">
                                                                        <p align="center">&nbsp;</p>
</TD>
                                                                </tr>
                                                                <tr>
<TD width="205">
                                                                        <p align="center">&nbsp;</p>
</TD>
                                                                </tr>
                                                                <tr>
<TD width="205">
                                                                        <p align="center">&nbsp;</p>
</TD>
                                                                </tr>
</TBODY></TABLE></TD></TR></TBODY></TABLE>
                                                <p>&nbsp;</p>
</TD></TR></TBODY></TABLE></TD></TR>
                        </table>
        </td>
        </tr>
      </table>

<?
include("../daum2.html");
?>