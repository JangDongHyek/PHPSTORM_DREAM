<?
/******************************************************************
 ★ 파일설명 ★
일반 게시판 목록스킨

 ★ 스킨 제작을 위한 변수 설명 ★

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디
<?=$mb_id?>						회원글이라면 회원아이디
<?=$mb_open_info?>		회원글이라면 정보공개여부(회원정보)

<?=$no?> 							논리적인 게시물번호(순서)
<?=$rg_doc_num?>			물리적인 게시물번호(디비상의 게시물번호)
<?=$rg_reply?>				응답글 깊이와 아이콘
<?=$rg_secret_icon?>	비밀글 아이콘
<?=$rg_title?>				제목
<?=$rg_cmt_count?>		코멘트 갯수
<?=$rg_new_icon?>			새글 아이콘
<?=$rg_reg_date?>			글등록일
<?=$rg_name?>					등록자명
<?=$rg_email_enc?>		메일
<?=$rg_home_url?>			홈페이지
<?=$rg_mb_icon?>			등록자가 회원이라면 회원아이콘
<?=$rg_doc_hit?>			글조회수

<?=$a_list_view?>			글보기 링크


<?=$show_category_begin?>카테고리<?=$show_category_end?>
<?=$rg_cat_name?>			카테고리명
<?=$show_chk_begin?>카트사용(체크박스)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>추천수<?=$show_vote_yes_end?>
<?=$rg_vote_yes?>			추천수
<?=$show_vote_no_begin?>비추천수<?=$show_vote_no_end?>
<?=$rg_vote_no?>			비추천수

******************************************************************/
?>
<?
	$rg_title = substr($rg_title,0,15);
	$max_title_len = strlen($rg_title);
	$start_title_len = $max_title_len-4;
	if($start_title_len >= 1){
		$rg_title1 = substr($rg_title,0,$start_title_len);
		$rg_title2 = "****";
	}else{
		$rg_title1 = "";
		$rg_title2 = str_replace($rg_title,"****",$rg_title);
	}
?>
	<TR bgColor='<?=($no%2==1)?"#ffffff":"#ffffff"?>' height=26>
		<TD align=middle class="bbs"><?=$no?></TD>

		<TD nowrap>
<?=$show_chk_begin?>
	<input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
<?=$show_chk_end?><?=$a_list_view?>
	<?=date("Y-m-d",$rg_ext5)?>
	<?=$rg_cat_name?>
	<?=$rg_reply?> <?=$rg_secret_icon?></a> <span style='font-size:8pt;'><?=$rg_cmt_count?></span> <?=$rg_new_icon?></TD></xmp></xml></font>
	<TD align=middle class="bbs"><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$rg_mb_icon?> <?=$rg_name?></span></TD>
	<TD align="center"><?=$rg_ext1?></TD>
	<TD align="center"><?=$rg_ext2?></TD>
	<TD align=middle class="bbs"><?=$rg_title1?><?=$rg_title2?></TD>

	</TR>
	<TR>
		<TD align=middle bgColor=#E7E7E7 colSpan='<?=$colspan?>' height=1></TD>
	</TR>