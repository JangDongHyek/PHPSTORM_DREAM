<?
	$name = str_replace(">","><font class=z_list>",$name);
	$homepage = str_replace(">","><font class=z_list></b>",$homepage);
	$a_file_link1 = str_replace(">","><font class=z_list></b>",$a_file_link1);
	$a_file_link2 = str_replace(">","><font class=z_list></b>",$a_file_link2);
	$a_file_link3 = str_replace(">","><font class=z_list></b>",$a_file_link3);
	$a_file_link4 = str_replace(">","><font class=z_list></b>",$a_file_link4);
	$a_file_link5 = str_replace(">","><font class=z_list></b>",$a_file_link5);
	$sitelink1 = str_replace(">","><font class=z_list></b>",$sitelink1);
	$sitelink2 = str_replace(">","><font class=z_list></b>",$sitelink2);
	$memo = str_replace("<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"table-layout:fixed;\"><col width=100%></col><tr><td valign=top>","<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"table-layout:fixed;\"><col width=100%></col><tr><td valign=top class=list_han>",$memo);
?>

<img src=<?=$dir?>/t.gif border=0 height=5><br>

<table style="border:solid 1 #dddddd;" cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr class=z_t1>
	<td class=z_t1 style=padding:8px;word-break:break-all;>
		<b><?=$subject?></b>
	</td>
</tr>
<tr class=list1>
	<td height=180 valign=top>
		<table border=0 cellspacing=0 width=100% style=table-layout:fixed height=30 class=list0>
		<col width=></col><col width=240></col>
		<tr>
			<td nowrap style=padding-left:10px>
				<?=$face_image?> <?=$name?></b>&nbsp;님이 올려주신 글입니다.
				<?
					if($data['homepage']) {
				?><a href="<?=$data['homepage']?>" target=_blank><font class=list_eng>(Homepage)</font></a><?
					}
				?>
			</td>
			<td align=right style=padding-right:10px class=list_eng><?=$data[date_free]?>, 조회 : <b><?=number_format($data[hit2])?></b>, 추천 : <b><?=$vote?></b></td>
		</tr>
		<tr>
			<td height=1 class=line1></td>
			<td class=line1></td>
		</tr>
		</table>
		<table border=0 cellspacing=0 cellpadding=10 width=100% padding=8 style=table-layout:fixed>
		<tr>
			<td>

				<?=$hide_sitelink1_start?><font class=z_list>- <b>SiteLink #1</b> : <?=$sitelink1?></font><br><?=$hide_sitelink1_end?>
				<?=$hide_sitelink2_start?><font class=z_list>- <b>SiteLink #2</b> : <?=$sitelink2?></font><br><?=$hide_sitelink2_end?>
				<?=$hide_download1_start?><font class=z_list>- <b>Download #1</b> : <?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download : <?=$file_download1?></font><br><?=$upload_image1?><?=$hide_download1_end?>
				<?=$hide_download2_start?><font class=z_list>- <b>Download #2</b> : <?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download : <?=$file_download2?></font><br><?=$upload_image2?><?=$hide_download2_end?>
				<?=$hide_download3_start?><font class=z_list>- <b>Download #3</b> : <?=$a_file_link3?><?=$file_name3?> (<?=$file_size3?>)</a>, Download : <?=$file_download3?></font><br><?=$upload_image3?><?=$hide_download3_end?>
				<?=$hide_download4_start?><font class=z_list>- <b>Download #4</b> : <?=$a_file_link4?><?=$file_name4?> (<?=$file_size4?>)</a>, Download : <?=$file_download4?></font><br><?=$upload_image4?><?=$hide_download4_end?>
				<?=$hide_download5_start?><font class=z_list>- <b>Download #5</b> : <?=$a_file_link5?><?=$file_name5?> (<?=$file_size5?>)</a>, Download : <?=$file_download5?></font><br><?=$upload_image5?><?=$hide_download5_end?>
		
				<img src=<?=$dir?>/t.gif border=0 width=10><br>
				<?=$memo?>
				<div align=right class=z_list><?=$ip?></div>
			</td>
		</tr>
		</table>
	</td>

	</td>
</tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=2><br>
<?if($member['level']<=$setup['grant_comment']){?>
<?}?>