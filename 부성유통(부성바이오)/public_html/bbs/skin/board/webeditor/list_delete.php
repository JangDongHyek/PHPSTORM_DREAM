<?
/******************************************************************
 �� ���ϼ��� �� 
������ũ�� �� ��Ͻ�Ų

 �� ��Ų ������ ���� ���� ���� �� 
list_main.php ����

******************************************************************/
?>
<TR bgColor='<?=($no%2==1)?"#ffffff":"#f2f2f2"?>' height=22> 
	<TD align=middle class="bbs"><?=$no?></TD>
<?=$show_category_begin?>
	<td align=middle class="bbs"><?=$rg_cat_name?></td>
<?=$show_category_end?>
	<TD nowrap class="bbs">
<?=$show_chk_begin?>
	<input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
    <?=$show_chk_end?>
    <?=$rg_reply?>
    <?=$a_list_view?><font color="#FF0000">[�����ȱ��Դϴ�.]</font></a></TD>
  </xmp></xml></font>
	<TD align=middle class="bbs"><?=$rg_mb_icon?> <?=$rg_name?></TD>
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
	<TD align=middle bgColor=#cdcdc colSpan='<?=$colspan?>' height=1></TD>
</TR>