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
<?
include("../include/top.html");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="950" bgcolor="39372B"><table width="950" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="161" valign="top" bgcolor="#FFFFFF">
<?
include("../include/all_left.html");
include("../include/posi_left.html");
?>
          <td width="655" valign="top" bgcolor="#FFFFFF">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="651">
                                    <p><img src="../img/kjko1.jpg" width="659" height="119" border="0"></p>
                                </td>
                            </tr>
                        </table>
                        <table width="656">

<TR>
<TD bgColor=#d9d9d0 width="650"></TD></TR>
<TR>
<TD vAlign=top width="650">
<TABLE cellSpacing=0 cellPadding=0 width="93%" align=center border=0>
<TBODY>
<TR>
<TD vAlign=top width="430">
<table>
<TR>
<TD width=213><center><IMG height=88 src="../img/090_11.gif" 
width="438"></a></TD></TR>
<TR>
<TD>
<?
$board = "bbs_posi"; //�Խ��� Table ��
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
<TD vAlign=top width="205">
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
<TD width=59></TD>
<TD width=59>
<TABLE cellSpacing=1 cellPadding=0 width=200 bgColor=#cccccc border=0>
<FORM name=form1 method=post>
<TBODY>
<TR>
<TD bgColor=#ffffff>
<TABLE cellSpacing=0 cellPadding=0 width=180 align=center border=0>
<TBODY>
<TR>
<TD><IMG height=82 src="jio2.gif" width=180></TD></TR>
<TR>
<TD>
<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#cecfce border=0>
<TBODY>
<TR>
<TD class=lh130 bgColor=#f7f7f7><FONT color=#4080ae>�α� �������� �����߽��ϴ�. �α�������&nbsp;�Ѵ��� 
������..</FONT></TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD>
<TABLE>
<TBODY>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>1. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/hot/f8.php?set=view&board=bbs_hot&uid=81&opti_ex=����%20������%20�ϴ�%20����%20������%20����%20�ٶ��%20����%20�ִٸ鿩����%20��%20����%20���������Ӹ�%20�ƴ϶�%20��Ƽ%20����������%20��...&check_array=&search_word=&page=1&page_num=9">���� �����ϴ� ����..</A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>2. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/hot/f10.php?set=view&board=bbs_hot&uid=85&opti_ex=���㸮�,%20�Ҹ�,%20ǥ����%20����ϰ�%20��â%20����%20����%20����%20����%20�����ӿ�%20����%20�㸮��%20�����̴�%20��%20�߿��ϴ�...&check_array=&search_word=&page=1&page_num=5">������ ���� �¼���... </A><A 
href="/service/body/bodycareabc/20020330037/default.jsp"> </A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>3. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/hot/f11.php?set=view&board=bbs_hot&uid=82&opti_ex=������%20������%20���ڳ�%20��%20����%20���ڳ�%20ħ�뿡��%20�ö󰡸�%20��������%20�Ǽ���%20��������.����%20����%20������%20�ִ�...&check_array=&search_word=&page=1&page_num=3">������ �������� �Ǽ�
</A><A 
href="/service/body/hottrend/20020411009/default.jsp"> </A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>4. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/posi/b11.php?set=view&board=bbs_posi&uid=67&opti_ex=1.%20������%20����������%20�߱����%20ġ�ῡ%20ȿ����%20�ִ�%20ü��%20������%20����%20����%20�ٷ�%20����%20������%20��%20����%20����...&check_array=&search_word=&page=1&page_num=2">������ ���� 9���� ü��</A><A 
href="/service/body/hottrend/20020402008/default.jsp"> </A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>5. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/posi/b13.php?set=view&board=bbs_posi&uid=64&opti_ex=���,%20����,%20�Ҵ�,%20����,%20����,%20����%20����%20���%20��������%20�ǰ���%20ġ������%20�ǿ�����%20��%20��%20�ִ�.%20�ҳ����%20�̸�...&check_array=&search_word=&page=1&page_num=2">���� ������ �� �ϴ�..</A> </TD>
<TD width=5>&nbsp;</TD></TR>
</TBODY></TABLE></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD bgColor=#cccccc><IMG height=1 
src="http://www.dong100.com/image/main_img/blank.gif" width=1></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
</TBODY></TABLE></TD></TR><INPUT type=hidden value=0002 
name=cd_event> <INPUT type=hidden value=20050702164055 name=dt_entry> <INPUT 
type=hidden name=cd_id> </FORM></TBODY></TABLE></TD>
<TD width=59>
<P>&nbsp;</P></TD></TR></TBODY></TABLE>
<table border="0" cellpadding="0" cellspacing="0" width="204">
<tr>
	<td width="10">
		<p>&nbsp;</p>
	</td>
	<td width="182"><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR>
<TD width=205>
<TABLE cellSpacing=0 cellPadding=0 width=180 align=center border=0>
<TBODY>
<TR>
<TD><IMG height=82 src="../ses/semun.gif" width=180></TD></TR>
<TR>
<TD>
<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#cecfce border=0>
<TBODY>
<TR>
<TD class=lh130 bgColor=#f7f7f7><FONT color=#4080ae>����Ȱ�� ���� ����ϴ� ü���� 
� 
ü���ΰ���?</FONT></TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD>
<TABLE cellSpacing=0 cellPadding=0 width="95%" align=center border=0>
<TBODY>
<TR>
<TD><INPUT class=none type=radio value=1 name=ds_correct>������<BR><INPUT 
class=none type=radio value=2 name=ds_correct>�Ĺ���<BR><INPUT class=none 
type=radio value=3 name=ds_correct>������<BR><INPUT class=none type=radio 
value=4 name=ds_correct>����<BR></TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD bgColor=#cccccc><IMG height=1 
src="http://www.dong100.com/image/main_img/blank.gif" width=1></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD>
<TABLE cellSpacing=0 cellPadding=0 width=145 align=center border=0>
<TBODY>
<TR>
<TD width=74><A onfocus=this.blur() href="javascript:Open_Quiz_Result();"><IMG 
height=19 src="http://www.dong100.com/image/mag_img/btn_quize_01.gif" width=64 
border=0></A></TD>
<TD width=71><A onfocus=this.blur() href="../../jsp/event/quiz.jsp"><IMG 
height=19 src="http://www.dong100.com/image/mag_img/btn_quize_02.gif" width=71 
border=0></A></TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></td>
		<td width="12">
			<p>&nbsp;</p>
		</td>
	</tr>
</table>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<P>&nbsp;</P></td>
                                                                                <td width="59">
                                                                                    <p>&nbsp;</p>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
                                                <p>&nbsp;</p>
</TD></TR></TBODY></TABLE></TD></TR>
                        </table>
        </td>
        </tr>
      </table>

<?
include('../daum4.html');
?>