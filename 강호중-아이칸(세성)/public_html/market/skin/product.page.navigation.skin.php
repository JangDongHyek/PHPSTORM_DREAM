<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2006. 12. 14
 *	�̸��� : heroyeo@hanmail.net
 *	���ϸ� : page.navigation.skin.php
 *	
 *	��ǰ����Ʈ ������ ó��
 *	$page_info ( [page], [offset], [rows], [total_rows], [page_rows], [total_page], [first], [prior_step], [prior], [pages] => Array ( ), [next], [next_step], [end], ) 
 -----------------------------------------------------------------------------*/
// ī�װ���ȣ �߰�
 $_get_str .= "&category_num=$category_num";
?>						
						<table width="97%"  border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="F2F2F2">
              <tr>
                <td align="center" bgcolor="#FFFFFF" valign="middle">
<?

/*if(!empty($page_info[first]))
	echo "<a href=\"?{$p_str}&page={$page_info[first]}\">[ó��]</a> ";
else
	echo "[ó��]";*/

if(!empty($page_info[prior_step]))
	echo "<a href=\"?{$_get_str}&page={$page_info[prior_step]}\" ><img src=\"../image/bu_pre10.gif\" border=\"0\" align=\"absmiddle\"></a> ";
else
	echo "<img src=\"../image/bu_pre10.gif\" border=\"0\" alt=\"���� $page_info[page_rows] ������\" align=\"absmiddle\"> ";


if(!empty($page_info[prior]))
	echo "<a href=\"?{$_get_str}&p={$page_info[prior]}\"><img src=\"../image/bu_pre.gif\" border=\"0\" align=\"absmiddle\" alt=\"���� ������\"></a> ";
else
	echo "<img src=\"../image/bu_pre.gif\" border=\"0\" align=\"absmiddle\" alt=\"���� ������\"> ";

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<b>[{$page_info[pages][$i]}]</b> ";
	else
		echo "<a href=\"?{$_get_str}&page={$page_info[pages][$i]}\">[{$page_info[pages][$i]}]</a> ";
}

if(!empty($page_info[next]))
	echo "<a href=\"?{$_get_str}&page={$page_info[next]}\"><img src=\"../image/bu_next.gif\" align=\"absmiddle\" border=\"0\" alt=\"���� ������\"></a> ";
else
	echo "<img src=\"../image/bu_next.gif\" align=\"absmiddle\" border=\"0\" alt=\"���� ������\"> ";

if(!empty($page_info[next_step]))
	echo "<a href=\"?{$_get_str}&page={$page_info[next_step]}\"><img src=\"../image/bu_next10.gif\" border=\"0\" align=\"absmiddle\" alt=\"���� {$page_info[page_rows]} ������\"></a>";
else
	echo "<img src=\"../image/bu_next10.gif\" align=\"absmiddle\" border=\"0\" alt=\"���� {$page_info[page_rows]} ������\">";


/*if(!empty($page_info[end]))
 	echo "<a href=\"?{$p_str}&page={$page_info[end]}\">[��]</a> ";
else
	echo "[��]";*/

?>

                </td>
              </tr>
</table>