<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2006. 12. 14
 *	�̸��� : heroyeo@hanmail.net
 *	���ϸ� : product.sort.skin.php
 *	
 *	��ǰ����Ʈ�� �⺻ ���ĺκ�
 -----------------------------------------------------------------------------*/
?>
<select name="flag" style="width:150px; height:34px; background:#f7f9fa; border:1px solid #e3e3e3; padding:4px;" id="select_flag" onchange="self.location.href='?<?=$_get_str?>&category_num=<?=$category_num?>&flag='+this.value">
<?
// ��ǰ���� �ʵ� ��� 
$arr_sort_list = array("item_order"=>"�α��ǰ��", "item_name"=>"��ǰ���", "z_price_down"=>"�������ݼ�", "z_price_up"=>"�������ݼ�", "item_no"=>"��ǰ����ϼ�");
echo rg_html_option($arr_sort_list,'','',$flag);
?>
</select>
