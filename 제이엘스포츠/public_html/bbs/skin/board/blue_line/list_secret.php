<?
/******************************************************************
 ★ 파일설명 ★ 
비밀글 목록스킨

 ★ 스킨 제작을 위한 변수 설명 ★ 
list_main.php 참고

******************************************************************/
?>
	<TR bgColor='<?=($no%2==1)?"#ffffff":"#ffffff"?>' height=34> 
		<TD align=middle class="bbs"><?=$no?></TD>
		
		<?=$show_category_begin?>
		<td align=middle class="bbs"><?=$rg_cat_name?></td>
		<?=$show_category_end?>
	
		<TD nowrap>
		<?=$show_chk_begin?>
		<input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
		<?=$show_chk_end?>
	
		<?=$rg_reply?> <?=$rg_secret_icon?><?=$a_list_view?><?=$rg_title?></a> <span style='font-size:8pt;'><?=$rg_cmt_count?></span> <?=$rg_new_icon?></TD></xmp></xml></font>
		<TD align=middle class="bbs"><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '', '', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$rg_mb_icon?> <?=$rg_name?></span></TD>
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
		<TD align=middle bgColor=#E7E7E7 colSpan='<?=$colspan?>' height=1><IMG height=1 src="<?=$skin_board_url?>images/blank_.gif" width="100%" border=0></TD>
	</TR>