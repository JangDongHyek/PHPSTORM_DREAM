<img src=<?=$dir?>/t.gif border=0 height=5><br>
<?$coloring=0;?>
<table style="border:solid 1 #dddddd;" cellspacing=0 cellpadding=0 width=<?=$width?> style=table-layout:fixed>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<col width=40></col>
<?=$hide_category_start?><col width=70></col><?=$hide_category_end?>
<col width=></col>
<col width=1></col>
<col width=80></col>
<col width=70></col>
<col width=40></col>
<tr align=center class=z_t>
	<td class=line4>번호</td>
	<?=$hide_category_start?><td class=line4>분류</td><?=$hide_category_end?>
	<td>제목</td>
	<td class=line1></td>
	<td class=line4>작성자</td>
	<td class=line4>작성일</td>
	<td><?=$a_hit?>조회</a></td>
</tr>
<tr class=line2>
	<td></td>
	<?=$hide_category_start?><td></td><?=$hide_category_end?>
	<td></td> 
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
