<?
//============================== 관리자 지정상품  =================================

$adminmain_sql = "select * from $Admin_ItemTable where mart_id='$mart_id' and adminmain_parent = '$banner_no' order by adminmain_item_order asc limit 50";
//echo $rec_sql;
$adminmain_res = mysql_query($adminmain_sql, $dbconn);
$adminmain_tot = mysql_num_rows($adminmain_res);

$_tdCount=5;
?>
<table width="700" border="0" cellspacing="0" cellpadding="0">
	<tr>
<?
for( $k = 0; $adminmain_row = mysql_fetch_array($adminmain_res); $k++ ){
	$adminmain_item_no[$k] = $adminmain_row[fav_item_no];
	$item_no[$k] = $adminmain_row[item_no];

	if($k%$_tdCount==0)
		echo "			  <tr>\n";

	$adminmain_sql1 = "select * from $ItemTable T1, $CategoryTable T2 where T1.item_no='$item_no[$k]' and T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'";
	//$rec_sql1 = "select * from $ItemTable T1, $CategoryTable T2 where T1.item_no='$item_no[$k]' and T1.category_num=T2.category_num";

	$adminmain_res1 = mysql_query($adminmain_sql1, $dbconn);
	$adminmain_tot1 = mysql_num_rows($adminmain_res1);
	$adminmain_row1 = mysql_fetch_array($adminmain_res1);
	
	$item_no1 = $adminmain_row1[item_no];
	$category_num = $adminmain_row1[firstno];
	$prevno = $adminmain_row1[prevno];
	$cate_num = $adminmain_row1[category_num];
	$item_name = $adminmain_row1[item_name];
	$img_high = $adminmain_row1[img_high];
	if(!$img_high)
		$img_high = $adminmain_row1[img_sml];
	$short_explain = $adminmain_row1[short_explain];
	$z_price = number_format($adminmain_row1[z_price]);
	$bonus = number_format($adminmain_row1[bonus]);
	$icon_no = $adminmain_row1[icon_no];
	$jaego = $adminmain_row1[jaego];
	$jaego_use = $adminmain_row1[jaego_use];

	$item_name = han_cut2($item_name,22);

	if($jaego_use == 1 && $jaego == 0){
		$icon_str = "<img src='../image/soldout_icon_s.gif' width='25' height='12' align='absmiddle'>";
	}else{
		if($icon_no == 0) $icon_str = "";
		if($icon_no == 1) $icon_str = "<img src='../image/hot.gif' width='22' height='13' align='absmiddle'>";
		if($icon_no == 2) $icon_str = "<img src='../image/new.gif' width='25' height='14' align='absmiddle'>";
		if($icon_no == 3) $icon_str = "<img src='../image/sale.gif' width='22' height='13' align='absmiddle'>";
		if($icon_no == 4) $icon_str = "<img src='../image/reserv.gif' width='53' height='12' align='absmiddle'>";
		//$icon_str = make_incon_tag($icon_no, "../image/");
	}

	//============================ 상품 이미지 =======================================
	if($img_high != "" && file_exists("$Co_img_UP$mart_id/$img_high")){
		if (strstr(strtolower(substr($img_high,-4)),'.jpg') || strstr(strtolower(substr($img_high,-4)),'.gif')){
			$img_str = "<a href='../main/product_info.html?mart_id=$mart_id&category_num=$category_num&category_num1=$prevno&category_num2=$category_num2&cate_num=$cate_num&item_no=$item_no1' target='_parent'><img src='$Co_img_DOWN$mart_id/$img_high' width='$list_product_img_width' height='$list_product_img_height' border='0'></a>";
		}
	}else{
		$img_str = "<a href='../main/product_info.html?mart_id=$mart_id&category_num=$category_num&category_num1=$prevno&category_num2=$category_num2&cate_num=$cate_num&item_no=$item_no1' target='_parent'><img src='../image/noimage_s.gif' width='$list_product_img_width' height='$list_product_img_height' border='0'></a>";
	}
?>
		<td width="<?=($list_product_img_width+20)?>" align="center" valign="top">
			<table width="<?=$list_product_img_width?>" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align=center><?=$img_str?></td>
				</tr>
				<tr>
					<td valign="top">
						<table width="<?=$list_product_img_width?>" border="0" cellspacing="1" cellpadding="0">
							<tr>
								<td align=center><span class="text_main_s"><?=$item_name?> <?=$icon_str?></span></td>
							</tr>
							<tr>
								<td align=center><span class="text_18_s"><?=$short_explain?></span></td>
							</tr>
							<tr>
								<td align=center><span class="text_main1_s">\<?=$z_price?></span></td>
							</tr>
							<tr>
								<td align=center><img src="../image/icon_point.gif" width="13" height="10"><span class="point"><?=$bonus?> 원</span> 
									</td>
								</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
<?
	if($k%$_tdCount==$_tdCount-1)
		echo "			  </tr>\n";
}
	if($k%$_tdCount)
	{
		for($l=$k%$_tdCount; $l<$_tdCount; $l++)
		{
?>
				<td width="20%">&nbsp;</td>
<?
			if($l%$_tdCount==$_tdCount-1)
				echo "			  </tr>\n";
		}
	}
?>
		<td>&nbsp;</td>
	</tr>
</table>
<?
if( $adminmain_res ){
	mysql_free_result( $adminmain_res );
}
if( $adminmain_res1 ){
	mysql_free_result( $adminmain_res1 );
}
?>