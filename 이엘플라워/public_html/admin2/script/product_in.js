function direct_submit()
{
	var form			= document.form;
	var item_no = form.item_no.value;
	var item_name = form.item_name.value;
	var item_code = form.item_code.value;
	var mart_id = form.mart_id.value;
	var z_price = form.z_price.value;
	var bonus = form.bonus.value;
	var use_bonus = form.use_bonus.value;
	var direct_submit_flag = form.direct_submit_flag.value;
	
	parent.document.location.href="/autocart/market/product/product_detail.php?productCd="+productCd+"&itemNum="+itemNum+"&itemCnt="+itemCnt;
	
}
function addorder()
{
	var form			= document.form;
	var flag = 'addorder';
	var item_no = form.item_no.value;
	var item_name = form.item_name.value;
	var item_code = form.item_code.value;
	var mart_id = form.mart_id.value;
	var z_price = form.z_price.value;
	var bonus = form.bonus.value;
	var use_bonus = form.use_bonus.value;
	parent.document.location.href="/autocart/market/product/product_detail.php?+flag="+flag=+"&item_no="+item_no+"&item_name="+item_name+"&item_code="+item_code+"&mart_id"+mart_id+"&z_price"+z_price+"&bonus="+bonus+"&use_bonus="+use_bonus;
}
function add_reco()
{
parent.document.location.href="/autocart/market/product/reco.php?mart_id="+mart_id+"&item_no="+item_no+"&category_num="+category_num;
}
