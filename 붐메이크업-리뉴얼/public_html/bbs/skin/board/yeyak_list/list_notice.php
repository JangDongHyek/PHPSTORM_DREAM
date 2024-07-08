<?
/******************************************************************
 ★ 파일설명 ★ 
공지글 스킨

 ★ 스킨 제작을 위한 변수 설명 ★ 
list_main.php 참고

******************************************************************/
?>
	<TR bgColor='<?=($no%2==1)?"#E4E4E4":"#E4E4E4"?>' height=28> 
		<TD align=middle class="bbs"><IMG src="<?=$skin_board_url?>images/noticeno.gif" border=0></TD>
		
		<?=$show_category_begin?>
		<td align=middle class="bbs">공지</td>
		<?=$show_category_end?>
		
		<TD nowrap>
		
		<?=$show_chk_begin?>
		<input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
		<?=$show_chk_end?>
		
		<?=$rg_reply?> <?=$rg_secret_icon?><?=$a_list_view?><?=$rg_title?></a> <span style='font-size:8pt;'><?=$rg_cmt_count?></span> <?=$rg_new_icon?></TD></xmp></xml></font>
		<TD align=middle class="bbs"><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$rg_mb_icon?> <?=$rg_name?></span></TD>
		<TD align=middle class="bbs"><?=$rg_reg_date?></TD>
		<?=$show_download_begin?>
	
		<TD align=middle class="bbs"><?=$rg_file1_hit?></td>
	
		<?=$show_download_end?>
		<TD align=middle class="bbs"><?=$rg_doc_hit?></TD>

		<?=$show_vote_yes_begin?>
		<TD align=middle class="bbs"><?=$rg_vote_yes?></td>

		<?=$show_vote_yes_end?>

		<?=$show_vote_no_begin?>
		<TD align=middle class="bbs"><?=$rg_vote_no?></td>
		<?=$show_vote_no_end?>

	</TR>
	<TR> 
		<TD align=middle bgColor=#D5D5D5 colSpan='<?=$colspan?>' height=1></TD>
	</TR>