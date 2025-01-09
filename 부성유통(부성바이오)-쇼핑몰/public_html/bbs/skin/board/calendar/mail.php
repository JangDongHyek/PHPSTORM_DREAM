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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>메일발송</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>

<body>       
<table width=100% border=1 align=center cellpadding=4 cellspacing=0 bordercolordark='white' bordercolorlight='navy' style='font-family:Verdana; font-size:12px;'>
  <tr> 
    <td>
      <?=$mail_subject?>
    </td>
  </tr>
  <tr> 
    <td>제목 : 
      <?=$mail_title?>
  </tr>
  <tr> 
    <td>게시자 : 
      <?=$mail_from_name?>
      　</td>
  </tr>
  <tr>
    <td>입력내용 : 
      <p> 
        <?=$mail_content?>
    </td>
  </tr>
  <tr> 
    <td> [<a href='<?=$mail_view_url?>' target=_gnuboard>해당글 
      바로보기</a>] </td>
  </tr>
</table>
</body>
</html>
