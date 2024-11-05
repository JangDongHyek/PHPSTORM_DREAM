<?
	$name = str_replace(">","><font class=list_han>",$name);
	$homepage = str_replace(">","><font class=list_eng></b>",$homepage);
	$a_file_link1 = str_replace(">","><font class=list_eng></b>",$a_file_link1);
	$a_file_link2 = str_replace(">","><font class=list_eng></b>",$a_file_link2);
	$sitelink1 = str_replace(">","><font class=list_eng></b>",$sitelink1);
	$sitelink2 = str_replace(">","><font class=list_eng></b>",$sitelink2);
$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data[reg_date])."'><font class=list_eng>".date("m-d", $data[reg_date])."</font></span>"; 
?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td class='view2'>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<col width=></col><col width=100></col>
<tr>
 <td align=left height=30 style='word-break:break-all; padding:12 20 9 30;'><b><?=$subject?></b></td>
 <td align=right style='padding:0 10 0 0;' valign=bottom><font class='list_eng'>VIEW : <?=number_format($hit)?></font></td></tr></table>
 </td></tr>
</tr>
	<?=$hide_sitelink1_start?>
<tr>
<td align=left width=100% height=25 style='word-break:break-all; padding:5 20 5 20;'>
<font class='icon2'>◆</font> <?=$sitelink1?>
</td></tr>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_sitelink1_end?>
<?=$hide_sitelink2_start?>
<tr><td align=left width=100% height=25 style='word-break:break-all; padding:5 20 5 20;'>
	<font class='icon2'>◆</font> <?=$sitelink2?>
</td></tr>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_sitelink2_end?>
<?=$hide_download1_start?>
<? if(!$file_name1 || eregi("(\.(gif|jpg|jpeg|bmp|png))$",$file_name1)) { } else { ?>
<tr><td align=left width=100% height=25 style='word-break:break-all; padding:5 20 5 20;'>
<font class='icon2'>◆</font> <?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Down : <?=$file_download1?></td></tr>
<tr><td height=1 class=line1><img src=$dir/t.gif border=0 height=1></td></tr>
<? } ?>
	<?=$hide_download1_end?>
	<?=$hide_download2_start?>
<? if(!$file_name2 || eregi("(\.(gif|jpg|jpeg|bmp|png))$",$file_name2)) { } else { ?>
<tr><td align=left width=100% height=25 style='word-break:break-all; padding:5 20 5 20;'>
<font class='icon2'>◆</font> <?=$a_file_link2?><?=$file_name2 ?>(<?=$file_size2?>)</a>, Down : <?=$file_download2?></td></tr>
<tr><td height=1 class=line1><img src=$dir/t.gif border=0 height=1></td></tr>
<? } ?>
	<?=$hide_download2_end?>
<tr><td width=100%>
<table border=0 cellspacing=0 cellpadding=0 style='table-layout:fixed;' width=100%>
<?=$hide_download1_start?><tr><td align=center style='padding:10 20 0 20;'><table border=0 cellspacing=0 cellpadding=0 style='table-layout:fixed;'><tr><td><?=$upload_image1?></td></tr></table></td></tr><?=$hide_download1_end?>
<?=$hide_download2_start?><tr><td align=center style='padding:10 20 0 20;'><table border=0 cellspacing=0 cellpadding=0 style='table-layout:fixed;'><tr><td><?=$upload_image2?></td></tr></table></td></tr><?=$hide_download2_end?>
<tr><td style='word-break:break-all;line-height:160%;padding:10 20 10 20;'>
				<?=$memo?></td></tr></table>
				<div align=right class=list_eng style='padding-right:10;'><?=$ip?></div></td>
			
</tr>
</table>
