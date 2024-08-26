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

if($tmp[cat_name] == $ss_mb_id || $MemberLevel==1){ //분류명과 로긴아이디랑 같으면 등록가능
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