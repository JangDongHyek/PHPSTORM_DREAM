<table border="0" cellpadding="0" cellspacing="0">
<form name='search_cate2_form' method='get' action=''>
<input type='hidden' name='category_num' value='<?=$category_num?>'>
<input type="hidden" name="ss[search_mode]" value="category">
	<tr>
	  <td bgcolor="ffffff"><div align="left" style="font-size:13px;">상품명 <input type='radio' name='ss[search_field]' value='item_name' <?if(($select_key=="item_name") || (!$select_key)){ echo "checked";}?> style="display:none">&nbsp;&nbsp;&nbsp;<!--제조사(브랜드)
                        <input type='radio' name='ss[search_field]' value='item_company' <?if($select_key=="item_company"){ echo "checked";}?>> &nbsp;&nbsp;-->
                        <input name="kw" id="kw" value="<?=$kw?>" type="text" size="30" style='width:243px; height:34px; background:#f7f9fa; border:1px solid #e3e3e3;' required="required" itemname="검색어"></div></td>
	  <td bgcolor="ffffff"><input type='submit' style="width:60px; height:36px; color:#FFF; background:#333; border:1px solid #000;" align="absmiddle" value='검색' onfocus='blur();'></td>
	</tr>
</form>
</table>