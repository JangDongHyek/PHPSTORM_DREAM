<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2006. 12. 14
 *	�̸��� : heroyeo@hanmail.net
 *	���ϸ� : product.sort.skin.php
 *	
 *	��ǰ����Ʈ�� �⺻ ���ĺκ�
 -----------------------------------------------------------------------------*/
 $arr_sort_list = array("item_no"=>"�Ż�ǰ�� <i class='fas fa-caret-up'></i>","z_price_up"=>"�������ݼ� <i class='fas fa-caret-up'></i>",  "z_price_down"=>"�������ݼ� <i class='fas fa-caret-down'></i>", "item_order"=>"��õ�� <i class='fas fa-caret-up'></i>", 
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