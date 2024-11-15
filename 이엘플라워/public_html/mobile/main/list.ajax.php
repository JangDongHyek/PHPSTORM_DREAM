<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";

$cnt_sql = "select * from $ItemTable where mart_id='$mart_id' and $first_prev='$category_num1_2' and if_hide='0' order by $flag_name $order, item_no desc ";
$cnt_res = mysql_query( $cnt_sql, $dbconn );
$cnt = mysql_num_rows($cnt_res);

if($mode == "cate2_search"){
	$sql0 = "select * from $ItemTable where ($select_key like '%$input_key%') and mart_id='$mart_id' and $first_prev='$category_num1_2' and if_hide='0' order by $flag_name $order, item_no desc limit $olds,$line";		// 3차 상품등록
}else{
	$sql0 = "select * from $ItemTable where mart_id='$mart_id' and $first_prev='$category_num1_2' and if_hide='0' order by $flag_name $order, item_no desc limit $olds,$line";	// 3차 상품등록
}

$res0 = mysql_query( $sql0, $dbconn );

if($cnt < $line) exit;

$i = 0;
while($row0 = mysql_fetch_array($res0)){
	$cate_num = $row0[category_num];
	$item_no = $row0[item_no];
	$item_name = iconv('euc-kr','utf-8',$row0[item_name]);
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

	//$item_name = han_cut2($item_name,40);
	//$short_explain = han_cut($short_explain,28);
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

	if($jaego_use == 1 && $jaego == 0){
		$icon_str = "<img src='../image/soldout_icon_s.gif' width='25' height='12'>";
	}else{
		if($icon_no == 0) $icon_str = "";
		if($icon_no == 1) $icon_str = "<img src='../images/hot.gif' width='22' height='13'>";
		if($icon_no == 2) $icon_str = "<img src='../image/new.gif' width='25' height='14'>";
		if($icon_no == 3) $icon_str = "<img src='../images/sale.gif' width='22' height='13'>";
		if($icon_no == 4) $icon_str = "<img src='../images/reserv.gif' width='53' height='12'>";
	}

	//============================ 상품 이미지 =======================================
	if($img_sml != "" && file_exists("$Co_img_UP$mart_id/$img_sml")){
		if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_sml' class='img'>";
		}
		if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_sml'></embed>";
		}
	}else if($img != "" && file_exists("$Co_img_UP$mart_id/$img")){
		if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img' class='img'>";
		}
		if (strstr(strtolower(substr($img,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img'></embed>";
		}
	}else if($img_big != "" && file_exists("$Co_img_UP$mart_id/$img_big")){
		if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_big' class='img'>";
		}
		if (strstr(strtolower(substr($img_big,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_big'></embed>";
		}
	}else{
		$img_str = "<img src='../image/noimage_s.gif' class='img'>";
	}
	if($jaego_use == 1 && $jaego == 0){
			$icon_str = "<img src='../../market/image/soldout_icon_s.gif' align='absmiddle' style='width:50px;height:auto'>";
		}else{
			if($icon_no == 0) $icon_str = "";
			if($icon_no == 1) $icon_str = "<img src='../../market/image/1.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 2) $icon_str = "<img src='../../market/image/2.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 3) $icon_str = "<img src='../../market/image/3.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 4) $icon_str = "<img src='../../market/image/4.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 5) $icon_str = "<img src='../../market/image/5.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 6) $icon_str = "<img src='../../market/image/6.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 7) $icon_str = "<img src='../../market/image/7.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 8) $icon_str = "<img src='../../market/image/8.gif' align='absmiddle' style='width:50px;height:auto'>";
			if($icon_no == 9) $icon_str = "<img src='../../market/image/9.gif' align='absmiddle' style='width:50px;height:auto'>";
		}
	$list[$i]['a_link'] = '<a href="product_info.html?mart_id='.$mart_id.'&category_num='.$category_num.'&category_num1='.$category_num1_2.'&category_num2='.$category_num2.'&cate_num='.$cate_num.'&flag='.$flag.'&item_no='.$item_no.'">';
	$list[$i]['img_str'] = $img_str;
	$list[$i]['item_name'] = $item_name;
	$list[$i]['z_price_str'] = $z_price_str;
	$list[$i]['bonus'] = $bonus_str;
	$list[$i]['icon_str']=$icon_str;
	$i++;
}

header("Content-Type:application/json");
echo json_encode($list);
?>