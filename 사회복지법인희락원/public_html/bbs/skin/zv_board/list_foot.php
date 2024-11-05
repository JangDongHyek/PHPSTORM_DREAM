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
	$print_page = str_replace("계속 검색","<font class=z_list>계속 검색",$print_page);
	$print_page = str_replace("이전 검색","<font class=z_list>계속 검색",$print_page);
?>
<img src=<?=$dir?>/t.gif border=0 height=5><br>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr valign=top>
	<td>
		<?=$a_list?>목록보기</a>
		<?=$a_delete_all?>정리삭제</a>
		<?=$a_1_prev_page?>이전페이지</a>
		<?=$a_1_next_page?>다음페이지</a>
		<?=$a_write?>글쓰기</a>
	</td>
	<td align=right>
		<?=$a_prev_page?>[이전 <?=$setup[page_num]?>개]</a></font> <?=$print_page?> <?=$a_next_page?>[다음 <?=$setup[page_num]?>개]</font></a><br>
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
                            <option value="sn" <?=($sn=="on"?"selected":"")?>>이름</option> 
                            <option value="ss" <?=($ss=="on"?"selected":"")?>>제목</option> 
                            <option value="sc" <?=($sc=="on"?"selected":"")?>>내용</option> 
                            </select>
                            <input type=text name=keyword value="<?=$keyword?>" class=input size=10>
                            <input type=submit class=submit value="검색">
                            <input type=button class=button value="취소" onclick=location.href="zboard.php?id=<?=$id?>"></td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
<br>
