<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2006. 12. 14
 *	�̸��� : heroyeo@hanmail.net
 *	���ϸ� : product.category.skin.php
 *	
 *	��ǰ����Ʈ �ֻ��� ī�װ� ���� ������ ī�װ����� ���
 *	���� ���� ī�װ� or �Ǵ� ���� ������ ī�װ� ����Ʈ�� ���
 -----------------------------------------------------------------------------*/

if(!$category_num)
	$category_name = "��ü";
?>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="46" background="../images/depth2_list_1.gif" style="background-repeat:no-repeat"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			   			<tr>
                  <td width="2%">&nbsp;</td>
                  <td width="48%"><img src="../images/list_icon.gif" width="8" height="9" align="absmiddle"> <span class="category_title">
                    <?=$category_name?> 
                  </span> (�� <?=$page_info[total_rows]?>��)</td>
                  <td width="48%" align="right"><div align="right"><img src="../images/home_icon.gif" width="8" height="9" align="absmiddle">
									<span class="navi">
									<!--------------- ī�װ� �׺���̼�----------------->
									<?=make_upperclass_str($arr_upperclass);?>
									<!--------------- ī�װ� �׺���̼�----------------->
									</span></div></td>
                  <td width="2%">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" background="../images/depth2_list_2.gif" style="background-repeat:repeat-y">
							<table width="93%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
										<!-------------- ����ī�װ� ����Ʈ --------------->
										<span class="category_3">
<? 
	for($i=0, $d_subclass_count = count($arr_d_subclass); $i<$d_subclass_count; $i++)
	{
		echo "<a href='product_list.html?$_get_str&category_num={$arr_d_subclass[$i]['category_num']}'>{$arr_d_subclass[$i]['category_name']} ({$arr_d_subclass[$i]['item_count']})</a>";
		if($i<$d_subclass_count-1)
			echo " | ";
	}
?>
                    </span>
										<!-------------- ����ī�װ� ����Ʈ --------------->                    
                  </td>
                </tr>
							</table>
						</td>
          </tr>
          <tr>
            <td><img src="../images/depth2_list_3.gif"></td>
          </tr>
</table>