<?
$rg_ext1_ex = explode("-",$rg_ext1);
?>
	<TR height=26> 
		<TD align=middle class="bbs"><IMG src="<?=$skin_board_url?>images/cdoc.gif" border=0>
		<?=$show_chk_begin?>
		<input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
		<?=$show_chk_end?>
		</TD>
		
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext2?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext1?>(<?=getWeekDay($rg_ext1_ex[0],$rg_ext1_ex[1],$rg_ext1_ex[2])?>)</TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?if($rg_ext11=="접수"){echo"<font color=black><b>접수</b></font>";}else{echo"<font color=blue><b>완료</b></font>";}?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext3?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext4?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext5?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=number_format($rg_ext6)?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=number_format($rg_ext7)?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=number_format($rg_ext8)?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext9?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext10?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_content?></TD>
		<TD align=middle class="bbs"><?=$a_list_view?><?=$rg_ext12?></TD>

	</TR>
	<TR> 
		<TD height=1 colSpan='14' align=middle background="<?=$skin_board_url?>images/dot_line.gif" ></TD>
	</TR>
<!--/////////////////////////////////////-리스트메인끝--------->

