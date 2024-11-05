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
		<?=$a_login?>로그인</a>
		<?=$a_member_join?>회원가입</a>
		<?=$a_member_modify?>정보수정</a>
		<?=$a_member_memo?>메모박스</a>
		<?=$a_logout?>로그아웃</a>
		<?=$a_setup?>설정변경</a>
	</td>
</tr>
</table>
