<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2006. 12. 14
 *	�̸��� : heroyeo@hanmail.net
 *	���ϸ� : product.list.item.skin.php
 *	
 *	��ǰ ����Ʈ�� ��ǰ�ڽ� 1��
 -----------------------------------------------------------------------------*/
?>

									

									<td width="179" valign="top" align="center">
							<?
									$list_size_opts = explode("=", $row0[opt]);
									$list_size_op1 = explode("!", $list_size_opts[1]);
									$list_size_op1_count = count($list_size_op1);
									for($zzzz=1;$zzzz< $list_size_op1_count;$zzzz++){

										$list_size_view .= $list_size_op1[$zzzz]."&#13;";
									}
							?> 								
							<table width="165"  border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
                      <td height="160" align="center">
											<?	if($jaego_use == 1 && $jaego == 0){?>
                       <a href="javascript:alert('���� ǰ���� ��ǰ�Դϴ�!');">
                        <?=$img_str?>
                      </a>
                      <?}else{?>
											<a href='product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no?>&page=<?=$page?>&mode=<?=$mode?>'>
                        <?=$img_str?>
                      </a>
											<?}?>

				
					</td>
                    </tr>
                    <!-- <tr>
											<td height="30" align="center"><?=$icon_str?></td>
										</tr> -->
                    <tr height='20'>
                      <td align="center" class="product">
											<?	if($jaego_use == 1 && $jaego == 0){?>
												<a href="javascript:alert('���� ǰ���� ��ǰ�Դϴ�!');">
                        <?=$item_name?>
                      </a>
			               <?}else{?>
										 <a href='product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no?>&page=<?=$page?>&mode=<?=$mode?>'>
                        <?=$item_name?>
                     </a>
										 <?}?>
											</td>
                    </tr>
										<tr>
                      <td height="20" align="center" class="product3"><?=$item_company?></td>
                    </tr>
										<?if($short_explain){?>
                    <tr>
                      <td height="25" align="center" class="text_14_s2"><?=$short_explain?></td>
                    </tr>
										<?}?>
					<?
					if($if_strike=='1'&&$price>0){
					?>
					<tr>
                      <td height="30" align="center" bgcolor="F3F3F3"><?=$new_tar4?>
                          <strike><?=$price_str?> ��</strike>
					  </td>
                    </tr>					
					<?
					}
					?>

                    <tr>
                      <td height="30" align="center" bgcolor="F3F3F3"><?=$new_tar4?>
                          <span class="price">
                          <?=$z_price_str?> ��<?=$icon_str?>
                          </span><br><img src="../image/icon_point.gif" width="13" height="10"><span class="point">
                          <?=$bonus_str?> ��</span></td>
                    </tr>
                </table></td>
<?if($i%$_tdCount!=$_tdCount-1){?>
                <td width="1" background="../image/point_line.gif"></td>
<?}?>

<?
$list_size_view = "";
?>





