<?
/******************************************************************
 ★ 파일설명 ★ 
비밀글 목록스킨

 ★ 스킨 제작을 위한 변수 설명 ★ 
list_main.php 참고

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
		<TD align=middle bgColor=#E7E7E7 colSpan='<?=$colspan?>' height=1><IMG height=1 src="<?=$skin_board_url?>images/blank_.gif" width="100%" border=0></TD>
	</TR>