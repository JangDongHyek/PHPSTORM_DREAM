<?
####################################################################################
//					메뉴이름 지정
####################################################################################
$menu_list="검색엔진순위,검색어순위,플러그인정보";


####################################################################################
//					메뉴생성
####################################################################################
$menu_list=explode(",",$menu_list);

for($i=0;$i<sizeof($menu_list);$i++)
{
$temp1="bgcolor".$i;
$temp2="b".$i;
if($pmode==($i+1)){$temp1="bgcolor=#F1F9FD";$temp2="<b>";}
}
?>

<table align=center width=100% cellpadding=2 cellspacing=0 border=1 bordercolor=white bgcolor=#C9F0FF>
<tr>
<?
for($i=0;$i<sizeof($menu_list);$i++)
{
$temp1="bgcolor".$i;
$temp2="b".$i;
?>
<td width=9% align=center <?=$temp1?> nowrap>
&nbsp;<a href="admin_counter.php?counter=<?=$counter?>&pmode=<?=($i+1)?>&id=<?=$id?>"><?=$temp2?><?=$menu_list[$i]?></a>&nbsp;
</td>
<?
}
?>
</tr>
</table>