<?
/******************************************************************
 �� ���ϼ��� �� 
�ۺ����ϴ�

 �� ��Ų ������ ���� ���� ���� �� 
<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL

<?=$a_list?>					��Ϻ��� ��ũ



<?=$show_write_begin?>�۾���<?=$show_write_end?>
<?=$a_write?>					�۾��� ��ũ
<?=$show_reply_begin?>�����<?=$show_reply_end?>
<?=$a_reply?>					����۾��� ��ũ
<?=$show_edit_begin?>�۾���<?=$show_edit_end?>
<?=$a_edit?>					�۾��� ��ũ
<?=$show_delete_begin?>�ۻ���<?=$show_delete_end?>
<?=$a_delete?>				�ۻ��� ��ũ
<?=$show_vote_yes_begin?>��õ<?=$show_vote_yes_end?>
<?=$a_vote_yes?>			��õ��ũ
<?=$show_vote_no_begin?>����õ<?=$show_vote_no_end?>
<?=$a_vote_no?>				����õ��ũ
<?=$show_admin_begin?>�۰���<?=$show_admin_end?>
<?=$u_board_manager?> �۰��� �ּ�
******************************************************************/
?>
<TABLE cellSpacing=0 cellPadding=5 width="100%" border=0>
  <TR> 
    <TD class="bbs" align=right><br>
        <a href="../bbs/list2.php?bbs_id=golf"><IMG src="<?=$skin_board_url?>images/list.gif" border=0></a>

        <?=$show_edit_begin?><a href="edit.php?bbs_id=<?=$bbs_id?>&doc_num=<?=$doc_num?>&book=<?=$book?>"><IMG src="<?=$skin_board_url?>images/modify.gif" border=0></a><?=$show_edit_end?>
        <?=$show_delete_begin?><?=$a_delete?><IMG src="<?=$skin_board_url?>images/delete.gif" border=0></a><?=$show_delete_end?>

		<?=$show_vote_yes_begin?><?=$a_vote_yes?><IMG src="<?=$skin_board_url?>images/vote.gif" border=0></a><?=$show_vote_yes_end?>
		<?=$show_vote_no_begin?><?=$a_vote_no?><IMG src="<?=$skin_board_url?>images/novote.gif" border=0></a><?=$show_vote_no_end?>

        <?=$show_admin_begin?>
        <a href="javascript:view_manager(<?=$rg_doc_num?>)"><IMG src="<?=$skin_board_url?>images/admin.gif" border=0></a>

		<script language="JavaScript" type="text/JavaScript">
		function view_manager(doc_num){
			window.open('<?=$u_board_manager?>?bbs_id=<?=$bbs_id?>&chk_rg_num[]='+doc_num, "board_manager", 'scrollbars=no,width=355,height=200');
		}
		</script>

        <?=$show_admin_end?>
		</TD>
  </TR>
</TABLE>
<br>
