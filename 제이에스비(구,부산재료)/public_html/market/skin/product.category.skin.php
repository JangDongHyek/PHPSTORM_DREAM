<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 14
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : product.category.skin.php
 *	
 *	상품리스트 최상위 카테고리 부터 최하위 카테고리까지 출력
 *	하위 서브 카테고리 or 또는 같은 레벨의 카테고리 리스트를 출력
 -----------------------------------------------------------------------------*/

if(!$category_num)
	$category_name = "전체";
?>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="46" background="../images/depth2_list_1.gif" style="background-repeat:no-repeat"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			   			<tr>
                  <td width="2%">&nbsp;</td>
                  <td width="48%"><img src="../images/list_icon.gif" width="8" height="9" align="absmiddle"> <span class="category_title">
                    <?=$category_name?> 
                  </span> (총 <?=$page_info[total_rows]?>건)</td>
                  <td width="48%" align="right"><div align="right"><img src="../images/home_icon.gif" width="8" height="9" align="absmiddle">
									<span class="navi">
									<!--------------- 카테고리 네비게이션----------------->
									<?=make_upperclass_str($arr_upperclass);?>
									<!--------------- 카테고리 네비게이션----------------->
									</span></div></td>
                  <td width="2%">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" background="../images/depth2_list_2.gif" style="background-repeat:repeat-y">
							<table width="93%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
										<!-------------- 서브카테고리 리스트 --------------->
										<span class="category_3">
<? 
	for($i=0, $d_subclass_count = count($arr_d_subclass); $i<$d_subclass_count; $i++)
	{
		echo "<a href='product_list.html?$_get_str&category_num={$arr_d_subclass[$i]['category_num']}'>{$arr_d_subclass[$i]['category_name']} ({$arr_d_subclass[$i]['item_count']})</a>";
		if($i<$d_subclass_count-1)
			echo " | ";
	}
?>
                    </span>
										<!-------------- 서브카테고리 리스트 --------------->                    
                  </td>
                </tr>
							</table>
						</td>
          </tr>
          <tr>
            <td><img src="../images/depth2_list_3.gif"></td>
          </tr>
</table>