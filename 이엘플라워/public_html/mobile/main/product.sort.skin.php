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
 .sort{ text-align:right; margin-top:5px;}
 .sort a{opacity:0.6; font-weight:bold; font-size:11px; display:inline-block; margin-right:10px;}
 .sort .active a{
	color:#404040;
	opacity:1;
 }
 .sort .active svg{color:#EF4553;}
</style>
<div class="sort">
		<?
			foreach($arr_sort_list as $key => $val){
		?>
		<span <? if($key==$flag){echo " class='active'";}?>><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=<?=$key?>"><?=$val?></a></span>
		<? }?>
</div>