<?
/******************************************************************
 �� ���ϼ��� �� 
�ڸ�Ʈ���

 �� ��Ų ������ ���� ���� ���� �� 
<?=$vtc_reg_ip?>			�ڸ�Ʈ ������
<?=$vtc_num?>					�ڸ�Ʈ ��ȣ(��������)
<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�
<?=$mb_id?>						ȸ�����̶�� ȸ�����̵�
<?=$vtc_name?>				�ۼ��ڸ�
<?=$vtc_email?>				�ۼ��� �̸���
<?=$mb_homepage?>			ȸ�����̶�� ȸ��Ȩ������
<?=$rg_mb_icon?>			����ڰ� ȸ���̶�� ȸ��������
<?=$mb_open_info?>		ȸ�����̶�� ������������(ȸ������)
<?=$vtc_reg_date?>		�ڸ�Ʈ �����
<?=$vtc_comment?>			�ڸ�Ʈ ����

<?=$a_comment_delete?>	������ũ

<?=$show_comment_delete_begin?>
�ڸ�Ʈ����
<?=$show_comment_delete_end?>

******************************************************************/
?>
<a name='c<?=$vtc_num?>'></a>
<tr><td class=bbs style='padding:3px; padding-left:10px; padding-right:10px;'>
			<span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$vtc_name?>', '<?=$vtc_email?>', '<?=$mb_homepage?>', '<?=$mb_open_info?>','<?=$skin_site_url?>')" style='cursor:hand;'>
      <?=$vtc_mb_icon?>
      <?=$vtc_name?>
      </span> [<?=$vtc_reg_date?>] 
      <?=$show_comment_delete_begin?>
      - 
      <?=$a_comment_delete?>
      <img src="<?=$skin_vote_url?>del.gif" border=0></a> <br>
      <?=$show_comment_delete_end?>
      <img width=1 height=5><br>
      <?=$vtc_comment?>
      <Br>
      <img width=1 height=5><br>
    <div align="right">WRITE IP : 
      <?=$vtc_reg_ip?>
    </div></td></tr>
			<TD align=middle bgColor=#cdcdc colSpan=2 height=1><IMG 
									height=1 width="100%" 
									border=0></TD>
			</TR>