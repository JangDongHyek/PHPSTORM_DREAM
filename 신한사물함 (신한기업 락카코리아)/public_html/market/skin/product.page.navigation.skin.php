<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 14
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : page.navigation.skin.php
 *	
 *	상품리스트 페이지 처리
 *	$page_info ( [page], [offset], [rows], [total_rows], [page_rows], [total_page], [first], [prior_step], [prior], [pages] => Array ( ), [next], [next_step], [end], ) 
 -----------------------------------------------------------------------------*/
// 카테고리번호 추가
 $_get_str .= "&category_num=$category_num";
?>						
						<table width="97%"  border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="F2F2F2">
              <tr>
                <td align="center" bgcolor="#FFFFFF" valign="middle">
<?

/*if(!empty($page_info[first]))
	echo "<a href=\"?{$p_str}&page={$page_info[first]}\">[처음]</a> ";
else
	echo "[처음]";*/

if(!empty($page_info[prior_step]))
	echo "<a href=\"?{$_get_str}&page={$page_info[prior_step]}\" ><img src=\"../image/bu_pre10.gif\" border=\"0\" align=\"absmiddle\"></a> ";
else
	echo "<img src=\"../image/bu_pre10.gif\" border=\"0\" alt=\"이전 $page_info[page_rows] 페이지\" align=\"absmiddle\"> ";


if(!empty($page_info[prior]))
	echo "<a href=\"?{$_get_str}&p={$page_info[prior]}\"><img src=\"../image/bu_pre.gif\" border=\"0\" align=\"absmiddle\" alt=\"이전 페이지\"></a> ";
else
	echo "<img src=\"../image/bu_pre.gif\" border=\"0\" align=\"absmiddle\" alt=\"이전 페이지\"> ";

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<b>[{$page_info[pages][$i]}]</b> ";
	else
		echo "<a href=\"?{$_get_str}&page={$page_info[pages][$i]}\">[{$page_info[pages][$i]}]</a> ";
}

if(!empty($page_info[next]))
	echo "<a href=\"?{$_get_str}&page={$page_info[next]}\"><img src=\"../image/bu_next.gif\" align=\"absmiddle\" border=\"0\" alt=\"다음 페이지\"></a> ";
else
	echo "<img src=\"../image/bu_next.gif\" align=\"absmiddle\" border=\"0\" alt=\"다음 페이지\"> ";

if(!empty($page_info[next_step]))
	echo "<a href=\"?{$_get_str}&page={$page_info[next_step]}\"><img src=\"../image/bu_next10.gif\" border=\"0\" align=\"absmiddle\" alt=\"다음 {$page_info[page_rows]} 페이지\"></a>";
else
	echo "<img src=\"../image/bu_next10.gif\" align=\"absmiddle\" border=\"0\" alt=\"다음 {$page_info[page_rows]} 페이지\">";


/*if(!empty($page_info[end]))
 	echo "<a href=\"?{$p_str}&page={$page_info[end]}\">[끝]</a> ";
else
	echo "[끝]";*/

?>

                </td>
              </tr>
</table>