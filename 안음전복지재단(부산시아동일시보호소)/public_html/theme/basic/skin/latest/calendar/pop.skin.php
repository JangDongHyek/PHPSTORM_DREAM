<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");

$g4[title] = "일정보기";
include_once("./head.sub.php");

 if ($member[mb_level] < $board[bo_read_level]) {  
      alert('비정상적인 접근이군요.\\n\\n정상적인 경로로 접근해주세요.','javascript:window.close()');
	  exit;
 }

?>
<link rel="stylesheet" href="./style.css" type="text/css">

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF"><tr><td width="100%" height="100%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr><td width="100%" height="10"></td></tr>
</table>
<? for ($i=0; $i<count($list); $i++) { ?>
<TABLE width="100%" cellSpacing=0 cellPadding=0 bgColor=#f6f6f6 border=0>
  <tr><td width="100%" height=1 bgcolor=#EEEEEE></td></tr>
  <TR>
    <TD>
	  <TABLE width="100%" border=0 cellpadding="3" cellspacing="0">
        <TR bgcolor="#EFEFDE">
          <TD width="100%" height="28" valign="middle">&nbsp;<IMG src="<?=$board_skin_path?>/img/cal.gif" align=absMiddle border=0>
				<B><FONT color=#000000><?=$list[$i][wr_subject]?></FONT></B> </TD>
		</TR>
      </TABLE>
	</TD>
  </TR>
  <TR>
      <TD width="100%" height="1" background="./skin/board/schedulex/images/dotline.gif"></TD>
  </TR>
</TABLE>
<TABLE width="100%" cellSpacing=0 cellPadding=3 border=0 bgcolor="#FFFFFF">
  <?
     $from_date = str_replace("http://","",$list[$i][wr_link1]);
     $to_date = str_replace("http://","",$list[$i][wr_link2]);
     $from_date = substr($from_date,0,4)."년 ".sprintf("%2d",substr($from_date,4,2))."월 ".sprintf("%2d",substr($from_date,6,2))."일";
     $to_date   = substr($to_date,0,4)."년 ".sprintf("%2d",substr($to_date,4,2))."월 ".sprintf("%2d",substr($to_date,6,2))."일";
  ?>
  <tr height="25">
    <td width="100%" valign="middle">&nbsp;일 정 : <?=$from_date?> <? if($from_date != $to_date) echo"~ $to_date";?></td>
  </tr>
  <TR><TD height="1" background="./skin/board/schedulex/images/dotline.gif"></TD></TR>
    <tr>
     <td>
	  <TABLE width="100%" border=0 cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
        <TR><TD>
       <span class=content><?=$list[$i][content]?></span>
            <!-- 테러 태그 방지용 -->
       </xml></xmp><a href=""></a><a href=''></a>
	   </TD></TR></table>
	 </td>
  </tr>
</TABLE>
<TABLE width="100%" cellSpacing=0 cellPadding=0 border=0 align="center" bgcolor="#FFFFFF">
  <TR>
    <TD bgColor=#f6f6f6 height=1></TD>
  </TR>
</TABLE>
<? } ?>
<TABLE width='100%' height='30' cellpadding='5' cellspacing='0' border='0' bgcolor="#FFFFFF">
  <TR><TD align=center><br><input type='button' value=' 닫 기 ' onClick='window.close()'align='absmiddle'></td></tr>
</table>
<TABLE width="100%" cellSpacing=0 cellPadding=0 border=0 align="center" bgcolor="#FFFFFF">
  <TR>
    <TD bgColor=#f6f6f6 height=1></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
<?
include_once("./tail.sub.php");
?>