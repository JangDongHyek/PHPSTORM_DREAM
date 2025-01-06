<?
/******************************************************************
 ★ 파일설명 ★ 
목록페이지 이동을 위한 네비게이션

 ★ 스킨 제작을 위한 변수 설명 ★ 
PHP를 어느정도 아시는 분께서 손을 대시기 바랍니다.

******************************************************************/
?>
<style>
.c_page{ border:1px solid blue;height:30px;width:30px;vertical-align:middle;line-height:30px;}/* 현재 페이지 클래스 */
.l_page{ border:1px solid #90bae0;height:30px;width:30px;vertical-align:middle;line-height:30px;}
</style>
<table width="" cellpadding="0" cellspacing="0" style="padding-bottom:20px">
	<tr>

<?

 if(!empty($page_info[first]))
	echo "<td class=l_page align=center><a href=\"$u_navigation{$page_info[first]}\" class='bbs' data-ajax=false >맨앞 11</a></td> ";

if(!empty($page_info[prior_step])) {
	echo "<td class=l_page  align=center><a href=\"$u_navigation{$page_info[prior_step]}\" title=\"이전 $page_info[page_rows] 페이지\" class='bbs'  data-ajax=false>";
	echo ("이전");
	echo "</a></td>";
}

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<td class=c_page  align=center><b>{$page_info[pages][$i]}</b></td> ";
	else
		echo "<td class=l_page  align=center><a href=\"$u_navigation{$page_info[pages][$i]}\" class='bbs'  data-ajax=false  style=border:1px solid #96c0e6>{$page_info[pages][$i]}</a></td> ";
}

if(!empty($page_info[next_step])) {
	echo "<td class=l_page align=center><a href=\"$u_navigation{$page_info[next_step]}\" title=\"다음 {$page_info[page_rows]} 페이지\" class='bbs' data-ajax=false  style=border:1px solid #96c0e6>";
	echo ("다음");
	echo "</a></td>  ";
}
 if(!empty($page_info[end]))
	echo "<Td class=l_page  align=center><a href=\"$u_navigation{$page_info[end]}\" class=bbs  data-ajax=false >맨끝</a></td> ";
?>

	</tr>
</table>