<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 14
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : category.search.skin.php
 *	
 *	카테고리내에 상품검색폼
 -----------------------------------------------------------------------------*/
?>							
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<form name='search_cate2_form' method='get' action=''>
							<input type='hidden' name='category_num' value='<?=$category_num?>'>
							<input type="hidden" name="ss[search_mode]" value="category">
								<tr>
									<td height="10" colspan="3"></td>
                </tr>
                <tr>
                  <td width="10">&nbsp;</td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="120"><img src="../image/product/search_title.gif" width="120" height="30"></td>
                      <td bgcolor="#EAEAEA"> 
                        <input type='radio' name='ss[search_field]' value='item_name' <?if(($select_key=="item_name") || (!$select_key)){ echo "checked";}?>> &nbsp; 제조사(브랜드)
                        <input type='radio' name='ss[search_field]' value='item_company' <?if($select_key=="item_company"){ echo "checked";}?>> &nbsp;&nbsp;
                        <input name="kw" id="kw" value="<?=$kw?>" type="text" class="input_02" size="30" style='imde-mode:active' required="required" itemname="검색어">
                        <input type='image' src="../image/product/search_bu.gif" width="60" height="30" border="0" align="absmiddle" onfocus='blur();'>
                      </td>
                      <td width="20"><img src="../image/product/search_end.gif" width="20" height="30"></td>
                    </tr>
                  </table></td>
                  <td width="10">&nbsp;</td>
                </tr>
                <tr>
                  <td height="10" colspan="3"></td>
                </tr>
              </form>
						</table>
