<?
if(!$category_num)
	$category_name = "��ü";
?>
<table width="97%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="D4CFC3">
	<tr>
	  <td bgcolor="EAE6E2"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td height="10" colspan="2"></td>
		  </tr>
		  <tr>
			<td width="50%"><img src="../images/proudct/product_info_title_icon.gif" width="13" height="13" align="absmiddle" /> <span class="category_title"><?=$category_name?></span>(�� <?=$page_info[total_rows]?>��)</td>
			<td width="50%" align="right">
				<img src="../images/home_icon.gif" width="8" height="9" align="absmiddle">
				<span class="navi">
				<!--------------- ī�װ� �׺���̼�----------------->
				<?=make_upperclass_str($arr_upperclass);?>
				<!--------------- ī�װ� �׺���̼�----------------->
				</span>
			</td>
		  </tr>
		  <tr>
			<td height="7" colspan="2"></td>
		  </tr>
		  <tr>
			<td height="1" bgcolor="D4CFC3" colspan="2"></td>
		  </tr>
		  <tr>
			<td height="7" bgcolor="#FFFFFF" colspan="2"></td>
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF" style="padding-left:5px;padding-right:5px" colspan="2">
			<!-------------- ����ī�װ� ����Ʈ --------------->
			<? 
				for($i=0, $d_subclass_count = count($arr_d_subclass); $i<$d_subclass_count; $i++)
				{
					echo "<a href='product_list.html?$_get_str&category_num={$arr_d_subclass[$i]['category_num']}'>{$arr_d_subclass[$i]['category_name']} ({$arr_d_subclass[$i]['item_count']})</a>";
					if($i<$d_subclass_count-1)
						echo " | ";
				}
			?>
			<!-------------- ����ī�װ� ����Ʈ --------------->                    
			</td>
		  </tr>
		  <tr>
			<td height="7" bgcolor="#FFFFFF" colspan="2"></td>
		  </tr>
		  <tr>
			<td height="1" bgcolor="D4CFC3" colspan="2"></td>
		  </tr>
		  <tr>
			<td height="10" colspan="2"></td>
		  </tr>
	  </table></td>
	</tr>
</table>