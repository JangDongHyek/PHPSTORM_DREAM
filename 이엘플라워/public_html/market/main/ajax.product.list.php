<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";

// get 변수를 설정
$_get_str = $p_str;	
?>
<?
//================== 현재 카테고리 정보를 불러옴 ==========================================
$sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
$res = mysql_query($sql, $dbconn);
$row = mysql_fetch_array( $res );
$category_prevno = $row[prevno];
$category_name = $row[category_name];
$category_degree = $row[category_degree]+1;
$category_left = $row["category_left"];

$arr_upperclass = make_upperclass($category_num, $category_degree);
$arr_d_subclass = make_d_subclass($category_num);
if(!count($arr_d_subclass))
	$arr_d_subclass = make_d_subclass($category_prevno);

$_field = array(1=>"firstno", "prevno", "thirdno", "category_num");
?>



<!-------------------- 카테고리 출력 ----------------------->
                                <!-------------------- 카테고리 출력 ----------------------->                            <?
					//================== 카테고리 상품을 불러옴 ==========================================
					if( $flag == "z_price_up" ){//높은가격순
						$flag_name = "z_price";
						$order = "desc";
						$flag_img1 = "align_1_on.gif";
						$flag_img2 = "align_2.gif";
						$flag_img3 = "align_3.gif";
						$flag_img4 = "align_4.gif";
						$_get_str .= "&flag=$flag";
					}else if( $flag == "z_price_down" ){//낮은가격순
						$flag_name = "z_price";
						$order = "asc";
						$flag_img1 = "align_1.gif";
						$flag_img2 = "align_2_on.gif";
						$flag_img3 = "align_3.gif";
						$flag_img4 = "align_4.gif";
						$_get_str .= "&flag=$flag";
					}else if( $flag == "item_name" ){//상품명 정렬
						$flag_name = "item_name";
						$order = "asc";
						$flag_img1 = "align_1.gif";
						$flag_img2 = "align_2.gif";
						$flag_img3 = "align_3_on.gif";
						$flag_img4 = "align_4.gif";
						$_get_str .= "&flag=$flag";
					}else if( $flag == "item_no" ){//신상품순
						$flag_name = "item_no";
						$order = "desc";
						$flag_img1 = "align_1.gif";
						$flag_img2 = "align_2.gif";
						$flag_img3 = "align_3.gif";
						$flag_img4 = "align_4_on.gif";
						$_get_str .= "&flag=$flag";
					}else{//정렬이 아닐때
						//$flag_name = "item_order";
						$flag_name = "z_price";
						$order = "desc";
						$flag_img1 = "align_1.gif";
						$flag_img2 = "align_2.gif";
						$flag_img3 = "align_3.gif";
						$flag_img4 = "align_4.gif";
					}
                                        $_get_str .= "&flag=$flag";
					// 상품리스트 시작 
						for($i=0;$i<count($ss_key);$i++) {
						switch ($ss_key[$i]) {
								/***********************************************************************/
								// 검색필드로 
						  case "search_field": 
									if($ss[$ss_key[$i]]) {
										$qstr .= " AND `{$ss[$ss_key[$i]]}` LIKE '%$kw%' ";
										$_get_str .= "&kw=$kw";
									}
									break;
								case "search_mode":
									switch($ss["search_mode"])
									{
										case "default":
											$qstr .= " AND (`item_name` LIKE '%$kw%' OR `item_company` LIKE '%$kw%')";
										$_get_str .= "&kw=$kw";
										break;
										case "detail":
											if($form_price == "" && $to_price == "" && !$item_name && !$item_company && !$item_explain)
											{
												$qstr .= " AND 1=0 ";
												break;
											}
											if($from_price != "")
											{
												$qstr .= " AND `z_price` >= ".str_replace(",", "", $from_price)." ";
												$_get_str .= "&from_price=$from_price";
											}
											if($to_price != "" )
											{	 
												$qstr .= " AND `z_price` <= ".str_replace(",", "", $to_price)." ";
												$_get_str .= "&to_price=$to_price";
											}
											if($item_name)
											{	
												$qstr .= " AND `item_name` LIKE '%$item_name%' ";
												$_get_str .= "&item_name=$item_name";
											}
											if($item_company)
											{	
												$qstr .= " AND `item_company` LIKE '%$item_company%' ";
												$_get_str .= "&item_company=$item_company";
											}
											if($item_explain)
											{
												$qstr .= " AND `item_explain` LIKE '%$item_explain%' ";
												$_get_str .= "&item_explain=$item_explain";
											}
										break;

										case "category":
										default:
										break;
									}
								break;
						}
						}

						if (empty($ot)) $ot = 10;
					  switch ($ot) {
						case 10 : $ostr .= " ORDER BY mb_num DESC";		break;
						case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
						case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
						case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
						case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;

					  }
					  

						$ostr = "ORDER BY $flag_name $order, item_no desc ";

						// query 설정
						if($category_num)
							$qstr .= "AND `{$_field[$category_degree]}`='$category_num' ";

						$dbqry="
								SELECT count(item_no) as row_count 
								FROM `$ItemTable`
								WHERE if_hide='0' and mart_id='$mart_id' $qstr
								$ostr
							";

						$rs = mysql_query($dbqry,$dbconn);
						fetch($rs, array("row_count"));
						$page_info=rg_navigation($page,$row_count,32,10);

						$dbqry="
								SELECT *
								FROM `$ItemTable`
								WHERE if_hide='0' and mart_id='$mart_id' $qstr
								$ostr
								LIMIT $page_info[offset],$page_info[rows]
							";
						
						//echo $dbqry;
						
						$res0=query($dbqry,$dbconn);
						$no = $page_info[total_rows]-$page_info[offset]+1;

					?>
							
							</td>
                          </tr>
                     
                      </table></td>
                    </tr>
                    
                    <tr>
                      <td background="../images/proudct/product_list_box_bg2.gif" bgcolor="#FFFFFF"><div align="center">
                          <!---------------------------------------상품리스트 출력 시작------------------------------------------->
                          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                            <?
if( $page_info[total_rows] == "0" ){
?>
                            <tr>
                              <td height='50' align='center' colspan='7'><b>등록된 상품이 없습니다.</b></td>
                            </tr>
                            <?
}else{

	$i = 0;
	$_tdCount=3;
	while($row0 = mysql_fetch_array($res0)){
		$id = $total - ($olds + $i);

		$cate_num = $row0[category_num];
		$item_no = $row0[item_no];
		$item_name = $row0[item_name];
		$price = $row0[price];
		$z_price = $row0[z_price];
		$member_price = $row0[member_price];
		$bonus = $row0[bonus];
		$use_bonus = $row0[use_bonus];
		$jaego = $row0[jaego];
		$img_sml = $row0[img];
		$img = $row0[img];
		$img_big = $row0[img_big];
		$opt = $row0[opt];
		$doctype = $row0[doctype];
		$short_explain = $row0[short_explain];
		$reg_date = $row0[reg_date];
		$item_company = $row0[item_company];
		$icon_no = $row0[icon_no];
		$jaego_use = $row0[jaego_use];
		$use_coupon = $row0[use_coupon];
		$if_strike = $row0[if_strike];

		$item_name = han_cut2($item_name,40);
		$short_explain = han_cut($short_explain,260);
		$short_explain = strip_tags($short_explain);
		$price_str = number_format($price);
		if( $if_member_price == '1' && $UnameSess ){
			if($member_price == 0){
				$z_price = round($z_price * $member_price_percent / 100, -2);
			}else{
				$z_price = $member_price;	
			}
		}

		$z_price_str = number_format($z_price);
		$bonus_str = number_format($bonus);
		$fee = $row0[fee];
		$thumbnail = $row0[thumbnail];

		
	if($z_price_str == 0){
		$z_price_str = "가격문의";
	}


		if($jaego_use == 1 && $jaego == 0){
			$icon_str = "<img src='../image/soldout_icon_s.gif' align='absmiddle'>";
		}else{
			if($icon_no == 0) $icon_str = "";
			if($icon_no == 1) $icon_str = "<img src='../image/1.gif' align='absmiddle'>";
			if($icon_no == 2) $icon_str = "<img src='../image/2.gif' align='absmiddle'>";
			if($icon_no == 3) $icon_str = "<img src='../image/3.gif' align='absmiddle'>";
			if($icon_no == 4) $icon_str = "<img src='../image/4.gif' align='absmiddle'>";
			if($icon_no == 5) $icon_str = "<img src='../image/5.gif' align='absmiddle'>";
			if($icon_no == 6) $icon_str = "<img src='../image/6.gif' align='absmiddle'>";
			if($icon_no == 7) $icon_str = "<img src='../image/7.gif' align='absmiddle'>";
			if($icon_no == 8) $icon_str = "<img src='../image/8.gif' align='absmiddle'>";
			if($icon_no == 9) $icon_str = "<img src='../image/9.gif' align='absmiddle'>";
		}

		//============================ 상품 이미지 =======================================
		
		
		if($thumbnail == 'y'){
			$fixed_size = " width='320'";
		}else{
			$fixed_size = " width='130' height='130' ";
		}
		
		
		
		if($img_sml != "" && file_exists("$Co_img_UP$mart_id/$img_sml")){
			if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
				$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_sml' border='0' $fixed_size>";
			}
			if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
				$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_sml' $fixed_size></embed>";
			}
		}else if($img != "" && file_exists("$Co_img_UP$mart_id/$img")){
			if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
				$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img' border='0' $fixed_size>";
			}
			if (strstr(strtolower(substr($img,-4)),'.swf')){
				$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img' $fixed_size></embed>";
			}
		}else if($img_big != "" && file_exists("$Co_img_UP$mart_id/$img_big")){
			if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
				$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_big' border='0' $fixed_size>";
			}
			if (strstr(strtolower(substr($img_big,-4)),'.swf')){
				$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_big' $fixed_size></embed>";
			}
		}else{
			$img_str = "<img src='../image/noimage_s.gif' border='0' style='margin:30% auto;'>";
		}

		if( $img_big ){
			$target4 = "../..$Co_img_DOWN$mart_id/$img_big";
			//==================== 이미지 사이즈를 구함 ======================================
			$img_size1 = @GetImageSize("$target4"); 
			$img_width1 = $img_size1[0] + 100; //이미지의 넓이를 알 수 있음 
			$img_height1 = $img_size1[1]; //이미지의 높이를 알 수 있음
			$img_height1 = $img_height1 + 120;
			$new_tar4 = "<a onClick=\"window.open('big.html?item_no=$item_no&file=$target4','원본사진보기','width=$img_width1,height=$img_height1,top=0,left=0,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')\" style='cursor:hand'>";
		}else if( $img ){
			$target4 = "../..$Co_img_DOWN$mart_id/$img";
			//==================== 이미지 사이즈를 구함 ======================================
			$img_size1 = @GetImageSize("$target4"); 
			$img_width1 = $img_size1[0] + 100; //이미지의 넓이를 알 수 있음 
			$img_height1 = $img_size1[1]; //이미지의 높이를 알 수 있음
			$img_height1 = $img_height1 + 120;
			$new_tar4 = "<a onClick=\"window.open('big.html?item_no=$item_no&file=$target4','원본사진보기','width=$img_width1,height=$img_height1,top=0,left=0,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')\" style='cursor:hand'>";
		}else if( $img_sml ){
			$target4 = "../..$Co_img_DOWN$mart_id/$img_sml";
			//==================== 이미지 사이즈를 구함 ======================================
			$img_size1 = @GetImageSize("$target4"); 
			$img_width1 = $img_size1[0] + 100; //이미지의 넓이를 알 수 있음 
			$img_height1 = $img_size1[1]; //이미지의 높이를 알 수 있음
			$img_height1 = $img_height1 + 120;
			$new_tar4 = "<a onClick=\"window.open('big.html?item_no=$item_no&file=$target4','원본사진보기','width=$img_width1,height=$img_height1,top=0,left=0,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')\" style='cursor:hand'>";
		}else{
			$new_tar4 = "";
		}



		if($fee == "무료배송" || $fee == "착불"){
				$freight_fee = "무료";
		}else{
			$freight_fee = number_format($freight_cost)."원";
		}





		if($i%$_tdCount==0)
			echo "						<tr>\n";

		// 리스트 아이템 스킨 불러오기
		include "../skin/product.list.item.skin.php";

		if($i%$_tdCount==$_tdCount-1)
			echo "						</tr>\n
													<tr>
														<td height=\"5\"></td>
													</tr>
			";

		$i++;
	}

	// td를 다 채우지 못했을 경우
	if($i%$_tdCount)
	{
		for($j=$i%$_tdCount; $j<$_tdCount; $j++)
		{
			include "../skin/product.list.empty.skin.php";
			$fixed_size = "";
			if($j%$_tdCount==$_tdCount-1)
				echo "						</tr>\n
														<tr>
															<td height=\"5\"></td>
														</tr>
				";
		}
		
	}
}
?>
                          </table>
                        <!---------------------------------------상품리스트 출력 끝------------------------------------------->
                         
                      </div></td>
                    </tr>
                    
                  </table>                
<?
mysql_close($dbconn);
?>
