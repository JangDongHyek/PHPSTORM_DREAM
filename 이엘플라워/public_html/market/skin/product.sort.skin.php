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
// ��ǰ���� �ʵ� ��� 
$arr_sort_list = array("item_no"=>"�Ż�ǰ�� <i class='fas fa-caret-up'></i>", "item_order"=>"�α��ǰ�� <i class='fas fa-caret-up'></i>","z_price_down"=>"�������ݼ� <i class='fas fa-caret-down'></i>", "z_price_up"=>"�������ݼ� <i class='fas fa-caret-up'></i>");
echo rg_html_option($arr_sort_list,'','',$flag);
?>
</select>-->
