</table>
<?
	if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=z_list>",$a_list)."";
	if(!eregi("Zeroboard",$delete_all)) $a_delete_all = str_replace(">","><font class=z_list>",$a_delete_all)."";
	if(!eregi("Zeroboard",$a_1_prev_page)) $a_1_prev_page = str_replace(">","><font class=z_list>",$a_1_prev_page)."";
	if(!eregi("Zeroboard",$a_1_next_page)) $a_1_next_page = str_replace(">","><font class=z_list>",$a_1_next_page)."";
	if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=z_list>",$a_write)."";
	if(!eregi("Zeroboard",$a_prev_page)) $a_prev_page = str_replace(">","><font class=z_list>",$a_prev_page)."";
	if(!eregi("Zeroboard",$a_next_page)) $a_next_page = str_replace(">","><font class=z_list>",$a_next_page)."";
	$print_page = str_replace("<font style=font-size:8pt>","<font class=z_list>",$print_page);
	$print_page = str_replace("��� �˻�","<font class=z_list>��� �˻�",$print_page);
	$print_page = str_replace("���� �˻�","<font class=z_list>��� �˻�",$print_page);
?>
<img src=<?=$dir?>/t.gif border=0 height=5><br>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr valign=top>
	<td>
		<?=$a_list?>��Ϻ���</a>
		<?=$a_delete_all?>��������</a>
		<?=$a_1_prev_page?>����������</a>
		<?=$a_1_next_page?>����������</a>
		<?=$a_write?>�۾���</a>
	</td>
	<td align=right>
		<?=$a_prev_page?>[���� <?=$setup[page_num]?>��]</a></font> <?=$print_page?> <?=$a_next_page?>[���� <?=$setup[page_num]?>��]</font></a><br>
		<table border=0 cellspacing=0 cellpadding=0>
		</form>
		<form method=get name=search action=<?=$PHP_SELF?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value=<?=$sn?>> 
<input type=hidden name=ss value=<?=$ss?>> 
<input type=hidden name=sc value=<?=$sc?>> 
<input type=hidden name=category value="<?=$category?>">
		<tr>
			<td>
                            <select onChange="zbSearchSelectOption(this.options[this.selectedIndex].value);"> 
                            <? 
                            $sn = "off"; 
                            $ss = "on"; 
                            $sc = "off"; 
                            ?> 
                            <script language="javascript"> 
                            function zbSearchSelectOption(key) { 
                            search.sn.value = 'off'; 
                            search.ss.value = 'off'; 
                            search.sc.value = 'off'; 
                            search[key].value = 'on'; 
                            } 
                            </script> 
                            <option value="sn" <?=($sn=="on"?"selected":"")?>>�̸�</option> 
                            <option value="ss" <?=($ss=="on"?"selected":"")?>>����</option> 
                            <option value="sc" <?=($sc=="on"?"selected":"")?>>����</option> 
                            </select>
                            <input type=text name=keyword value="<?=$keyword?>" class=input size=10>
                            <input type=submit class=submit value="�˻�">
                            <input type=button class=button value="���" onclick=location.href="zboard.php?id=<?=$id?>"></td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
<br>
