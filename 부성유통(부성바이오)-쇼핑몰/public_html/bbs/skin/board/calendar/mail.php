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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>���Ϲ߼�</title>
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
    <td>���� : 
      <?=$mail_title?>
  </tr>
  <tr> 
    <td>�Խ��� : 
      <?=$mail_from_name?>
      ��</td>
  </tr>
  <tr>
    <td>�Է³��� : 
      <p> 
        <?=$mail_content?>
    </td>
  </tr>
  <tr> 
    <td> [<a href='<?=$mail_view_url?>' target=_gnuboard>�ش�� 
      �ٷκ���</a>] </td>
  </tr>
</table>
</body>
</html>
