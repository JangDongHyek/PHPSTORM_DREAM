<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 22
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : product.detail.search.sort.skin.php
 *	
 *	상세검색후 정렬부분 
 -----------------------------------------------------------------------------*/
?>
						<table width="680"  border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td width="188" height="40" valign="bottom"><img src="../image/search_title.gif" width="120" height="31"></td>
							  <td align="right" valign="bottom" style="padding-right:10px;"><select name="flag" id="select_flag" onchange="self.location.href='?<?=$p_str?>&category_num=<?=$category_num?>&flag='+this.value">
<?
								// 상품정렬 필드 목록 
								$arr_sort_list = array("item_order"=>"인기상품순", "item_name"=>"상품명순", "z_price_down"=>"낮은가격순", "z_price_up"=>"높은가격순", "item_no"=>"상품등록일순");
								echo rg_html_option($arr_sort_list,'','',$flag);
?>							</select>
								<!-- <a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=z_price_up"><img src="../image/product/<?=$flag_img1?>" width="70" height="20" hspace="5" border="0"></a><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=z_price_down"><img src="../image/product/<?=$flag_img2?>" width="70" height="20" border="0"></a><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=item_name"><img src="../image/product/<?=$flag_img3?>" width="60" height="20" hspace="5" border="0"></a><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=item_no"><img src="../image/product/<?=$flag_img4?>" width="60" height="20" border="0"></a> --></td>
							</tr>
						</table>