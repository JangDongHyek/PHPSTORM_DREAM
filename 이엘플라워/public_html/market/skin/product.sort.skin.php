<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 14
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : product.sort.skin.php
 *	
 *	상품리스트에 기본 정렬부분
 -----------------------------------------------------------------------------*/
 $arr_sort_list = array("item_no"=>"신상품순 <i class='fas fa-caret-up'></i>","z_price_up"=>"높은가격순 <i class='fas fa-caret-up'></i>",  "z_price_down"=>"낮은가격순 <i class='fas fa-caret-down'></i>", "item_order"=>"추천순 <i class='fas fa-caret-up'></i>", 
 );
?>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<style>
 .sort td{padding:0 5px;}
 .sort td a{opacity:0.6; font-weight:bold;}
 .sort .active a{
	color:#404040;
	opacity:1;
 }
 .sort .active svg{color:#EF4553;}
</style>
<table cellpadding="2" cellspacing="0" class="sort">
	<tr>
		<?
			foreach($arr_sort_list as $key => $val){
		?>
		<td <? if($key==$flag){echo " class='active'";}?>><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=<?=$key?>"><?=$val?></a></td>
		<? }?>
	</tr>
</table>
<!--
<select name="flag" style="width:150px; height:34px; background:#f7f9fa; border:1px solid #e3e3e3; padding:4px;" id="select_flag" onchange="self.location.href='?<?=$_get_str?>&category_num=<?=$category_num?>&flag='+this.value">
<?
// 상품정렬 필드 목록 
$arr_sort_list = array("item_no"=>"신상품순 <i class='fas fa-caret-up'></i>", "item_order"=>"인기상품순 <i class='fas fa-caret-up'></i>","z_price_down"=>"낮은가격순 <i class='fas fa-caret-down'></i>", "z_price_up"=>"높은가격순 <i class='fas fa-caret-up'></i>");
echo rg_html_option($arr_sort_list,'','',$flag);
?>
</select>-->
