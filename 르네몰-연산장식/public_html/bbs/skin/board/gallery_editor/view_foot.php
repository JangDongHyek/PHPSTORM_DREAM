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
<TR> 
	<TD class="bbs" height=50>
    <?=$a_list?><IMG src="<?=$skin_board_url?>images/list.gif" border=0></a>
<?
	$qry="SELECT * FROM rg_goods_category";
	$rs=mysql_query($qry);
	$tmp = mysql_fetch_array($rs);


$qry="SELECT * FROM rg_goods_category where cat_num='$ss[fc]'";
$rs=query($qry,$dbcon);
$tmp = mysql_fetch_array($rs);

if($tmp[cat_name] == $ss_mb_id || $MemberLevel==1){ //�з���� �α���̵�� ������ ��ϰ���
?>

    <?=$show_write_begin?><a href="./write.php?bbs_id=<?=$bbs_id?>&ss[fc]=<?=$ss[fc]?>"><IMG src="<?=$skin_board_url?>images/write.gif" border=0></a><?=$show_write_end?>
    <?=$show_reply_begin?><?=$a_reply?><IMG src="<?=$skin_board_url?>images/reply.gif" border=0></a><?=$show_reply_end?>

    <?=$show_edit_begin?><?=$a_edit?><IMG src="<?=$skin_board_url?>images/modify.gif" border=0></a><?=$show_edit_end?>
    <?=$show_delete_begin?><?=$a_delete?><IMG src="<?=$skin_board_url?>images/delete.gif" border=0></a><?=$show_delete_end?>

	<?=$show_vote_yes_begin?><?=$a_vote_yes?><IMG src="<?=$skin_board_url?>images/vote_good.gif" border=0></a><?=$show_vote_yes_end?>
	<?=$show_vote_no_begin?><?=$a_vote_no?><IMG src="<?=$skin_board_url?>images/vote_bad.gif" border=0></a><?=$show_vote_no_end?>
<?
}
?>
	</TD>
</TR>
</TABLE>