<?
/******************************************************************
 �� ���ϼ��� �� 
��ϻ��

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�

<?=$total_doc_count?>	�� �Խù���
<?=$page?>						����������
<?=$total_page?>			�� ��������

<?=$show_category_begin?>ī�װ�<?=$show_category_end?>
<?=$u_category?>			ī�װ� ���� URL
<?=$category_list_option?>	ī�װ� option ����Ʈ
<?=$show_chk_begin?>īƮ���(üũ�ڽ�)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>��õ��<?=$show_vote_yes_end?>
<?=$show_vote_no_begin?>����õ��<?=$show_vote_no_end?>

******************************************************************/
$l_cols = 0;
?>
<?
$qry="SELECT * FROM rg_goods_category";
$rs=mysql_query($qry);
$tmp = mysql_fetch_array($rs);


$qry="SELECT * FROM rg_goods_category where cat_num='$ss[fc]'";
$rs=query($qry,$dbcon);
$tmp = mysql_fetch_array($rs);


$qry2 = "select * from reservation_com where value11='$tmp[cat_name]'";
$rs2=query($qry2,$dbcon);
$tmp2 = mysql_fetch_array($rs2);

echo "<font size=3><b>$tmp2[value1] ��ǰ����Ʈ</b></font>";
?>
<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<!--
<form name=fcategory>
	<td width=50%> 
    <?=$show_category_begin?>
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>��ü</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
-->
	<td width=50% align="right" class="bbs"><?=$page?>/<?=$total_page?>, �� ��ǰ���� : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<!--<TR>
	<TD bgcolor=#80a8de height=6></TD>
</TR>-->
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>