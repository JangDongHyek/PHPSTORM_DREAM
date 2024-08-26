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
$board = "bbs_sung"; //게시판 Table 명
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
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=188&opti_ex=섹스할%20때%20부끄럽고%20창피해서%20집중할%20수%20없다%20.이럴%20때는%20보통%20섹스%20행위보다%20육체적인%20것에%20신경이%20쓰여%20집중이...&check_array=&search_word=&page=1&page_num=1">섹스 
                                                                                                                                                                                                    도중 
                                                                                                                                                                                                    이럴 
                                                                                                                                                                                                    때 
                                                                                                                                                                                                    난처하다</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>2. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=189&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">쾌감을 
                                                                                                                                                                                                    좀 
                                                                                                                                                                                                    더 
                                                                                                                                                                                                    느끼고 
                                                                                                                                                                                                    싶다</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>3. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=190&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">러브파워로 
                                                                                                                                                                                                    그를 
                                                                                                                                                                                                    만족시키고 
                                                                                                                                                                                                    싶다</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>4. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=191&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">여자가 
                                                                                                                                                                                                    리드하는 
                                                                                                                                                                                                    황홀한 
                                                                                                                                                                                                    관능의 
                                                                                                                                                                                                    세계 
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
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=192&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">표현법 
                                                                                                                                                                                                    -표정과 
                                                                                                                                                                                                    몸짓 
                                                                                                                                                                                                    등 
                                                                                                                                                                                                    온몸으로 
                                                                                                                                                                                                    애정을 
                                                                                                                                                                                                    표현한다</a></p>
 </TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>6. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=193&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">성감대-그가 
                                                                                                                                                                                                    느끼는 
                                                                                                                                                                                                    성감대 
                                                                                                                                                                                                    급소를 
                                                                                                                                                                                                    찾는 
                                                                                                                                                                                                    것도 
                                                                                                                                                                                                    새로운 
                                                                                                                                                                                                    즐거움</a></p>
 </TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>7. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=194&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">전희 
                                                                                                                                                                                                    적극적인 
                                                                                                                                                                                                    전희로 
                                                                                                                                                                                                    애정을 
                                                                                                                                                                                                    느끼는 
                                                                                                                                                                                                    남성이 
                                                                                                                                                                                                    많다</a></p>
</TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>8. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=195&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">오럴섹스 
                                                                                                                                                                                                    남성이 
                                                                                                                                                                                                    간절히 
                                                                                                                                                                                                    원하는, 
                                                                                                                                                                                                    여성이 
                                                                                                                                                                                                    완전히 
                                                                                                                                                                                                    주도권을 
                                                                                                                                                                                                    잡는 
                                                                                                                                                                                                    결정적 
                                                                                                                                                                                                    테크닉</a></p>
 </TD>
</TR>
<TR>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
vAlign=top align=right width=20>9. </TD>
<TD class=top10 
style="PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" 
width="136">
                                                                                                                                                                                                    <p><a href="http://www.beautye.net/ver1/sung/a8.php?set=view&board=bbs_sung&uid=196&opti_ex=0&check_array=&search_word=&page=1&page_num=&sort1=&sort2=">체위 
                                                                                                                                                                                                    여성이 
                                                                                                                                                                                                    먼저 
                                                                                                                                                                                                    잘 
                                                                                                                                                                                                    느껴지는 
                                                                                                                                                                                                    포즈를 
                                                                                                                                                                                                    알려준다</a></p>
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