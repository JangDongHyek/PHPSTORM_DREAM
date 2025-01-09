<?
/******************************************************************
 ★ 파일설명 ★ 
목록페이지 이동을 위한 네비게이션

 ★ 스킨 제작을 위한 변수 설명 ★ 
PHP를 어느정도 아시는 분께서 손을 대시기 바랍니다.

******************************************************************/
?><?

if(!empty($page_info[first]))
	echo "<a href=\"$u_navigation{$page_info[first]}\" class=bbs>[first]</a> ";

if(!empty($page_info[prior_step]))
	echo "<a href=\"$u_navigation{$page_info[prior_step]}\" title=\"이전 $page_info[page_rows] 페이지\" class=bbs>&lt;</a> ";

//if(!empty($page_info[prior]))
//	echo "<a href=\"$u_navigation{$page_info[prior]}\">[이전페이지]</a> ";

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<b>[{$page_info[pages][$i]}]</b> ";
	else
		echo "<a href=\"$u_navigation{$page_info[pages][$i]}\" class=bbs>[{$page_info[pages][$i]}]</a> ";
}

//if(!empty($page_info[next]))
//	echo "<a href=\"$u_navigation{$page_info[next]}\">[다음페이지]</a> ";

if(!empty($page_info[next_step]))
	echo "<a href=\"$u_navigation{$page_info[next_step]}\" title=\"다음 {$page_info[page_rows]} 페이지\" class=bbs>&gt;</a> ";

if(!empty($page_info[end]))
 	echo "<a href=\"$u_navigation{$page_info[end]}\" class=bbs>[end]</a> ";

?>