<?
/******************************************************************
 �� ���ϼ��� �� 
�ڸ�Ʈ���

 �� ��Ų ������ ���� ���� ���� �� 
<?=$cmt_reg_ip?>			�ڸ�Ʈ ������
<?=$cmt_num?>					�ڸ�Ʈ ��ȣ(��������)
<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�
<?=$mb_id?>						ȸ�����̶�� ȸ�����̵�
<?=$cmt_name?>				�ۼ��ڸ�
<?=$cmt_email?>				�ۼ��� �̸���
<?=$mb_homepage?>			ȸ�����̶�� ȸ��Ȩ������
<?=$rg_mb_icon?>			����ڰ� ȸ���̶�� ȸ��������
<?=$mb_open_info?>		ȸ�����̶�� ������������(ȸ������)
<?=$cmt_reg_date?>		�ڸ�Ʈ �����
<?=$cmt_comment?>			�ڸ�Ʈ ����

<?=$a_comment_delete?>	������ũ

<?=$show_comment_delete_begin?>
�ڸ�Ʈ����
<?=$show_comment_delete_end?>

******************************************************************/
?>
		<a name='c<?=$cmt_num?>'></a>
		<tr bgcolor=#FFFFFF>
			<td class=bbs>
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
			  <tr>
				<td width="80" valign="top"><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$cmt_name?>', '<?=$cmt_email?>', '<?=$mb_homepage?>', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$cmt_mb_icon?><?=$cmt_name?></span></td>
				<td valign="top">
				  <?=$cmt_comment?>
				  &nbsp;
				  <?=$show_comment_delete_begin?>
				  <?=$a_comment_delete?>
				  <img src="<?=$skin_board_url?>images/del.gif" border=0></a>
				  <?=$show_comment_delete_end?>
				  <br>
				  <font color="#999999">[
				  <?=$cmt_reg_date?>
				  ]</font></td>
			  </tr>
			  <TR bgcolor=#e7e7e7> 
				<TD height="1" colspan="2"></TD>
			  </TR>
			</table> 
			</td>
		</tr>