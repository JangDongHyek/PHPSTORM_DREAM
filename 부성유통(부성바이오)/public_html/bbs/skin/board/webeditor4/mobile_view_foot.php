<?
/******************************************************************
 ★ 파일설명 ★ 
글보기하단

 ★ 스킨 제작을 위한 변수 설명 ★ 
<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL

<?=$a_list?>					목록보기 링크



<?=$show_write_begin?>글쓰기<?=$show_write_end?>
<?=$a_write?>					글쓰기 링크
<?=$show_reply_begin?>응답글<?=$show_reply_end?>
<?=$a_reply?>					응답글쓰기 링크
<?=$show_edit_begin?>글쓰기<?=$show_edit_end?>
<?=$a_edit?>					글쓰기 링크
<?=$show_delete_begin?>글삭제<?=$show_delete_end?>
<?=$a_delete?>				글삭제 링크
<?=$show_vote_yes_begin?>추천<?=$show_vote_yes_end?>
<?=$a_vote_yes?>			추천링크
<?=$show_vote_no_begin?>비추천<?=$show_vote_no_end?>
<?=$a_vote_no?>				비추천링크
<?=$show_admin_begin?>글관리<?=$show_admin_end?>
<?=$u_board_manager?> 글관리 주소
******************************************************************/
?>
<div class="bbs_view_third" align="right">
	<span class="button large"><?=$a_list?>목록</a></span>
	<?=$show_write_begin?><span onclick="javascript:prepareForPicker();" class="button large"><?=$a_write?>글쓰기</a></span><?=$show_write_end?>
	<?=$show_reply_begin?><span class="button large"><?=$a_reply?>답변</a></span><?=$show_reply_end?>
	<?=$show_edit_begin?><span onclick="javascript:prepareForPicker2();" class="button large"><?=$a_edit?>수정</a></span><?=$show_edit_end?>
    <?=$show_delete_begin?><span class="button large"><?=$a_delete?>삭제</a></span><?=$show_delete_end?>
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