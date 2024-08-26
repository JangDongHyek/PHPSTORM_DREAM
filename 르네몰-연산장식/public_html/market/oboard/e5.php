<?
if(!$HTTP_COOKIE_VARS[BEAUTYE_ID]){
	echo "<meta http-equiv='Refresh' content='0; URL=../member1.php'>";
	exit;
}
?>

<html>
<head><title>아름다운 성 - 뷰티e넷</title>
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
<script language=JavaScript>function click() {if ((event.button==2) || (event.button==2)) {alert('죄송합니다. 오른쪽 마우스 금지입니다. - 뷰티e ');}}document.onmousedown=click// --></script> 
<script language="JavaScript">
<!-- www.tagin.net
function click() { 
     if((event.ctrlKey) || (event.shiftKey)) { 
       alert('키를 사용할 수 없습니다.'); 
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
<?
include("../include/all_left.html");
include("../include/ee_left.html");
?>
		  <td width="655" valign="top" bgcolor="#FFFFFF">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="651">
                                    <p><img src="../img/mj18.jpg" width="659" height="119" border="0"></p>
                                </td>
                            </tr>
                        </table>
                        <table width="656">

<TR>
<TD vAlign=top width="650">
                        <table width="660">

<TR>
<TD bgColor=#d9d9d0 width="654"></TD></TR>
                        </table>
                        <table width="660">

<TR>
<TD vAlign=top width="654">
<TABLE cellSpacing=0 cellPadding=0 width="658" align=center border=0>
<TBODY>
<TR>
<TD vAlign=top width="441">
                                                <table>

<TR>
<TD width=213></TD></TR>
<TR>
<TD width=438><IMG height=43 src="../img/apo6.gif" 
width="438"></TD></TR>
<TR>
<TD><IMG height=5 src="http://www.dongadept.com/image/sub_img/blank.gif" width=1></TD></TR>
<TR>
<TD>
<?
$board = "bbs_ee"; //게시판 Table 명
$board_type = "magazine"; //게시판 Type(board,faq,magazine)
$code_url = $PHP_SELF; // 부모 url 이자 테이블 페이지 구분 코드값
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
<TD width=1 bgColor=#d9d9d0><IMG height=1 src="../sung/blank.gif" 
width=1></TD>
<TD vAlign=top width="216">
<TABLE cellSpacing=0 cellPadding=0 width=200 align=right border=0>
<TBODY>
<TR>
<TD vAlign=top>
<TABLE cellSpacing=0 cellPadding=0 width=200 border=0>
<TBODY>
<TR>
<TD><IMG height=8 src="../sung/blank.gif" 
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
<TD width="187"><IMG height=82 src="../img/aap4.gif" width=180></TD></TR>
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
                                                                                                                                                                                                    <p><a href="../hot/f2.php">다리를 
                                                                                                                                                                                                                꼭 
                                                                                                                                                                                                                붙이게 
                                                                                                                                                                                                                한다</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>2. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="/ver1/hot/f2.php?set=view&board=bbs_hot&uid=92&opti_ex=정상위로%20여성의%20성삼이%20높아지는%20곳을%20계산해%20보면%20남성은%20그대로%20페니스의%20축으로%20해%20여성의%20몸을%2090도%20회전시...&check_array=&search_word=&page=1&page_num=1">좌위-질내에 
                                                                                                                                                                                                                자극적인 
                                                                                                                                                                                                                포즈</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>3. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="../hot/f2_3.php">기승위-다리를 
                                                                                                                                                                                                                가슴위쪽</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>4. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="../hot/f2_4.php">후배위-여성의 
                                                                                                                                                                                                                다리를 
                                                                                                                                                                                                                자신의 
                                                                                                                                                                                                                다리로 
                                                                                                                                                                                                                조임</a></p>
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
</TD></TR>
                        </table>
                </td>
        </tr>
      </table>

<?
include("../daum7.html");
?>
