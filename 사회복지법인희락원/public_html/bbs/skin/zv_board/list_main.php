<?php   
/* Check New Comment <?=$comment_new?> */
  $last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
  $last_comment_time = $last_comment['reg_date'];
  if(time()-$last_comment_time<60*60*12) $comment_new = "<font color=red size=1 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">+</font>";
  elseif(time()-$last_comment_time<60*60*24) $comment_new = "<font color=blue size=1 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">+</font>";
  else $comment_new = "";
 ?>
<?
	$subject = str_replace(">","><font class=z_list>",$subject);
	$name= str_replace(">","><font class=z_list>",$name);
?>

<tr align=center class=z_box>
	<td class=line4><?=$number?></td>
	<?=$hide_category_start?><td nowrap class=line4><nobr><?=$category_name?><nobr></td><?=$hide_category_end?>
	<td align=left nowrap><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$subject?>&nbsp;<?=$comment_num?><?=$comment_new?></td> 
	<td class=line1></td>
	<td class=line4><nobr><?=$face_image?>&nbsp;<?=$name?></nobr></td>
	<td nowrap class=line4><?=$date=date("m-d H:i",$data[reg_date])?></td>
	<td nowrap><?=$hit?></td>
</tr>

<?$coloring++;?>

<tr class=line1>
	<td></td>
	<?=$hide_category_start?><td></td><?=$hide_category_end?>
	<td></td> 
	<td></td> 
	<td></td>
	<td></td>
	<td></td>
</tr>