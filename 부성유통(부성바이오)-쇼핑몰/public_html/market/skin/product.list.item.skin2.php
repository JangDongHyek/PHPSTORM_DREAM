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

									

									<td width="150" valign="top" align="center">
							<?
									$list_size_opts = explode("=", $row0[opt]);
									$list_size_op1 = explode("!", $list_size_opts[1]);
									$list_size_op1_count = count($list_size_op1);
									for($zzzz=1;$zzzz< $list_size_op1_count;$zzzz++){

										$list_size_view .= $list_size_op1[$zzzz]."&#13;";
									}
							?>
							<table width="270" border="0" align="center" cellpadding="0" cellspacing="0" style='table-layout:fixed;296px'>
                              <tr>
                                <td width="145" valign="top"><div align="center">
                                  <?	if($jaego_use == 1 && $jaego == 0){?>
                                    <a href="javascript:alert('���� ǰ���� ��ǰ�Դϴ�!');">
                                    <?=$img_str?>
                                    <?}else{?>
                                    </a><a href='product_info.html?mart_id=<?=$mart_id?>&amp;category_num=<?=$cate_num?>&amp;flag=<?=$flag?>&amp;item_no=<?=$item_no?>&amp;page=<?=$page?>&amp;mode=<?=$mode?>'>
                                    <?=$img_str?>
                                    </a>
                                    <?}?>
                                </div></td>
                                <td valign="top"><table width="98%" border="0" align="center" cellpadding="4" cellspacing="0">
                                    <tr>
                                      <td height="25" class="product"><?	if($jaego_use == 1 && $jaego == 0){?>
                                          <a href="javascript:alert('���� ǰ���� ��ǰ�Դϴ�!');">
                                          <?=$item_name?>
                                          </a>
                                          <?}else{?>
                                          <a href='product_info.html?mart_id=<?=$mart_id?>&amp;category_num=<?=$cate_num?>&amp;flag=<?=$flag?>&amp;item_no=<?=$item_no?>&amp;page=<?=$page?>&amp;mode=<?=$mode?>'>
                                          <?=$item_name?>
                                          </a>
                                          <?}?>                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="product">
                                        <span class="text_main1_s">
                          \<?=$z_price_str?>
<?=$icon_str?>
                                        </span> <img src="../image/icon_point.gif" width="13" height="10" /><span class="point">
                                        <?=$bonus_str?>
��</span></td>
                                    </tr>
                                    <tr>
                                      <td class="text_14_s2">
                                        <?=$short_explain?></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table></td>
<?if($i%$_tdCount!=$_tdCount-1){?>
                <td width="2" background="http://www.lets080.com/~picasso/market/image/point_line.gif"></td>
<?}?>

<?
$list_size_view = "";
?>





