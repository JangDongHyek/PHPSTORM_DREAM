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
                   	  <div style="border:1px solid #e3d9d4;">
                        	<?	if($jaego_use == 1 && $jaego == 0){?>
                       <a href="javascript:alert('현재 품절인 상품입니다!');">
                        <?=$img_str?>
                      </a>
                      <?}else{?>
					  <a href='product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no?>&page=<?=$page?>&mode=<?=$mode?>'>
                        <?=$img_str?>
                      </a><?}?>
                        </div>
                      </td>
                    </tr>
                    					<tr>
					<td height="5" align=center></td>
				</tr>
                    <!-- <tr>
											<td height="30" align="center"><?=$icon_str?></td>
										</tr> -->
                    <tr height='20'>
                      <td align="center" class="product">
											<?	if($jaego_use == 1 && $jaego == 0){?>
												<a href="javascript:alert('현재 품절인 상품입니다!');">
                        <?=$item_name?> <?=$icon_str?>
                      </a>
			               <?}else{?>
										 <a href='product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no?>&page=<?=$page?>&mode=<?=$mode?>'>
                        <?=$item_name?> <?=$icon_str?>
                     </a>
										 <?}?>
											</td>
                    </tr>
					<!--<tr>
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
                          <strike><?=$price_str?> 원</strike>
					  </td>
                    </tr>					
					<?
					}
					?>

                    <tr>
                      <td height="30" align="center" bgcolor="#ffffff"><?=$new_tar4?>
                          <span class="price" style="line-height:33px;">\
                          <?=$z_price_str?> <?if($z_price_str != 0){?>원<?}?>
                          </span>
                          <?
				if($bonus_ok == 't'){
			  ?>
			<br><span class="new_point"><?=$bonus_str?> 원</span>
			<?}?>	
			</td>-->
                    </tr>
                    <!--<tr>
                      <td height="35">&nbsp;</td></tr>-->
                </table></td>
<?if($i%$_tdCount!=$_tdCount-1){?>
                <td width="1" background=""></td>
<?}?>

<?
$list_size_view = "";
?>



