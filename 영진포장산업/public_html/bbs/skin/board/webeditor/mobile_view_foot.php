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
<div class="bbs_view_third" align="right">
	<span class="button large"><?=$a_list?>���</a></span>
	<?=$show_write_begin?><span onclick="javascript:prepareForPicker();" class="button large"><?=$a_write?>�۾���</a></span><?=$show_write_end?>
	<?=$show_reply_begin?><span class="button large"><?=$a_reply?>�亯</a></span><?=$show_reply_end?>
	<?=$show_edit_begin?><span onclick="javascript:prepareForPicker2();" class="button large"><?=$a_edit?>����</a></span><?=$show_edit_end?>
    <?=$show_delete_begin?><span class="button large"><?=$a_delete?>����</a></span><?=$show_delete_end?>
	<? /*?>
    <?=$show_write_begin?><?=$a_write?><IMG src="<?=$skin_board_url?>images/write.gif" border=0></a><?=$show_write_end?>
    <?=$show_reply_begin?><?=$a_reply?><IMG src="<?=$skin_board_url?>images/reply.gif" border=0></a><?=$show_reply_end?>

    <?=$show_edit_begin?><?=$a_edit?><IMG src="<?=$skin_board_url?>images/modify.gif" border=0></a><?=$show_edit_end?>
    <?=$show_delete_begin?><?=$a_delete?><IMG src="<?=$skin_board_url?>images/delete.gif" border=0></a><?=$show_delete_end?>

	<?=$show_vote_yes_begin?><?=$a_vote_yes?><IMG src="<?=$skin_board_url?>images/vote_good.gif" border=0></a><?=$show_vote_yes_end?>
	<?=$show_vote_no_begin?><?=$a_vote_no?><IMG src="<?=$skin_board_url?>images/vote_bad.gif" border=0></a><?=$show_vote_no_end?>
	<? */?>
</div>
<?
	/*
?>
<TR> 
	<TD class="bbs" height=50>
    <?=$a_list?><IMG src="<?=$skin_board_url?>images/list.gif" border=0></a>

    <?=$show_write_begin?><?=$a_write?><IMG src="<?=$skin_board_url?>images/write.gif" border=0></a><?=$show_write_end?>
    <?=$show_reply_begin?><?=$a_reply?><IMG src="<?=$skin_board_url?>images/reply.gif" border=0></a><?=$show_reply_end?>

    <?=$show_edit_begin?><?=$a_edit?><IMG src="<?=$skin_board_url?>images/modify.gif" border=0></a><?=$show_edit_end?>
    <?=$show_delete_begin?><?=$a_delete?><IMG src="<?=$skin_board_url?>images/delete.gif" border=0></a><?=$show_delete_end?>

	<?=$show_vote_yes_begin?><?=$a_vote_yes?><IMG src="<?=$skin_board_url?>images/vote_good.gif" border=0></a><?=$show_vote_yes_end?>
	<?=$show_vote_no_begin?><?=$a_vote_no?><IMG src="<?=$skin_board_url?>images/vote_bad.gif" border=0></a><?=$show_vote_no_end?>

    <?=$show_admin_begin?>
    <a href="javascript:view_manager(<?=$rg_doc_num?>)"><IMG src="<?=$skin_board_url?>images/check_admin.gif" border=0></a>
<script language="JavaScript" type="text/JavaScript">
function view_manager(doc_num)
{
	window.open('<?=$u_board_manager?>?bbs_id=<?=$bbs_id?>&chk_rg_num[]='+doc_num, "board_manager", 'scrollbars=no,width=355,height=200');
}
</script>
        <?=$show_admin_end?>
	</TD>
</TR>
</TABLE>
<br>
<br>
<? */?>

<script type="text/javascript">
var a = "<?echo($mb[mb_num]);?>";
var b = "<?echo ($bbs_id);?>";

function prepareForPicker2(){
    if(getAndroidVersion().indexOf("4.4.2") != -1 && b == "pro_sell1"){
        window.jsi.register(a, "edit");
        return false;
    }
}
</script>