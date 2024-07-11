<table width="100%" height="26" border="0" cellpadding="0" cellspacing="0">
<form name='search_cate2_form' method='get' action=''>
<input type='hidden' name='category_num' value='<?=$category_num?>'>
<input type="hidden" name="ss[search_mode]" value="category">
	<tr>
	  <td width="138"><img src="../images/proudct/product_list_search_title.gif" width="138" height="26"></td>
	  <td bgcolor="EAEAEA"><div align="center">상품명<input type='radio' name='ss[search_field]' value='item_name' <?if(($select_key=="item_name") || (!$select_key)){ echo "checked";}?>> &nbsp; 제조사(브랜드)
                        <input type='radio' name='ss[search_field]' value='item_company' <?if($select_key=="item_company"){ echo "checked";}?>> &nbsp;&nbsp;
                        <input name="kw" id="kw" value="<?=$kw?>" type="text" class="input_03" size="30" style='imde-mode:active' required="required" itemname="검색어"></div></td>
	  <td width="35" bgcolor="EAEAEA"><input type='image' src="../images/proudct/product_list_search_btn.gif" width="35" height="26" align="absmiddle" onfocus='blur();'></td>
	</tr>
</form>
</table>