<?
if(!$category_num)
	$category_name = "��ü";
?>
<style>
.cate_cg a{color:#636363; font-size:13px;}
.cate_cg a:hover{color:#000}
</style>
<div style="height:20px"></div>
<div style="border:1px solid #e4e4e4; border-radius:6px; background:#fff; padding:18px;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="50%"><img src="../images/proudct/product_info_title_icon.gif" align="absmiddle" /> <span class="category_title"><?=$category_name?></span>(�� <?=$page_info[total_rows]?>��)</td>
			<td width="50%" align="right">
				<img src="../images/home_icon.gif" width="10" height="10" align="absmiddle">
				<span class="navi">
				<!--------------- ī�װ� �׺���̼�----------------->
				<?=make_upperclass_str($arr_upperclass);?>
				<!--------------- ī�װ� �׺���̼�----------------->
				</span>
			</td>
		  </tr>
          <tr>
            <td>&nbsp;</td></tr>
		  <tr>
			<td bgcolor="#FFFFFF" style="padding-left:5px;padding-right:5px; border-top:1px solid #ebebeb; padding-top:10px;" colspan="2">
			<!-------------- ����ī�װ� ����Ʈ --------------->
			<div class="cate_cg"><? 
				for($i=0, $d_subclass_count = count($arr_d_subclass); $i<$d_subclass_count; $i++)
				{
					echo "<a href='product_list.html?$_get_str&category_num={$arr_d_subclass[$i]['category_num']}'>{$arr_d_subclass[$i]['category_name']} ({$arr_d_subclass[$i]['item_count']})</a>";
					if($i<$d_subclass_count-1)
						echo " | ";
				}
			?></div>
			<!-------------- ����ī�װ� ����Ʈ --------------->                    
			</td>
		  </tr>
	  </table>
</div>