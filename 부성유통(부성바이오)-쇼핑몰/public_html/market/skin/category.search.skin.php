<table width="55%" height="26" border="0" cellpadding="0" cellspacing="0">
<form name='search_cate2_form' method='get' action=''>
<input type='hidden' name='category_num' value='<?=$category_num?>'>
<input type="hidden" name="ss[search_mode]" value="category">
	<tr>
	  <td bgcolor="ffffff"><div align="left">상품명<input type='radio' name='ss[search_field]' value='item_name' <?if(($select_key=="item_name") || (!$select_key)){ echo "checked";}?>> &nbsp; 제조사(브랜드)
                        <input type='radio' name='ss[search_field]' value='item_company' <?if($select_key=="item_company"){ echo "checked";}?>> &nbsp;&nbsp;
                        <input name="kw" id="kw" value="<?=$kw?>" type="text" class="input_033" size="30" style='width:175px; height:20px;' required="required" itemname="검색어"></div></td>
	  <td bgcolor="ffffff"><input type='image' src="../images/proudct/product_list_search_btnn.gif" align="absmiddle" onfocus='blur();'></td>
	</tr>
</form>
</table>