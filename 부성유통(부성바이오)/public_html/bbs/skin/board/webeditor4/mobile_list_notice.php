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
<?
	if($no%2==0){
		$class_bg="n_board_list";
	}else{
		$class_bg="n_board_list_bg";
	}
?>
<?=$a_list_view?>

<div class="<?=$class_bg?>">
           <ul>
			<li class="title"><?=$rg_reply?><?=$rg_secret_icon?><?=$rg_title?></li>
			<li class="writer"><?=$rg_reg_date?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?=$rg_name?></li>
		   </ul> 
</div>
</a>