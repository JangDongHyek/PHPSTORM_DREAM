<?
/******************************************************************
 ★ 파일설명 ★ 
목록페이지 이동을 위한 네비게이션

 ★ 스킨 제작을 위한 변수 설명 ★ 
PHP를 어느정도 아시는 분께서 손을 대시기 바랍니다.

******************************************************************/
?><?

 if(!empty($page_info[first]))
	echo "<a href=\"$u_navigation{$page_info[first]}\" class=bbs>첫 페이지</a>&nbsp;";

if(!empty($page_info[prior_step])) {
	echo "<a href=\"$u_navigation{$page_info[prior_step]}\" title=\"이전 $page_info[page_rows] 페이지\" class=bbs>";
	echo ("<img src=".$skin_board_url."images/pre.gif border=0>");
	echo "</a>&nbsp;";
}

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<b>{$page_info[pages][$i]}</b>&nbsp;";
	else
		echo "<a href=\"$u_navigation{$page_info[pages][$i]}\" class=bbs>[{$page_info[pages][$i]}]</a>&nbsp;";
}

if(!empty($page_info[next_step])) {
	echo "<a href=\"$u_navigation{$page_info[next_step]}\" title=\"다음 {$page_info[page_rows]} 페이지\" class=bbs>";
	echo ("<img src=".$skin_board_url."images/next.gif border=0>");
	echo "</a>&nbsp;";
}
 if(!empty($page_info[end]))
	echo "<a href=\"$u_navigation{$page_info[end]}\" class=bbs>끝 페이지</a>&nbsp;";

?>