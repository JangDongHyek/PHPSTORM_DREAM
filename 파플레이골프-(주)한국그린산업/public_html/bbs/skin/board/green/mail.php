<?
/******************************************************************
 �� ���ϼ��� �� 
���Ͻ�Ų

 �� ��Ų ������ ���� ���� ���� �� 

<?=$mail_subject?>		��������
<?=$mail_title?>			Ÿ��Ʋ
<?=$mail_from_name?>	�۾���
<?=$mail_content?>		�۳���
<?=$mail_view_url?>		�۹ٷκ���

******************************************************************/
?>
<? 
   $site_path = "���弳ġ���";
   $site_url = "������ URL ";
?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>���Ϲ߼�</title>
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
      <div align="right"><b>ī�װ�</b> :</div>
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
      <div align="right"><b>����</b> :</div>
    <td>
      <?=$mail_title?>
  </tr>
  <TR bgcolor=#e7e7e7>
    <TD height="1"></TD>
    <TD height="1"></TD>
  </TR>
  <tr>
    <td style='padding-right:15;' height="30"> 
      <div align="right"><b>�Խ���</b> :</div>
    </td>
    <td>
      <?=$mail_from_name?>
      ��[<a href='<?=$mail_view_url?>' target=_rgboard>�ش�� �ٷκ���</a>] </td>
  </tr>
  <TR bgcolor=#e7e7e7>
    <TD height="1"></TD>
    <TD height="1"></TD>
  </TR>
  <tr>
    <td style='padding-right:15;'> 
      <div align="right"><b>�Է³���</b> :</div>
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
