<?
/******************************************************************
 �� ���ϼ��� �� 
��������� �̵��� ���� �׺���̼�

 �� ��Ų ������ ���� ���� ���� �� 
PHP�� ������� �ƽô� �в��� ���� ��ñ� �ٶ��ϴ�.

******************************************************************/
?>
<style>
.c_page{ border:1px solid blue;height:30px;width:30px;vertical-align:middle;line-height:30px;}/* ���� ������ Ŭ���� */
.l_page{ border:1px solid #90bae0;height:30px;width:30px;vertical-align:middle;line-height:30px;}
</style>
<table width="" cellpadding="0" cellspacing="0" style="padding-bottom:20px">
	<tr>

<?

 if(!empty($page_info[first]))
	echo "<td class=l_page align=center><a href=\"$u_navigation{$page_info[first]}\" class='bbs' data-ajax=false >�Ǿ� 11</a></td> ";

if(!empty($page_info[prior_step])) {
	echo "<td class=l_page  align=center><a href=\"$u_navigation{$page_info[prior_step]}\" title=\"���� $page_info[page_rows] ������\" class='bbs'  data-ajax=false>";
	echo ("����");
	echo "</a></td>";
}

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<td class=c_page  align=center><b>{$page_info[pages][$i]}</b></td> ";
	else
		echo "<td class=l_page  align=center><a href=\"$u_navigation{$page_info[pages][$i]}\" class='bbs'  data-ajax=false  style=border:1px solid #96c0e6>{$page_info[pages][$i]}</a></td> ";
}

if(!empty($page_info[next_step])) {
	echo "<td class=l_page align=center><a href=\"$u_navigation{$page_info[next_step]}\" title=\"���� {$page_info[page_rows]} ������\" class='bbs' data-ajax=false  style=border:1px solid #96c0e6>";
	echo ("����");
	echo "</a></td>  ";
}
 if(!empty($page_info[end]))
	echo "<Td class=l_page  align=center><a href=\"$u_navigation{$page_info[end]}\" class=bbs  data-ajax=false >�ǳ�</a></td> ";
?>

	</tr>
</table>