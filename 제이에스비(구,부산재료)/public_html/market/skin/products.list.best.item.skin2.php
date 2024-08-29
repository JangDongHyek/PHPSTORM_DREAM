<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 14
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : product.list.empty.skin.php
 *	
 *	상품 리스트에 베스트 아이템 스킨
 -----------------------------------------------------------------------------*/
?>
<script language="JavaScript">
<!--
var fixedX = -1; ////////// 레이어 X축 위치 (-1 : 버튼에 바로 아래에 표시)
var fixedY = -1; ////////////// 레이어 Y축 위치 (-1 : 버튼에 바로 아래에 표시)

function openPopup3(obj)
{
	var leftpos = 0;
	var toppos = 140;
	var cleft;
	var ctop;

	// 현재 오브젝트의 좌표값
	aTag = obj;
	do {
		aTag = aTag.offsetParent;
		leftpos	+= aTag.offsetLeft;
		toppos += aTag.offsetTop;
	} while(aTag.tagName!="BODY");

	cleft =	fixedX==-1 ? obj.offsetLeft	+ leftpos :	fixedX;
	ctop = fixedY==-1 ?	obj.offsetTop +	obj.offsetHeight + toppos :	fixedY;

	// 팝업메뉴설정
	oSubmenu = document.getElementById("best1"+obj.id);
	oSubmenu.style.left = cleft+95;
	oSubmenu.style.top = ctop-20-143;
	oSubmenu.style.zIndex = "9";
	oSubmenu.style.width = "100";
	oSubmenu.style.height = "100";
	// 메뉴가 현재 에서 오버 된다면
	if((parseInt(document.body.clientHeight)+document.body.scrollTop) < (parseInt(oSubmenu.style.top)+parseInt(oSubmenu.style.height)))
		oSubmenu.style.top = parseInt(document.body.clientHeight) + document.body.scrollTop - parseInt(oSubmenu.style.height);
	oSubmenu.style.display = "inline";
}

function closePopup3(obj)
{
	oSubmenu = document.getElementById("best1"+obj.id);
	oSubmenu.style.display = "none";
}

function swapImgRestore3() { //v3.0 
	var i,x,a=document.sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc; 
} 
//-->
</script>
<script language="JavaScript">
<!--
var fixedX = -1; ////////// 레이어 X축 위치 (-1 : 버튼에 바로 아래에 표시)
var fixedY = -1; ////////////// 레이어 Y축 위치 (-1 : 버튼에 바로 아래에 표시)

function openPopup4(obj)
{
	var leftpos = 0;
	var toppos = 140;
	var cleft;
	var ctop;

	// 현재 오브젝트의 좌표값
	aTag = obj;
	do {
		aTag = aTag.offsetParent;
		leftpos	+= aTag.offsetLeft;
		toppos += aTag.offsetTop;
	} while(aTag.tagName!="BODY");

	cleft =	fixedX==-1 ? obj.offsetLeft	+ leftpos :	fixedX;
	ctop = fixedY==-1 ?	obj.offsetTop +	obj.offsetHeight + toppos :	fixedY;

	// 팝업메뉴설정
	oSubmenu = document.getElementById("best2"+obj.id);
	oSubmenu.style.left = cleft+95;
	oSubmenu.style.top = ctop-20-143;
	oSubmenu.style.zIndex = "9";
	oSubmenu.style.width = "100";
	oSubmenu.style.height = "100";
	// 메뉴가 현재 에서 오버 된다면
	if((parseInt(document.body.clientHeight)+document.body.scrollTop) < (parseInt(oSubmenu.style.top)+parseInt(oSubmenu.style.height)))
		oSubmenu.style.top = parseInt(document.body.clientHeight) + document.body.scrollTop - parseInt(oSubmenu.style.height);
	oSubmenu.style.display = "inline";
}

function closePopup4(obj)
{
	oSubmenu = document.getElementById("best2"+obj.id);
	oSubmenu.style.display = "none";
}

function swapImgRestore4() { //v3.0 
	var i,x,a=document.sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc; 
} 
//-->
</script>
<table width="700"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><img src="../images/sub_10.gif" width="700" height="38"></td>
          </tr>
          <tr>
            <td><table width="96%"  border="0" align="center" cellpadding="10" cellspacing="5" bgcolor="FFDFD5">
              <tr>
                <td bgcolor="#FFFFFF"><?
//========================= 해당 1차 카테고리의 베스트오브베스트를 불러옴 ================
$fav_sql = "select * from $Best_ItemTable where mart_id='$mart_id' and `{$_field[$category_degree]}`='$category_num' order by best_item_order asc limit 6";	 // 2차 상품등록
$fav_res = mysql_query($fav_sql, $dbconn);
$fav_tot = mysql_num_rows($fav_res);

for( $k = 0; $fav_row = mysql_fetch_array($fav_res); $k++ ){
	$fav_item_no[$k] = $fav_row[fav_item_no];
	$item_no[$k] = $fav_row[item_no];
	
	$fav_sql1 = "select * from $ItemTable T1, $CategoryTable T2 where T1.item_no='$item_no[$k]' and T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'";

	$fav_res1 = mysql_query($fav_sql1, $dbconn);
	$fav_tot1 = mysql_num_rows($fav_res1);
	$fav_row1 = mysql_fetch_array($fav_res1);
	
	$item_no1 = $fav_row1[item_no];
	$prevno = $fav_row1[prevno];
	$cate_num = $fav_row1[category_num];
	$item_name[$k] = $fav_row1[item_name];
	$short_explain[$k] = $fav_row1[short_explain];
	//$price[$k] = $fav_row1[price];
	$z_price[$k] = $fav_row1[z_price];
	$member_price[$k] = $fav_row1[member_price];
	$bonus[$k] = $fav_row1[bonus];

	$img_big[$k] = $fav_row1[img_big];
	$img_sml[$k] = $fav_row1[img_sml];
	$opt_view[$k] = $fav_row1[opt];

	//$item_name[$k] = han_cut2($item_name[$k],22);
	//$short_explain[$k] = han_cut($short_explain[$k],22);

	if( $k == 0 ){
		$item_name0 = "<a href='../main/product_info.html?mart_id=$mart_id&category_num=$cate_num&item_no=$item_no1'>$item_name[0]</a>";
		$short_explain0 = $short_explain[0];
		$z_price_str0 = number_format($z_price[0])."원";
		$bonus0 = "<img src='../image/icon_point.gif' width='13' height='10'><span class='point'>".number_format($bonus[0])."원</span>";
		//============================ 상품 이미지 =======================================

			$size_opts = explode("=", $opt_view[0]);
			$size_op1 = explode("!", $size_opts[1]);
			$size_op1_count = count($size_op1);
			for($zz=1;$zz< $size_op1_count;$zz++){
				$size_view .= $size_op1[$zz]."&#13;";
			}
		
		if($img_big[0] != "" && file_exists("$Co_img_UP$mart_id/$img_big[0]")){
			$target0 = "../..$Co_img_DOWN$mart_id/$img_big[0]";
			$new_tar0 = "<a onClick=\"window.open('big.html?item_no=$item_no1&file=$target0','원본사진보기','width=600,height=620,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')\" style='cursor:hand' title='$size_view'><img src='../image/product/zoom.gif' width='15' height='15' border='0' align='absmiddle'></a>";

			if (strstr(strtolower(substr($img_big[0],-4)),'.jpg') || strstr(strtolower(substr($img_big[0],-4)),'.gif')){
				$img_str0 = "<img src='$Co_img_DOWN$mart_id/$img_big[0]' width='200' height='200' border='0'>";
				$a_ste0 = "../main/product_info.html?mart_id=$mart_id&category_num=$cate_num&item_no=$item_no1";
			}
		}else{
			$img_str0 = "<img src='../image/noimage_m.gif' width='200' height='200' border='0'>";
			$a_ste0 = "../main/product_info.html?mart_id=$mart_id&category_num=$cate_num&item_no=$item_no1";
		}
	}
	if( $k == 1 ){
		$item_name1 = "<a href='../main/product_info.html?mart_id=$mart_id&category_num=$cate_num&item_no=$item_no1'>$item_name[1]</a>";
		$short_explain1 = $short_explain[1];
		$z_price_str1 = number_format($z_price[1])."원";
		$bonus1 = "<img src='../image/icon_point.gif' width='13' height='10'><span class='point'>".number_format($bonus[1])."원</span>";
		//============================ 상품 이미지 =======================================

			$size_opts = explode("=", $opt_view[1]);
			$size_op1 = explode("!", $size_opts[1]);
			$size_op1_count = count($size_op1);
			for($zz=1;$zz< $size_op1_count;$zz++){
				$size_view2 .= $size_op1[$zz]."&#13;";
			}
		
		if($img_sml[1] != "" && file_exists("$Co_img_UP$mart_id/$img_sml[1]")){
			$target1 = "../..$Co_img_DOWN$mart_id/$img_big[1]";
			$new_tar1 = "<a onClick=\"window.open('big.html?item_no=$item_no1&file=$target1','원본사진보기','width=600,height=620,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')\" style='cursor:hand' title='$size_view2'><img src='../image/product/zoom.gif' width='15' height='15' border='0' align='absmiddle'></a>";

			if (strstr(strtolower(substr($img_sml[1],-4)),'.jpg') || strstr(strtolower(substr($img_sml[1],-4)),'.gif')){
				$img_str1 = "<img src='$Co_img_DOWN$mart_id/$img_big[1]' width='200' height='200' border='0'>";
				$a_ste1 = "../main/product_info.html?mart_id=$mart_id&category_num=$cate_num&item_no=$item_no1'";
			}
		}else{
			$img_str1 = "<img src='../image/noimage_m.gif' width='100' height='100' border='0'>";
			$a_ste1 = "../main/product_info.html?mart_id=$mart_id&category_num=$cate_num&item_no=$item_no1'"; 
		}
	}
}

if(!$a_ste0){
	$a_ste0 = "<img src='../image/noimage_m.gif' width='200' height='200' border='0'>";
}
if(!$a_ste1){
	$a_ste1 = "<img src='../image/noimage_m.gif' width='200' height='200' border='0'>";
}


if( $fav_res ){
	mysql_free_result( $fav_res );
}
if( $fav_res1 ){
	mysql_free_result( $fav_res1 );
}
?>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="300"><!--왼쪽 상품테이블-->
                            <table width="240"  border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="240" height="230" align="center"><a href="<?=$a_ste0?>" onmouseover="openPopup3(this);" onmouseout="closePopup3(this);" id="menu"><?=$img_str0?></a>
																<div id='best1menu' style="display:none;position:absolute;FILTER:alpha(opacity=99);opacity:0.99;z-index:99;" onmouseover="openPopup3(document.getElementById('menu'));" onmouseout="swapImgRestore3();closePopup3(document.getElementById('menu'));">
																<table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#EABE71">
																	<tr>
																		<td bgcolor="#ffffff" valign="top">
																		<table width="100%" cellpadding="0" cellspacing="0" border="0">
																				<tr>
																					<td height="20" style="font-size:12px;">
																					주문가능사이즈</td>
																				</tr>									<tr>
																					<td height="20" style="font-size:12px;">
																					<?=$size_view?></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
																</div>																
																</td>
                              </tr>
                              <tr>
                                <td align="center" class="product"><?=$item_name0?></td>
                              </tr>
                              <tr>
                                <td height="25" align="center" class="text_14_s2"><?=$short_explain0?></td>
                              </tr>
                              <tr>
                                <td height="40" align="center" bgcolor="F3F3F3"><?=$new_tar0?>
                                    <span class="price">
                                    <?=$z_price_str0?>
                                    </span>
                                    <?=$bonus0?></td>
                              </tr>
                            </table>
                            <!--왼쪽 상품테이블 END-->
                        </td>
                        <td width="1" background="../image/point_line.gif"></td>
                        <td><table width="240"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="240" height="230" align="center"><a href="<?=$a_ste1?>" onmouseover="openPopup4(this);" onmouseout="closePopup4(this);" id="menu"><?=$img_str1?></a>
														<div id='best2menu' style="display:none;position:absolute;FILTER:alpha(opacity=99);opacity:0.99;z-index:99;" onmouseover="openPopup4(document.getElementById('menu'));" onmouseout="swapImgRestore4();closePopup4(document.getElementById('menu'));">
														<table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#EABE71">
															<tr>
																<td bgcolor="#ffffff" valign="top">
																<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																			<td height="20" style="font-size:12px;">
																			주문가능사이즈</td>
																		</tr>									<tr>
																			<td height="20" style="font-size:12px;">
																			<?=$size_view2?></td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
														</div>														
														</td>
                          </tr>
                          <tr>
                            <td align="center" class="product"><?=$item_name1?></td>
                          </tr>
                          <tr>
                            <td height="25" align="center" class="text_14_s2"><?=$short_explain1?></td>
                          </tr>
                          <tr>
                            <td height="40" align="center" bgcolor="F3F3F3"><?=$new_tar1?>
                                <span class="price">
                                <?=$z_price_str1?>
                                </span>
                                <?=$bonus1?></td>
                          </tr>
                        </table></td>
                      </tr>
                  </table></td>
              </tr>
            </table>
						</td>
          </tr>
				</table>