<?
/******************************************************************
 �� ���ϼ��� �� 
��������� �̵��� ���� �׺���̼�

 �� ��Ų ������ ���� ���� ���� �� 
PHP�� ������� �ƽô� �в��� ���� ��ñ� �ٶ��ϴ�.

******************************************************************/
?><?

 if(!empty($page_info[first]))
	echo "<a href=\"$u_navigation{$page_info[first]}\" class=bbs>ù ������</a>&nbsp;";

if(!empty($page_info[prior_step])) {
	echo "<a href=\"$u_navigation{$page_info[prior_step]}\" title=\"���� $page_info[page_rows] ������\" class=bbs>";
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
	echo "<a href=\"$u_navigation{$page_info[next_step]}\" title=\"���� {$page_info[page_rows]} ������\" class=bbs>";
	echo ("<img src=".$skin_board_url."images/next.gif border=0>");
	echo "</a>&nbsp;";
}
 if(!empty($page_info[end]))
	echo "<a href=\"$u_navigation{$page_info[end]}\" class=bbs>�� ������</a>&nbsp;";

?>