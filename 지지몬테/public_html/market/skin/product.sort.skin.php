<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 14
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : product.sort.skin.php
 *	
 *	상품리스트에 기본 정렬부분
 -----------------------------------------------------------------------------*/
?>
<select name="flag" style="width:150px; height:34px; background:#f7f9fa; border:1px solid #e3e3e3; padding:4px;" id="select_flag" onchange="self.location.href='?<?=$_get_str?>&category_num=<?=$category_num?>&flag='+this.value">
<?
// 상품정렬 필드 목록 
$arr_sort_list = array("item_order"=>"인기상품순", "item_name"=>"상품명순", "z_price_down"=>"낮은가격순", "z_price_up"=>"높은가격순", "item_no"=>"상품등록일순");
echo rg_html_option($arr_sort_list,'','',$flag);
?>
</select>
