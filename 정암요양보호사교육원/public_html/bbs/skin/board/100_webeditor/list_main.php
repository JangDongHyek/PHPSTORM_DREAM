<?
/******************************************************************
 �� ���ϼ��� �� 
�Ϲ� �Խ��� ��Ͻ�Ų

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�
<?=$mb_id?>						ȸ�����̶�� ȸ�����̵�
<?=$mb_open_info?>		ȸ�����̶�� ������������(ȸ������)

<?=$no?> 							������ �Խù���ȣ(����)
<?=$rg_doc_num?>			�������� �Խù���ȣ(������ �Խù���ȣ)
<?=$rg_reply?>				����� ���̿� ������
<?=$rg_secret_icon?>	��б� ������
<?=$rg_title?>				����
<?=$rg_cmt_count?>		�ڸ�Ʈ ����
<?=$rg_new_icon?>			���� ������
<?=$rg_reg_date?>			�۵����
<?=$rg_name?>					����ڸ�
<?=$rg_email_enc?>		����
<?=$rg_home_url?>			Ȩ������
<?=$rg_mb_icon?>			����ڰ� ȸ���̶�� ȸ��������
<?=$rg_doc_hit?>			����ȸ��

<?=$a_list_view?>			�ۺ��� ��ũ


<?=$show_category_begin?>ī�װ�<?=$show_category_end?>
<?=$rg_cat_name?>			ī�װ���
<?=$show_chk_begin?>īƮ���(üũ�ڽ�)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>��õ��<?=$show_vote_yes_end?>
<?=$rg_vote_yes?>			��õ��
<?=$show_vote_no_begin?>����õ��<?=$show_vote_no_end?>
<?=$rg_vote_no?>			����õ��

******************************************************************/
?>
	<TR bgColor='<?=($no%2==1)?"#ffffff":"#ffffff"?>' height=26> 
		<TD align=middle class="bbs"><?=$no?></TD>
		
		<?=$show_category_begin?>
		<td align=middle class="bbs"><?=$rg_cat_name?></td>
		<?=$show_category_end?>
	
		<TD nowrap>
		
		<?=$show_chk_begin?>
		<input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
		<?=$show_chk_end?>
	
		<?=$rg_reply?><?=$rg_secret_icon?><?=$a_list_view?><?=$rg_title?></a> <span style='font-size:8pt;'><?=$rg_cmt_count?></span> <?=$rg_new_icon?></TD></xmp></xml></font>
		<TD align=middle class="bbs"><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$rg_mb_icon?> <?=$rg_name?></span></TD>
		<TD align=middle class="bbs"><?=$rg_reg_date?></TD>
		
		<?=$show_download_begin?>
		<TD align=middle class="bbs"><?=$rg_file1_hit?></td>
		<?=$show_download_end?>
	
		<TD align=middle class="bbs"><?=$rg_doc_hit?></TD>
		
		<?=$show_vote_yes_begin?>
		<TD align=middle class="bbs"><?=$rg_vote_yes?></td>
		<?=$show_vote_yes_end?>

	</TR>
	<TR> 
		<TD align=middle bgColor=#E7E7E7 colSpan='<?=$colspan?>' height=1></TD>
	</TR>