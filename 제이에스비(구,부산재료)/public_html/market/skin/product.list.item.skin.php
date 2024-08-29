<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 14
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : product.list.item.skin.php
 *	
 *	상품 리스트에 상품박스 1개
 -----------------------------------------------------------------------------*/
?>

									

									<td width="25%" valign="top" align="center">
							<?
									$list_size_opts = explode("=", $row0[opt]);
									$list_size_op1 = explode("!", $list_size_opts[1]);
									$list_size_op1_count = count($list_size_op1);
									for($zzzz=1;$zzzz< $list_size_op1_count;$zzzz++){

										$list_size_view .= $list_size_op1[$zzzz]."&#13;";
									}
							?> 								
							<table width="93%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #E3E3E3;">
									<tr>
                      <td height="160" align="center">
											<?	if($jaego_use == 1 && $jaego == 0){?>
                       <a href="javascript:alert('현재 품절인 상품입니다!');">
                        <?=$img_str?>
                      </a>
                      <?}else{?>
											<a href='product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no?>&page=<?=$page?>&mode=<?=$mode?>' onmouseover="openPopup2(this);" onmouseout="closePopup2(this);" id="menu<?=$i?>">
                        <?=$img_str?>
                      </a>
											<?}?>

<!--
					<div id='itemmenu<?=$i?>' style="display:none;position:absolute;FILTER:alpha(opacity=99);opacity:0.99;z-index:99;" onmouseover="openPopup2(document.getElementById('menu<?=$i?>'));" onmouseout="swapImgRestore2();closePopup2(document.getElementById('menu<?=$i?>'));">
					<table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#EABE71">
						<tr>
							<td bgcolor="#ffffff" valign="top">
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td height="20" style="font-size:12px;">
										주문가능사이즈</td>
									</tr>									<tr>
										<td height="20" style="font-size:12px;">
										<?=$list_size_view?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</div>
-->					
					</td>
                    </tr>
                    <!-- <tr>
											<td height="30" align="center"><?=$icon_str?></td>
										</tr> -->
                    <tr height='20'>
                      <td align="center" class="product">
											<?	if($jaego_use == 1 && $jaego == 0){?>
												<a href="javascript:alert('현재 품절인 상품입니다!');">
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
                      <td height="20" align="center" class="product"><?=$item_company?></td>
                    </tr>
										<?if($short_explain){?>
                    <tr>
                      <td height="25" align="center" class="text_14_s2"><?=$short_explain?></td>
                    </tr>
										<?}?>
                    <tr>
                      <td height="30" align="center"><?=$new_tar4?>
                          <img src="../image/product/zoom.gif" width="15" height="15" border="0" align="absmiddle"> <span class="price">
                          <?=$z_price_str?> <?=$icon_str?>
                          </span>
						  <!--<br><img src="../image/icon_point.gif" width="13" height="10"><span class="point">
                          <?=$bonus_str?> 원</span>--></td>
                    </tr>
</table></td>
<?if($i%$_tdCount!=$_tdCount-1){?>
                <td width="1" background="../image/point_line.gif"></td>
<?}?>

<?
$list_size_view = "";
?>





