<?
/******************************************************************
 ★ 파일설명 ★ 
메일스킨

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$mail_subject?>		메일제목
<?=$mail_title?>			타이틀
<?=$mail_from_name?>	글쓴이
<?=$mail_content?>		글내용
<?=$mail_view_url?>		글바로보기

******************************************************************/
?>
<? 
   $site_path = "보드설치경로";
   $site_url = "보드의 URL ";
?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>메일발송</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>

<body>       
<!--<table width=100% border=1 align=center cellpadding=4 cellspacing=0 bordercolordark='white' bordercolorlight='navy' style='font-family:Verdana; font-size:12px;'>-->
<div align="center"><img src="<?=$site_url?>/<?=$skin_board_url?>images/head_img13.gif" border=0 vspace="15"></div>
<table width=100% border=0 align=center cellpadding=5 cellspacing=0 style='font-size:9pt;color:#666666'>
  <TR bgcolor="#999999">
    <TD height="2"></TD>
    <TD height="2"></TD>
  </TR>
  <tr>
    <td width="15%" height="30" style='padding-right:15;'> 
      <div align="right"><b>카테고리</b> :</div>
    </td>
    <td> 
      <?=$mail_subject?>
    </td>
  </tr>
  <TR bgcolor=#e7e7e7>
    <TD height="1"></TD>
    <TD height="1"></TD>
  </TR>
  <tr>
    <td style='padding-right:15;' height="30"> 
      <div align="right"><b>제목</b> :</div>
    <td>
      <?=$mail_title?>
  </tr>
  <TR bgcolor=#e7e7e7>
    <TD height="1"></TD>
    <TD height="1"></TD>
  </TR>
  <tr>
    <td style='padding-right:15;' height="30"> 
      <div align="right"><b>게시자</b> :</div>
    </td>
    <td>
      <?=$mail_from_name?>
      　[<a href='<?=$mail_view_url?>' target=_rgboard>해당글 바로보기</a>] </td>
  </tr>
  <TR bgcolor=#e7e7e7>
    <TD height="1"></TD>
    <TD height="1"></TD>
  </TR>
  <tr>
    <td style='padding-right:15;'> 
      <div align="right"><b>입력내용</b> :</div>
    </td>
    <td>
<p> 
        <?=$mail_content?>
    </td>
  </tr>
    <TR bgcolor=#e7e7e7>
    <TD height="1"></TD>
    <TD height="1"></TD>
  </TR>
</table>
</body>
</html>
