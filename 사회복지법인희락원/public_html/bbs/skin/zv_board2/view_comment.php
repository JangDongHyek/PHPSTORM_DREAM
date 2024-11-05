<?
	$comment_name = str_replace(">","><font class=z_list>",$comment_name);
	if($is_admin) $show_comment_ip = "<font class=z_list>".$c_data['ip']."</font>";
	else $show_comment_ip = "";
?>
<img src=<?=$dir?>/t.gif border=0 height=5><br>
<table width=<?=$width?> cellspacing=0 cellpadding=0>
<col width=100></col><col width=1></col><col width=5></col><col width=></col><col width=100></col>
<tr valign=top>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
		<tr>
			<td><NOBR><?=$c_face_image?> <?=$comment_name?></b></NOBR></td>
		</tr>
		</table>
		<?=$show_comment_ip?>
	</td>
	<td width=1 class=line2 style=padding:1px><img src=/images/t.gif border=0 width=1></td>
	<td width=5><img src=/images/t.gif border=0 width=5></td>
	<td style='word-break:break-all;'><font class=z_list><?=str_replace("\n","<br>",$c_memo)?></font></td>
	<td align=right><font class=z_list><?=date("Y-m-d",$c_data[reg_date])?><br><?=date("H:i:s",$c_data[reg_date])?></font><br><?=$a_del?>ªË¡¶</a></td>
</tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=5><br>