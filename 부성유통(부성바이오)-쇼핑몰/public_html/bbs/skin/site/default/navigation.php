<?
/******************************************************************
 �� ���ϼ��� �� 
��������� �̵��� ���� �׺���̼�

 �� ��Ų ������ ���� ���� ���� �� 
PHP�� ������� �ƽô� �в��� ���� ��ñ� �ٶ��ϴ�.

******************************************************************/
?><?

if(!empty($page_info[first]))
	echo "<a href=\"$u_navigation{$page_info[first]}\" class=bbs>[first]</a> ";

if(!empty($page_info[prior_step]))
	echo "<a href=\"$u_navigation{$page_info[prior_step]}\" title=\"���� $page_info[page_rows] ������\" class=bbs>&lt;</a> ";

//if(!empty($page_info[prior]))
//	echo "<a href=\"$u_navigation{$page_info[prior]}\">[����������]</a> ";

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<b>[{$page_info[pages][$i]}]</b> ";
	else
		echo "<a href=\"$u_navigation{$page_info[pages][$i]}\" class=bbs>[{$page_info[pages][$i]}]</a> ";
}

//if(!empty($page_info[next]))
//	echo "<a href=\"$u_navigation{$page_info[next]}\">[����������]</a> ";

if(!empty($page_info[next_step]))
	echo "<a href=\"$u_navigation{$page_info[next_step]}\" title=\"���� {$page_info[page_rows]} ������\" class=bbs>&gt;</a> ";

if(!empty($page_info[end]))
 	echo "<a href=\"$u_navigation{$page_info[end]}\" class=bbs>[end]</a> ";

?>