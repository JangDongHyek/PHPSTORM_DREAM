<?
if(!eregi("Zeroboard",$a_login)) $a_login= str_replace(">","><class=z>",$a_login)."";
if(!eregi("Zeroboard",$a_logout)) $a_logout= str_replace(">","><class=z>",$a_logout)."";
if(!eregi("Zeroboard",$a_setup)) $a_setup= str_replace(">","><class=z>",$a_setup)."";
if(!eregi("Zeroboard",$a_member_join)) $a_member_join= str_replace(">","><class=z>",$a_member_join)."";
if(!eregi("Zeroboard",$a_member_modify)) $a_member_modify= str_replace(">","><class=z>",$a_member_modify)."";
if(!eregi("Zeroboard",$a_member_memo)) $a_member_memo= str_replace(">","><class=z>",$a_member_memo)."";
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<?=$hide_category_start?>
	<td align=left><?=$a_category?></td>
<?=$hide_category_end?>
	<td valign=bottom align=right <?if(!$setup[use_category]) echo"align=right";?>>
		<?=$a_login?>�α���</a>
		<?=$a_member_join?>ȸ������</a>
		<?=$a_member_modify?>��������</a>
		<?=$a_member_memo?>�޸�ڽ�</a>
		<?=$a_logout?>�α׾ƿ�</a>
		<?=$a_setup?>��������</a>
	</td>
</tr>
</table>
