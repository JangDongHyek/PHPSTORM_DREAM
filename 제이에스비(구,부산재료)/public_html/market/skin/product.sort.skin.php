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
						<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td width="188" height="40" valign="bottom"><img src="../images/sub_23.gif" width="188" height="32"></td>
							  <td align="right" valign="bottom" style="padding-right:10px;"><select name="flag" id="select_flag" onchange="self.location.href='?<?=$_get_str?>&category_num=<?=$category_num?>&flag='+this.value">
<?
								// ��ǰ���� �ʵ� ��� 
								$arr_sort_list = array("item_order"=>"�α��ǰ��", "item_name"=>"��ǰ���", "z_price_down"=>"�������ݼ�", "z_price_up"=>"�������ݼ�", "item_no"=>"��ǰ����ϼ�");
								echo rg_html_option($arr_sort_list,'','',$flag);
?>							</select>
								<!-- <a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=z_price_up"><img src="../image/product/<?=$flag_img1?>" width="70" height="20" hspace="5" border="0"></a><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=z_price_down"><img src="../image/product/<?=$flag_img2?>" width="70" height="20" border="0"></a><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=item_name"><img src="../image/product/<?=$flag_img3?>" width="60" height="20" hspace="5" border="0"></a><a href="?<?=$_get_str?>&category_num=<?=$category_num?>&flag=item_no"><img src="../image/product/<?=$flag_img4?>" width="60" height="20" border="0"></a> --></td>
							</tr>
						</table>