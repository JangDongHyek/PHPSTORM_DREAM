<? 
//�Խ��� ��Ϻ��⿡�� ���� ���ڼ� �ڸ��� 
//$rg_title = rg_cut_string($rg_title,15,'...'); 
?> 
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
<?
//����� ���μ��� ũ�� ���� 
	$thum_width = 30; 
	$thum_height = 30; 

	if($l_cols % $cols == 0) {
?>

<TR> 
	<TD align=middle bgColor=#ffffff colSpan='<?=$colspan?>' height=1>
	<IMG height=1 src="<?=$skin_board_url?>blank_.gif" width="100%" border=0></TD>
</TR>
<tr bgcolor="#FFFFFF">
<?
	}
	$l_cols++;

	if($l_cols == 1){
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	change_image('<?=$rg_file1_url?>', '<?=$rg_file1_info[0]?>', '<?=$rg_title?>');
//-->
</SCRIPT>	
<?
	}
?>
     <td align="left" valign="top"> 
       
		<table cellspacing="0" cellpadding="0" border=0>
		  <tr>
			<td align="center" valign="bottom"> 
			  <table border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">
				<tr>
				  <td bgcolor="#FFFFFF"> 
					<img src="<?=$rg_file1_url?>" border="0" width="<?=$thum_width?>" height="<?=$thum_height?>" onerror="this.src='<?=$skin_board_url?>blank_.gif'" onclick="change_image('<?=$rg_file1_url?>','<?=$rg_file1_info[0]?>', '<?=$rg_title?>')" style="cursor:hand;" height="94" vspace="4" hspace="4"></td>
				</tr>
			  </table>
			</td>
		  </tr>
		  <tr>
			<td align="center" valign="top"> 
			  <?=$show_chk_begin?>
			  <input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
			  <?=$show_chk_end?>
			  <!--  <span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>','<?=$skin_board_url?>')" style='cursor:hand;'>
			  <?=$rg_mb_icon?> <?=$rg_name?>
			  </span> 
			  <?=$a_list_view?>
			  <?=$rg_title?></a>
			  <span style='font-size:8pt;'>
			  <?=$rg_cmt_count?>
			  </span> --> </td>
		  </tr>
		</table>
	</td>
<?
	if($l_cols%3==0){
?>
</tr>
<? 
	}
?>
