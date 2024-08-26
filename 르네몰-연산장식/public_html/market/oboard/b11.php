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
$board = "bbs_posi"; //게시판 Table 명
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
<TD class=lh130 bgColor=#f7f7f7><FONT color=#4080ae>인기 순위별로 집계했습니다. 인기정보를&nbsp;한눈에 
보세요..</FONT></TD></TR></TBODY></TABLE></TD></TR>
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
width=135><A href="http://beautye.net/ver1/hot/f8.php?set=view&board=bbs_hot&uid=81&opti_ex=섹스%20행위를%20하는%20동안%20남성이%20가장%20바라는%20것이%20있다면여성이%20한%20번의%20오르가슴뿐만%20아니라%20멀티%20오르가슴에%20이...&check_array=&search_word=&page=1&page_num=9">빨리 사정하는 것을..</A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>2. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/hot/f10.php?set=view&board=bbs_hot&uid=85&opti_ex=＊허리운동,%20소리,%20표정은%20대담하게%20한창%20섹스%20중일%20때는%20그의%20움직임에%20맞춰%20허리를%20움직이는%20게%20중요하다...&check_array=&search_word=&page=1&page_num=5">여성을 위한 굿섹스... </A><A 
href="/service/body/bodycareabc/20020330037/default.jsp"> </A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>3. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/hot/f11.php?set=view&board=bbs_hot&uid=82&opti_ex=성격이%20차분한%20남자나%20불%20같은%20남자나%20침대에만%20올라가면%20여지없이%20실수를%20저지른다.섹스%20때는%20절차가%20있는...&check_array=&search_word=&page=1&page_num=3">남성이 저지르는 실수
</A><A 
href="/service/body/hottrend/20020411009/default.jsp"> </A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>4. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/posi/b11.php?set=view&board=bbs_posi&uid=67&opti_ex=1.%20남성의%20정력증강과%20발기부전%20치료에%20효과가%20있는%20체위%20여성은%20위를%20보고%20바로%20눕고%20남성은%20그%20위에%20엎드...&check_array=&search_word=&page=1&page_num=2">여성을 위한 9가지 체위</A><A 
href="/service/body/hottrend/20020402008/default.jsp"> </A></TD>
<TD width=5>&nbsp;</TD></TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>5. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width=135><A href="http://beautye.net/ver1/posi/b13.php?set=view&board=bbs_posi&uid=64&opti_ex=쇠약,%20조루,%20불능,%20위축,%20과로,%20음주%20등의%20경우%20성행위는%20건강에%20치명적인%20악영향을%20줄%20수%20있다.%20소녀경은%20이를...&check_array=&search_word=&page=1&page_num=2">몸이 안좋을 때 하는..</A> </TD>
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
<TD class=lh130 bgColor=#f7f7f7><FONT color=#4080ae>성생활시 가장 즐겨하는 체위는 
어떤 
체위인가요?</FONT></TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD><IMG height=8 src="http://www.dong100.com/image/main_img/blank.gif" 
width=1></TD></TR>
<TR>
<TD>
<TABLE cellSpacing=0 cellPadding=0 width="95%" align=center border=0>
<TBODY>
<TR>
<TD><INPUT class=none type=radio value=1 name=ds_correct>정상위<BR><INPUT 
class=none type=radio value=2 name=ds_correct>후배위<BR><INPUT class=none 
type=radio value=3 name=ds_correct>좌측위<BR><INPUT class=none type=radio 
value=4 name=ds_correct>입위<BR></TD></TR></TBODY></TABLE></TD></TR>
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